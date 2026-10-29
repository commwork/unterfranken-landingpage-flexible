<?php
/**
 * Module: Accordion
 *
 * @package uflp
 */

$content = get_sub_field( 'content' ) ?: array();
$rows    = $content['accordion_row'] ?? null;

if ( empty( $rows ) || ! is_array( $rows ) ) {
	return;
}
?>
<div class="accordion">
	<?php foreach ( $rows as $index => $row ) : ?>
		<?php
		$title = $row['title'] ?? '';
		$text  = $row['text'] ?? '';

		if ( $title === '' && $text === '' ) {
			continue;
		}

		$item_id = 'accordion-item-' . get_row_index() . '-' . ( $index + 1 );
		?>
		<div class="accordion-item">
			<button
				class="accordion-item-title"
				type="button"
				aria-expanded="false"
				aria-controls="<?php echo esc_attr( $item_id ); ?>"
			>
				<span><?php echo esc_html( $title ); ?></span>
				<span class="accordion-icon" aria-hidden="true">
					<span class="accordion-icon-plus"></span>
					<span class="accordion-icon-minus"></span>
				</span>
			</button>
			<div class="accordion-item-content" id="<?php echo esc_attr( $item_id ); ?>">
				<div>
					<?php echo wp_kses_post( $text ); ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
