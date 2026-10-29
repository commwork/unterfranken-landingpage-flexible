<?php
    /*
     * Template Name: Startseite Flexiteam
     */
    get_header();

    $flexiteam_header = get_field( 'flexiteam_header' ) ?: array();
    $header_headline = $flexiteam_header['headline'] ?? '';
    $header_text = $flexiteam_header['text'] ?? '';
    $header_button = $flexiteam_header['button'] ?? null;
    $header_image = $flexiteam_header['image'] ?? null;
?>
			
<main id="main-content" tabindex="-1">
    <section class="section home-section-1">
        <div class="container">
            <div class="row g-5 flex-center-x">
                <div class="col-12 col-xl-5 content-box">      
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/FYH_Logo_Weiß_Rot.svg" alt="" class="fyh-signage">
                
                    <?php if ( $header_headline !== '' ) : ?>
                    <h1 id="hero-heading">
                        <?php echo esc_html( $header_headline ); ?>
                    </h1>
                    <?php endif; ?>
                    
                    <?php if ( $header_text !== '' ) : ?>
                    <div class="lead color-white">
                        <?php echo wp_kses_post( $header_text ); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $header_button['url'] ) ) : ?>
                        <?php
                        $header_button_target = ! empty( $header_button['target'] ) ? $header_button['target'] : '_self';
                        $header_button_label  = ! empty( $header_button['title'] ) ? $header_button['title'] : $header_button['url'];
                        ?>
                        <a
                            href="<?php echo esc_url( $header_button['url'] ); ?>"
                            class="btn btn-primary"
                            target="<?php echo esc_attr( $header_button_target ); ?>"
                            <?php echo '_blank' === $header_button_target ? 'rel="noopener noreferrer"' : ''; ?>
                        >
                            <?php echo esc_html( $header_button_label ); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <?php if ( ! empty( $header_image['url'] ) ) : ?>
                <div class="col-12 col-xl-6">
                    <figure class="img-wrap-1-1">
                        <img src="<?php echo esc_url( $header_image['url'] ); ?>" alt="<?php echo esc_attr( $header_image['alt'] ?? '' ); ?>" class="radius-m">
                    </figure>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if ( have_rows( 'blocks' ) ) : ?>
        <?php while ( have_rows( 'blocks' ) ) : the_row(); ?>
            <?php if ( 'block' !== get_row_layout() ) { continue; } ?>
            <?php
            $block_options = get_sub_field( 'block_options' ) ?: array();
            $section_classes = array( 'section' );
            if ( ! empty( $block_options['block_option_bgcolor'] ) ) {
                $section_classes[] = 'section-bg-tertiary-light';
            }

            $block_index = get_row_index();
            ?>
            <section
                class="<?php echo esc_attr( implode( ' ', $section_classes ) ); ?>"
                <?php if ( is_user_logged_in() ) : ?>
                    data-block-index="<?php echo esc_attr( (string) $block_index ); ?>"
                <?php endif; ?>
            >
                <div class="container">
                    <div class="row g-5 flex-center-x">
                        <?php if ( have_rows( 'columns' ) ) : ?>
                            <?php while ( have_rows( 'columns' ) ) : the_row(); ?>
                                <?php if ( 'column' !== get_row_layout() ) { continue; } ?>
                                <?php
                                $column_options = get_sub_field( 'column_options' ) ?: array();
                                $column_width   = isset( $column_options['column_options_width'] )
                                    ? (string) $column_options['column_options_width']
                                    : '12';

                                $column_classes = array( 'col-12', 'content-box' );
                                if ( '6' === $column_width ) {
                                    $column_classes[] = 'col-xl-6';
                                } elseif ( '4' === $column_width ) {
                                    $column_classes[] = 'col-xl-4';
                                }
                                ?>
                                <div class="<?php echo esc_attr( implode( ' ', $column_classes ) ); ?>">
                                    <?php if ( have_rows( 'modules_content' ) ) : ?>
                                        <?php
                                        $module_map = array(
                                            'module_headline' => 'module-headline',
                                            'text'            => 'text',
                                            'intro_text'      => 'intro-text',
                                            'image'           => 'image',
                                            'accordion'       => 'accordion',
                                            'links'           => 'links',
                                            'benefits'        => 'benefits',
                                        );
                                        ?>
                                        <?php while ( have_rows( 'modules_content' ) ) : the_row(); ?>
                                            <?php
                                            $layout = get_row_layout();
                                            if ( isset( $module_map[ $layout ] ) ) {
                                                get_template_part( 'template-parts/modules/' . $module_map[ $layout ] );
                                            }
                                            ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>