#!/usr/bin/env python3
# WCAG contrast check of a theme.json palette against the evive token contract.
# Usage: tools/contrast-check.py path/to/theme.json [label]   (a child theme.json only needs the slugs it overrides
# when merged by hand; pass the full palette).
import sys,json
def lum(h):
    h=h.lstrip('#'); r,g,b=[int(h[i:i+2],16)/255 for i in (0,2,4)]
    f=lambda c: c/12.92 if c<=0.03928 else ((c+0.055)/1.055)**2.4
    return 0.2126*f(r)+0.7152*f(g)+0.0722*f(b)
def cr(a,b):
    la,lb=sorted([lum(a),lum(b)],reverse=True); return (la+0.05)/(lb+0.05)
PAIRS=[('contrast','base',4.5),('contrast','surface',4.5),('primary','base',4.5),('primary-contrast','primary',4.5),
       ('accent-contrast','accent',4.5),('muted','base',4.5),('muted','surface',4.5),('primary','surface',4.5),('muted','base',3.0,'input border (non-text)')]
def check(name,pal,extra=[]):
    print(f'## {name}')
    for p in PAIRS+extra:
        fg,bg,mn=p[:3]; r=cr(pal[fg],pal[bg]); note=p[3] if len(p)>3 else 'text'
        print(f'| {fg} {pal[fg]} on {bg} {pal[bg]} | {r:.2f}:1 | {"PASS" if r>=mn else "FAIL"} (≥{mn}, {note}) |')
if __name__=='__main__':
    t=json.load(open(sys.argv[1])); pal={c['slug']:c['color'] for c in t['settings']['color']['palette']}
    check(sys.argv[2] if len(sys.argv)>2 else sys.argv[1],pal)
