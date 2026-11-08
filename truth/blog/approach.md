# Blog post 2: approach so far

> Notes for the blog post, in the order things happened.

## The angle (owner, 2026-11-07)
Rushing development with Claude can be the right call when it is used on purpose and execution time really matters. Contrast with post 1, where the design was done by hand in Figma. Second half: how to use Claude this way.

## The story in beats (real, from LOG.md)
1. **One idea, one evening.** A real experiment (a Voronoi-diagram taxi dispatcher, seminar project) becomes an imaginary startup, NearCab, with a waitlist page. Kick-off: 20 minutes.
2. **Direction by conversation, not by Figma.** From a "dispatch office" mood to a hand-painted storybook look over a corporate SaaS, decided in a few messages, with pi.security and Yuitech as references.
3. **Art from one locked reference.** One painted taxi became the style reference; every later image (streets, map, washes, driver) sent it as the only reference. Prompt lessons:
   - keep a style, change the subject: "Match the exact painting style of the reference image", then the new subject;
   - never send a photo as a second reference (the model handed the photo back);
   - don't ask a model to split a painting into layers; paint layers separately, or draw them in code;
   - remove a logo by editing the painting itself, not by asking a fresh generation not to draw it.
4. **Taste as a tool.** The taste skill rejected the first tokens (Instrument Serif + Geist, rounded corners, boxes) as the "AI look"; Swiss editorial grid + Libre Franklin + Literata + a cream paper ground replaced them. Critique rounds scored the page like an Awwwards juror and named the top three problems each round.
5. **Iterate on what you can see.** Demo v1 (sterile) → v2 (painted) → the ride. The owner's reviews drove every turn: "the car is going in reverse", "it feels like a quirky animation between sections", "the reading frames should be the keyframes".
6. **The ride.** One pinned stage, one scroll-driven animation; reading frames are its keyframes; the cab drives you between them. The map story lives inside one frame with its own inner animation.
7. **Measure, don't eyeball.** The reversing bug was invisible in screenshots. Reading the street's position at 101 scroll steps found it in one run. Same method checked wheels never turn backwards and that no copy overlaps the street at four screen sizes.
8. **Claude as motion designer.** A real film of the lift was written as code (Remotion) from the paintings, rendered to frames and scrubbed by scroll. It worked technically, and the owner rejected it for UX: scrubbing made the cab look like it went backwards and the perspective shift felt odd. The final lift plays out in time once a safety margin is crossed. Lesson: the impressive technique is not always the right one for the reader.
9. **Real Voronoi on the page.** The zones on the map are a real Voronoi diagram computed from where the painted cabs sit, with the same clipping idea the original project used.
10. **Honest by design.** The waitlist says the product does not exist and signs you up to the real blog newsletter; the footer says the paintings were made with an image model.

## Numbers for the "short time" claim (fill the last ones at the end)
| Phase | Time |
|---|---|
| Kick-off | 20 min |
| Claude Design workflow set up | 4 min |
| Style, tokens, art direction | 1 h 9 min |
| Design + motion iterations | about 2 h (7 Nov) + 8 Nov session |
| WordPress build | [after the one-command build] |
| Hosting | [ ] |

