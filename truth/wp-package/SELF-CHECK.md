# Self-check

Run against the reader's WordPress, with the demo served from `design/ride-test/` as the reference (any static server, such as `npx http-server -p 8766`).

Write this as a script: 1% loops at six sizes with image diffs are too much for clicking through a browser tool. Screen sizes: **1918×930, 2560×1080, 1440×900, 1205×620, 390×844, 375×667**. Hide any cookie banner before taking screenshots.

## 1. Drive (all must be 0)
Scroll in 1% steps, 0 to 100. Each step, read the `.world` and `.near` transforms (`DOMMatrix.m41`), the first `.wheel` rotation, and the bounding boxes of `.world` and `.near`.
- `streetRight`, `nearRight`: steps where a layer moves right by more than 1px
- `wheelBack`: steps where the wheel rotation decreases
- `gapLeft`: `.world` left edge above 1px. `gapRight`: `.world` or `.near` right edge short of the viewport

`firstDrivePx`, the `.world` x at 5% minus x at 12%, must be above 150.

## 2. Reading areas
At the end of each hold (F0 4.6%, F1 19.8%, F2 55.5%, F3 71.8%, F4 85.8%, F5 100%), every visible `h1,h2,h3,p,li,label,.form` in the frame ends above the frame's bottom edge, the frame's bottom is above the street band's top, and nothing sits under the header at the start of the hold (tall copy scrolls up during it). Run the same check on the demo: the result must match it, apart from F0, which always fits.

Phones: also at 360×640, 375×667 and 390×664 (a real phone with its URL bar showing). At the start of the F4 hold (80.6%) the consent ends above the street band's top.

## 3. Sky state
Scroll in this order. 20% off. 24.5% on, and after 1.2 s the band opacity is 0 and the map opacity 1. 22% still on. 21% off. 58% off (coming from below 24%, the safety margin keeps it off). The `.world` x is identical at 20% and 58%.

## 4. Pixels against the demo
For each size at {0, 16, 35, 50, 69, 83, 100}%, screenshot the build and the demo, reach each position from a few percent earlier, and wait for transitions to settle. Build one side-by-side contact sheet per size, and compute the mean pixel difference. The scale is mean absolute difference per RGB channel, 0 to 255. Above 6 at a hold position: look at it and fix it.

Expect a higher number at 1205×620 at 0%: F0 scales there on purpose. Short screens at 50% to 100% can also read high when one screenshot lands mid-scroll; retake before you trust the number.

## 5. Standards
- Text contrast at least 4.5:1.
- Keyboard, at each frame's hold: Tab reaches that frame's links and fields with a visible focus ring. Other frames are hidden, so Tab stays inside the frame on screen. Enter on the header CTA rides to F4, and the next Tab lands on the email.
- The email and consent fields block an empty submit.
- Real clicks at the F4 hold: the checkbox, its text and the stain around it all toggle the consent.
- Block editor (log in with a test admin): all seven blocks load with no block warnings and no errors from the theme. Ignore WordPress's own `was added to the iframe incorrectly` notice; default themes log it too.

## 6. Reduced motion
Emulate `prefers-reduced-motion: reduce`: a plain stacked page, fully readable.

## Report
One message: the contact sheets, a table of results, and one question: approve, or what to change. Say which checks did not run.
