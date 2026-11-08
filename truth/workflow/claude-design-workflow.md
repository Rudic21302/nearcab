# Workflow: from idea to built page with Claude

One page, four tools, one direction of travel. Each step leaves a file here, so the next step (or the next person) starts from it.

```
brief + pacing (markdown)  ->  style bible + tokens  ->  Claude Design (page)  ->  handoff to Claude Code  ->  WordPress theme
                                   |
                         image model (painted cut-outs)  ->  art/generated/  ->  theme assets
```

## 1. Brief Claude Design like a client would
A good design prompt has four parts: **goal, audience, content, layout**. Paste, don't describe from memory:
- goal + audience: from [[../00-brief]]
- content: the section list with real copy from [[../sections/copy-deck]] (no lorem ipsum: placeholder text makes placeholder design)
- look: [[../style/style-bible]] + [[../style/tokens]] + 2-3 reference images
- layout rules: 390px mobile base, 20px side gutter, max content width 1440px, desktop + mobile artboards

## 2. Design system first, page second
Create the NearCab design system (colours, type, spacing, radii, buttons, cards) before the page, so every page artboard inherits it. Source of the values: [[../style/tokens]]. Later, `/design-sync` keeps Claude Design and the theme code matched.

## 3. Painted art is a separate track
Claude Design lays out the page with placeholder art. The watercolour cut-outs come from an image model, always with the style prefix and the locked reference image from the style bible. Finished files go to `art/generated/`, then into the design to replace placeholders.

## 4. Review before handoff
UI/UX review on the design: contrast, tap sizes, reading order on mobile, every section answers its reader question. Fix in Claude Design, not in code.

## 5. Handoff
Export > Handoff to Claude Code. Claude Code builds it as a WordPress block theme. Design values become `theme.json` tokens (the only token source); Tailwind reads them. Motion is added in code at this step.

