# Pattern library — evive-base

Generic patterns every customer can use. They contain neutral placeholder text (translatable, text domain `evive`) and placeholder art shipped in `assets/images/`, use tokens only, and make no external requests. Customer-specific patterns live in the child theme.

**Live gallery:** https://whyatwork.cloud/pattern-gallery/ (staging; shown with the active theme, so with a child theme active it shows the customer's brand).

Screenshots per pattern: **default palette** (desktop), **dark-primary test palette** (desktop) and **mobile** (390px, default palette). The dark-primary palette is the test palette from `tools/` / card D.1: deep green primary with an orange accent.

## Building blocks used by the patterns
- **Card** block style for Group (`is-style-card`): `base` background, `border` hairline, radius `l`, shadow `s`.
- **Motif** block style for Group (`is-style-motif`): two large, faded rounded-rectangle outlines in the text colour behind the section. Used by *Hero: on primary colour*.
- **Shadow tokens** `s`, `m`, `l` (added in 0.3.0, as proposed in D.1). They are built from the `contrast` colour with `color-mix()`, so they follow the palette.
- **Page without title** template (`page-no-title`) for pages that start with a hero (the hero has the H1).
- **FAQ structured data:** a Group with class `evive-faq` outputs `FAQPage` JSON-LD built from its Details blocks (summary = question, content = answer). Editors only edit the visible text.

## Hero: text and image
`evive/hero-media` · category `evive-hero`

Page heading, intro text and two buttons, with an image or screenshot on the side.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Hero: text and image, default](patterns/hero-media-default-1280.webp) | ![Hero: text and image, dark primary](patterns/hero-media-dark-1280.webp) | ![Hero: text and image, mobile](patterns/hero-media-default-390.webp) |

## Hero: split 50/50
`evive/hero-split` · category `evive-hero`

Two equal halves: text on a surface background, image on the other side.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Hero: split 50/50, default](patterns/hero-split-default-1280.webp) | ![Hero: split 50/50, dark primary](patterns/hero-split-dark-1280.webp) | ![Hero: split 50/50, mobile](patterns/hero-split-default-390.webp) |

## Hero: page title and intro
`evive/hero-page` · category `evive-hero`

Simple page hero: heading and an intro paragraph, for inner pages.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Hero: page title and intro, default](patterns/hero-page-default-1280.webp) | ![Hero: page title and intro, dark primary](patterns/hero-page-dark-1280.webp) | ![Hero: page title and intro, mobile](patterns/hero-page-default-390.webp) |

## Hero: on primary colour
`evive/hero-primary` · category `evive-hero`

Hero on the primary colour. Uses the Motif block style (faded rounded rectangles); switch the style to Default to remove it.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Hero: on primary colour, default](patterns/hero-primary-default-1280.webp) | ![Hero: on primary colour, dark primary](patterns/hero-primary-dark-1280.webp) | ![Hero: on primary colour, mobile](patterns/hero-primary-default-390.webp) |

## Features: three cards
`evive/features-cards` · category `evive-features`

Section heading and three feature cards with an icon, text and a link.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Features: three cards, default](patterns/features-cards-default-1280.webp) | ![Features: three cards, dark primary](patterns/features-cards-dark-1280.webp) | ![Features: three cards, mobile](patterns/features-cards-default-390.webp) |

## Features: alternating image and text
`evive/features-alternating` · category `evive-features`

Rows of text and image that swap sides, one per feature.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Features: alternating image and text, default](patterns/features-alternating-default-1280.webp) | ![Features: alternating image and text, dark primary](patterns/features-alternating-dark-1280.webp) | ![Features: alternating image and text, mobile](patterns/features-alternating-default-390.webp) |

## Features: icon list
`evive/features-icon-list` · category `evive-features`

Heading on the left, a two-column list of short points with icons on the right.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Features: icon list, default](patterns/features-icon-list-default-1280.webp) | ![Features: icon list, dark primary](patterns/features-icon-list-dark-1280.webp) | ![Features: icon list, mobile](patterns/features-icon-list-default-390.webp) |

## CTA band: primary colour
`evive/cta-primary` · category `evive-cta`

Call-to-action band on the primary colour with one button.

| Default | Dark primary | Mobile |
|---|---|---|
| ![CTA band: primary colour, default](patterns/cta-primary-default-1280.webp) | ![CTA band: primary colour, dark primary](patterns/cta-primary-dark-1280.webp) | ![CTA band: primary colour, mobile](patterns/cta-primary-default-390.webp) |

## CTA band: surface
`evive/cta-surface` · category `evive-cta`

Call-to-action band on the surface colour with one button.

| Default | Dark primary | Mobile |
|---|---|---|
| ![CTA band: surface, default](patterns/cta-surface-default-1280.webp) | ![CTA band: surface, dark primary](patterns/cta-surface-dark-1280.webp) | ![CTA band: surface, mobile](patterns/cta-surface-default-390.webp) |

## FAQ
`evive/faq` · category `evive-content`

Frequently asked questions as expandable Details blocks. Adds FAQPage structured data (JSON-LD) built from the questions and answers.

| Default | Dark primary | Mobile |
|---|---|---|
| ![FAQ, default](patterns/faq-default-1280.webp) | ![FAQ, dark primary](patterns/faq-dark-1280.webp) | ![FAQ, mobile](patterns/faq-default-390.webp) |

## Logo wall
`evive/logo-wall` · category `evive-proof`

A short line and a row of customer logos.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Logo wall, default](patterns/logo-wall-default-1280.webp) | ![Logo wall, dark primary](patterns/logo-wall-dark-1280.webp) | ![Logo wall, mobile](patterns/logo-wall-default-390.webp) |

## Testimonial
`evive/testimonial` · category `evive-proof`

One large customer quote with name, role and photo.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Testimonial, default](patterns/testimonial-default-1280.webp) | ![Testimonial, dark primary](patterns/testimonial-dark-1280.webp) | ![Testimonial, mobile](patterns/testimonial-default-390.webp) |

## Testimonials: grid of three
`evive/testimonials-grid` · category `evive-proof`

Three customer quotes as cards.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Testimonials: grid of three, default](patterns/testimonials-grid-default-1280.webp) | ![Testimonials: grid of three, dark primary](patterns/testimonials-grid-dark-1280.webp) | ![Testimonials: grid of three, mobile](patterns/testimonials-grid-default-390.webp) |

## Stats
`evive/stats` · category `evive-proof`

Four big numbers with a label each.

| Default | Dark primary | Mobile |
|---|---|---|
| ![Stats, default](patterns/stats-default-1280.webp) | ![Stats, dark primary](patterns/stats-dark-1280.webp) | ![Stats, mobile](patterns/stats-default-390.webp) |

## Header and footer (0.2.0)
`evive/header` (default), `evive/header-no-cta`, `evive/header-sticky`; `evive/footer` (extended), `evive/footer-simple`. See `CHANGELOG.md`.
