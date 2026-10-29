<?php
/**
 * Module: Bild
 *
 * @package uflp
 */

$image_id = get_sub_field( 'image' );

if ( ! $image_id ) {
	return;
}

$caption   = wp_get_attachment_caption( $image_id );
$mime_type = get_post_mime_type( $image_id );
$is_svg    = ( 'image/svg+xml' === $mime_type );

$figure_class = $is_svg ? 'module-image module-image--svg' : 'img-wrap-1-1';
?>
<figure class="<?php echo esc_attr( $figure_class ); ?>">
	<?php
	echo wp_get_attachment_image(
		$image_id,
		$is_svg ? 'full' : 'large',
		false,
		array(
			'class' => 'radius-m',
		)
	);
	?>
	<?php if ( $caption ) : ?>
		<figcaption><?php echo esc_html( $caption ); ?></figcaption>
	<?php endif; ?>
</figure>
