<?php 

function houzez_extend_enqueue_scripts() {
    if( is_singular('client_requirement') ) {
        wp_register_script( 'single-client-share-requirement', HOUZEZ_Extend_JS_DIR_URI . 'single-client-share-requirement.js', array('jquery'), '1.0.0', true );
        wp_register_script( 'single-client-share-property', HOUZEZ_Extend_JS_DIR_URI . 'single-client-share-property.js', array('jquery'), '1.0.0', true );

    }

    if ( is_page_template('template/user_requirment_submit.php') ) {
        wp_enqueue_script('validate', HOUZEZ_JS_DIR_URI . 'vendors/jquery.validate.min.js', array('jquery'), '1.19.0', true);
    }

    // if( houzez_is_dashboard() ) {   
        wp_enqueue_script('requirement_js', HOUZEZ_Extend_JS_DIR_URI . 'houzez_requirement.js', array('jquery'), '1.19.0', true);

        $requirement_data = [
            'ajaxURL' => admin_url('admin-ajax.php'),
            'verify_nonce' => wp_create_nonce('verify_gallery_nonce'),
            'verify_file_type' => esc_html__('Valid file formats', 'houzez'),
            'msg_digits' => esc_html__('Please enter only digits', 'houzez'),
            'image_max_file_size' => houzez_option('image_max_file_size'),
            'max_prop_attachments' => houzez_option('max_prop_attachments', '3'),
            'attachment_max_file_size' => houzez_option('attachment_max_file_size', '12000kb'),
            'plan_title_text' => houzez_option('cl_plan_title', 'Plan Title' ),
            'plan_size_text' => houzez_option('cl_plan_size', 'Plan Size' ),
            'plan_bedrooms_text' => houzez_option('cl_plan_bedrooms', 'Bedrooms' ),
            'plan_bathrooms_text' => houzez_option('cl_plan_bathrooms', 'Bathrooms' ),
            'plan_price_text' => houzez_option('cl_plan_price', 'Price' ),
            'plan_price_postfix_text' => houzez_option('cl_plan_price_postfix', 'Price Postfix' ),
            'plan_image_text' => houzez_option('cl_plan_img', 'Plan Image' ),
            'plan_description_text' => houzez_option('cl_plan_des', 'Description'),
            'plan_upload_text' => houzez_option('cl_plan_img_btn', 'Select Image'),
            'plan_upload_size' => houzez_option('cl_plan_img_size', 'Minimum size 800 x 600 px'),

            'mu_title_text' => houzez_option('cl_subl_title', 'Title' ),
            'mu_type_text' => houzez_option('cl_subl_type', 'Property Type' ),
            'mu_beds_text' => houzez_option('cl_subl_bedrooms', 'Bedrooms' ),
            'mu_baths_text' => houzez_option('cl_subl_bathrooms', 'Bathrooms' ),
            'mu_size_text' => houzez_option('cl_subl_size', 'Property Size' ),
            'mu_size_postfix_text' => houzez_option('cl_subl_size_postfix', 'Size Postfix' ),
            'mu_price_text' => houzez_option('cl_subl_price', 'Price' ),
            'mu_price_postfix_text' => houzez_option('cl_subl_price_postfix', 'Price Postfix' ),
            'mu_availability_text' => houzez_option('cl_subl_date', 'Availability Date' ),

            'are_you_sure_text' => esc_html__('Are you sure you want to do this?', 'houzez'),
            'delete_btn_text' => esc_html__('Delete', 'houzez'),
            'cancel_btn_text' => esc_html__('Cancel', 'houzez'),
            'confirm_btn_text' => esc_html__('Confirm', 'houzez'),
            'processing_text' => esc_html__('Processing, Please wait...', 'houzez'),
            'add_listing_msg' => esc_html__('Submitting, Please wait...', 'houzez'),
            'confirm_featured' => esc_html__('Are you sure you want to make this a listing featured?', 'houzez'),
            'confirm_featured_remove' => esc_html__('Are you sure you want to remove this listing from featured?', 'houzez'),
            'confirm_relist' => esc_html__('Are you sure you want to relist this property?', 'houzez'),
            'delete_confirmation' => esc_html__('Are you sure you want to delete?', 'houzez'),
            'featured_listings_none' => esc_html__('You have used all the "Featured" listings in your package.', 'houzez'),
            'prop_sent_for_approval' => esc_html__('Sent for Approval', 'houzez'),
            'is_edit_property' => houzez_edit_property(),
            'is_mapbox' => houzez_option('houzez_map_system'),
            'api_mapbox' => houzez_option('mapbox_api_key'),
            'enable_title_limit' => houzez_option('enable_title_limit', 0),
            'property_title_limit' => houzez_option('property_title_limit')
        ];

        wp_localize_script( 'requirement_js', 'houzeextendRequirement', $requirement_data );
    // }
}

add_action( 'wp_enqueue_scripts', 'houzez_extend_enqueue_scripts' );