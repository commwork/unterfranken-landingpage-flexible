<footer class="container_wrapper section" role="contentinfo">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav class="footer-nav" aria-label="Footer-Navigation">
                    <a href="<?php echo home_url(); ?>/impressum">Impressum</a>
                    <a href="<?php echo home_url(); ?>/datenschutzerklaerung">Datenschutzerklärung</a>
                    <a href="#cookie-einstellungen">Cookie-Einstellungen</a>
				</nav>
			</div>

			<div class="col-12">
				<p class="copyright">
                    &copy; <?php echo date('Y'); ?> AWO Unterfranken
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

