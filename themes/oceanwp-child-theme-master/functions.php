<?php
/**
 * OceanWP Child Theme Functions
 */

function oceanwp_child_enqueue_parent_style() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update the theme).
	$theme   = wp_get_theme( 'OceanWP' );
	$version = $theme->get( 'Version' );

	// Load the child stylesheet.
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

/**
 * Get page permalink dynamically by its assigned template.
 */
function get_custom_page_link_by_template($template_name, $fallback_slug) {
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => $template_name,
        'hierarchical' => 0
    ));
    if ($pages && !empty($pages)) {
        return get_permalink($pages[0]->ID);
    }
    return home_url('/' . $fallback_slug . '/');
}

/**
 * Enqueue custom page-specific stylesheets and scripts for the 6 custom templates.
 */
function appletlogic_enqueue_custom_styles() {
    // Check templates and load styling/scripts
    $is_custom_template = false;
    $ver = '1.1.3';

    if ( is_page_template( 'templates/template-home.php' ) ) {
        wp_enqueue_style( 'appletlogic-global', get_stylesheet_directory_uri() . '/css/global.css', array(), $ver );
        wp_enqueue_style( 'appletlogic-home', get_stylesheet_directory_uri() . '/css/home.css', array( 'appletlogic-global' ), $ver );
        wp_enqueue_style( 'appletlogic-service', get_stylesheet_directory_uri() . '/css/service.css', array( 'appletlogic-global' ), $ver );
        wp_enqueue_style( 'appletlogic-portfolio', get_stylesheet_directory_uri() . '/css/portfolio.css', array( 'appletlogic-global' ), $ver );
        wp_enqueue_script( 'appletlogic-global-js', get_stylesheet_directory_uri() . '/js/global.js', array(), $ver, true );
        wp_enqueue_script( 'appletlogic-home-js', get_stylesheet_directory_uri() . '/js/home.js', array( 'appletlogic-global-js' ), $ver, true );
        $is_custom_template = true;
    } elseif ( is_page_template( 'templates/template-service.php' ) || is_singular( 'service' ) ) {
        wp_enqueue_style( 'appletlogic-global', get_stylesheet_directory_uri() . '/css/global.css', array(), $ver );
        wp_enqueue_style( 'appletlogic-service', get_stylesheet_directory_uri() . '/css/service.css', array( 'appletlogic-global' ), $ver );
        wp_enqueue_script( 'appletlogic-global-js', get_stylesheet_directory_uri() . '/js/global.js', array(), $ver, true );
        $is_custom_template = true;
    } elseif ( is_page_template( 'templates/template-industries.php' ) ) {
        wp_enqueue_style( 'appletlogic-global', get_stylesheet_directory_uri() . '/css/global.css', array(), $ver );
        wp_enqueue_style( 'appletlogic-industries', get_stylesheet_directory_uri() . '/css/industries.css', array( 'appletlogic-global' ), $ver );
        wp_enqueue_style( 'appletlogic-home', get_stylesheet_directory_uri() . '/css/home.css', array( 'appletlogic-global' ), $ver ); // Testimonials track slider CSS is defined in home.css
        wp_enqueue_script( 'appletlogic-global-js', get_stylesheet_directory_uri() . '/js/global.js', array(), $ver, true );
        $is_custom_template = true;
    } elseif ( is_page_template( 'templates/template-portfolio.php' ) ) {
        wp_enqueue_style( 'appletlogic-global', get_stylesheet_directory_uri() . '/css/global.css', array(), $ver );
        wp_enqueue_style( 'appletlogic-portfolio', get_stylesheet_directory_uri() . '/css/portfolio.css', array( 'appletlogic-global' ), $ver );
        wp_enqueue_script( 'appletlogic-global-js', get_stylesheet_directory_uri() . '/js/global.js', array(), $ver, true );
        $is_custom_template = true;
    } elseif ( is_page_template( 'templates/template-why-us.php' ) ) {
        wp_enqueue_style( 'appletlogic-global', get_stylesheet_directory_uri() . '/css/global.css', array(), $ver );
        wp_enqueue_style( 'appletlogic-why-us', get_stylesheet_directory_uri() . '/css/why-us.css', array( 'appletlogic-global' ), $ver );
        wp_enqueue_style( 'appletlogic-home', get_stylesheet_directory_uri() . '/css/home.css', array( 'appletlogic-global' ), $ver ); // Testimonials and counters CSS are defined in home.css
        wp_enqueue_script( 'appletlogic-global-js', get_stylesheet_directory_uri() . '/js/global.js', array(), $ver, true );
        $is_custom_template = true;
    } elseif ( is_page_template( 'templates/template-contact.php' ) ) {
        wp_enqueue_style( 'appletlogic-global', get_stylesheet_directory_uri() . '/css/global.css', array(), $ver );
        wp_enqueue_style( 'appletlogic-contact', get_stylesheet_directory_uri() . '/css/contact.css', array( 'appletlogic-global' ), $ver );
        wp_enqueue_script( 'appletlogic-global-js', get_stylesheet_directory_uri() . '/js/global.js', array(), $ver, true );
        $is_custom_template = true;
    } elseif ( is_404() ) {
        wp_enqueue_style( 'appletlogic-global', get_stylesheet_directory_uri() . '/css/global.css', array(), $ver );
        wp_enqueue_script( 'appletlogic-global-js', get_stylesheet_directory_uri() . '/js/global.js', array(), $ver, true );
        $is_custom_template = true;
    }

    // Dequeue parent styles/scripts if we are on our custom templates, to prevent theme conflicts
    if ( $is_custom_template ) {
        wp_dequeue_style( 'oceanwp-style' );
        wp_dequeue_style( 'child-style' );
    }
}
add_action( 'wp_enqueue_scripts', 'appletlogic_enqueue_custom_styles', 999 );

/**
 * Programmatically create the 6 pages if they do not exist and assign their custom templates.
 */
function appletlogic_create_custom_pages() {
    $pages_to_create = array(
        'Home' => array(
            'template' => 'templates/template-home.php',
            'slug'     => 'home'
        ),
        'Services' => array(
            'template' => 'templates/template-service.php',
            'slug'     => 'services'
        ),
        'Industries' => array(
            'template' => 'templates/template-industries.php',
            'slug'     => 'industries'
        ),
        'Portfolio' => array(
            'template' => 'templates/template-portfolio.php',
            'slug'     => 'portfolio'
        ),
        'Why Us' => array(
            'template' => 'templates/template-why-us.php',
            'slug'     => 'why-us'
        ),
        'Contact' => array(
            'template' => 'templates/template-contact.php',
            'slug'     => 'contact'
        ),
    );

    foreach ( $pages_to_create as $title => $data ) {
        // Query to check if page with template already exists
        $query = new WP_Query( array(
            'post_type'      => 'page',
            'meta_key'       => '_wp_page_template',
            'meta_value'     => $data['template'],
            'posts_per_page' => 1
        ) );

        if ( ! $query->have_posts() ) {
            // Check by slug to prevent duplicates
            $page_by_slug = get_page_by_path( $data['slug'] );
            if ( ! $page_by_slug ) {
                $page_id = wp_insert_post( array(
                    'post_title'   => $title,
                    'post_name'    => $data['slug'],
                    'post_status'  => 'publish',
                    'post_type'    => 'page',
                    'post_content' => '',
                ) );

                if ( ! is_wp_error( $page_id ) ) {
                    update_post_meta( $page_id, '_wp_page_template', $data['template'] );
                }
            } else {
                update_post_meta( $page_by_slug->ID, '_wp_page_template', $data['template'] );
            }
        }
    }
}
add_action( 'init', 'appletlogic_create_custom_pages' );

/**
 * Dynamically populate the Contact Form 7 service-name hidden field.
 */
function appletlogic_populate_cf7_service_name( $tag, $replace ) {
    if ( isset( $tag['name'] ) && $tag['name'] === 'service-name' ) {
        $service_name = '';

        if ( is_singular( 'service' ) ) {
            $service_name = get_the_title();
        } elseif ( is_page_template( 'templates/template-service.php' ) ) {
            $slug = isset( $_GET['slug'] ) ? sanitize_key( $_GET['slug'] ) : '';
            if ( $slug ) {
                $service_post = get_page_by_path( $slug, OBJECT, 'service' );
                if ( $service_post ) {
                    $service_name = get_the_title( $service_post->ID );
                }
            }
        }

        if ( ! empty( $service_name ) ) {
            $tag['values'] = (array) $service_name;
        }
    }
    return $tag;
}
add_filter( 'wpcf7_form_tag', 'appletlogic_populate_cf7_service_name', 10, 2 );

/**
 * Custom Post Types and Meta Fields for Services and Testimonials.
 */
require_once get_stylesheet_directory() . '/inc/cpt-fields.php';

/**
 * Custom validation filter for Contact Form 7 tel/phone fields (minimum 7 digits).
 */
function appletlogic_cf7_tel_validation_filter( $result, $tag ) {
    $tag = new WPCF7_FormTag( $tag );
    $name = $tag->name;

    // Check if the field name contains 'intl_tel' or 'phone', or if the field type is tel
    if ( $tag->type === 'tel' || $tag->type === 'tel*' || strpos( $name, 'intl_tel' ) === 0 || strpos( $name, 'phone' ) !== false ) {
        $value = isset( $_POST[$name] ) ? trim( $_POST[$name] ) : '';
        if ( ! empty( $value ) ) {
            // Strip everything except digits to count them
            $digits = preg_replace( '/[^0-9]/', '', $value );
            if ( strlen( $digits ) < 7 ) {
                $result->invalidate( $tag, 'Phone number must be at least 7 digits.' );
            }
        }
    }
    return $result;
}
add_filter( 'wpcf7_validate_tel', 'appletlogic_cf7_tel_validation_filter', 20, 2 );
add_filter( 'wpcf7_validate_tel*', 'appletlogic_cf7_tel_validation_filter', 20, 2 );
add_filter( 'wpcf7_validate_text', 'appletlogic_cf7_tel_validation_filter', 20, 2 );
add_filter( 'wpcf7_validate_text*', 'appletlogic_cf7_tel_validation_filter', 20, 2 );

