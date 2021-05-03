<?php 

class Houzez_Child_Shortcode {

	public function __construct() {
		//my_requirment
	    add_shortcode( 'wp_realestate_my_client_requirement', [ $this, 'my_client_requirement' ] );
	    //requirement
	    add_shortcode( 'houzez_child_client_requirement', [ $this, 'client_requirement' ] );
	}

	public function my_client_requirement( $atts ) {

	}

	public function client_requirement( $atts ) {

		$atts = wp_parse_args( $atts, array(
			'limit' => 10,
			'post__in' => array(),
			'categories' => array(),
			'types' => array(),
			'locations' => array(),
		));


		if ( get_query_var( 'paged' ) ) {
		    $paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
		    $paged = get_query_var( 'page' );
		} else {
		    $paged = 1;
		}

		$query_args = array(
			'post_type' => 'client_requirement',
		    'post_status' => 'publish',
		    'post_per_page' => $atts['limit'],
		    'paged' => $paged,
		);

		$listings_query = new WP_Query( $query_args );
		$mb ='';
			ob_start();
		?>


                <div class="listing-tools-wrap">
                    <div class="d-flex align-items-center <?php echo esc_attr($mb); ?>">
                        <?php get_template_part('template-parts/listing/listing-tabs'); ?>    
                        <?php get_template_part('template-parts/listing/listing-sort-by'); ?>      
                    </div><!-- d-flex -->
                </div><!-- listing-tools-wrap --> 

                <div class="listing-view grid-view card-deck">
                    <?php
                    if ( $listings_query->have_posts() ) :
                        while ( $listings_query->have_posts() ) : $listings_query->the_post();

                            get_template_part('template-parts/listing/item', 'v1');

                        endwhile;
                        wp_reset_postdata();
                    else:
                        get_template_part('template-parts/listing/item', 'none');
                    endif;
                    ?>   
                </div><!-- listing-view -->

                <?php houzez_pagination( $listings_query->max_num_pages, $range = 2 ); 

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
	}
}

new Houzez_Child_Shortcode();