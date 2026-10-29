<footer class="container_wrapper section" role="contentinfo">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav class="footer-nav" aria-label="Footer-Navigation">

                    <?php
                    /**
                     * /////////////////////////////////////////////////
                     *  > CUSTOM START
                     *  - FOOTER NAVIGATION
                     * /////////////////////////////////////////////////
                     */    
                    ?>
                    <?php 
                    /* AWO Karlsruhe */
                    if ( is_page_template('tpl-home-karlsruhe.php') 
                    || is_page('impressum-awo-karlsruhe') 
                    || is_page('datenschutzerklaerung-awo-karlsruhe') ) { ?>
                        <a href="<?php echo home_url(); ?>/impressum-awo-karlsruhe">Impressum</a>
                        <a href="<?php echo home_url(); ?>/datenschutzerklaerung-awo-karlsruhe">Datenschutzerklärung</a>
                    <?php }
                        /* AWO Unterfranken */  else { ?>                    
                        <a href="<?php echo home_url(); ?>/impressum">Impressum</a>
                        <a href="<?php echo home_url(); ?>/datenschutzerklaerung">Datenschutzerklärung</a>
                    <?php } ?>
                    <?php
                    /**
                     * /////////////////////////////////////////////////
                     *  < CUSTOM END
                     *  - FOOTER NAVIGATION
                     * /////////////////////////////////////////////////
                     */    
                    ?>
                    <a href="#cookie-einstellungen">Cookie-Einstellungen</a>
				</nav>
			</div>

			<div class="col-12">
				<p class="copyright">
                    <?php
                    /**
                     * /////////////////////////////////////////////////
                     *  > CUSTOM START
                     *  - COPYRIGHT
                     * /////////////////////////////////////////////////
                     */    
                    ?>
					<?php 
                    /* AWO Karlsruhe */
                    if ( is_page_template('tpl-home-karlsruhe.php') 
                    || is_page('impressum-awo-karlsruhe') 
                    || is_page('datenschutzerklaerung-awo-karlsruhe') ) { ?>
                        &copy; <?php echo date('Y'); ?> AWO Karlsruhe
                    <?php }
                        /* AWO Unterfranken */  else { ?>
                        &copy; <?php echo date('Y'); ?> AWO Unterfranken
                    <?php } ?>
                    <?php
                    /**
                     * /////////////////////////////////////////////////
                     *  < CUSTOM END
                     *  - COPYRIGHT
                     * /////////////////////////////////////////////////
                     */    
                    ?>
				</p>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>

</html>

