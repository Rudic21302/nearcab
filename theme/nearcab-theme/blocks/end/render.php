<?php
/**
 * NearCab End (F5) — dynamic render. End of the line (97-100%): a giant link home, a short body, the fine print in a
 * washed card. Night falls on the street behind it (the cab's headlights come on).
 *
 * @var array $attributes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<section class="frame f5" data-hold="100" aria-label="<?php echo esc_attr( $attributes['frameLabel'] ?? '' ); ?>">
	<div class="grid">
		<p class="label rule"><?php echo esc_html( $attributes['label'] ?? '' ); ?></p>
		<a class="big" href="<?php echo esc_url( $attributes['bigHref'] ?? '' ); ?>"><?php echo esc_html( $attributes['bigLabel'] ?? '' ); ?></a>
		<p class="body"><?php echo esc_html( $attributes['body'] ?? '' ); ?></p>
		<div class="card wash blush"><div class="fine label">
			<?php foreach ( (array) ( $attributes['fine'] ?? array() ) as $line ) : ?>
				<span><?php echo esc_html( $line ); ?></span>
			<?php endforeach; ?>
		</div></div>
	</div>
</section>
