# The film (Remotion)

Claude Code as the motion designer: each camera move is a React composition built from our own paintings (`public/`), rendered to a frame sequence. Tested for scroll scrubbing and rejected: scrubbed, the cab looked like it was reversing. The final page does not use it.

- `src/Lift.tsx`: the lift. The street sinks and shrinks, the map tilts from a street-level angle to straight above, the cab travels into the map and becomes its yellow dot.
- Render: `npm i` then `node node_modules/@remotion/cli/remotion-cli.js render src/index.ts Lift out/lift --sequence --image-format=jpeg --jpeg-quality=82`
- Web frames: 72 x WebP 1280px q70 (about 3.9 MB) in `../ride-test/film/lift/`.
- Page: a `<canvas>` draws the frame for the scroll position and eases the film's map onto the page map's exact box, so the hand-over is seamless.
