#!/usr/bin/env python3
"""evive #411: JSON translations for the editor scripts of the theme blocks (blocks/*/index.js).

Usage: python3 -I tools/i18n/build-json.py nl_NL
Writes languages/evive-<locale>-<md5 of the script path>.json (the file WordPress's load_script_textdomain looks
for, same format as `wp i18n make-json`) from the translations table, for every __( '...', 'evive' ) in the script.
"""
import hashlib, importlib.util, json, pathlib, re, sys

root = pathlib.Path(__file__).resolve().parents[2]
locale = sys.argv[1]
spec = importlib.util.spec_from_file_location('tbl', root / 'tools/i18n' / f'{locale}.py')
tbl = importlib.util.module_from_spec(spec); spec.loader.exec_module(tbl)
for js in sorted((root / 'blocks').glob('*/index.js')):
    rel = js.relative_to(root).as_posix()
    ids = sorted(set(re.findall(r"__\( '((?:[^'\\]|\\.)+)', 'evive' \)", js.read_text())))
    msgs = {'': {'domain': 'messages', 'lang': locale, 'plural-forms': 'nplurals=2; plural=(n != 1);'}}
    missing = [i for i in ids if i not in tbl.T]
    msgs.update({i: [tbl.T[i]] for i in ids if i in tbl.T})
    out = root / 'languages' / f'evive-{locale}-{hashlib.md5(rel.encode()).hexdigest()}.json'
    data = {'translation-revision-date': '', 'generator': 'evive tools/i18n', 'source': rel, 'domain': 'messages', 'locale_data': {'messages': msgs}}
    out.write_text(json.dumps(data, ensure_ascii=False, indent='\t') + '\n')
    print(f'{rel} -> {out.name}: {len(ids) - len(missing)} translated, {len(missing)} missing')
    for m in missing: print('  missing:', m)
