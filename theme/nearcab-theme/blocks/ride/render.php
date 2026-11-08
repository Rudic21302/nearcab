<?php
/**
 * NearCab Ride — dynamic render. The design study: one pinned stage that the page
 * scroll drives like a camera. The street band (three back and three front paintings, the road, the cab) pans left
 * stop by stop; between the second and third stop the stage lifts into the sky and the Voronoi zone map takes over.
 * The six frames ($content) are the reading stops.
 *
 * Motion is CSS scroll-driven animation (style.scss); view.js only measures overflowing frames, switches the sky
 * state with safety margins and marks scrolling for the wheel blur. Without scroll timelines or with reduced motion
 * the frames are a plain page.
 *
 * Reference: truth/design/ride-test/index.html (the demo; match it pixel for pixel).
 *
 * @var array  $attributes
 * @var string $content
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img = static fn( string $name ) => esc_url( get_theme_file_uri( "assets/nearcab/$name.webp" ) );

// Voronoi zones around the painted cabs (viewBox 0-100), computed by half-plane clipping in the design phase.
$zones = array(
	'M0.0 0.0 L51.1 0.0 L36.5 32.2 L0.0 37.8 Z',
	'M51.1 0.0 L89.7 0.0 L48.0 48.7 L47.0 48.2 L36.5 32.2 Z',
	'M89.7 0.0 L100.0 0.0 L100.0 32.1 L97.4 35.0 L52.5 53.0 L48.0 48.7 Z',
	'M0.0 80.0 L0.0 37.8 L36.5 32.2 L47.0 48.2 Z',
	'M53.9 57.8 L52.5 53.0 L97.4 35.0 L80.6 68.9 L79.2 69.9 Z',
	'M16.2 100.0 L0.0 100.0 L0.0 80.0 L47.0 48.2 L48.0 48.7 L52.5 53.0 L53.9 57.8 L46.6 81.8 Z',
	'M100.0 32.1 L100.0 80.5 L80.6 68.9 L97.4 35.0 Z',
	'M46.6 81.8 L53.9 57.8 L79.2 69.9 L74.7 79.9 L66.2 84.9 Z',
	'M100.0 80.5 L100.0 100.0 L92.0 100.0 L74.7 79.9 L79.2 69.9 L80.6 68.9 Z',
	'M92.0 100.0 L67.7 100.0 L66.2 84.9 L74.7 79.9 Z',
	'M67.7 100.0 L16.2 100.0 L46.6 81.8 L66.2 84.9 Z',
);
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'nearcab' ) ); ?> data-wp-interactive="nearcab">
	<header class="nav" aria-label="<?php echo esc_attr( $attributes['navLabel'] ?? '' ); ?>">
		<a class="brand" href="<?php echo esc_url( $attributes['brandHref'] ?? '' ); ?>" data-wp-on--click="actions.jump"><?php echo esc_html( $attributes['brand'] ?? '' ); ?></a>
		<a class="btn" href="<?php echo esc_url( $attributes['ctaHref'] ?? '' ); ?>" data-wp-on--click="actions.jump"><?php echo esc_html( $attributes['ctaLabel'] ?? '' ); ?></a>
	</header>

	<main class="ride" id="top">
		<div
			class="stage"
			data-wp-init="callbacks.init"
			data-wp-on-window--scroll="callbacks.scroll"
			data-wp-on-window--resize="callbacks.measure"
			data-wp-class--is-sky="state.sky"
			data-wp-class--is-moving="state.moving"
		>
			<div class="band" aria-hidden="true">
				<div class="world"><img src="<?php echo $img( 'dusk-back' ); ?>" alt=""><img src="<?php echo $img( 'garage-back' ); ?>" alt=""><img src="<?php echo $img( 'night-back' ); ?>" alt=""></div>
				<div class="near"><img src="<?php echo $img( 'dusk-front' ); ?>" alt=""><img src="<?php echo $img( 'garage-front' ); ?>" alt=""><img src="<?php echo $img( 'night-front' ); ?>" alt=""></div>
				<div class="road"></div>
				<div class="cab"><span class="lamp"></span><span class="brake"></span><span class="puff"></span><span class="puff"></span><span class="puff"></span><img class="body" src="<?php echo $img( 'taxi-side' ); ?>" alt=""><img class="wheel w1" src="<?php echo $img( 'wheel' ); ?>" alt=""><img class="wheel w2" src="<?php echo $img( 'wheel' ); ?>" alt=""></div>
			</div>

			<div class="mapstage" aria-hidden="true">
				<div class="map">
					<img src="<?php echo $img( 'map-streets' ); ?>" alt="">
					<svg viewBox="0 0 100 100" preserveAspectRatio="none">
						<defs><filter id="nearcab-wc" x="-5%" y="-5%" width="110%" height="110%"><feTurbulence type="fractalNoise" baseFrequency=".09" numOctaves="3" seed="7"/><feDisplacementMap in="SourceGraphic" scale="2.2"/><feGaussianBlur stdDeviation=".35"/></filter></defs>
						<g filter="url(#nearcab-wc)">
							<?php foreach ( $zones as $i => $d ) : ?>
								<path class="zone z<?php echo (int) $i + 1; ?>" d="<?php echo esc_attr( $d ); ?>"/>
							<?php endforeach; ?>
						</g>
						<circle class="ping" cx="51.9" cy="47.3" r="2"/>
						<path class="route" d="M63.3 39.0 L57.6 43.2 L51.9 47.3"/>
						<circle class="dot" cx="63.3" cy="39.0" r="1.4"/>
					</svg>
				</div>
			</div>

			<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput -- rendered inner blocks. ?>
		</div>
	</main>
</div>
