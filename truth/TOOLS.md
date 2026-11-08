# Tools used on NearCab

Everything native to Claude: Claude Code, its skills and plugins, and MCP connectors. Updated as the project goes.

## Used so far
| Tool | Kind | Used for |
|---|---|---|
| Claude Code (desktop app) | app | the whole project, this vault |
| Built-in browser | Claude Code tool | studying pi.security (screens + how it is built) |
| Web search / fetch | Claude Code tool | Claude Design and Claude Motion research, inspiration |
| Higgsfield | MCP connector + plugin skill `higgsfield-generate` (CLI) | painted taxi style tests (Nano Banana Pro, Nano Banana 2, GPT Image 2.5) |
| `taste-skill` (tasteskill v2) | plugin skill | anti-slop art direction: dealt the page direction, type, palette, section blueprints |
| Remotion 4 (npm) | motion design in code | renders the scroll-scrubbed films from the paintings |
| Playwright (MCP) | browser automation | scroll tests: reads layer positions at every scroll step, screenshots per frame and screen size |
| `superpowers` | plugin skills | working method (skill check before acting) |
| caveman / ponytail | output styles | short replies, smallest complete change |

## Design skills available (read 2026-11-07)
| Skill | What it is for | Plan |
|---|---|---|
| `taste-skill:taste-skill` | landing-page art direction, house rules against generated-page tells, browser inspector, critique loop | **main design guide** |
| `taste-skill:minimalist-ui`, `high-end-visual-design`, `industrial-brutalist-ui`, `gpt-taste`, `stitch-design-taste` | alternative style recipes | not used, our direction is set |
| `taste-skill:image-to-code`, `imagegen-frontend-web` | turn a picture of a design into code / prompts for page mock images | maybe at build time |
| `taste-skill:redesign-existing-projects` | audit + redesign an existing page | UI/UX review step |
| `taste-skill:brandkit` | brand kit | not needed |
| `ui-ux-pro-max:*` (ui-ux-pro-max, design-system, ui-styling, design, brand, banner-design) | big library of UI/UX rules, palettes, font pairings, design-system generator | second opinion in the UI/UX review |
| `frontend-design:frontend-design` | Anthropic's official skill for distinctive front-end code | build step |
| `styleseed` | design-system seed engine | not used |
| `react-bits` | ready animated React components | not used (we write motion with CSS + Interactivity API) |
| `motion-dev-animations` | Motion.dev animations | not used (no React on the front end) |
| `wp-interactivity-blocks` | WordPress blocks with React editor + Interactivity API | build step |
| `artifact-design` + Claude Design (Design artifact type) | page design on a canvas, design system, handoff | design step |
| `anti-ai-writing`, `humanizing-writing`, `storytelling`, `viral-hooks` | writing checks | blog post (owner writes the English) |
