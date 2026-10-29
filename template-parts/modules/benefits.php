<?php
/**
 * Module: Benefits
 *
 * @package uflp
 */

$content  = get_sub_field( 'content' ) ?: array();
$benefits = $content['benefits'] ?? null;

if ( empty( $benefits ) || ! is_array( $benefits ) ) {
	return;
}
?>
<div class="module-benefits">
	<?php foreach ( $benefits as $benefit ) : ?>
		<?php
		$icon_option = $benefit['icon_options'] ?? 'standard';
		$icon_url    = $benefit['icon'] ?? '';
		$title       = $benefit['titel'] ?? '';
		$text        = $benefit['text'] ?? '';

		if ( $title === '' && $text === '' ) {
			continue;
		}
		?>
		<article class="module-benefits-item">
			<?php if ( 'none' !== $icon_option ) : ?>
				<?php if ( 'upload' === $icon_option && $icon_url ) : ?>
					<div
						class="module-benefits-icon module-benefits-icon--masked"
						aria-hidden="true"
						style="--icon-url: url('<?php echo esc_url( $icon_url ); ?>');"
					></div>
				<?php else : ?>
					<div class="module-benefits-icon" aria-hidden="true">
						<span class="module-benefits-icon-check"></span>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( $title !== '' ) : ?>
				<h3 class="module-benefits-title h4"><?php echo esc_html( $title ); ?></h3>
			<?php endif; ?>

			<?php if ( $text !== '' ) : ?>
				<div class="module-benefits-text">
					<?php echo wp_kses_post( $text ); ?>
				</div>
			<?php endif; ?>
		</article>
	<?php endforeach; ?>
</div>
