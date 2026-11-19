# Pattern screenshots (`docs/patterns/`)

How the screenshots in `docs/patterns.md` are made (evive #482). Every pattern gets three WebP files:

| File | Palette | Viewport | Saved at |
|---|---|---|---|
| `<pattern>-default-1280.webp` | evive-base defaults (`theme.json`) | 1280 × 900 | 960 wide |
| `<pattern>-dark-1280.webp` | dark-primary test palette (`palettes.json`) | 1280 × 900 | 960 wide |
| `<pattern>-default-390.webp` | evive-base defaults | 390 × 844 (phone) | 390 wide |

The shot is only the pattern: the box around everything inside the post content (also parts that stick out of the
section), not the header, page title or footer. Rendered from **evive-base alone** (neutral tokens, no child theme), so
no customer brand ends up in the docs. Never shoot staging (whyatwork.cloud): it runs the Why at Work child theme.

## One command per batch (on the M)

```sh
sudo /usr/local/sbin/evive-base-test-gate up <card>          # throwaway site https://c<card>-t.evive.works/ with branch card-<card>
node tools/pattern-shots/shoot.mjs --card <card> steps bento pricing-plans   # names after "evive/"
sudo /usr/local/sbin/evive-base-test-gate down <card>        # when done
```

`shoot.mjs` creates (or replaces) the page `/pattern-<name>/` on the test site with only `<!-- wp:pattern
{"slug":"evive/<name>"} /-->` in it, then takes the three shots per pattern and writes them to `docs/patterns/`.
Add the section to `docs/patterns.md` by hand (title, slug and category, a short description, the three-image table;
copy one of the existing sections).

What it does per shot:
- a fresh browser context at the viewport above, device scale 1, `prefers-reduced-motion: reduce` (moving strips and
  carousels stand still);
- the palette is set by overriding the preset custom properties `--wp--preset--color--<slug>` on `:root` (evive-base
  never redefines them lower down, so every block follows); the `default` palette overrides nothing;
- the cookie banner (`#evive-cb`) is hidden;
- it scrolls the whole page and waits for every image and web font (lazy images), and notes the layout at the real
  viewport (the pattern's box and the font sizes of its first text elements);
- it then makes the viewport as tall as the page (same width, so `vw`-based fluid sizes stay the same) and takes a plain
  shot clipped to the pattern's box. No `fullPage` shot: that lets Chromium resize the page during capture, and now and
  then the fluid font sizes came out too small in the shot (a smaller text, or an empty band at the bottom);
- every shot is taken twice; both must be identical and the layout must match the one at the real viewport before
  and after. Otherwise it retries (up to 3 times, printed as `retry ...`) and then reports a `PROBLEM` without writing
  the file;
- the PNG is scaled and encoded to WebP (quality 0.85) inside the browser, so no image tools are needed.

Console errors and failing requests are printed as `PROBLEM ...` and give exit code 2 (the files are still written;
look at them). A shot that stays unstable after 3 tries also gives `PROBLEM` and exit code 2, and its file is not written.

Options: `--only default,dark,mobile` (a subset), `--out <dir>`, `--quality 0.85`, and `--site <url> --no-pages` for any
other WordPress site with evive-base active where the `/pattern-<name>/` pages already exist (for example a local
WordPress or WordPress Playground; the page template must not add anything inside the post content).

Needs Node 18+ and `playwright-core` with Chromium: on the M it is taken from `~/tools/node_modules`; elsewhere
`npm i playwright-core && npx playwright-core install chromium` in this folder, or set `PLAYWRIGHT_CORE_DIR`.

## The dark-primary test palette

`palettes.json` → `dark`: the test palette of card D.1, a deep green primary with an orange accent. Batch 1
did not record its values; primary `#0f3d2e`, accent `#f4a259`, surface `#eff4f0` and contrast `#17221d` were
sampled from the batch 1 dark screenshots (19 Nov 2026), muted and border were chosen to match. All pairs pass
`tools/contrast-check.py` (contrast 16.4, primary on base 12.2, accent-contrast on accent 8.1, muted on base 6.9).
Change a value only together with new dark shots for every pattern, or the docs will mix two palettes.

Batch 1 shots have the same file names, sizes and palette, but were made in an unrecorded way with other system fonts,
so their text looks slightly different from batch 2 (evive-base loads no web fonts; the font comes from the system).
