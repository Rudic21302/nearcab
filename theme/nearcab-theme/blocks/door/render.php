<?php
/**
 * NearCab Door (F4) — dynamic render. Stop 4, the waitlist: the stage turns cab-yellow (80-86%). The form posts
 * to the address in the formAction attribute ("#" until you connect a mailing list). The terms consent is required.
 *
 * @var array $attributes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$input_id = wp_unique_id( 'nearcab-email-' );
?>
<section class="frame f4" id="f4" data-hold="83" aria-label="<?php echo esc_attr( $attributes['frameLabel'] ?? '' ); ?>">
	<form class="grid nearcab-waitlist" method="post" action="<?php echo esc_url( $attributes['formAction'] ?? '' ); ?>">
		<p class="label rule door-label"><?php echo esc_html( $attributes['label'] ?? '' ); ?></p>
		<h2 class="display"><?php echo esc_html( $attributes['heading'] ?? '' ); ?></h2>
		<p class="lead"><?php echo esc_html( $attributes['lead'] ?? '' ); ?></p>
		<div class="form">
			<label for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_html( $attributes['emailLabel'] ?? '' ); ?></label>
			<input id="<?php echo esc_attr( $input_id ); ?>" type="email" name="email" placeholder="<?php echo esc_attr( $attributes['placeholder'] ?? '' ); ?>" autocomplete="email" required>
			<button type="submit"><?php echo esc_html( $attributes['buttonLabel'] ?? '' ); ?></button>
		</div>
		<label class="consent wash cabwash"><input type="checkbox" name="terms" value="1" required> <span><?php echo esc_html( $attributes['consentBefore'] ?? '' ); ?> <a href="<?php echo esc_url( $attributes['termsHref'] ?? '' ); ?>"><?php echo esc_html( $attributes['termsLabel'] ?? '' ); ?></a> <?php echo esc_html( $attributes['andLabel'] ?? '' ); ?> <a href="<?php echo esc_url( $attributes['privacyHref'] ?? '' ); ?>"><?php echo esc_html( $attributes['privacyLabel'] ?? '' ); ?></a>.</span></label>
		<p class="note"><?php echo esc_html( $attributes['note'] ?? '' ); ?></p>
	</form>
</section>
