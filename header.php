<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

    <?php
        /**
         * /////////////////////////////////////////////////
         *  > CUSTOM START
         *  - TITLE & DESCRIPTION
         * /////////////////////////////////////////////////
         */    
    ?>
    <?php 
        /* AWO Karlsruhe */
        if ( is_page_template('tpl-home-karlsruhe.php') 
        || is_page('impressum-awo-karlsruhe') 
        || is_page('datenschutzerklaerung-awo-karlsruhe') ) { 
    ?>
        <title>AWO Karlsruhe &#8211; Willkommenstag</title>
        <meta name="description" content="Willkommenstag für neue Kolleg*innen der AWO Karlsruhe." />
    <?php } 
        /* AWO Unterfranken */ else { ?>        
        <title>AWO Unterfranken &#8211; Willkommenstag</title>
        <meta name="description" content="Willkommenstag für neue Kolleg*innen der AWO Unterfranken." />
    <?php } ?>
    <?php
        /**
         * /////////////////////////////////////////////////
         *  < CUSTOM END
         *  - TITLE & DESCRIPTION
         * /////////////////////////////////////////////////
         */    
    ?>
	
	<meta name="page-topic" content="Dienstleistung">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
    /**
     * /////////////////////////////////////////////////
     *  > CUSTOM START
     *  - NAVIGATION
     * /////////////////////////////////////////////////
     */    
?>
<?php 
/* AWO Karlsruhe */
if ( is_page_template('tpl-home-karlsruhe.php') 
|| is_page('impressum-awo-karlsruhe') 
|| is_page('datenschutzerklaerung-awo-karlsruhe') ) { ?>
    <header class="header-section" role="banner">
        <div class="logo">
            <?php if ( ! is_front_page() ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Startseite">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/logo-awo-karlsruhe.png" alt="AWO Karlsruhe | Startseite">
                </a>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/logo-awo-karlsruhe.png" alt="AWO Karlsruhe | Startseite" aria-label="AWO Karlsruhe | Startseite	">
            <?php endif; ?>
        </div>
    </header>
<?php }
    /* AWO Care / Flexiteam */
    elseif ( is_page_template( 'tpl-home-flexiteam.php' ) ) { ?>
    <header class="header-section" role="banner">
        <div class="logo">
            <?php if ( ! is_front_page() ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Startseite">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/logo-awo-care.png" alt="AWO care | Startseite">
                </a>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/logo-awo-care.png" alt="AWO care | Startseite" aria-label="AWO care | Startseite">
            <?php endif; ?>
        </div>
    </header>
<?php }
    /* AWO Unterfranken pages */  else { ?>                    
    <header class="header-section" role="banner">
        <div class="logo">
            <?php if ( ! is_front_page() ) : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Startseite">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/awo-unterfranken_logo.svg" alt="AWO Unterfranken | Startseite">
                </a>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/awo-unterfranken_logo.svg" alt="AWO Unterfranken | Startseite" aria-label="AWO Unterfranken | Startseite	">
            <?php endif; ?>
        </div>

        <?php if ( is_front_page() ) : ?>
            <div class="header-section-button">
                <a href="#kontakt-section" class="btn btn-secondary btn-icon-arrow-down" rel="noopener noreferrer">Jetzt Teilnahme bestätigen</a>
            </div>
        <?php endif; ?>
    </header>
<?php } ?>
<?php
    /**
     * /////////////////////////////////////////////////
     *  < CUSTOM END
     *  - NAVIGATION
     * /////////////////////////////////////////////////
     */    
?>
