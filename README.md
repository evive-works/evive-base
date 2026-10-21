# evive-base

Neutral WordPress parent **block theme** of the evive rebuild service (StackPros B.V.). Every customer site gets a child theme on top of it, and the child only sets brand values.

- **Token contract:** [`docs/tokens.md`](docs/tokens.md) lists every slug, its role, the neutral default and the contrast rule a child palette must meet. Child themes override values, never slugs.
- **Rules for working in this repo:** [`CLAUDE.md`](CLAUDE.md).
- **Changes:** [`CHANGELOG.md`](CHANGELOG.md).

## Requirements
WordPress 6.6+ (theme.json schema 3), PHP 8.1+. Works on single site and Multisite. Nothing in the theme is Multisite-specific.

## Child theme quick start
```
wp-content/themes/<customer>/
  style.css      /* Theme Name: …  Template: evive-base */
  theme.json     /* version 3; override palette values, fontFamilies (+ self-hosted fontFace), etc. */
  assets/fonts/  /* self-hosted woff2 */
```

## What's in it
| Path | Contents |
|---|---|
| `theme.json` | Tokens, editor restrictions, global styles |
| `templates/` | `index`, `front-page`, `page`, `single`, `archive`, `404`, `search` |
| `parts/` | `header`, `footer` |
| `patterns/` | Hidden helper patterns used by templates (translatable strings); generic patterns follow in later releases |
| `assets/css/base.css` | Focus rings, reduced motion, form inputs — tokens only |

`front-page.html` renders a static front page's content without a title (the H1 comes from the page's hero). When the front page shows the latest posts, the theme falls back to `index.html`.

## Release and deploy
Releases are tagged `vX.Y.Z` on `main`, with a `CHANGELOG.md` entry. The auto-update mechanism and the release procedure come with card WAW 0.4. During the whyatwork.nl build, any branch can be deployed to staging with `bin/deploy-staging.sh base=<branch>` from the whyatwork-site repo.
