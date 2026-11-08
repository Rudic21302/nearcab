<?php
/**
 * NearCab theme bootstrap: registers the blocks and loads the Vite build through @kucrut/vite-for-wp.
 */

use Kucrut\Vite;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NEARCAB_DIR', get_template_directory() );
define( 'NEARCAB_BUILD_DIR', NEARCAB_DIR . '/build' );

require_once NEARCAB_DIR . '/vendor/autoload.php';

/**
 * A block added since the last `npm run build` has no manifest entry yet: skip it instead of breaking the page.
 */
function nearcab_is_built( string $entry ): bool {
	$manifest = Vite\get_manifest( NEARCAB_BUILD_DIR );
	return $manifest->is_dev || isset( $manifest->data->{$entry} );
}

/**
 * Register a Vite entry as a Script Module (Interactivity API). vite-for-wp only handles classic scripts.
 */
function nearcab_register_view_module( string $id, string $entry ): void {
	if ( ! nearcab_is_built( $entry ) ) {
		return;
	}
	$manifest = Vite\get_manifest( NEARCAB_BUILD_DIR );
	$src      = $manifest->is_dev
		? Vite\generate_development_asset_src( $manifest, $entry )
		: Vite\prepare_asset_url( $manifest->dir ) . '/' . $manifest->data->{$entry}->file;

	wp_register_script_module( $id, $src, array( '@wordpress/interactivity' ), null );
}

/**
 * Shared stylesheet (src/main.js), registered once so block styles can depend on it.
 */
function nearcab_main_assets(): array {
	static $assets = null;
	if ( null === $assets ) {
		$assets = (array) Vite\register_asset( NEARCAB_BUILD_DIR, 'src/main.js', array( 'handle' => 'nearcab-main' ) );
	}
	return $assets;
}

// Priority 5: handles must exist before blocks register on init:10 and reference them from block.json.
add_action(
	'init',
	function () {
		$editor_deps = array( 'wp-blocks', 'wp-block-editor', 'wp-components', 'wp-data', 'wp-element', 'wp-i18n', 'wp-server-side-render' );

		// blocks/<name>/edit.jsx -> handle nearcab-<name>-editor, view.js -> module nearcab-<name>-view, style.scss -> nearcab-<name>-style.
		foreach ( glob( NEARCAB_DIR . '/blocks/*/block.json' ) as $block_json ) {
			$dir  = dirname( $block_json );
			$name = basename( $dir );

			if ( nearcab_is_built( "blocks/$name/edit.jsx" ) ) {
				Vite\register_asset(
					NEARCAB_BUILD_DIR,
					"blocks/$name/edit.jsx",
					array(
						'handle'       => "nearcab-$name-editor",
						'dependencies' => $editor_deps,
					)
				);
			}

			if ( file_exists( "$dir/view.js" ) ) {
				nearcab_register_view_module( "nearcab-$name-view", "blocks/$name/view.js" );
			}

			$manifest = Vite\get_manifest( NEARCAB_BUILD_DIR );
			if ( ! $manifest->is_dev && nearcab_is_built( "blocks/$name/style.scss" ) ) {
				wp_register_style( "nearcab-$name-style", Vite\prepare_asset_url( $manifest->dir ) . '/' . $manifest->data->{"blocks/$name/style.scss"}->file, nearcab_main_assets()['styles'] ?? array(), null );
			}
		}
	},
	5
);

add_action(
	'init',
	function () {
		foreach ( glob( NEARCAB_DIR . '/blocks/*/block.json' ) as $block_json ) {
			register_block_type( dirname( $block_json ) );
		}
	}
);

// Shared stylesheet: frontend and editor canvas. Block styles load per block.
add_action(
	'enqueue_block_assets',
	function () {
		foreach ( nearcab_main_assets() as $group => $handles ) {
			array_map( 'scripts' === $group ? 'wp_enqueue_script' : 'wp_enqueue_style', $handles );
		}
	}
);

// One pinned screen under a fixed header: the admin bar would cover the header and push the stage down.
add_filter( 'show_admin_bar', '__return_false' );
