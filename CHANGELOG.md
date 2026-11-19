# Changelog — evive-base

All notable changes. Semantic versioning: a slug change in the token contract is a major release.

## Unreleased
- Fix: a sticky header now actually sticks. In a block theme the header group sits inside `<header class="wp-block-template-part">`, which is exactly as tall as the group, so the group had no room to move. When the header part holds a sticky group (pattern `evive/header-sticky`, or the header group set to sticky), the wrapper itself is sticky, with a background, below the admin bar when logged in (no offset up to 600px, where the admin bar scrolls away). Anchor links land below the header (`scroll-padding-top`); a small deferred script (`assets/js/sticky-header.js`, only on pages with a sticky group) keeps that offset equal to the header's real height, 6rem without JavaScript. Headers that are not sticky are unchanged (evive #513).

## 0.8.0 — 2026-11-19
- New pattern `evive/team` (category Content): a grid of people with a square photo with rounded corners (radius `l`), name, role and a LinkedIn link (Social Icons block, logos only, in the `muted` colour, `primary` on hover). Four per row on wide screens (the column count in the grid settings, so three is one click), two per row on phones (evive #406).
- nl_NL translations for the new strings (284 of 284).
- New pattern `evive/contact` (category Call to action): contact or demo request section with a small label, heading, intro and contact details (email, phone, address; links where they have one) on one side, and a form in a card on the other: name, email (both required, side by side), company, message (required). The form is the "Form" block of the evive Forms plugin (spam trap, minimum fill time and rate limit, entries, mail via `wp_mail`, so via FluentSMTP where that is set up). Without evive Forms active the form side stays empty. Stacks on phones, text first (evive #407).
- nl_NL translations for the new strings (298 of 298).
- Block validator: also checks the evive Forms blocks (`evive/form`, `evive/field`, with the plugin's own `save()`), and installs again from a clean checkout: one `@wordpress/element` (two copies turned every rich text into `<div>` and failed every pattern), lockfile in sync with `package.json`.
- New pattern `evive/blog-teasers` (category Content): the three latest posts as cards (featured image, category, title, excerpt, date) with an "All articles" link to the posts page (or the home page when the latest posts are on the front page). The cards fill themselves; with one or two posts the row shows fewer cards, with none it shows "No articles yet.". Three per row on wide screens, one on phones (evive #408).
- nl_NL translations for the new strings (284 of 284).
- Block validator: `validate.sh` stubs `get_permalink()` (evive #408).
- New pattern `evive/integrations` (category Features): section heading, a row of static category labels (pills, the active one on the primary colour; plain text, not a working filter) and a grid of integration tiles with logo, name and one line. Four columns on wide screens, two on tablets, one on phones, where each tile becomes a compact row with the logo on the left (evive #409).
- nl_NL translations for the new strings (289 of 289).
- New pattern `evive/testimonial-photo` ("Testimonial: large photo", category Proof): a large portrait photo (4:5, cropped to fill) next to a big quote with an opening quote mark in the primary colour, name, role and company logo, on the surface colour. On phones the photo stacks above the quote. New placeholder image `placeholder-portrait.svg` (evive #410).
- nl_NL translations for the new strings (282 of 282).
- New block **Tabs** (`evive/tabs`, with inner `evive/tab` blocks; theme blocks live in the new folder `blocks/`): content in tabs, each tab holding any blocks; starts with three tabs. Accessible tab list (WAI-ARIA tabs: `role="tablist"`/`tab`/`tabpanel`, arrow keys, Home and End, roving focus), works with mouse and touch. Without JavaScript the tab list stays hidden and every tab is shown with its label as a heading. Its small script and CSS load only on pages that use the block. Both blocks save only their inner blocks (labels in the block comment, tab list rendered in PHP), so later markup changes don't invalidate saved content (evive #411).
- Block validator also checks the theme's own blocks against their real `save()`; `tools/i18n/build-json.py` makes the JSON translations for block editor scripts.
- nl_NL translations for the new strings (293 of 293, editor script 7 of 7).
- New block **Before / after** (`evive/before-after`, in `blocks/before-after/`): two images with a divider the visitor drags with the mouse or by touch (a sideways drag; vertical swipes still scroll the page) or moves with the keyboard and screen readers through a range input (arrow keys, Page Up/Down, Home/End). Labels "Before"/"After" (editable per block), start position of the divider, wide/full alignment. Without JavaScript both images are shown side by side (stacked on phones) with their labels. Its script and styles load only on pages that use the block. The block saves two ordinary Image blocks, so alt text and the media library work as usual. New placeholder art `placeholder-before.svg` / `placeholder-after.svg` (evive #412).
- The theme registers every block in `blocks/*/block.json`; asset versions follow the theme version.
- Dev tools: the block validator also validates the theme's own blocks; `tools/i18n/make-mo.py` compiles a .po without WP-CLI.
- nl_NL translations for the new strings (291 of 291).
- New block style **Moving strip** for Group, made for the logo wall (`evive/logo-wall`): the logos glide slowly in an endless loop, CSS only (the theme repeats the logos server-side; the copies are `aria-hidden` and `inert`). Pauses on hover, on keyboard focus and with a "Pause animation" checkbox under the strip; with reduced motion, and without JavaScript, it stands still as a normal scrollable row (evive #413).
- New block style **Carousel** for Columns, made for the testimonials (`evive/testimonials-grid`): a scroll-snap row (one card on phones, two on tablets/laptops, three on wide screens from four columns), with previous/next buttons from a small deferred script (`assets/js/carousel.js`, only loaded on pages with a carousel). Without JavaScript it is a normal scrollable row (evive #413).
- nl_NL translations for the new strings (285 of 285).
- New paragraph style "Count up" (`is-style-count-up`): a number that counts up from 0 once, when it scrolls into view (IntersectionObserver, about 1.6 s). The real number stays in the HTML, so search engines, visitors without JavaScript and visitors with reduced motion see the final number at once and nothing counts. Prefix and suffix stay (`€`, `+`, `%`), the thousands separator and decimals are kept (`1,200`, `1.200`, `4,8`); text with more than one number (`24/7`) is left alone. The script (`assets/js/count-up.js`, deferred, in the footer) loads only on pages with such a paragraph. `evive/stats` uses the style on its numbers; pages already built from the pattern get it by picking the style on a number (evive #414).
- nl_NL translations for the style name and the new pattern description (280 of 280).

## 0.7.1 — 2026-11-18
- Fix: the "Phone" image style now has a fixed phone shape (9:19.5). A screenshot of any size fills the screen from the top and is cut off at the bottom, instead of being shrunk with white bands beside it; inside the CTA band (`evive/cta-media`) the frame follows the height cap (evive #402).
- New image style "Phone, floating": the same phone turned slightly in 3D, with a metal edge, a side button and a soft shadow below. Phone corners and notch now scale with the phone size. In the CTA band both phone styles stand inside the band instead of resting on its bottom edge (evive #402).
- nl_NL translations for the new style name (279 of 279).

## 0.7.0 — 2026-11-17
- Cases as ordinary posts in the category "Cases" (slug `cases`, filter `evive_case_category`): new template `single-case` (hero with category, title and excerpt as intro, wide featured image, previous/next case), picked automatically for posts in that category and selectable as "Case"; category page `category-cases` with a card grid (hidden pattern `evive/case-archive`). New pattern `evive/case-study` (key figures, challenge / solution / result, fact box with logo, quote, CTA), offered as a starter when you create a post, and `evive/case-cards` (three customer cards: logo, result in one number, quote, link) (evive #405).
- nl_NL translations for all new strings (278 of 278).

## 0.6.0 — 2026-10-30
- New pattern `evive/steps`: "how it works" in three numbered steps, joined by a dashed line on wide screens (evive #401).
- Device frames for screenshots: image block styles "Phone", "Browser window" and "Laptop", drawn in CSS around a plain screenshot; new pattern `evive/product-screenshot` (text + framed screenshot) and placeholder `placeholder-phone.svg` (evive #402).
- New pattern `evive/bento`: features as tiles of different sizes on the core four-column grid layout; tiles stack on phones (evive #403).
- New pattern `evive/problem-solution`: "without us" (cross list) next to "with us" (checklist, highlighted card); new list class `evive-crosslist` (evive #404).
- nl_NL translations for all new strings (246 of 246).

## 0.5.1 — 2026-10-30
- Dutch (nl_NL) translations for the pricing patterns, the CTA band with image and the Comparison table style (200 of 200 strings).
- Updates come from the GitHub org `evive-works` by default (was `stackpros`, which doesn't exist). `EVIVE_GITHUB_OWNER` still overrides it.

## 0.5.0 — 2026-10-30
- New pattern `evive/cta-media`: call-to-action band on the primary colour with text and two buttons on the left and an image on the right that rises above the band (wide screens) and rests on its bottom edge. Made for a product mockup with a transparent background; on phones the image sits centred below the text.

## 0.4.3 — 2026-10-30
- Comparison table on phones: tighter plan columns, and long words in the feature column hyphenate, so a table with three plans fits a 390px screen without sideways scrolling. Group headings aren't uppercased on phones.
- Top-level page parts get `min-width: 0`, so wide content scrolls inside its own box instead of widening the page.

## 0.4.2 — 2026-10-30
- `evive/pricing-plans`: centred card header (badge centred on the top border, name, description, price, yearly note); the checklist stays left-aligned. The bold price is on its own line with the period text below it (CSS, so existing pages built from 0.4.0 follow).
- New pattern `evive/pricing-addon`: one wide card for an add-on or separate offer, with text and checklist on the left and a centred price box on the right in the plan price style.

## 0.4.1 — 2026-10-30
- Fix: a heading inside a section with its own text colour (e.g. a CTA band on the primary colour) takes that colour. Before, it kept the theme's heading colour and could be invisible (navy on navy).

## 0.4.0 — 2026-10-29
- Pricing patterns (evive #400): `evive/pricing-plans` (three equal-height plan cards, the middle one highlighted with a badge on its top border, large price with period, a line for the yearly price, a checklist, buttons aligned at the bottom) and `evive/pricing-comparison` (feature table across plans). New pattern category **Pricing**.
- Block style **Comparison** for the Table block: plan columns centred, ✓ in the primary colour, an empty cell shows a muted dash, a row with a bold first cell and empty plan cells is a group heading, sticky header row; on phones the feature column stays fixed and the table scrolls sideways if it has to.
- List class `evive-checklist`: check marks in the primary colour instead of bullets.
- Block validator: dependencies aligned with the current block library (a fresh install mixed two `@wordpress/blocks` and `private-apis` versions and crashed); lockfile committed.

## 0.3.2 — 2026-10-22
- Dutch (nl_NL) translations for every theme string: pattern placeholders, pattern titles and descriptions, footer links, the header button ("Aan de slag") and the theme.json labels. `languages/evive.pot` is the template for further locales; regenerate it with `wp i18n make-pot` and fill a locale with `tools/i18n/build-po.py` (see `tools/i18n/README.md`).

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
