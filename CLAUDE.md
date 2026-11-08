# NearCab

`truth/` is the knowledge base: read `truth/CLAUDE.md` before working. `theme/nearcab-theme/` is the finished theme. `/nearcab-build` builds the theme again from `truth/` alone.

## Rules
- The demo `truth/design/ride-test/index.html` is the design source of truth. Never invent a design decision; if the truth files are silent, ask.
- `theme.json` is the only token source. No inline `style=` in blocks, no hex in markup.
- No hardcoded visible strings in block components: every string is a block attribute.
- Mobile-first, base 390px, only `min-width` media queries.
- React in the editor only. PHP render, Interactivity API on the front end. No GSAP, no extra libraries.
- Keep every keyframe percentage and `clamp()` from the demo identical.
- Run `npm run build` before testing a style change.
