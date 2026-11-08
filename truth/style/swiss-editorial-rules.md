# Swiss editorial rules

> History: how the idea developed. The demo (`design/ride-test/`) replaced this where they differ.

> Status: proposal 2026-11-07. Owner direction: keep fonts, colours and the watercolour art, lay it out with Swiss / Swiss-editorial grid and spacing. Why it fits: Libre Franklin is an American gothic in the same family tree as the Swiss grotesks, the NY cab world is newsprint and timetables, and paper-white grids are where watercolour cut-outs look most deliberate.

## The grid
- **12 columns** on desktop (1440 frame: 28px margins, 24px gutters), **4 columns** on phone (390 frame: 20px margins, 12px gutters).
- **Baseline grid: 8px.** Every size, line height and gap is a multiple of 8 (or of 4 for small type). Text sits on the baseline grid.
- **Modules:** the page is cut into rows of modules (4 columns × N baselines). Every block (text, painting, colour field) fills whole modules. Nothing floats between them.
- **Flush left, ragged right.** No centred text, no justified text.
- **Asymmetry:** content hangs from column lines, never from the centre. Two main hang lines: column 1 and column 5 (one third in).

## Type (sizes on the 8px grid)
| Role | Font | Desktop | Phone | Leading |
|---|---|---|---|---|
| Display | Libre Franklin 700, uppercase | 144 | 48 | 0.9 |
| Heading | Libre Franklin 700 | 64 | 32 | 1.0 |
| Lead | Literata 400 | 24 | 20 | 1.33 |
| Body | Literata 400 | 18 | 17 | 1.55 |
| Caption | Libre Franklin 700 | 14 | 13 | 1.43 |
Hierarchy by size and weight only, never colour. Max measure 60ch.

## Editorial devices (Swiss newspaper)
- **Thick rules:** one 4px ink rule across the full module width above a section's heading (the newspaper "section rule"). No hairlines.
- **Stop labels:** a short caption on the rule, flush left ("Stop 2 · The call"), set in the caption style.
- **Captions under paintings:** small, flush left with the painting's left edge, describing what you see.
- **Columns for running text:** long text sets in 2 columns on desktop (each 4-5 grid columns).
- **One big thing per frame:** each stop has one dominant element (a headline, a painting or a colour field).

## Spacing (8px scale)
8 · 16 · 24 · 32 · 48 · 64 · 96 · 128 · 192. Inside a frame: 8-64. Between frames: the cab ride (see [[../design/ride-concept]]), never plain space.

## Colour use on the grid
Cream paper ground. Blush or river fill whole modules only (a wash is a module, never a blob). Cab yellow only on actions and the waitlist frame.

## Conflicts with taste-skill (owner decides)
taste-skill bans rules, index numbers and small caption labels as generated-page tells. Swiss editorial uses all three on purpose. Proposal: allow **thick 4px rules, stop labels and captions**, still ban hairlines, monospace, pill badges, shadows and gradients.
