<?php 

if ( !function_exists('houzez_edit_requirements') ) {
    function houzez_edit_requirements() {   
        if ( isset( $_GET[ 'edit_requirement' ] ) && ! empty( $_GET[ 'edit_requirement' ] ) ) {
            return true;
        }

        return false;
    }
}

if( !function_exists('houzez_dashboard_add_requirement') ) {
    function houzez_dashboard_add_requirement() {
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template/user_dashboard_submit.php'
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $pages[0]->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}

if( !function_exists('houzez_dashboard_requirement') ) {
    function houzez_dashboard_requirement() {
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template/user_requirement.php'
        );
        $pages = get_pages($args);
        if( $pages ) {
            $add_link = get_permalink( $pages[0]->ID );
        } else {
            $add_link = home_url('/');
        }
        return $add_link;
    }
}


function loop_agency_requirement_count( $agency_id = null ) {
            
    if ( null == $agency_id ) {
        $agency_id = get_the_ID();
    }

           
    $args = array(
        'post_type' => 'client_requirement',
        'posts_per_page' => -1,
        'fields' => 'ids',
        'post_status' => 'publish'
    );

    $posts = get_posts($args);

    return count($posts);
}


if( !function_exists( 'houzez_requirement_required_field' ) ) {
    function houzez_requirement_required_field( $field ) {
        $required_fields = houzez_option('requirement_required_fields');
        
        if(array_key_exists($field, $required_fields)) {
            $field = $required_fields[$field];
            if( $field != 0 ) {
                return ' *';
            }
        }
        
        return '';
    }
}

if( !function_exists('houzez_requirement_get_required_field_2') ) {
    function houzez_requirement_get_required_field_2( $field ) {
        $required_fields = houzez_option('requirement_required_fields');
        
        if(array_key_exists($field, $required_fields)) {
            $field = $required_fields[$field];
            if( $field != 0 ) {
                return 'required';
            }
        }
        return '';
    }
}

if( !function_exists('houzez_requirement_required_field_2') ) {
    function houzez_requirement_required_field_2( $field ) {
        echo houzez_requirement_get_required_field_2($field);
    }
}


if( !function_exists( 'houzez_is_requirement_bedsbaths_range' )) {
    function houzez_is_requirement_bedsbaths_range() {
        $is_enabled = houzez_option( 'requirement_range-bedsroomsbaths', 0 );

        if( $is_enabled ) {
            return true;
        }

        return false;
    }
}

if( !function_exists( 'houzez_requirement_input_attr_for_bbr' )) {
    function houzez_requirement_input_attr_for_bbr() {
        
        $return = 'type="number" min="1" max="99"';
        if( houzez_is_requirement_bedsbaths_range() ) {
            $return = 'type="text"';
        }

        echo $return;
    }
}

if( !function_exists('houzez_requirement_id_prefix') ) {
    function houzez_requirement_id_prefix( $requirement_id ) {
        $requirement_id_prefix = houzez_option('requirement_id_prefix');
        if( !empty( $requirement_id_prefix ) ) {
            $requirement_id = $requirement_id_prefix.$requirement_id;
        }
        return $requirement_id;
    }
}
