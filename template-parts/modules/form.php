<?php
/**
 * Module: Formular
 *
 * @package uflp
 */

$shortcode = get_sub_field( 'form_shortcode' );

if ( ! is_string( $shortcode ) || trim( $shortcode ) === '' ) {
	return;
}
?>
<div class="module-form">
	<?php echo do_shortcode( $shortcode ); ?>
</div>
