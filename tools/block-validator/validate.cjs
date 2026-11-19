// node validate.mjs file.html ... : parse block markup and validate every block like the editor does.
require('global-jsdom/register');
window.matchMedia = window.matchMedia || (() => ({ matches: false, addListener() {}, removeListener() {}, addEventListener() {}, removeEventListener() {} }));
globalThis.requestAnimationFrame = (cb) => setTimeout(cb, 0);
const { parse, getBlockType, validateBlock } = require('@wordpress/blocks');
const _log = console.log; console.error = () => {}; console.warn = () => {}; console.info = () => {};
const { registerCoreBlocks } = require('@wordpress/block-library');
registerCoreBlocks();
// evive #407: the evive Forms blocks (plugin evive-forms) with the same save() as the plugin: the form saves only
// its inner blocks, a field saves nothing (both are rendered on the server).
const { registerBlockType } = require('@wordpress/blocks');
const { createElement: el } = require('@wordpress/element');
const { InnerBlocks } = require('@wordpress/block-editor');
registerBlockType('evive/form', { title: 'Form', category: 'widgets', attributes: { formTitle: { type: 'string', default: '' }, notifyTo: { type: 'string', default: '' }, submitLabel: { type: 'string', default: '' }, successMessage: { type: 'string', default: '' }, confirmation: { type: 'boolean', default: false }, confirmationSubject: { type: 'string', default: '' }, confirmationMessage: { type: 'string', default: '' } }, supports: { html: false }, edit: () => null, save: () => el(InnerBlocks.Content) });
registerBlockType('evive/field', { title: 'Form field', category: 'widgets', parent: ['evive/form'], attributes: { type: { type: 'string', default: 'text', enum: ['text', 'email', 'tel', 'textarea', 'select', 'checkbox', 'consent'] }, label: { type: 'string', default: '' }, name: { type: 'string', default: '' }, required: { type: 'boolean', default: false }, placeholder: { type: 'string', default: '' }, help: { type: 'string', default: '' }, options: { type: 'array', default: [], items: { type: 'string' } }, width: { type: 'string', default: 'full', enum: ['full', 'half'] } }, supports: { html: false }, edit: () => null, save: () => null });
// evive #411: the theme's own blocks (blocks/*/index.js), loaded with the same wp.* globals the editor gives them,
// so their markup is checked against their real save().
window.wp = { blocks: require('@wordpress/blocks'), blockEditor: require('@wordpress/block-editor'), element: require('@wordpress/element'), i18n: require('@wordpress/i18n') };
for (const dir of require('fs').readdirSync(__dirname + '/../../blocks')) {
  const js = `${__dirname}/../../blocks/${dir}/index.js`;
  if (!require('fs').existsSync(js)) continue;
  const reg = window.wp.blocks.registerBlockType;
  window.wp.blocks = { ...window.wp.blocks, registerBlockType: (name, settings) => {
    const meta = JSON.parse(require('fs').readFileSync(`${__dirname}/../../blocks/${name.split('/')[1]}/block.json`, 'utf8'));
    return reg(name, { ...meta, ...settings });
  } };
  require(js);
  window.wp.blocks = require('@wordpress/blocks');
}
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
