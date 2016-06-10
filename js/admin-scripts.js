jQuery(document).ready(function() {

	// Media Uploader for Author Page
	jQuery('.custom_media_upload').click(function(e) {
	    e.preventDefault();

	    var custom_uploader = wp.media({
	        title: 'Upload Background Image',
	        button: {
	            text: 'Select Background Image'
	        },
	        multiple: false  // Set this to true to allow multiple files to be selected
	    })
	    .on('select', function() {
	        var attachment = custom_uploader.state().get('selection').first().toJSON();
	        jQuery('.author_bg_image').attr('src', attachment.url).show( 400 );
	        jQuery('.author-media-url').val(attachment.url);
	        //jQuery('.custom_media_id').val(attachment.id);
	    })
	    .open();
	});
	jQuery('.author-image-remove').click(function(e) {
		jQuery('.author_bg_image').hide( 400 );
		jQuery('.author-media-url').val('');
	});

	// Standard
	var standard = jQuery('#post-format-0:checked').val();
	
	if (standard != '0') {
		jQuery('#standardbox').css('display', 'none');
	} else  {
		jQuery('#standardbox').css('display', 'block');
	}
	
	jQuery('#post-format-0').click( function() {
		jQuery('#standardbox').css('display', 'block');
	});
	
	jQuery('#post-format-video, #post-format-gallery, #post-format-quote, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-image, #post-format-link').click( function() {
		jQuery('#standardbox').css('display', 'none');
	});
	
	// Image
	var image = jQuery('#post-format-image:checked').val();
	
	if (image != 'image') {
		jQuery('#imagebox').css('display', 'none');
	} else  {
		jQuery('#imagebox').css('display', 'block');
	}
	
	jQuery('#post-format-image').click( function() {
		jQuery('#imagebox').css('display', 'block');
	});
	
	jQuery('#post-format-video, #post-format-gallery, #post-format-quote, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-0, #post-format-link').click( function() {
		jQuery('#imagebox').css('display', 'none');
	});
	
	// Video
	var video = jQuery('#post-format-video:checked').val();
	
	if (video != 'video') {
		jQuery('#videobox').css('display', 'none');
	} else  {
		jQuery('#videobox').css('display', 'block');
	}
	
	jQuery('#post-format-video').click( function() {
		jQuery('#videobox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-gallery, #post-format-quote, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-image, #post-format-link').click( function() {
		jQuery('#videobox').css('display', 'none');
	});

	// Audio
	var audio = jQuery('#post-format-audio:checked').val();
	
	if (audio != 'audio') {
		jQuery('#audiobox').css('display', 'none');
	} else  {
		jQuery('#audiobox').css('display', 'block');
	}
	
	jQuery('#post-format-audio').click( function() {
		jQuery('#audiobox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-gallery, #post-format-link, #post-format-aside, #post-format-chat, #post-format-status, #post-format-quote, #post-format-image, #post-format-video').click( function() {
		jQuery('#audiobox').css('display', 'none');
	});

	// Link
	var link = jQuery('#post-format-link:checked').val();
	
	if (link != 'link') {
		jQuery('#linkbox').css('display', 'none');
	} else  {
		jQuery('#linkbox').css('display', 'block');
	}
	
	jQuery('#post-format-link').click( function() {
		jQuery('#linkbox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-gallery, #post-format-quote, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-image, #post-format-video').click( function() {
		jQuery('#linkbox').css('display', 'none');
	});

	// Gallery
	var gallery = jQuery('#post-format-gallery:checked').val();
	
	if (gallery != 'gallery') {
		jQuery('#gallerybox').css('display', 'none');
	} else  {
		jQuery('#gallerybox').css('display', 'block');
	}
	
	jQuery('#post-format-gallery').click( function() {
		jQuery('#gallerybox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-quote, #post-format-link, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-image, #post-format-video').click( function() {
		jQuery('#gallerybox').css('display', 'none');
	});

	// Status
	var status = jQuery('#post-format-status:checked').val();
	
	if (status != 'status') {
		jQuery('#statusbox').css('display', 'none');
	} else  {
		jQuery('#statusbox').css('display', 'block');
	}
	
	jQuery('#post-format-status').click( function() {
		jQuery('#statusbox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-gallery, #post-format-quote, #post-format-link, #post-format-aside, #post-format-chat, #post-format-audio, #post-format-image, #post-format-video').click( function() {
		jQuery('#statusbox').css('display', 'none');
	});

	// Quote
	var quote = jQuery('#post-format-quote:checked').val();
	
	if (quote != 'quote') {
		jQuery('#quotebox').css('display', 'none');
	} else  {
		jQuery('#quotebox').css('display', 'block');
	}
	
	jQuery('#post-format-quote').click( function() {
		jQuery('#quotebox').css('display', 'block');
	});
	
	jQuery('#post-format-0, #post-format-gallery, #post-format-link, #post-format-aside, #post-format-chat, #post-format-status, #post-format-audio, #post-format-image, #post-format-video').click( function() {
		jQuery('#quotebox').css('display', 'none');
	});
});

/*
* Font Ions for Widget Titles
*
*/
jQuery( window ).load(function() {
    function format(state) {
        if (!state.id) return state.text; // optgroup
        return "<i class='fa fa-" + state.id.toLowerCase() + "'></i>" + state.text;
    }
    function initColorPicker( widget ) {
        widget.find( '.title-icon' ).select2( {
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) { return m; }
        });
    }

    function onFormUpdate( event, widget ) {
        initColorPicker( widget );
    }

    jQuery( document ).on( 'widget-added widget-updated', onFormUpdate );

    jQuery( document ).ready( function() {
        jQuery( '#widgets-right .widget:has(.title-icon)' ).each( function () {
            initColorPicker( jQuery( this ) );
        } );
    } );
});


/*
* Color Picker Tool for Widgets
*
*/
jQuery( window ).load(function() {
    function initColorPicker( widget ) {
        widget.find( '.color-picker' ).wpColorPicker( {
            change: _.throttle( function() { // For Customizer
                jQuery(this).trigger( 'change' );
            }, 3000 )
        });
    }

    function onFormUpdate( event, widget ) {
        initColorPicker( widget );
    }

    jQuery( document ).on( 'widget-added widget-updated', onFormUpdate );

    jQuery( document ).ready( function() {
        jQuery( '#widgets-right .widget:has(.color-picker)' ).each( function () {
            initColorPicker( jQuery( this ) );
        } );
    } );
});