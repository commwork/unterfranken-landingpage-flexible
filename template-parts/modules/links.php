<?php
/**
 * Module: Links (Buttons)
 *
 * @package uflp
 */

$links = get_sub_field( 'links' );

if ( empty( $links ) || ! is_array( $links ) ) {
	return;
}
?>
<div class="module-links">
	<?php foreach ( $links as $item ) : ?>
		<?php
		$link = $item['url'] ?? null;

		if ( empty( $link['url'] ) ) {
			continue;
		}

		$target = ! empty( $link['target'] ) ? $link['target'] : '_self';
		$label  = ! empty( $link['title'] ) ? $link['title'] : $link['url'];
		?>
		<a
			href="<?php echo esc_url( $link['url'] ); ?>"
			class="btn btn-primary"
			target="<?php echo esc_attr( $target ); ?>"
			<?php echo '_blank' === $target ? 'rel="noopener noreferrer"' : ''; ?>
		>
			<?php echo esc_html( $label ); ?>
		</a>
	<?php endforeach; ?>
</div>
