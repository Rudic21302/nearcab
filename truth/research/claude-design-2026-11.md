# Claude Design, Claude Motion and image tools: what they really do (checked 2026-11-07)

Sources at the bottom. Things change fast; re-check before trusting a detail.

## Claude Design
- Now part of Claude itself: a **Design** artifact type. The old standalone site (claude.ai/design) closes on 2026-12-14; its design systems can be moved over.
- Available on all plans, on by default. Uses the same usage limits as the rest of Claude (Claude Code included).
- Start: ask for a design in a chat (or Output > Design), pick the Design template in Artifacts, or run `/design` in Claude Code.
- Output: a canvas of artboards with layers (text, shapes, images). Can be an interactive prototype.
- Inputs: screenshots, images, wireframes, a document whose style to match, a linked code repo.
- **Design system:** import from a GitHub repo, design files, uploads, or a local codebase with `/design-sync` in Claude Code. New projects inherit it, and Claude checks its output against it.
- **Export:** .zip, PDF, PPTX, Google Slides, standalone HTML, and partners (Canva, Miro, Netlify, Replit, v0, Vercel, Wix...). **Handoff to Claude Code** (local or web): `/design` brings the design into a codebase, so the build continues from the real design instead of a screenshot.
- Known limits: no version history yet, basic multi-person editing, comments can vanish (paste feedback into chat instead).
- Motion: the help pages do not describe scroll animation. Treat Claude Design as layout + look; motion is written in code.

## Claude Motion
- Separate tool (beta since 2026-10-08): turns text, data and images into short explainer animations; Claude writes animation code, export to MP4.
- Plan access reported as Team/Enterprise only (third-party sources, conflicting). Not needed for the site: our motion lives in the page code. Possible use: a short teaser clip for the blog post.

## Images: can Claude paint the stills itself?
- No. Claude writes code and text; it does not output pixels. It **can** draw SVG (cars, map zones, lines, icons) by writing code.
- The GitHub "image skills" (claude-art-skill, nano-banana skills) are wrappers: a style file + reference image + a call to an image model API (mostly Google Nano Banana). They need your own API key.
- The Higgsfield connector already gives the same models (Nano Banana 2 / Pro / 2.1, GPT Image 2, FLUX.2, Seedream) without a separate key. Several accept reference images and a seed, which is how style stays consistent.
- So we copy the good idea from those skills (a style file + one locked reference image used on every prompt) without installing anything. See [[../style/style-bible]].

## Sources
- https://support.claude.com/en/articles/14604416-get-started-with-claude-design
- https://support.claude.com/en/articles/17454997 (Claude Motion export)
- https://eesel.ai/blog/claude-motion
- https://jimchristian-net.pages.dev/blog/2026/02/27/claude-art-skill-visual-content-system/
- https://gittrend.io/repo/kkoppenhaver/cc-nano-banana
