<?php 

add_filter( 'rwmb_meta_boxes', 'prefix_register_meta_boxes' );

function prefix_register_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => 'Personal Information',
        'post_types' => 'property',
        'fields' => array(
            array(
                'name'  => 'Full name',
                'desc'  => 'Format: {First Name} {Last Name}',
                'id'    => 'prefix_name',
                'type'  => 'text',
            ),
        )
    );


    return $meta_boxes;
}


include_once( get_theme_file_path('/framework/metaboxes/property/information.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/fields_builder.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/map.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/settings.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/media.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/virtual_tour.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/agent.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/home_slider.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/multi_units.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/floor_plans.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/attachments.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/private_note.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/energy.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/listing_layout.php') );

include_once( get_theme_file_path('/framework/metaboxes/property/listing_rental.php') );

if( !function_exists('houzez_extend_register_property_metaboxes') ) {

    function houzez_extend_register_property_metaboxes( $meta_boxes ) {

        $meta_boxes_tabs = array();

        $meta_boxes_fields = array();

        $meta_boxes[] = array(
            'id'         => 'houzez-property-meta-box',
            'title'      => esc_html__('Requirement', 'houzez'),
            'post_types' => array( 'client_requirement' ),
            'tabs'       => apply_filters( 'houzez_property_metabox_tabs', $meta_boxes_tabs ),
            'tab_style'  => 'left',
            'fields'     => apply_filters( 'houzez_property_metabox_fields', $meta_boxes_fields ),
        );

        return apply_filters( 'houzez_extend_theme_meta', $meta_boxes );

    }

    add_filter( 'rwmb_meta_boxes', 'houzez_extend_register_property_metaboxes' );
}
