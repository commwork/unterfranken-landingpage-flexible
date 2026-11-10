<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

    <title><?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
    <!-- <meta name="description" content="AWO als Arbeitegeber" /> -->
	
	<meta name="page-topic" content="Dienstleistung">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="skip-link" href="#main-content">Zum Inhalt springen</a>

<header class="header-section" role="banner">
    <?php
    $logo       = function_exists( 'get_field' ) ? get_field( 'main_logo', 'option' ) : null;
    $logo_url   = '';
    $logo_max_height_mobile  = 50;
    $logo_max_height_desktop = 70;

    if ( is_array( $logo ) ) {
        $logo_url = isset( $logo['logo'] ) && is_string( $logo['logo'] ) ? $logo['logo'] : '';
        if ( isset( $logo['logo_max_height_mobile'] ) && $logo['logo_max_height_mobile'] !== '' ) {
            $logo_max_height_mobile = (int) $logo['logo_max_height_mobile'];
        }
        if ( isset( $logo['logo_max_height_mobile_kopieren'] ) && $logo['logo_max_height_mobile_kopieren'] !== '' ) {
            $logo_max_height_desktop = (int) $logo['logo_max_height_mobile_kopieren'];
        }
    } elseif ( is_string( $logo ) && $logo !== '' ) {
        $logo_url = $logo;
    }

    if ( $logo_url === '' ) {
        $logo_url = get_template_directory_uri() . '/assets/images/no-logo.svg';
    }

    $logo_alt = get_bloginfo( 'name' );
    ?>
    <div class="logo" style="--logo-max-height-mobile: <?php echo esc_attr( $logo_max_height_mobile ); ?>px; --logo-max-height-desktop: <?php echo esc_attr( $logo_max_height_desktop ); ?>px;">
        <?php if ( ! is_front_page() ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Startseite">
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>">
            </a>
        <?php else : ?>
            <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $logo_alt ); ?>">
        <?php endif; ?>
    </div>
</header>