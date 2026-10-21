// node validate.mjs file.html ... : parse block markup and validate every block like the editor does.
require('global-jsdom/register');
window.matchMedia = window.matchMedia || (() => ({ matches: false, addListener() {}, removeListener() {}, addEventListener() {}, removeEventListener() {} }));
globalThis.requestAnimationFrame = (cb) => setTimeout(cb, 0);
const { parse, getBlockType, validateBlock } = require('@wordpress/blocks');
const _log = console.log; console.error = () => {}; console.warn = () => {}; console.info = () => {};
const { registerCoreBlocks } = require('@wordpress/block-library');
registerCoreBlocks();
const fs = require('fs');
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
