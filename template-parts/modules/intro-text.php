<?php
/**
 * Module: Intro-Text
 *
 * @package uflp
 */

$text = get_sub_field( 'text' );

if ( ! $text ) {
	return;
}
?>
<div class="lead editor">
	<?php echo wp_kses_post( $text ); ?>
</div>
