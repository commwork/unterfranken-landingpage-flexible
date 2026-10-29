<?php
/**
 * Module: Überschrift
 *
 * @package uflp
 */

$tag    = get_sub_field( 'headline_hirarchy' ) ?: 'h2';
$design = get_sub_field( 'headline_design' ) ?: $tag;
$text   = get_sub_field( 'text' );

if ( ! $text ) {
	return;
}

$allowed = array( 'h2', 'h3', 'h4' );

if ( ! in_array( $tag, $allowed, true ) ) {
	$tag = 'h2';
}

if ( ! in_array( $design, $allowed, true ) ) {
	$design = $tag;
}
?>
<<?php echo tag_escape( $tag ); ?> class="<?php echo esc_attr( $design ); ?>">
	<?php echo esc_html( $text ); ?>
</<?php echo tag_escape( $tag ); ?>>
