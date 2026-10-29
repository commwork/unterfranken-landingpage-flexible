<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

    <title>AWO Flexiteam</title>
    <meta name="description" content="Wir bei der AWO geben unseren Pflegekräften die Möglichkeit, genau nach ihren Bedürfnissen zu arbeiten." />
	
	<meta name="page-topic" content="Dienstleistung">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

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