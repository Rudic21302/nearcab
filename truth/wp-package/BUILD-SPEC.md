# Build spec: NearCab from zero

Build NearCab as a standalone WordPress block theme. `truth/START.md` says which folder.

**The demo `design/ride-test/index.html` is the visual and behavioural reference.** Where this spec and the demo disagree, the demo wins, except for the deliberate differences listed below.

## Rules
- `theme.json` is the only token source. No hex in markup, no inline `style=` in blocks, named classes in each block's `style.scss`.
- Every visible string is a block attribute (headings, labels, button text, alt text, legal lines, URLs).
- Mobile-first, 390 base, only `min-width` media queries.
- React only in the editor (`edit.jsx`), PHP render, Interactivity API (`viewScriptModule`) on the front end. No GSAP, no extra libraries.

## Stack
| Thing | How |
|---|---|
| Theme | Block theme: `style.css`, `theme.json`, `functions.php`, `templates/index.html`, `patterns/page.php` |
| Packages | `package.json` with `"type": "module"` and dev dependencies `@kucrut/vite-for-wp` ^0.12, `vite` ^7.3, `tailwindcss` and `@tailwindcss/vite` ^4.3, `sass` ^1.105, `rollup-plugin-external-globals` ^0.13, `vite-plugin-external` ^6.2 (the last two are peers of `wp_scripts()`) |
| PHP side of vite-for-wp | Copy `truth/vendor/` to `vendor/` and require `vendor/autoload.php` in `functions.php`. No Composer needed |
| Entries | Every `blocks/<name>/{edit.jsx,view.js,style.scss}` becomes a Vite entry automatically, plus `src/main.js` |
| JSX | esbuild `jsxFactory: 'createElement'`, `jsxFragment: 'Fragment'`, `jsxInject` importing both from `@wordpress/element` |
| Interactivity | WordPress serves `@wordpress/interactivity`, so keep it external and don't install it. vite-for-wp only registers classic scripts, so register `view.js` with `wp_register_script_module()` using the manifest. `ride` needs `"supports": { "interactivity": true }` |
| Block styles | A CSS-only entry can't go through `register_asset()`: it would be registered as a script. Use `wp_register_style()` with the manifest's `file`, depending on the main stylesheet |
| Editor script deps | `wp-blocks`, `wp-block-editor`, `wp-components`, `wp-data`, `wp-element`, `wp-i18n`, `wp-server-side-render` |
| Handles | `nearcab-<name>-editor`, `nearcab-<name>-view`, `nearcab-<name>-style`, registered on `init` priority 5, before the blocks register on priority 10 |
| Tailwind | `src/main.css`: `@import "tailwindcss" source("../blocks")`, so it doesn't scan `truth/`, and `@theme inline` reading `--wp--preset--*` |

The Tailwind import matters even with no utility classes: its reset is part of the look.

`vite.config.js`:

```js
import { existsSync, readdirSync } from 'node:fs';
import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import { v4wp } from '@kucrut/vite-for-wp';
import { wp_scripts } from '@kucrut/vite-for-wp/plugins';

// Every blocks/<name>/edit.jsx, view.js and style.scss becomes an entry automatically — adding a block never touches
// this file. Block styles are their own CSS files, loaded only on pages that use the block (functions.php).
const blockEntries = Object.fromEntries(
	readdirSync( 'blocks', { withFileTypes: true } )
		.filter( ( d ) => d.isDirectory() )
		.flatMap( ( { name } ) => [
			[ `${ name }-editor`, `blocks/${ name }/edit.jsx` ],
			[ `${ name }-view`, `blocks/${ name }/view.js` ],
			[ `${ name }-style`, `blocks/${ name }/style.scss` ],
		] )
		.filter( ( [ , path ] ) => existsSync( path ) )
);

export default defineConfig( {
	plugins: [
		tailwindcss(),
		v4wp( {
			input: { main: 'src/main.js', ...blockEntries },
			outDir: 'build',
		} ),
		wp_scripts(),
	],
	build: {
		rollupOptions: {
			// Script Modules resolve via WordPress's import map, not wp.* globals — keep as bare import.
			external: [ '@wordpress/interactivity' ],
		},
	},
	esbuild: {
		jsxFactory: 'createElement',
		jsxFragment: 'Fragment',
		jsxInject: "import { createElement, Fragment } from '@wordpress/element';",
	},
} );
```

## Tokens (`theme.json`)
| Kind | Values |
|---|---|
| Palette | `nearcab-paper` #FDFAF7, `nearcab-ink` #1C1A19, `nearcab-soft` #55524F, `nearcab-cab` #FCCF5D, `nearcab-cab-deep` #E2A93B, `nearcab-blush` #FBE7E2, `nearcab-river` #E2E8EB, `nearcab-road` #EFE9E2 |
| Fonts | `nearcab-display` Libre Franklin 700, `nearcab-text` Literata 400, 600, 400 italic. Self-host from `truth/design/ride-test/fonts/`; Literata is variable, one file per subset covers 400 and 600. Copy each `unicodeRange` from the demo's `@font-face` rules |
| Effect colours | Any other colour in the demo goes in `settings.custom.nearcab` and is read as `--wp--custom--nearcab--*` |
| Global styles | Background `nearcab-paper`, text `nearcab-ink`, font `nearcab-text` |

## Files
- Images: `design/ride-test/img/` to `assets/nearcab/`. Keep them as they are. If you re-encode, never composite on transparent black: it darkens semi-transparent pixels and tints the map. Blank only pixels with alpha below 8.
- Template: `templates/index.html` holds one line, `<!-- wp:pattern {"slug":"nearcab/page"} /-->`.
- Pattern: `patterns/page.php` holds `nearcab/ride` with the six frame blocks in order. No attributes: the copy lives in each `block.json` as defaults.
- `functions.php`: `add_filter( 'show_admin_bar', '__return_false' )`. The page is one pinned screen under a fixed header.

## Blocks (namespace `nearcab/*`, category `theme`)
**`ride`**: container, locked `InnerBlocks` with the six frames, `save` returns `InnerBlocks.Content`. Attributes `brand`, `brandHref` (`#top`), `ctaLabel`, `ctaHref` (`#f4`), `navLabel` (`NearCab`, the header's `aria-label`). Renders the header, the street band (three back and three front paintings, road, cab with wheels, brake light, headlights, exhaust), the sky map (painting plus the SVG geometry copied exactly from the demo; zone paths also in `design/voronoi-zones.json`; zone fills move to classes reading `settings.custom.nearcab`), then the frames.

Frame blocks render in PHP, with markup and classes as the demo's `.frame.f0` to `.f5`. Each also has `frameLabel` for the section's `aria-label`, `parent: ["nearcab/ride"]`, and no `save` output. Demo `style=` attributes become named classes. Decorative images have empty `alt`. Punctuation that joins two attributes can stay in the markup.

| Block | Frame | `data-hold` | Attributes |
|---|---|---|---|
| `pickup` | F0 | 0, plus `data-fit` | `lineOne`, `lineTwo`, `cabAlt`, `lead`, `ctaLabel`, `ctaHref` |
| `call` | F1 | 16 | `statementLines` (one line per line break), `label`, `heading`, `lead`, `body` |
| `sky` | F2 | 45 | `label`, `headingA`, `leadA`, `bodyA`, `captionA`, `headingB`, `leadB`, `stations` (4 × `{time, text}`) |
| `garage` | F3 | 69 | `label`, `heading`, `lead`, `items` (`{title, text, later}`), `linkLabel`, `linkHref` |
| `door` | F4 | 83 | `label`, `heading`, `lead`, `formAction` (`#`), `emailLabel`, `placeholder`, `buttonLabel`, `consentBefore`, `termsLabel`, `termsHref`, `andLabel`, `privacyLabel`, `privacyHref`, `note` |
| `end` | F5 | 100 | `label`, `bigLabel`, `bigHref`, `body`, `fine` (array of strings) |

Attribute defaults are the demo's text, exactly.

Form fields are named `email` and `terms`.

The editor for frame blocks is one shared helper: an inspector field per string, a switch per boolean, a textarea or item panels per array, and `ServerSideRender` for the preview. Previews stack as plain content: copy is edited in the side panels, so the editor needs no ride CSS.

## Interactivity store (`nearcab`, in `blocks/ride/view.js`)
`data-wp-interactive="nearcab"` goes on the block wrapper, because the header sits outside the stage.

1. **Measure** on load, fonts ready and resize. For each `.frame`, the room is `clientHeight - paddingTop - 24`. A frame with `data-fit` gets `--fit: min(1, room / grid.scrollHeight)`. Every other frame gets `--over`, its overflow in px.
2. **Sky state:** `is-sky` on the stage with safety margins, on inside `[.24, .565]`, off only outside `[.215, .59]`.
3. **Moving:** `is-moving` on the stage until 120 ms after the last scroll. Wheel blur is `--drive * --moving * 2.2px`, with `--drive` a registered `@property`.
4. **Jump:** header CTA, pickup CTA and brand smooth-scroll to the target frame's `data-hold` percent of the ride (`#top` counts as 0), only when scroll timelines are supported and motion is not reduced. The action calls `event.preventDefault()`, so wrap it in `withSyncEvent`.

Use `data-wp-init`, `data-wp-on-window--scroll`, `data-wp-on-window--resize`, `data-wp-class--is-sky`, `data-wp-class--is-moving`, `data-wp-on--click`.

## CSS
Port the demo's `<style>` into the blocks' `style.scss`: stage, band, cab and keyframes in `ride`, frame layouts in each frame block. Wrap it in `.nearcab { }`, except `@property`, which must stay top level or the wheel blur silently dies. Demo tokens on `:root` move to `.nearcab`; its `*` and `img` resets are covered by Tailwind's. Keep every keyframe percentage, `clamp()` and safety value identical. The street keyframes are safe on wide screens because of their `min()` and `max()` clamps; never simplify them.

## Deliberate differences from the demo
| Build | Why |
|---|---|
| F0 scales to fit (`transform: scale(var(--fit, 1))`, origin `0 0`, no inner animation) | The first frame must never scroll inside itself |
| Frame keyframes also animate `visibility`, with `visible` set at the hold keyframes | In the demo, the invisible F4 input catches clicks meant for the F0 button |
| Frame selectors are `.frame.fN` | They beat `.frame` whatever order the block styles load in. Use them for `.consent` too: it ties with `.wash`, and its padding is `18px 22px` on phones and `36px 40px 40px` from 768px |
| `.nearcab a { text-decoration: underline }` | Tailwind's reset removes link underlines |
| CTAs ride to F4 | The demo jumps |
| Form is `method="post"` to `formAction`, email and consent required | The reader connects their own mailing list |

Phones, in the demo too: the stage is `100dvh` while frames and the band stay `svh`, so the street stays on the screen's bottom edge when the URL bar collapses. `.ride` is road-coloured behind it. The door's phone spacing keeps the consent clear of the street at the start of its hold.

## Done
`npm run build` passes, `php -l` is clean on every PHP file if PHP is on the path, and `wp-package/SELF-CHECK.md` passes.
