jQuery(document).ready(function($) {

	var ajax_url = houzeextendRequirement.ajaxURL;
	var processing_text = houzeextendRequirement.processing_text;
    var fave_extend_processing_modal = function ( msg ) {
        var process_modal ='<div class="modal fade" id="fave_modal" tabindex="-1" role="dialog" aria-labelledby="faveModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body houzez_messages_modal">'+msg+'</div></div></div></div></div>';
        jQuery('body').append(process_modal);
        jQuery('#fave_modal').modal();
    }

    var fave_extend_processing_modal_close = function ( ) {
        jQuery('#fave_modal').modal('hide');
    }

    /*--------------------------------------------------------------------------
     *  Delete property
     * -------------------------------------------------------------------------*/
    $( 'a.delete-requirement' ).on( 'click', function ( event ) {
    		event.preventDefault();

            var $this = $( this );
            var propID = $this.data('id');
            var propNonce = $this.data('nonce');

            bootbox.confirm({
            message: "<strong>"+houzeextendRequirement.delete_confirmation+"</strong>",
            buttons: {
                confirm: {
                    label: houzeextendRequirement.delete_btn_text,
                    className: 'btn btn-primary'
                },
                cancel: {
                    label: houzeextendRequirement.cancel_btn_text,
                    className: 'btn btn-grey-outlined'
                }
            },
            callback: function (result) {
                if(result==true) {
                    fave_extend_processing_modal( processing_text );

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: ajax_url,
                        data: {
                            'action': 'houzez_delete_requirement',
                            'prop_id': propID,
                            'security': propNonce
                        },
                        success: function(data) {
                            if ( data.success == true ) {
                                window.location = data.redirect;
                            } else {
                                jQuery('#fave_modal').modal('hide');
                                alert( data.reason );
                            }
                        },
                        error: function(errorThrown) {

                        }
                    }); // $.ajax
                } // result
            } // Callback
        });

        return false;
        
    });


   //Duplicate listings
    $( '.clone-requirement' ).on( 'click', function( e ) {
        e.preventDefault();
        var $this = $( this );
        var propid = $this.data( 'requirement' );
        $.ajax({
            url: ajax_url,
            data: {
                'action': 'houzez_requirement_clone',
                'propID': propid
            },
            method: 'POST',
            dataType: "JSON",

            beforeSend: function( ) {
                fave_extend_processing_modal(processing_text);
            },
            success: function( response ) { 
                window.location = response.redirect;
            },
            complete: function(){
            }
        });

    });

    //Save property as draft
    $( "#save_requirement_as_draft" ).on('click', function() {
        var $form = $('#submit_property_form');
        var save_as_draft = $('#save_requirement_as_draft');
        var description = tinyMCE.get('prop_des').getContent();

        $.ajax({
            type: 'post',
            url: ajax_url,
            dataType: 'json',
            data: $form.serialize() + "&action=save_requirement_as_draft&description="+description,
            beforeSend: function( ) {
                $('.houzez-loader-js').addClass('loader-show');
            },
            complete: function(){
                $('.houzez-loader-js').removeClass('loader-show');
            },
            success: function( response ) {
                
                if( response.success ) {
                    $('input[name=draft_prop_id]').remove();
                    $('#submit_property_form').prepend('<input type="hidden" name="draft_prop_id" value="'+response.property_id+'">');
                    jQuery('#modal-save-draft').modal('show');
                }
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                console.log(err.Message);
            }
        })
    });

});