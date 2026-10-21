# Token contract — evive-base

Child themes set a brand by overriding the **values** of these presets in their own `theme.json`. They never rename or remove a slug: templates and patterns in evive-base reference the slugs, so a missing slug breaks them. Changing or removing a slug is a breaking change (major version). Adding one is a minor release.

## Colours (`settings.color.palette`)
CSS: `var(--wp--preset--color--<slug>)` · theme.json: `var:preset|color|<slug>`

| Slug | Role | Neutral default | Contrast rule the child palette must meet (WCAG 2.2 AA) |
|---|---|---|---|
| `base` | Page background, cards | `#ffffff` | — |
| `contrast` | Body text, headings | `#1d1d1f` | ≥ 4.5:1 on `base` and on `surface` |
| `primary` | Brand colour: links, primary buttons, bold sections | `#2c3e50` | ≥ 4.5:1 on `base` (links are `primary` text) |
| `primary-contrast` | Text and icons on `primary` | `#ffffff` | ≥ 4.5:1 on `primary` |
| `accent` | Highlights, hover/active states, icon tiles | `#5d6d7e` | Not used as text on `base` |
| `accent-contrast` | Text on `accent` | `#ffffff` | ≥ 4.5:1 on `accent` |
| `surface` | Alternate section background, footer, code | `#f4f5f7` | — |
| `muted` | Secondary text (dates, captions, meta), input borders | `#5a5f69` | ≥ 4.5:1 on `base` and on `surface` |
| `border` | Hairlines, card borders, separators (decorative) | `#d5d8de` | — (decorative; input borders use `muted`) |

Buttons: fill = `primary` / `primary-contrast`; hover = `accent` / `accent-contrast`; outline style = transparent with `primary` text and border.

## Font families (`settings.typography.fontFamilies`)
| Slug | Role | Default |
|---|---|---|
| `heading` | Headings, buttons, site title | system UI stack |
| `body` | Everything else | system UI stack |

The base ships **no web fonts**. A child theme registers its own self-hosted `fontFace` entries under these slugs.

## Font sizes (`settings.typography.fontSizes`, fluid)
| Slug | Default (min → max) | Used for |
|---|---|---|
| `xs` | 0.8125rem | captions, h6 |
| `s` | 0.9375rem | meta, buttons, navigation, h5 |
| `m` | 1rem → 1.125rem | body text, h4 |
| `l` | 1.25rem → 1.5rem | intro text, h3 |
| `xl` | 1.75rem → 2.5rem | h2 |
| `xxl` | 2.25rem → 3.5rem | h1 |

## Spacing (`settings.spacing.spacingSizes`)
CSS: `var(--wp--preset--spacing--<slug>)`

| Slug | Default |
|---|---|
| `10` | 0.25rem |
| `20` | 0.5rem |
| `30` | 1rem (block gap) |
| `40` | clamp(1.25rem, 2vw, 1.5rem) (side padding) |
| `50` | clamp(1.5rem, 4vw, 2.5rem) |
| `60` | clamp(2rem, 6vw, 4rem) (section padding) |
| `70` | clamp(3rem, 9vw, 6rem) |

## Radius (`settings.custom.radius`)
CSS: `var(--wp--custom--radius--<slug>)` · theme.json: `var:custom|radius|<slug>`

| Slug | Default | Used for |
|---|---|---|
| `s` | 4px | inputs, code |
| `m` | 8px | buttons |
| `l` | 16px | cards, images |

## Shadows (`settings.shadow.presets`, since 0.3.0)
CSS: `var(--wp--preset--shadow--<slug>)` · theme.json: `var:preset|shadow|<slug>`

| Slug | Used for |
|---|---|
| `s` | cards (Card block style) |
| `m` | raised elements |
| `l` | overlays, menus |

The defaults mix the `contrast` colour with transparency, so they follow any palette. A child may override the values.

## What a child theme may override
- The **values** of every slug above (`settings.color.palette`, `settings.typography.fontFamilies` + `fontFace`, `fontSizes`, `spacingSizes`, `settings.custom.radius`, `settings.shadow.presets`).
- `styles` (for example heading colour, button radius), as long as it uses presets only.
- Layout widths (`settings.layout`).
- Extra, brand-only palette entries are allowed if documented in the child theme. evive-base patterns never use them.

## Fixed (not tokens)
Border and outline widths (1px hairlines, 2px button borders and focus rings, 4px quote bar) and line heights are structural constants, the same for every customer.

## Editor
Custom colours, gradients, duotones, custom font sizes, custom spacing sizes and the core default palettes are switched off, so editors can only pick from the tokens.
