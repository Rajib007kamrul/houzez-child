<?php
/**
 * Post Type: Agent
 *
 * @package    wp-realestate
 * @author     Habq 
 * @license    GNU General Public License, version 3
 */

if ( ! defined( 'ABSPATH' ) ) {
  	exit;
}

class Post_Type_Client_Requirement {

	public function __construct() {
	  	add_action( 'init', array( $this, 'register_post_type' ) );
	  	// add_action('pre_get_posts', array( $this, 'add_custom_post_type' ));
	  	add_filter( 'manage_client_requirement_posts_columns', array( $this, 'custom_columns' ) );
	  	add_action( 'manage_client_requirement_posts_custom_column' , array( $this, 'custom_book_column' ), 10, 2 );
	}

	public function register_post_type() {
		$labels = array(
			'name'                  => __( 'Client Requirements', 'wp-realestate' ),
			'singular_name'         => __( 'Client Requirement', 'wp-realestate' ),
		);
		register_post_type( 'client_requirement',
			array(
				'labels'            => $labels,
				'supports'          => array( 'title', 'editor', 'thumbnail' ),
				'public'            => true,
				'has_archive'       => true,
				//'rewrite'           => $rewrite,
				//'menu_position'     => 51,
				//'categories'        => array(),
				//'menu_icon'         => 'dashicons-admin-post',
				//'show_in_rest'		=> true,
			)
		);
	}

	public function add_custom_post_type($query) {
	    if ( is_home() && $query->is_main_query() ) {
	        $query->set( 'post_type', array( 'client_requirement' ) );
	    }
	    return $query;
	}


	public function custom_columns( $columns ) {

        unset( $columns );

	    $columns = array(
	        "cb" => "<input type=\"checkbox\" />",
	        "title" => __( 'Title','houzez-theme-functionality' ),
	        "thumbnail" => __( 'Thumbnail','houzez-theme-functionality' ),
	        'city' => __( 'City','houzez-theme-functionality' ),
	        "type" => __('Type','houzez-theme-functionality'),
	        "status" => __('Status','houzez-theme-functionality'),
	        "price" => __('Price','houzez-theme-functionality'),
	        "id" => __( 'Property ID','houzez-theme-functionality' ),
	        "featured" => __( 'Featured','houzez-theme-functionality' )
	    );

	    $columns = apply_filters( 'houzez_custom_post_requirement_columns', $columns );

	    if ( is_rtl() ) {
	        $columns = array_reverse( $columns );
	    }

	    return $columns;
	    
	}

    public function custom_book_column( $column, $post_id ) {
        $houzez_prefix = 'fave_';
       
        switch ( $column ) {
            case 'id':
                $Prop_id = get_post_meta( $post_id, $houzez_prefix.'property_id',true );
                if( !empty( $Prop_id ) ) {
                    echo esc_attr( $Prop_id );
                }
                else{
                    _e('NA','houzez-theme-functionality');
                }
                break;

            case 'prop_id':
                echo get_the_ID();
                break;
            case 'featured':
                $featured = get_post_meta($post_id, $houzez_prefix.'featured',true);
                if($featured != 1 ) {
                    _e( 'No', 'houzez-theme-functionality' );
                } else {
                    _e( 'Yes', 'houzez-theme-functionality' );
                }
                break;
            case 'city':
                echo Houzez::admin_taxonomy_terms ( $post_id, 'property_city', 'property' );
                break;
            case 'address':
                $address = get_post_meta($post_id, $houzez_prefix.'property_address',true);
                if(!empty($address)){
                    echo esc_attr( $address );
                }
                else{
                    _e('No Address Provided!','houzez-theme-functionality');
                }
                break;
            case 'type':
                echo Houzez::admin_taxonomy_terms ( $post_id, 'property_type', 'property' );
                break;
            case 'status':
                echo Houzez::admin_taxonomy_terms ( $post_id, 'property_status', 'property' );
                break;
            case 'price':
                if( function_exists('houzez_property_price_admin')) {
                    houzez_property_price_admin();
                }
                break;
            case 'bed':
                $bed = get_post_meta($post_id, $houzez_prefix.'property_bedrooms',true);
                if(!empty($bed)){
                    echo esc_attr( $bed );
                }
                else{
                    _e('NA','houzez-theme-functionality');
                }
                break;
            case 'bath':
                $bath = get_post_meta($post_id, $houzez_prefix.'property_bathrooms',true);
                if(!empty($bath)){
                    echo esc_attr( $bath );
                }
                else{
                    _e('NA','houzez-theme-functionality');
                }
                break;
            case 'garage':
                $garage = get_post_meta($post_id, $houzez_prefix.'property_garage',true);
                if(!empty($garage)){
                    echo esc_attr( $garage );
                }
                else{
                    _e('NA','houzez-theme-functionality');
                }
                break;
            case 'features':
                echo get_the_term_list($post_id,'property-feature', '', ', ','');
                break;
        }
    }


}
new  Post_Type_Client_Requirement(); 