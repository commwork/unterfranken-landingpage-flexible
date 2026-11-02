<footer class="container_wrapper section" role="contentinfo">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav class="footer-nav" aria-label="Footer-Navigation">
					<?php
					$footer_locations = get_nav_menu_locations();
					$footer_menu_id   = $footer_locations['footer'] ?? 0;
					$footer_items     = $footer_menu_id ? wp_get_nav_menu_items( $footer_menu_id ) : array();

					if ( $footer_items ) {
						foreach ( $footer_items as $footer_item ) {
							if ( (int) $footer_item->menu_item_parent !== 0 ) {
								continue;
							}

							$target     = $footer_item->target ? $footer_item->target : '';
							$attributes = ' href="' . esc_url( $footer_item->url ) . '"';

							if ( $target ) {
								$attributes .= ' target="' . esc_attr( $target ) . '"';
							}
							if ( '_blank' === $target ) {
								$attributes .= ' rel="noopener noreferrer"';
							}
							if ( ! empty( $footer_item->current ) ) {
								$attributes .= ' aria-current="page"';
							}
							?>
							<a<?php echo $attributes; ?>><?php echo esc_html( $footer_item->title ); ?></a>
							<?php
						}
					}
					?>

                    <a href="#cookie-einstellungen">Cookie-Einstellungen</a>
				</nav>
			</div>

			<div class="col-12">
				<p class="copyright">
                    &copy; <?php echo esc_html( date( 'Y' ) . ' ' . get_bloginfo( 'name' ) ); ?>
				</p>
			</div>
		</div>
	</div>
</footer>

<?php if ( is_user_logged_in() ) : ?>
	<div class="section-admin-toggle" id="section-admin-toggle" aria-label="<?php esc_attr_e( 'Überschriften anzeigen', 'uflp' ); ?>">
		<div class="toggle-headline-view">
			<button type="button" class="btn-toggle-headline-view" aria-pressed="false">
				Headlines überprüfen
			</button>
		</div>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>

</html>

