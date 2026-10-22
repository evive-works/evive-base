# Translations

The theme's text domain is `evive`; WordPress loads `languages/<locale>.mo`.

To update after strings change (WP-CLI needed, e.g. on staging, since there are no local dev environments):

1. `wp i18n make-pot . languages/evive.pot --slug=evive --domain=evive --exclude=lib,tools,dist,bin`
2. Add or change entries in `tools/i18n/<locale>.py` (keyed by msgid; `CTX` for context-specific overrides).
3. `python3 -I tools/i18n/build-po.py <locale>` fills `languages/<locale>.po` and lists missing strings.
4. `wp i18n make-mo languages/<locale>.po languages/`
5. Bump the theme version, so the pattern cache is rebuilt.

Locales: nl_NL.
