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

$aspect_classes = array(
	'20_9' => 'img-wrap-20-9',
	'16_9' => 'img-wrap-16-9',
	'4_3'  => 'img-wrap-4-3',
	'1_1'  => 'img-wrap-1-1',
);

$image_options = get_sub_field( 'image_options' );
$aspect_ratio  = is_array( $image_options ) ? ( $image_options['image_aspect_ratio'] ?? '' ) : '';
$aspect_class  = $aspect_classes[ $aspect_ratio ] ?? 'img-wrap-20-9';

$figure_class = $is_svg ? 'module-image module-image--svg' : $aspect_class;
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
