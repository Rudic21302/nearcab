# Reference: pi.security (style reference only)

Looked at 2026-11-07. Used for mood, never copied.

## What it looks like
- Light page, lots of white. Character comes from loose watercolour + ink illustrations (animals, sleds, ice cubes, birds) sitting on white, not from a coloured background.
- Serif headline with one italic accent word in a warm colour; teal buttons; monospace small labels.
- UI cards stay clean and flat, with a faint watercolour wash behind them.

## How it is built (from the page's own files)
- Hero and scenes are pre-rendered **transparent videos** (`.webm`) and `.mp4`, not code-drawn watercolour.
- Small painted cut-outs (bird, ice cube, branch) are `.avif` images that move on scroll (parallax).
- Motion: GSAP + ScrollTrigger, Lenis smooth scroll, Lottie for small UI animations. Built in Webflow.

## Lesson for NearCab
Painted look = painted assets (images or video). Code moves them. Code-made watercolour filters are only for small things (zone washes).
