<?php
/**
 * NearCab Call (F1) — dynamic render. Stop 1: the statement (one line per line of statementLines) and a washed card
 * with the painted phone. Visible at 12.5-20% of the ride (style.scss k1).
 *
 * @var array $attributes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lines = array_map( 'esc_html', preg_split( '/\R/', trim( $attributes['statementLines'] ?? '' ) ) );
?>
<section class="frame f1" id="f1" data-hold="16" aria-label="<?php echo esc_attr( $attributes['frameLabel'] ?? '' ); ?>">
	<div class="grid">
		<p class="display"><?php echo implode( '<br>', $lines ); // phpcs:ignore WordPress.Security.EscapeOutput -- each line escaped. ?></p>
		<div class="card wash blush">
			<p class="label rule"><?php echo esc_html( $attributes['label'] ?? '' ); ?></p>
			<h2 class="head after-label"><?php echo esc_html( $attributes['heading'] ?? '' ); ?></h2>
			<p class="lead"><?php echo esc_html( $attributes['lead'] ?? '' ); ?></p>
			<p class="body"><?php echo esc_html( $attributes['body'] ?? '' ); ?></p>
			<img class="phone" src="<?php echo esc_url( get_theme_file_uri( 'assets/nearcab/phone.webp' ) ); ?>" alt="">
		</div>
	</div>
</section>
