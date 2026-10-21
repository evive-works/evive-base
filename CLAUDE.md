# CLAUDE.md — evive-base

Neutral WordPress **parent block theme** for the evive rebuild service (StackPros B.V.). Every customer site gets a child theme on top of this. Why at Work is the first one.

Distributed via **GitHub** releases so customer sites get auto-updates (same mechanism as our other WordPress plugins).

## What belongs here — and what doesn't
Rule: *would the next customer need this too?* Yes → here. No → the customer's child theme.
- ✅ Templates, template parts, layout, generic patterns (hero, feature grid, FAQ, CTA, pricing, logo wall, blog), accessibility, performance, editor settings.
- ❌ No brand: no logos, customer colours, customer fonts, customer copy, customer names.

## The token contract
`theme.json` defines **neutral default values** for a fixed set of preset slugs. Child themes override the values, never the slugs. Templates and patterns only reference these slugs.
- Colours: `base`, `contrast`, `primary`, `primary-contrast`, `accent`, `accent-contrast`, `surface`, `muted`, `border`.
- Font families: `heading`, `body`.
- Font sizes: `xs`, `s`, `m`, `l`, `xl`, `xxl` (fluid).
- Spacing: `10`–`70`.
- Radius: `s`, `m`, `l`.
Changing or removing a slug is a **breaking change**: major version bump and a note in `CHANGELOG.md`.

## Hard rules
- No page builders, no theme frameworks, no jQuery.
- No hardcoded colours, sizes or spacing anywhere. Presets only.
- Patterns: PHP files in `patterns/`, slug `evive/...`, all strings translatable with text domain `evive`, no real copy (neutral placeholder text).
- Every pattern must look good with any reasonable child palette: test with the default palette and at least one dark-primary palette.
- Accessibility: WCAG 2.2 AA. One H1 per page, visible focus, keyboard-navigable menus, reduced-motion support.
- Performance: no external requests, no web font CDNs, minimal CSS loaded per block.
- Must work on single site and Multisite.

## Versioning and release
- Semantic versioning. `CHANGELOG.md` per release.
- Tagged releases on GitHub, picked up by the auto-update mechanism.
- Never break a child theme in a minor release.

## Workflow
- Branches: `feat/<slug>`, `fix/<slug>`. Commit messages imperative, in English.
- Changes that come from a customer project reference it: `feat: logo wall pattern (from whyatwork-site card D.8)`.
