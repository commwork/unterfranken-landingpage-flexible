<?php
/**
 * Module: Text
 *
 * @package uflp
 */

$text = get_sub_field( 'text' );

if ( ! $text ) {
	return;
}
?>
<div class="text editor">
	<?php echo wp_kses_post( $text ); ?>
</div>
