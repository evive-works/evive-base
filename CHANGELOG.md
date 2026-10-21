# Changelog — evive-base

All notable changes. Semantic versioning: a slug change in the token contract is a major release.

## 0.3.1 — 2026-10-21
- Icon images in the feature patterns carry the class `evive-icon`, so child themes can style icon tiles without also hitting logos or avatars.

## 0.3.0 — 2026-10-21
- Pattern library, batch 1 (see `docs/patterns.md` with screenshots): heroes `evive/hero-media`, `hero-split`, `hero-page`, `hero-primary`; features `evive/features-cards`, `features-alternating`, `features-icon-list`; CTA bands `evive/cta-primary`, `cta-surface`; `evive/faq`; proof `evive/logo-wall`, `testimonial`, `testimonials-grid`, `stats`.
- Token contract, additive: shadow presets `s`, `m`, `l` (built from `contrast` with `color-mix()`).
- Block styles for Group: **Card** and **Motif**.
- FAQ structured data (`FAQPage` JSON-LD) generated from the Details blocks inside a group with class `evive-faq`.
- New template "Page without title" (`page-no-title`) for pages that start with a hero.
- Neutral placeholder art in `assets/images/` (image, logo, icon, avatar).
- Fix: header button markup matched the block's saved HTML (no "invalid block" in the editor).

## 0.2.0 — 2026-10-21
- Generic header (pattern `evive/header`): site logo linking home (site title as fallback, hidden once a logo is set), navigation with the core mobile overlay menu, language-switcher slot (renders `evive-language/switcher` only when that plugin is active), call-to-action button editable in the Site Editor.
- Header variations: `evive/header-no-cta`, `evive/header-sticky` (sticky with a bottom border).
- Generic footer (pattern `evive/footer`): logo + tagline, three link columns (navigation blocks), legal line with year and site title, social links. Variation `evive/footer-simple`.
- Mobile menu toggle gets `aria-expanded` (core only sets `aria-haspopup`). Focus trap, Escape and focus return come from core and were verified.
- Templates use real `<header>` and `<footer>` landmarks. Short pages keep the footer at the bottom of the viewport.
- Empty social-links blocks (no URLs yet) render nothing instead of an empty list.

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
