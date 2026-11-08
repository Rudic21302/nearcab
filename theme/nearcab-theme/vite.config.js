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
