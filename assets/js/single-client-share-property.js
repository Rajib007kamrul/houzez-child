		jQuery('document').ready(function(){
			jQuery('.add_to_my_data_button').on('click', function(e) {
		        e.preventDefault();

		        var thisz = jQuery(this);
		        var property_id = thisz.data('property_id');
		        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

		        thisz.addClass('loading');

		        jQuery.ajax({
		            url: ajaxurl,
		            type: "POST",
		            data: {
		                action: 'sfs_shared_to_my_property',
		                sf_property_id: property_id
		            },
		            success:function(data) {
		            	thisz.removeClass('loading');
		                if ( data ) {
		                	var data = JSON.parse(data);

			                var classes = 'alert bg-info';

			                if (data.status == 'error') {
			                    classes = 'alert bg-warning';
			                }
			                var $html = '<div id="wp-realestate-popup-message" class="animated fadeInRight"><div class="message-inner '+ classes +'">'+ data.mes +'</div></div>';
			                jQuery('body').find('#wp-realestate-popup-message').remove();
			                jQuery('body').append($html).fadeIn(500);
			                setTimeout(function() {
			                    jQuery('body').find('#wp-realestate-popup-message').removeClass('fadeInRight').addClass('delay-2s fadeOutRight');
			                }, 1500);

			                if(data.status == 'success'){
			                	thisz.removeClass('add_to_my_data_button').addClass('added_to_my_data_button');
			                	//thisz.;
			                	thisz.find('i').removeClass('flaticon-plus').addClass('flaticon-tick');
			                }
			            }
		            },
		            error: function(errorThrown){
		            	thisz.removeClass('loading');
			            var classes = 'alert bg-warning';
			            var $html = '<div id="wp-realestate-popup-message" class="animated fadeInRight"><div class="message-inner '+ classes +'">Opps! Something went wrong.</div></div>';
			                jQuery('body').find('#wp-realestate-popup-message').remove();
			                jQuery('body').append($html).fadeIn(500);
			                setTimeout(function() {
			                    jQuery('body').find('#wp-realestate-popup-message').removeClass('fadeInRight').addClass('delay-2s fadeOutRight');
			                }, 1500);
			            
		            }
		        });
		    });
		});