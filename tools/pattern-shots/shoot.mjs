#!/usr/bin/env node
// Pattern screenshots for docs/patterns.md (evive #482). See README.md next to this file.
//
//   node tools/pattern-shots/shoot.mjs --card <card> <pattern> [<pattern> ...]
//   node tools/pattern-shots/shoot.mjs --site <url> --no-pages <pattern> [...]
//
// <pattern> is the part after "evive/" (steps, pricing-plans, ...). Per pattern it writes three files to docs/patterns/:
//   <pattern>-default-1280.webp  default palette, viewport 1280, saved at 960 wide (same as batch 1)
//   <pattern>-dark-1280.webp     dark-primary test palette (palettes.json), viewport 1280, saved at 960 wide
//   <pattern>-default-390.webp   default palette, viewport 390 (phone), saved at 390 wide
// The shot is the pattern only: the box around everything inside the post content (also parts that stick out),
// not the header, the page title or the footer.
//
// --card <n>     use the evive-base test site https://c<n>-t.evive.works/ (evive-base-test-gate up <n> first) and
//                create/replace the page /pattern-<pattern>/ there with the pattern block (sudo evive-base-test-gate page).
// --site <url>   any WordPress site with evive-base active (no child theme), e.g. a local one.
// --no-pages     the pages /pattern-<pattern>/ exist already; don't create them.
// --out <dir>    output folder (default docs/patterns).
// --only <list>  comma list of variants: default,dark,mobile (default all three).
// --quality <q>  WebP quality 0-1 (default 0.85).
// Exit code 2 when a page had console errors or failing requests (the shots are still written; look at them), or when
// no stable shot could be made in 3 tries (that file is not written).
import { execFileSync } from 'node:child_process';
import { createRequire } from 'node:module';
import fs from 'node:fs';
import os from 'node:os';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const here = path.dirname(fileURLToPath(import.meta.url));
const repo = path.resolve(here, '../..');

// playwright-core: from this repo if installed, else from $PLAYWRIGHT_CORE_DIR or ~/tools (the M).
async function loadChromium() {
  try { return (await import('playwright-core')).chromium; } catch {}
  for (const dir of [process.env.PLAYWRIGHT_CORE_DIR, path.join(os.homedir(), 'tools')].filter(Boolean)) {
    try { return createRequire(path.join(dir, 'package.json'))('playwright-core').chromium; } catch {}
  }
  console.error('playwright-core not found: npm i playwright-core (and npx playwright-core install chromium), or set PLAYWRIGHT_CORE_DIR');
  process.exit(1);
}

const args = process.argv.slice(2);
const opt = { out: path.join(repo, 'docs/patterns'), only: 'default,dark,mobile', quality: 0.85, pages: true };
const patterns = [];
for (let i = 0; i < args.length; i++) {
  const a = args[i];
  if (a === '--card') opt.card = args[++i];
  else if (a === '--site') opt.site = args[++i];
  else if (a === '--out') opt.out = path.resolve(args[++i]);
  else if (a === '--only') opt.only = args[++i];
  else if (a === '--quality') opt.quality = Number(args[++i]);
  else if (a === '--no-pages') opt.pages = false;
  else if (a.startsWith('--')) { console.error('unknown option ' + a); process.exit(1); }
  else patterns.push(a.replace(/^evive\//, ''));
}
if (opt.card && !/^\d{1,6}$/.test(opt.card)) { console.error('--card needs a card number'); process.exit(1); }
if (!opt.site && opt.card) opt.site = `https://c${opt.card}-t.evive.works/`;
if (!opt.site || !patterns.length) {
  console.error('usage: shoot.mjs --card <card> <pattern...>   or   shoot.mjs --site <url> --no-pages <pattern...>'); process.exit(1);
}
if (opt.pages && !opt.card) { console.error('creating pages needs --card (the test gate); use --no-pages with --site'); process.exit(1); }
for (const p of patterns) {
  if (!/^[a-z0-9-]+$/.test(p)) { console.error('bad pattern name ' + p); process.exit(1); }
  if (!fs.existsSync(path.join(repo, 'patterns', p + '.php'))) console.warn(`warning: patterns/${p}.php not in this checkout`);
}
const site = opt.site.replace(/\/?$/, '/');
const palettes = JSON.parse(fs.readFileSync(path.join(here, 'palettes.json'), 'utf8'));
const VARIANTS = {
  default: { palette: 'default', width: 1280, height: 900, saveWidth: 960, suffix: 'default-1280' },
  dark:    { palette: 'dark',    width: 1280, height: 900, saveWidth: 960, suffix: 'dark-1280' },
  mobile:  { palette: 'default', width: 390,  height: 844, saveWidth: 390, suffix: 'default-390' },
};
const variants = opt.only.split(',').map(s => s.trim()).filter(Boolean);
for (const v of variants) if (!VARIANTS[v]) { console.error('unknown variant ' + v); process.exit(1); }
fs.mkdirSync(opt.out, { recursive: true });

// 1. One page per pattern, with only the pattern block in it.
if (opt.pages) {
  for (const p of patterns) {
    const r = execFileSync('sudo', ['/usr/local/sbin/evive-base-test-gate', 'page', opt.card, 'pattern-' + p],
      { input: `<!-- wp:pattern {"slug":"evive/${p}"} /-->\n`, encoding: 'utf8' });
    console.log(r.trim().split('\n').pop());
  }
}

// The pattern's box (union of everything inside the post content, in page coordinates, viewport width) plus a layout
// key: the box and the computed font size of the first text elements. Runs in the page.
function layout() {
  const pc = document.querySelector('.wp-block-post-content, .entry-content');
  if (!pc || !pc.children.length) return null;
  let t = Infinity, b = -Infinity;
  for (const el of [...pc.children, ...pc.querySelectorAll('*')]) {
    const r = el.getBoundingClientRect(); const cs = getComputedStyle(el);
    if (!r.width || !r.height || cs.visibility === 'hidden' || cs.display === 'none') continue;
    t = Math.min(t, r.top + scrollY); b = Math.max(b, r.bottom + scrollY);
  }
  const y = Math.max(0, Math.floor(t)), height = Math.ceil(b - y), width = document.documentElement.clientWidth;
  const fonts = [...pc.querySelectorAll('p, h1, h2, h3, li')].slice(0, 6).map(e => getComputedStyle(e).fontSize).join(',');
  return { y, width, height, key: `${width}x${height}@${y} ${fonts}` };
}

// 2. Screenshots.
const chromium = await loadChromium();
const browser = await chromium.launch();
let problems = 0;
for (const p of patterns) {
  const url = site + 'pattern-' + p + '/';
  for (const name of variants) {
    const v = VARIANTS[name];
    const ctx = await browser.newContext({ viewport: { width: v.width, height: v.height }, deviceScaleFactor: 1, reducedMotion: 'reduce' });
    const page = await ctx.newPage();
    const issues = [];
    page.on('console', m => { if (m.type() === 'error') issues.push('console: ' + m.text()); });
    page.on('pageerror', e => issues.push('pageerror: ' + e.message));
    page.on('response', r => { if (r.status() >= 400) issues.push(`${r.status()} ${r.url()}`); });
    const resp = await page.goto(url, { waitUntil: 'networkidle', timeout: 60000 });
    if (!resp || resp.status() !== 200) { console.error(`${url}: HTTP ${resp ? resp.status() : '?'}`); problems++; await ctx.close(); continue; }
    // Palette override: the preset custom properties on :root (nothing in evive-base redefines them lower down).
    const pal = palettes[v.palette] || {};
    const vars = Object.entries(pal).map(([slug, val]) => `--wp--preset--color--${slug}: ${val} !important;`).join(' ');
    // No cookie banner in the shot.
    await page.addStyleTag({ content: `:root { ${vars} } #evive-cb { display: none !important; }` });
    // Scroll down and back so lazy images load, then wait for every image.
    await page.evaluate(async () => {
      for (let y = 0; y < document.body.scrollHeight; y += 400) { window.scrollTo(0, y); await new Promise(r => setTimeout(r, 60)); }
      window.scrollTo(0, 0);
      await Promise.all([...document.images].map(i => i.complete ? null : new Promise(r => { i.onload = i.onerror = r; })));
      if (document.fonts) await document.fonts.ready;
    });
    await page.waitForTimeout(400);
    // evive #482 (test fail): a fullPage shot let Chromium resize the page during capture, and now and then the fluid
    // font sizes (vw) were laid out wrong in the shot. So: measure the layout at the real viewport, make the viewport
    // as tall as the page (the width stays), take plain clip shots (no resize during capture), take every shot twice
    // and check that both are identical and the layout still matches. Retry up to 3 times, else report a PROBLEM.
    const ref = await page.evaluate(layout);
    if (!ref) { console.error(`${url}: no post content found`); problems++; await ctx.close(); continue; }
    let png = null, box = null, why = '';
    for (let attempt = 1; attempt <= 3 && !png; attempt++) {
      for (let k = 0; k < 3; k++) { // the page height can follow the viewport height (min-height: 100vh); settle it
        const h = await page.evaluate(() => document.documentElement.scrollHeight);
        if (h === page.viewportSize().height) break;
        await page.setViewportSize({ width: v.width, height: Math.max(v.height, h) });
        await page.evaluate(() => new Promise(r => requestAnimationFrame(() => requestAnimationFrame(r))));
      }
      await page.evaluate(async () => {
        await Promise.all([...document.images].map(i => i.complete ? null : new Promise(r => { i.onload = i.onerror = r; })));
        window.scrollTo(0, 0);
      });
      await page.waitForTimeout(300);
      const before = await page.evaluate(layout);
      box = { x: 0, y: before.y, width: before.width, height: before.height };
      const a = await page.screenshot({ clip: box });
      const b = await page.screenshot({ clip: box });
      const after = await page.evaluate(layout);
      if (before.key !== ref.key) why = `layout differs from the ${v.width}x${v.height} viewport (${before.key} vs ${ref.key})`;
      else if (after.key !== before.key) why = `layout changed during the shot (${after.key} vs ${before.key})`;
      else if (!a.equals(b)) why = 'two shots in a row differ';
      else { png = a; why = ''; }
      if (why) console.log(`  retry ${attempt} (${p}, ${name}): ${why}`);
    }
    if (!png) { console.log(`  PROBLEM ${url} (${name}): no stable shot: ${why}`); problems++; await ctx.close(); continue; }
    // WebP encoding in the browser (no image tools needed), scaled to the batch 1 width.
    const webp = await page.evaluate(async ({ b64, w, q }) => {
      const img = new Image(); img.src = 'data:image/png;base64,' + b64; await img.decode();
      const h = Math.round(img.height * w / img.width);
      const c = document.createElement('canvas'); c.width = w; c.height = h;
      const x = c.getContext('2d'); x.imageSmoothingQuality = 'high'; x.drawImage(img, 0, 0, w, h);
      return c.toDataURL('image/webp', q).split(',')[1];
    }, { b64: png.toString('base64'), w: v.saveWidth, q: opt.quality });
    const file = path.join(opt.out, `${p}-${v.suffix}.webp`);
    fs.writeFileSync(file, Buffer.from(webp, 'base64'));
    console.log(`${path.relative(process.cwd(), file)}  ${v.saveWidth}x${Math.round(box.height * v.saveWidth / box.width)}  (${url}, ${name})`);
    for (const i of issues) { console.log('  PROBLEM ' + i); }
    if (issues.length) problems++;
    await ctx.close();
  }
}
await browser.close();
process.exit(problems ? 2 : 0);
