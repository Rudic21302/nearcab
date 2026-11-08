<?php
/**
 * NearCab Pickup (F0) — dynamic render. The first stop: two display lines rise in, the painted cab sits before line
 * two like a word. Visible at 0-5% of the ride (style.scss k0).
 *
 * @var array $attributes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<section class="frame f0" data-hold="0" data-fit aria-label="<?php echo esc_attr( $attributes['frameLabel'] ?? '' ); ?>">
	<div class="grid">
		<h1 class="display"><span class="heroln"><span><?php echo esc_html( $attributes['lineOne'] ?? '' ); ?></span></span><span class="heroln"><span><img class="cabword" src="<?php echo esc_url( get_theme_file_uri( 'assets/nearcab/taxi-side.webp' ) ); ?>" alt="<?php echo esc_attr( $attributes['cabAlt'] ?? '' ); ?>"> <?php echo esc_html( $attributes['lineTwo'] ?? '' ); ?></span></span></h1>
		<p class="lead"><?php echo esc_html( $attributes['lead'] ?? '' ); ?></p>
		<p class="act"><a class="btn" href="<?php echo esc_url( $attributes['ctaHref'] ?? '' ); ?>" data-wp-on--click="actions.jump"><?php echo esc_html( $attributes['ctaLabel'] ?? '' ); ?></a></p>
	</div>
</section>
