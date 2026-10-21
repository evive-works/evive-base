# Changelog — evive-base

All notable changes. Semantic versioning: a slug change in the token contract is a major release.

## 0.1.1 — 2026-10-21
- Updates from GitHub Releases via Plugin Update Checker v5.7 (same library as invaise-checkout). Off with `EVIVE_BASE_AUTO_UPDATE` = false or the `evive_auto_update` filter; `EVIVE_GITHUB_OWNER` / `EVIVE_GITHUB_TOKEN` in wp-config.php. Update checks run in the admin/cron, never on front-end page views.
- `Update URI` header, so WordPress.org can never offer a theme with the same slug as an update.
- `bin/build-release.sh` builds the release asset `dist/evive-base.zip`.

## 0.1.0 — 2026-10-21
- First release: parent block theme skeleton (`style.css`, `theme.json` schema 3, `functions.php`).
- Token contract with neutral defaults: colours `base`, `contrast`, `primary`, `primary-contrast`, `accent`, `accent-contrast`, `surface`, `muted`, `border`; font families `heading`, `body` (system stacks, no web fonts); fluid font sizes `xs`–`xxl`; spacing `10`–`70`; radius `s`, `m`, `l` (`settings.custom.radius`). See `docs/tokens.md`.
- Editor locked to the tokens: no default palette, gradients, duotones, custom colours, custom font or spacing sizes.
- Global styles for body, headings, links, buttons (fill + outline), captions, quotes, code; visible `:focus-visible` rings; `prefers-reduced-motion` support.
- Templates: `index`, `front-page`, `page`, `single`, `archive`, `404`, `search`. Template parts: `header`, `footer` (placeholders).
- Pattern categories: `evive-hero`, `evive-features`, `evive-proof`, `evive-cta`, `evive-content`.
