<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<style type="text/css">
	body{
		background-color: #f7f7f7 !important;
	}
	.add_to_my_div{
		vertical-align: middle;
    	height: 31px;
	}
	.add_to_my_data_button, .added_to_my_data_button{
		line-height: 1 !important;
    	height: 20px !important;
	}

	.add_to_my_div [class*="btn"]:before {
		top: -8px;
	}
</style>

	<section id="primary" class="content-area">
		<main id="main" class="site-main content" role="main">

<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); global $post; ?>

    <section class="content-wrap property-wrap property-detail-v1">
    	<?php 
    		get_template_part('property-details/navigation'); 
    		get_template_part('property-details/property-title');
    		get_template_part('property-details/top-area-v1');

    	?>
    	<div class="container">
    		<div class="row"> 
    			<div class="col-lg-8 col-md-12 bt-content-wrap">
					<?php
				    	get_template_part( 'requirement-details/single-requirement', 'simple');
				    ?>
				</div>

			    <div class="col-lg-4 col-md-12 bt-sidebar-wrap houzez_sticky">
			    	<?php get_sidebar('requirement'); ?>
			    </div>

			</div>
		</div>
	</section>

			<?php //if ( !empty($post) ) : ?>
			<div class="single-property-wrapper single-listing-wrapper">
				<article id="post-<?php echo $post->ID; ?>" class="property-single-layout property-single-v2 post-<?php echo $post->ID; ?> property type-property status-publish has-post-thumbnail hentry property_type-apartment property_location-berkshire property_status-for-sale property_amenity-air-conditioning property_amenity-barbeque property_amenity-dryer property_amenity-gym property_amenity-refrigerator property_amenity-sauna property_amenity-tv-cable property_amenity-washer property_amenity-wifi property_amenity-window-coverings property_material-brick property_material-rock property_material-wood">
	
					<div class="container">
						<div class="content-property-detail content-property-detail-v2">
							<a href="javascript:void(0)" class="mobile-sidebar-btn space-10 hidden-lg hidden-md btn-right">
								<i class="ti-menu-alt"></i> 
							</a>
							<div class="mobile-sidebar-panel-overlay"></div>
			
							<div class="row">
								<div class="property-detail-main col-xs-12 col-md-8">
									<div id="property-single-details">
										<div class="property-detail-header top-header-detail-property v2">
										    <div class="row">
										        <div class="col-sm-10">
										        	<div class="property-information flex-sm">
												        <div class="left-infor">
												            <div class="title-wrapper">
												            	<h1 class="property-title"><?php the_title(); //echo $post->post_title; ?></h1>
												            </div>
												        </div>
												    </div>
										        </div>
										        <div class="col-sm-2">
										        	<?php 

										        		// if(is_user_logged_in() && WP_RealEstate_User::is_agent(get_current_user_id()) && $post->post_author != get_current_user_id()){ 

										        	?>
									                    <div class="add_to_my_div_detail property-action-detail">
									                    <?php //if( get_post_meta( $post->ID, 'sfcr-agenthub-add-to-my-requirement-by-'.get_current_user_id(), true ) ) { ?>
									                        <!-- <a href="javascript:void(0)" class="btn-added_to_my added_to_my_cli_req_data_button" data-requirement_id="<?php echo $post->ID; ?>" data-toggle="tooltip" title="Requested to add in My Requirements" data-original-title="Requested to add in My Requirements"><i class="flaticon-tick"></i></a> -->
									                    <?php  //}else{ ?>
									                        <!-- <a href="javascript:void(0)" class="btn-add_to_my add_to_my_cli_req_data_button" data-requirement_id="<?php echo $post->ID; ?>" data-toggle="tooltip" title="Add To My Requirements" data-original-title="Add To My Requirements"><i class="flaticon-plus"></i></a> -->
									                    <?php //} ?>
									                    </div>
									                <?php // } ?>
										        </div>
										    </div>
										</div>
										<div class="description inner">
        									<h3 class="title">Overview</h3>
    										<div class="description-inner">
        										<?php //the_content(); ?>
            								</div>
										</div>
										<div class="property-detail-detail">
										    <h3 class="title">Requirements</h3>
										    <ul class="list">

										    </ul>
										</div>
										
										<div class="property-detail-detail">
										    <h3 class="title">Property Type</h3>
										    <ul class="list">

										    </ul>
										</div>	

										<?php if ( $post_meta = get_post_meta($post->ID, 'sfcr-agenthub-location-area', true) ) { ?>
										<div class="property-detail-detail">
										    <h3 class="title">Location</h3>
										    <ul class="list">
										    	<li style="width: 100%;">
										            <div class="text">Location :</div>
										            <div class="value"><?php echo implode(', ', explode(',', $post_meta)); ?></div>
										        </li>
										    </ul>
										</div>	
										<?php } ?>

										<div class="property-detail-detail">
										    <h3 class="title">Request Notes</h3>
										    <div class="description-inner">

            								</div>
										</div>	

										<div class="property-detail-detail">
										    <h3 class="title">Contacts</h3>
										    <ul class="list">

										    </ul>
										</div>	
									</div>
								</div>

								<div class="col-xs-12 col-md-4 sidebar-property sidebar-wrapper">
				   					<div class="sidebar sidebar-right">
										<div class="close-sidebar-btn hidden-lg hidden-md">
											<i class="ti-close"></i> <span>Close</span>
										</div>

										<?php get_template_part('template-parts/client-requirement/similarty'); ?>

				   					</div>
				   				</div>
			   				</div>
						</div>
					</div>	
				</article><!-- #post-## -->
			</div>

<?php 
    endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
		</main><!-- .site-main -->
	</section><!-- .content-area -->
	<?php //if(is_user_logged_in() && WP_RealEstate_User::is_agent(get_current_user_id())){ 
	wp_enqueue_script( 'single-client-share-property' );
	//} 
	// if(is_user_logged_in() && WP_RealEstate_User::is_agent(get_current_user_id())){ 
	wp_enqueue_script( 'single-client-share-requirement' );

 	//} 

 	get_footer(); ?>
