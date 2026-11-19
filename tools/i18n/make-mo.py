#!/usr/bin/env python3
"""Compile languages/<locale>.po into languages/<locale>.mo without WP-CLI or gettext (evive #412).

Usage: python3 -I tools/i18n/make-mo.py nl_NL
Handles msgctxt and single-line or multi-line strings; skips untranslated entries (like msgfmt).
"""
import ast, pathlib, re, struct, sys

root = pathlib.Path(__file__).resolve().parents[2]
locale = sys.argv[1]
po = (root / 'languages' / f'{locale}.po').read_text(encoding='utf-8')

def field(block, name):
    m = re.search(r'^%s ((?:".*"\n?)+)' % name, block, re.M)
    if not m: return None
    return ''.join(ast.literal_eval(part) for part in re.findall(r'"(?:[^"\\]|\\.)*"', m.group(1)))

entries = {}
for block in re.split(r'\n\s*\n', po):
    block = '\n'.join(l for l in block.splitlines() if not l.startswith('#')) + '\n'
    mid, mstr, ctx = field(block, 'msgid'), field(block, 'msgstr'), field(block, 'msgctxt')
    if mid is None or (mid != '' and not mstr): continue
    entries[(ctx + '\x04' + mid) if ctx else mid] = mstr

keys = sorted(entries, key=lambda k: k.encode('utf-8'))
ids = [k.encode('utf-8') for k in keys]; strs = [entries[k].encode('utf-8') for k in keys]
n = len(keys); start = 28 + 16 * n
table_ids, table_strs, data = [], [], b''
for s in ids: table_ids.append((len(s), start + len(data))); data += s + b'\0'
for s in strs: table_strs.append((len(s), start + len(data))); data += s + b'\0'
out = struct.pack('<7I', 0x950412de, 0, n, 28, 28 + 8 * n, 0, start)
out += b''.join(struct.pack('<2I', *t) for t in table_ids) + b''.join(struct.pack('<2I', *t) for t in table_strs) + data
(root / 'languages' / f'{locale}.mo').write_bytes(out)
print(f'{locale}.mo: {n - ("" in entries)} strings')
