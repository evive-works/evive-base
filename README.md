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

## Updates and releases
Sites get new versions through WordPress's own update screen (Network Admin → Updates), from **GitHub Releases** of this repo. It uses the same library as our other distributed plugins (invaise-checkout, evive Connector): [Plugin Update Checker v5](https://github.com/YahnisElsts/plugin-update-checker) (MIT), bundled in `lib/plugin-update-checker/`, wired up in `inc/updates.php`. Like every update, the click on "Update" stays manual.

Settings in `wp-config.php` (all optional):
| Constant | Effect |
|---|---|
| `EVIVE_BASE_AUTO_UPDATE` = `false` | No update checks for this theme (the filter `evive_auto_update` can do the same) |
| `EVIVE_GITHUB_OWNER` | GitHub account holding the repo (default `stackpros`) |
| `EVIVE_GITHUB_TOKEN` | Read-only token; only needed while the repo is **private** |

### Release procedure
1. On a branch: bump `Version:` in `style.css` and `EVIVE_BASE_VERSION` in `functions.php`; add a `## X.Y.Z — date` entry to `CHANGELOG.md`. Merge to `main`.
2. `git tag -a vX.Y.Z -m "evive-base X.Y.Z" && git push origin main vX.Y.Z`
3. `bin/build-release.sh vX.Y.Z` → `dist/evive-base.zip`. It checks that every version number matches the tag, then builds the zip with top folder `evive-base/` and without dev files.
4. Create the GitHub release `vX.Y.Z` with that zip as an asset, named exactly `evive-base.zip`. The notes are the CHANGELOG entry: `gh release create vX.Y.Z dist/evive-base.zip --title "X.Y.Z" --notes "…"`
5. Sites see "Update available" at their next check (every 12 hours, or right away via Dashboard → Updates → "Check again"). Check one site after the update.

Never break a child theme or a site in a minor or patch release (see `CHANGELOG.md` and `CLAUDE.md`).

### Staging without a release
While building, deploy any branch straight to whyatwork.cloud from the whyatwork-site repo: `bin/deploy-staging.sh base=<branch>` (add `--working-tree` for uncommitted changes). The version number doesn't change, so the updater isn't involved.
