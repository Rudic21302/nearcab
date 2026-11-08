<?php
/**
 * NearCab Garage (F3) — dynamic render. Stop 3, what exists today: heading and lead, an index of items sliding in one
 * by one (a "later" item is greyed with a watercolour drop), and the link to the prototype. Visible at 66-72%.
 *
 * @var array $attributes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<section class="frame f3" id="f3" data-hold="69" aria-label="<?php echo esc_attr( $attributes['frameLabel'] ?? '' ); ?>">
	<div class="grid">
		<p class="label rule"><?php echo esc_html( $attributes['label'] ?? '' ); ?></p>
		<h2 class="head"><?php echo esc_html( $attributes['heading'] ?? '' ); ?></h2>
		<p class="lead"><?php echo esc_html( $attributes['lead'] ?? '' ); ?></p>
		<ol class="index">
			<?php foreach ( (array) ( $attributes['items'] ?? array() ) as $item ) : ?>
				<li<?php echo empty( $item['later'] ) ? '' : ' class="later"'; ?>>
					<?php if ( ! empty( $item['later'] ) ) : ?>
						<img class="drop" src="<?php echo esc_url( get_theme_file_uri( 'assets/nearcab/drop-blush.webp' ) ); ?>" alt="">
					<?php endif; ?>
					<h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3><p><?php echo esc_html( $item['text'] ?? '' ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
		<p class="more label"><a href="<?php echo esc_url( $attributes['linkHref'] ?? '' ); ?>"><?php echo esc_html( $attributes['linkLabel'] ?? '' ); ?></a></p>
	</div>
</section>
