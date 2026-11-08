# Tokens

> History: how the idea developed. The demo (`design/ride-test/`) replaced this where they differ.

> Status: **v3 locked 2026-11-07** (colours + text font). v2 proposal 2026-11-07, after owner's anti-slop rules and the taste-skill direction draw (direction "The sentence is the layout", seed 350315655). v1 (Instrument Serif + Geist, soft radii, even scale) rejected by owner.

## Rules (owner + taste-skill house rules)
- No rounded corners: radius 0 everywhere (buttons, inputs, frames).
- No text boxes / cards, no outlined boxes, no hairline rules, no shadows at rest, no gradients, no glass.
- No eyebrow labels, no tiny uppercase tracked labels, no monospace outside code, no 01/02/03 numbering.
- No styled accent word in headlines (no italic/coloured word). One face, one colour; words carry emphasis.
- Big contrast in size: few sizes, far apart. Uneven spacing: gaps between sections much larger than gaps inside them.

## Type: newspaper front page
The dispatch office reads the city like a morning paper: a heavy American gothic for headlines over a sober serif for reading.
| Role | Font (Google Fonts) | Setting |
|---|---|---|
| Display + headings | **Libre Franklin 700** | tracking -0.035em, leading 0.92; hero title in capitals, section headings sentence case |
| Text | **Literata** 400 / 600 / italic (owner pick 2026-11-07) | leading 1.55, 45-75 characters per line |

Five sizes only:
| Step | Phone 390 | Desktop 1440 |
|---|---|---|
| `display` | 13.5vw (about 53px) | 9vw, max 150px |
| `head` | 32px | 64px |
| `lead` | 20px | 26px |
| `body` | 17px | 19px |
| `small` | 13px | 14px |

## Colour (v3, owner locked 2026-11-07)
One ground everywhere, cab yellow for every action, two pastel washes from the map painting used sparingly.
| Token | Value | Role |
|---|---|---|
| `paper` | #FDFAF7 | the only page ground (the painting's paper). No second cream anywhere. |
| `ink` | #1C1A19 | all text |
| `ink-soft` | #55524F | secondary notes |
| `cab` | #FCCF5D | every CTA / button, the waitlist field |
| `cab-deep` | #E2A93B | button hover |
| `blush` | #FBE7E2 | subtle wash for one section at a time (from the map's blush zone) |
| `river` | #E2E8EB | subtle wash, blue-grey (from the map's river zone) |
| `night` | #1C1A19 | footer field |
Rule: blush and river are never buttons or text, only quiet section washes; never two washed sections next to each other.

## Space (deliberately uneven)
- Page margins: 20px phone, 28px desktop (tight, large things run to the edges). Content max 1440px.
- Inside a section: 8 / 16 / 24 / 48 / 72px.
- Between sections: 96px phone, 160-220px desktop (the taxi drives in these gaps).

## Shape
- Radius 0. Buttons: flat filled `cab`, square, 48px tall minimum.
- Image frames: square corners; the painted cut-outs have no frame at all.
