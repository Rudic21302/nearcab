# Layout and motion spec

> History: how the idea developed. The demo (`design/ride-test/`) replaced this where they differ.

> Status: draft 2026-11-07, for owner review. Built from the taste-skill references (layout, motion) and the direction sheet "The sentence is the layout". Tokens: [[../style/tokens]] v3. Copy is placeholder until the owner writes it.

## The one idea
**The cab is the reader's guide.** It starts as a word in the headline, drops onto the street, and drives from stop to stop as you scroll. Each stop is one section. Every section answers one reader question.

## Grid and anchors
- 12 columns, gutter 12-24px, margins 20px phone / 28px desktop. No centred 1200px box: big things (type, paintings, colour fields) run edge to edge; only running text gets a measure (34-60ch).
- Two anchor lines for the whole page: **A = the left margin**, **B = column 5 (about one third in)**. Every heading, paragraph and row starts on A or B.
- Gaps: 8 / 16 / 24 / 48 / 72px inside a section; 160-220px between sections on desktop, 96-112px on a phone. A heading has at least twice the space above it as below.
- One ground (paper). Chapters are told apart by an occasional full-width wash (blush, river), the yellow waitlist field and the night footer. Never two washes next to each other.

## Sections (reader question, composition, phone, motion)
| # | Section | Reader question | Composition (desktop) | Phone (390) | Motion |
|---|---|---|---|---|---|
| 1 | Hero | What is this? | Two-line headline on anchor A at 9vw, the painted cab sitting in the sentence as a word. Lead sentence + yellow button below on B. The painted street full-bleed at the bottom, cab parked at the curb. | Headline at 11vw, cab-word one line tall; street cropped to the right half (cafe corner). | **Signature:** headline lines rise from their baselines on load (900ms). As you start scrolling, the cab leaves the sentence and lands on the street, then drives off right. |
| 2 | The call (blush wash) | Why does this matter? | Split: one short statement on A (36px max), house + ringing phone on the right half, bottoms aligned. | Statement first, then house and phone side by side at 60/40. | Phone rings (small wobble) only while in view. Statement rises line by line. |
| 3 | Zones | How does it work? | **Pinned story:** heading + paragraph stick on A while the map scrolls through 3 states: plain map, zones bloom in, the ping and the pencil line draw to the nearest cab. | No pin. Map full width, the three states as three short steps under it. | Zones fade in one by one (opacity only); line draws with stroke-dashoffset; a tiny cab travels the line. |
| 4 | From call to curb | How fast is it? | Full-bleed bar, segment widths = real durations (2 s, instant, 5 s, about 4 min). Labels inside, one clause under each. | Bar turns vertical, heights keep the proportions. | The painted cab drives the whole length of the bar, scroll-linked, ending at the door. |
| 5 | What exists today | Can I trust it? | Index list on anchor B: big row titles (built / next / later); hovering a row shows its painting in a fixed frame on the right third. | Rows stack, each painting inline above its title at alternating widths (100% / 70% right / 55% left). | Rows arrive one by one; preview crossfades 240ms on hover. |
| 6 | Waitlist (yellow) | What do I do next? | The sentence with a blank is the form ("Tell me when it runs: [email] Okay."). Honest note under it. Waving driver bottom right, bleeding off the edge. | Sentence at 10vw, input on its own line, button ends the line. | Driver pulls in from the right edge once; button press 140ms. |
| 7 | Footer (night) | Who made this? | **Curtain footer:** revealed from under the page. The brand at full width, fine print in three positions. | Fine print stacks. | Curtain reveal (sticky bottom). |

**System broken once, on purpose:** section 6 is the only centred moment on a phone, and the only full-colour field.

## Motion tokens (from taste-skill)
```css
--ease-out: cubic-bezier(0.22, 1, 0.36, 1);   /* enters, reveals */
--ease-in-out: cubic-bezier(0.76, 0, 0.24, 1);/* the cab travelling */
--ease-soft: cubic-bezier(0.33, 1, 0.68, 1);  /* long quiet reveals */
--t-press: 140ms; --t-hover: 180ms; --t-ui: 240ms; --t-reveal: 800ms;
```

## Motion rules
- One loud move (the cab leaving the headline). Everything else is quiet and different per section: lines rise, rows arrive one by one, washes bloom, the line draws. Never the same fade-up on every block.
- Transform, opacity, clip-path and stroke-dashoffset only.
- Scroll-linked moves use CSS scroll-driven animations (`animation-timeline: view()/scroll()`), wrapped in `@supports`; browsers without them get the still page. Interactivity API only for what CSS cannot do (hover preview index, form state).
- Content is never hidden without a fallback: hidden states only under `html.js`.
- `prefers-reduced-motion: reduce` = the finished still page (keep colour/opacity, drop travel).
- Loops (phone ring, cab idle) run only while in view.
- No scroll hijacking, no smooth-scroll library, no custom cursor, no bounce.

## Art still needed
- Map without washes + the washes as a separate layer (so zones can bloom in).
- A night pickup scene for the footer (cab front, headlights on) painted for a dark ground.
- Cab front with the grille badge painted out.

## Claude Design canvas
- `Main.dc.html`: desktop page, fluid (works down to phone).
- `Phone.dc.html`: same page framed at 390 to check the phone composition.
- `Motion.dc.html`: storyboard of the cab's journey, one frame per stop with its scroll range.
