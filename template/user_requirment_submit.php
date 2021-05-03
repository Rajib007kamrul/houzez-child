<?php
/**
 * Template Name: User Dashboard Create Requirement
 * Created by PhpStorm.
 * User: rokibul
 * Date: 06/10/15
 * Time: 3:49 PM
 */
global $houzez_local, $current_user, $properties_page, $hide_prop_fields, $requirement_hide_prop_fields, $is_multi_steps, $is_requirement_multi_steps;

wp_get_current_user();
$userID = $current_user->ID;

$submit_property_link = houzez_get_template_link('template/user_requirement.php');
if( is_user_logged_in() && !houzez_check_role() ) {
    wp_redirect(  home_url() );
}

$user_email = $current_user->user_email;
$admin_email =  get_bloginfo('admin_email');
$requirement_hide_prop_fields = houzez_option('requirement_hide_add_prop_fields');

get_header(); 

$houzez_loggedin = false;
if ( is_user_logged_in() ) {
    $houzez_loggedin = true;
}

$dash_main_class = "dashboard-add-new-listing";
if (houzez_edit_requirements()) { 
    $dash_main_class = "dashboard-edit-listing";
}

// $submit_form_type = houzez_option('submit_form_type');
$submit_form_type = houzez_option('requirement_submit_form_type');

if( $submit_form_type == 'one_step' ) {
    $submit_form_main_class = 'houzez-one-step-form';
    $is_multi_steps = 'active';
    $is_requirement_multi_steps = 'active';
} else {
    $submit_form_main_class = 'houzez-m-step-form';
    $is_multi_steps = 'form-step';
    $is_requirement_multi_steps = 'form-step';
}

if( isset( $_POST['action'] ) ) {

    $submission_action = $_POST['action'];    

    $new_property = array(
        'post_type' => 'client_requirement'
    );


    $property_id = apply_filters('houzez_submit_requirement_listing', $new_property);


    $args = array(
        'listing_title'  =>  get_the_title($property_id),
        'listing_id'     =>  $property_id,
        'listing_url'    =>  get_permalink($property_id)
    );


    if (!empty($submit_property_link)) {
        $submit_property_link = add_query_arg( 'edit_requirement', $property_id, $submit_property_link );
        $separator = (parse_url($submit_property_link, PHP_URL_QUERY) == NULL) ? '?' : '&';

        $parameter = 'success=1';
        if($submission_action == 'update_requirement') {
            $parameter = 'updated=1';
        }
        
        wp_redirect($submit_property_link . $separator . $parameter);
    }
}

if( is_user_logged_in() ) { ?> 

    <header class="header-main-wrap dashboard-header-main-wrap">
        <div class="dashboard-header-wrap">
            <div class="d-flex align-items-center">
                <div class="dashboard-header-left flex-grow-1">
                   <?php  if ( houzez_edit_requirements()) { ?>
                        <h1><?php echo 'Edit  Client Requirements'; ?></h1>
                    <?php } else { ?>
                        <h1><?php echo 'Create Client Requirements'; ?></h1>
                    <?php } ?>
                </div><!-- dashboard-header-left -->
                <div class="dashboard-header-right">
                    <?php 
                    if(houzez_edit_requirements()) { 
                        $view_link = isset($_GET['edit_requirement']) ? get_permalink($_GET['edit_requirement']) : '';
                    ?>
                    <a class="btn btn-primary-outlined" target="_blank" href="<?php echo esc_url($view_link); ?>"><?php echo houzez_option('fal_view_property', esc_html__('View Requirement', 'houzez')); ?></a>

                    <?php if( get_post_status( $_GET['edit_requirement'] ) == 'draft' ) { ?>
                    <button id="save_requirement_as_draft" class="btn btn-primary-outlined fave-load-more">
                        <?php get_template_part('template-parts/loader'); ?>
                        <?php echo houzez_option('fal_save_draft', esc_html__('Save as Draft', 'houzez')); ?>        
                    </button>
                    <?php } ?>

                    <?php } else { ?>

                    <button id="save_requirement_as_draft" class="btn btn-primary-outlined fave-load-more">
                        <?php get_template_part('template-parts/loader'); ?>
                        <?php echo houzez_option('fal_save_draft', esc_html__('Save as Draft', 'houzez')); ?>        
                    </button>

                    <?php } ?>

                </div><!-- dashboard-header-right -->
            </div><!-- d-flex -->
        </div><!-- dashboard-header-wrap -->
    </header><!-- .header-main-wrap -->
    <section class="dashboard-content-wrap <?php echo esc_attr($dash_main_class); ?>">

        <?php 
        if(houzez_edit_requirements()) { ?>
            <div class="d-flex">
                <div class="order-2">
                    <?php get_template_part('template-parts/dashboard/requirement/partials/menu-edit-property');?>
                </div><!-- order-2 -->
                <div class="order-1 flex-grow-1">
        <?php                 
        } ?>

        
        <div class="dashboard-content-inner-wrap">
            
            <?php 
                if ( houzez_edit_requirements()) {
                    get_template_part( 'template-parts/dashboard/requirement/edit-property-form' );
                } else {

                    get_template_part('template-parts/dashboard/requirement/submit-property-form');
                }
                // get_template_part( 'template-parts/client-requirements/add-form' ); 
            ?>
                
        </div><!-- dashboard-content-inner-wrap -->
        
    </section><!-- dashboard-content-wrap -->

    <section class="dashboard-side-wrap">
        <?php get_template_part('template-parts/dashboard/side-wrap'); ?>
    </section>

<?php
} else { // End if user logged-in ?>

<header class="header-main-wrap <?php houzez_transparent(); ?>">
    <?php
        if( houzez_option('top_bar') ) {
            // get_template_part('template-parts/topbar/top', 'bar');
        }

        $header = houzez_option('header_style'); 
        
        // get_template_part('template-parts/header/header', $header);
    ?>
</header><!-- .header-main-wrap -->
<section class="frontend-submission-page dashboard-content-inner-wrap">
    
    <div class="container">
        <div class="row">
            <div class="col-12">

            </div>
        </div><!-- row -->
    </div><!-- container -->
</section><!-- frontend-submission-page -->

<?php get_template_part('template-parts/footer/main');  ?>

<?php
} // End logged-in else


if(houzez_get_map_system() == 'google') {
    if(houzez_option('googlemap_api_key') != "") {
        wp_enqueue_script('houzez-submit-google-map',  get_theme_file_uri('/js/submit-property-google-map.js'), array('jquery'), HOUZEZ_THEME_VERSION, true);
    }
    
} else {
    houzez_enqueue_osm_api();
    wp_enqueue_script('houzez-submit-osm', get_theme_file_uri('/js/submit-property-osm.js'), array('jquery'), HOUZEZ_THEME_VERSION, true);
}
?>

<?php get_footer();?>