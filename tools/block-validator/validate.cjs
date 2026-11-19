// node validate.mjs file.html ... : parse block markup and validate every block like the editor does.
require('global-jsdom/register');
window.matchMedia = window.matchMedia || (() => ({ matches: false, addListener() {}, removeListener() {}, addEventListener() {}, removeEventListener() {} }));
globalThis.requestAnimationFrame = (cb) => setTimeout(cb, 0);
const { parse, getBlockType, validateBlock } = require('@wordpress/blocks');
const _log = console.log; console.error = () => {}; console.warn = () => {}; console.info = () => {};
const { registerCoreBlocks } = require('@wordpress/block-library');
registerCoreBlocks();
const fs = require('fs');
// evive #412: register the theme's own blocks too (blocks/<name>/block.json + the editor's index.js, with the
// npm packages standing in for window.wp), so markup that uses them is validated against their save().
const path = require('path');
const themeBlocks = path.resolve(__dirname, '../../blocks');
if (fs.existsSync(themeBlocks)) {
  const blocks = require('@wordpress/blocks');
  for (const dir of fs.readdirSync(themeBlocks)) {
    const meta = JSON.parse(fs.readFileSync(path.join(themeBlocks, dir, 'block.json'), 'utf8'));
    window.wp = globalThis.wp = {
      blocks: { ...blocks, registerBlockType: (name, settings) => blocks.registerBlockType({ ...meta, name }, settings) },
      element: require('@wordpress/element'), blockEditor: require('@wordpress/block-editor'),
      components: require('@wordpress/components'), i18n: require('@wordpress/i18n'),
    };
    require(path.join(themeBlocks, dir, 'index.js'));
    if (!getBlockType(meta.name)) _log(`theme block ${meta.name} did not register`);
  }
}
let bad = 0, total = 0;
function walk(blocks, file) {
  for (const b of blocks) {
    if (!b.name) continue;
    total++;
    if (!getBlockType(b.name)) { _log(`${file}: unregistered ${b.name}`); continue; }
    const [ok, vi] = validateBlock(b);
    if (!ok) {
      bad++;
      const { getSaveContent } = require('@wordpress/blocks');
      const exp = getSaveContent(b.name, b.attributes, b.innerBlocks).replace(/\s+/g, ' ');
      const got = (b.originalContent || '').replace(/\s+/g, ' ');
      let i = 0; while (i < exp.length && exp[i] === got[i]) i++;
      _log(`${file}: INVALID ${b.name}\n    expected: …${exp.slice(Math.max(0, i - 60), i + 140)}\n    actual:   …${got.slice(Math.max(0, i - 60), i + 140)}`);
    }
    walk(b.innerBlocks, file);
  }
}
for (const f of process.argv.slice(2)) walk(parse(fs.readFileSync(f, 'utf8')), f);
_log(`checked ${total} blocks, ${bad} invalid`);
