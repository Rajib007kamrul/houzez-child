<?php
define( 'HOUZEZ_Extend_JS_DIR_URI', get_stylesheet_directory_uri() . '/assets/js/' );

add_filter( 'houzez_is_dashboard_filter', 'add_client_requirement' );

function add_client_requirement( $templates ) {
	$templates[] = 'template/user_requirment_submit.php';
    $templates[] = 'template/user_requirement.php';

	return $templates;
}

add_filter( 'houzez_property_type_post_type_filter', 'houzez_extend_client' );
add_filter( 'houzez_property_status_post_type_filter', 'houzez_extend_client' );
add_filter( 'houzez_property_features_post_type_filter', 'houzez_extend_client' );
add_filter( 'houzez_property_label_post_type_filter', 'houzez_extend_client' );
add_filter( 'houzez_property_country_post_type_filter', 'houzez_extend_client' );
add_filter( 'houzez_property_state_post_type_filter', 'houzez_extend_client' );
add_filter( 'houzez_property_city_post_type_filter', 'houzez_extend_client' );
add_filter( 'houzez_property_area_post_type_filter', 'houzez_extend_client' );


function houzez_extend_client( $types ) {
    $types[] = 'client_requirement';

    return $types;
}


add_action( 'widgets_init', 'houzez_child_widgets_init' );

function houzez_child_widgets_init() {

	register_sidebar(array(
		'name' => esc_html__('Client Requirement Listings', 'houzez'),
		'id' => 'requirement',
		'description' => esc_html__('Widgets in this area will be shown in requirement listings sidebar.', 'houzez'),
		'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));

	register_sidebar(array(
		'name' => esc_html__('Single Client Requirement', 'houzez'),
		'id' => 'single-requirement',
		'description' => esc_html__('Widgets in this area will be shown in single property sidebar.', 'houzez'),
		'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));
}

include get_stylesheet_directory() . '/inc/class-client-requirement.php';
include get_stylesheet_directory() . '/inc/class-ajax.php';
include get_stylesheet_directory() . '/inc/class-assets.php';
include get_stylesheet_directory() . '/inc/class-shortcode.php';
include get_stylesheet_directory() . '/inc/class-meta.php';
include get_stylesheet_directory() . '/inc/submit-requirement.php';
include get_stylesheet_directory() . '/inc/functions.php';

if ( class_exists( 'ReduxFramework' ) ) {
	// require_once( get_theme_file_path('/inc/options/add-new-requirement.php') );
	require_once get_stylesheet_directory() . '/inc/options/add-new-requirement.php';
}


function filter_query_with_conditional( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( is_tax() ) {
            $query->set( 'post_type', 'property' );
        }
    }
}

add_action( 'pre_get_posts', 'filter_query_with_conditional' );

?>