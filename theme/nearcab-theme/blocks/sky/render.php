<?php
/**
 * NearCab Sky (F2) — dynamic render. Stop 2, above the city: shown while the stage is in the sky state (24-56.5% of
 * the ride). Part A explains the zones while they bloom on the map; part B lists the four stations as the route is
 * drawn. The map itself is part of the ride block; restmap is the still map for the plain (no-motion) page.
 *
 * @var array $attributes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<section class="frame f2" id="f2" data-hold="45" aria-label="<?php echo esc_attr( $attributes['frameLabel'] ?? '' ); ?>">
	<div class="grid">
		<div class="card wash river">
			<p class="label rule"><?php echo esc_html( $attributes['label'] ?? '' ); ?></p>
			<div class="parts">
				<div class="part pa">
					<h2 class="head after-label"><?php echo esc_html( $attributes['headingA'] ?? '' ); ?></h2>
					<p class="lead"><?php echo esc_html( $attributes['leadA'] ?? '' ); ?></p>
					<p class="body"><?php echo esc_html( $attributes['bodyA'] ?? '' ); ?></p>
					<p class="label after-label"><?php echo esc_html( $attributes['captionA'] ?? '' ); ?></p>
				</div>
				<div class="part pb">
					<h2 class="head after-label"><?php echo esc_html( $attributes['headingB'] ?? '' ); ?></h2>
					<p class="lead"><?php echo esc_html( $attributes['leadB'] ?? '' ); ?></p>
					<ol class="stations">
						<?php foreach ( array_values( (array) ( $attributes['stations'] ?? array() ) ) as $i => $station ) : ?>
							<li class="st<?php echo (int) $i + 1; ?>"><b><?php echo esc_html( $station['time'] ?? '' ); ?></b><span><?php echo esc_html( $station['text'] ?? '' ); ?></span></li>
						<?php endforeach; ?>
					</ol>
				</div>
			</div>
		</div>
		<div class="restmap"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/nearcab/map-streets.webp' ) ); ?>" alt="<?php echo esc_attr( $attributes['mapAlt'] ?? '' ); ?>"></div>
	</div>
</section>
