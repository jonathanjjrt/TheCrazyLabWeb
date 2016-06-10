<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'bpxl_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function bpxl_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'bpxl_';
	
	// Standard meta box
	$meta_boxes[] = array(
		'id' => 'standardbox',
		'title' => __( 'Standard Post Options', 'rwmb' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// Post Excerpt
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'rwmb' ),
				'id'   => "{$prefix}standard_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// Featured Image
			array(
				'name' => __( 'Hide Featured Image?', 'rwmb' ),
				'id'   => "{$prefix}standard_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide featured image on this post.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Image meta box
	$meta_boxes[] = array(
		'id' => 'imagebox',
		'title' => __( 'Image Post Options', 'rwmb' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'rwmb' ),
				'id'   => "{$prefix}image_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Featured Image?', 'rwmb' ),
				'id'   => "{$prefix}image_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide featured image on this post.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Audio meta box
	$meta_boxes[] = array(
		'id' => 'audiobox',
		'title' => __( 'Audio Post Options', 'rwmb' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// SELECT BOX
			array(
				'name'     => __( 'Audio File Host', 'rwmb' ),
				'desc' => __( 'Select host of your audio file. <br> <strong>Note:</strong> If you couldn\'t find host of your audio file in the dropdown list, you can paste the embed code of file in the "Audio Embed Code" box.', 'rwmb' ),
				'id'       => "{$prefix}audiohost",
				'type'     => 'select',
				'options'  => array(
					'soundcloud' => __( 'SoundCloud', 'rwmb' ),
					'mixcloud' => __( 'MixCloud', 'rwmb' ),
				),
				'multiple'    => false,
				'std'         => '',
				'placeholder' => __( 'Select an Item', 'rwmb' ),
			),
			// TEXT
			array(
				'name'  => __( 'Audio File URL (Soundcloud or Mixcloud) ', 'rwmb' ),
				'id'    => "{$prefix}audiourl",
				'desc'  => __( 'Enter URL of your audio file here.', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( '', 'rwmb' ),
				'clone' => false,
			),
			// TEXTAREA
			array(
				'name' => __( 'Audio Embed Code', 'rwmb' ),
				'desc' => __( 'Enter embed code of your audio file here.', 'rwmb' ),
				'id'   => "{$prefix}audiocode",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
			// mp3 audio
			array(
				'name'  => __( 'Self Hosted Audio', 'rwmb' ),
				'id'    => "{$prefix}mp3url",
				'desc'  => __( 'Upload your audio file here. Supported formats are: mp3, m4a, ogg, wav and wma.', 'rwmb' ),
				'type'  => 'file_advanced',
				'std'   => __( '', 'rwmb' ),
				'max_file_uploads'   => 1,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'rwmb' ),
				'id'   => "{$prefix}audio_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Audio?', 'rwmb' ),
				'id'   => "{$prefix}audio_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide audio on this post.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Video meta box
	$meta_boxes[] = array(
		'id' => 'videobox',
		'title' => __( 'Video Post Options', 'rwmb' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// SELECT BOX
			array(
				'name'     => __( 'Video File Host', 'rwmb' ),
				'id'       => "{$prefix}videohost",
				'desc' => __( 'Select host of your video file. <br> <strong>Note:</strong> If you couldn\'t find host of your video file in the dropdown list, you can paste the embed code of file in the "Video Embed Code" box.', 'rwmb' ),
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'youtube' => __( 'YouTube', 'rwmb' ),
					'vimeo' => __( 'Vimeo', 'rwmb' ),
					'dailymotion' => __( 'Dailymotion', 'rwmb' ),
					'metacafe' => __( 'Metacafe', 'rwmb' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => __( 'Select an Item', 'rwmb' ),
			),
			// Video ID
			array(
				'name'  => __( 'Video ID ', 'rwmb' ),
				'id'    => "{$prefix}videourl",
				'desc'  => __( 'Paste ID of your YouTube or Vimeo video here (For example: http://www.youtube.com/watch?v=<strong>dQw4w9WgXcQ</strong>).', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( '', 'rwmb' ),
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => false,
			),
			// Video Embed Code
			array(
				'name' => __( 'Video Embed Code (YouTube, Vimeo etc) ', 'rwmb' ),
				'desc' => __( 'Paste your YouTube or Vimeo embed code here.', 'rwmb' ),
				'id'   => "{$prefix}videocode",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
			// Self Hosted Video
			array(
				'name'  => __( 'Self Hosted Video', 'rwmb' ),
				'id'    => "{$prefix}hostedvideourl",
				'desc'  => __( 'Upload your video file here. Supported formats are: mp4, m4v, webm, ogv, wmv, and flv.', 'rwmb' ),
				'type'  => 'file_advanced',
				'std'   => __( '', 'rwmb' ),
				'max_file_uploads'   => 1,
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => false,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'rwmb' ),
				'id'   => "{$prefix}video_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Video?', 'rwmb' ),
				'id'   => "{$prefix}video_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide featured video on this post.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Link Post meta box
	$meta_boxes[] = array(
		'id' => 'linkbox',
		'title' => __( 'Link Post Options', 'rwmb' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			// TEXT
			array(
				'name'  => __( 'URL', 'rwmb' ),
				'id'    => "{$prefix}linkurl",
				'desc'  => __( 'Paste URL here.', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( '', 'rwmb' ),
				'clone' => false,
			),
			// COLOR
			array(
				'name' => __( 'Link Background Color', 'rwmb' ),
				'id'   => "{$prefix}link_background",
				'type' => 'color',
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'rwmb' ),
				'id'   => "{$prefix}link_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Link Box?', 'rwmb' ),
				'id'   => "{$prefix}link_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide link box on this post.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Gallery meta box
	$meta_boxes[] = array(
		'id' => 'gallerybox',
		'title' => __( 'Gallery Post Options', 'rwmb' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			array(
				'name'             => __( 'Upload Images for Gallery', 'rwmb' ),
				'id'               => "{$prefix}galleryimg",
				'type'             => 'image_advanced',
				'max_file_uploads' => 40,
			),
			// SELECT BOX
			array(
				'name'     => __( 'Gallery Type', 'rwmb' ),
				'id'       => "{$prefix}gallerytype",
				'desc' => __( 'Select the type of gallery you want to show.', 'rwmb' ),
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'slider' => __( 'Slider', 'rwmb' ),
					'tiled' => __( 'Tiled', 'rwmb' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => __( 'Select an Item', 'rwmb' ),
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'rwmb' ),
				'id'   => "{$prefix}gallery_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Gallery?', 'rwmb' ),
				'id'   => "{$prefix}gallery_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide gallery on this post.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Status Post Meta Box
	$meta_boxes[] = array(
		'id' => 'statusbox',
		'title' => __( 'Status Post Options', 'rwmb' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// SELECT BOX
			array(
				'name'     => __( 'Status Type', 'rwmb' ),
				'id'       => "{$prefix}statustype",
				'desc' => __( 'Select the type of status you want to publish.', 'rwmb' ),
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'twitter' => __( 'Twitter', 'rwmb' ),
					'facebook' => __( 'Facebook', 'rwmb' )
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => '',
				'placeholder' => __( 'Select an Item', 'rwmb' ),
			),
			// TEXT
			array(
				'name'  => __( 'Status Link', 'rwmb' ),
				'id'    => "{$prefix}statuslink",
				'desc'  => __( 'Paste source name of the quote here.', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( '', 'rwmb' ),
				'clone' => false,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Post Excerpt on Homepage', 'rwmb' ),
				'id'   => "{$prefix}status_excerpt_home",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide post excerpt on homepage.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Status?', 'rwmb' ),
				'id'   => "{$prefix}status_single_hide",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to hide status on this post.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	// Quote Post Meta Box
	$meta_boxes[] = array(
		'id' => 'quotebox',
		'title' => __( 'Quote Post Options', 'rwmb' ),
		'pages' => array( 'post', 'page' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// TEXT
			array(
				'name'  => __( 'Source Name', 'rwmb' ),
				'id'    => "{$prefix}sourcename",
				'desc'  => __( 'Paste source name of the quote here.', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( '', 'rwmb' ),
				'clone' => false,
			),
			// TEXT
			array(
				'name'  => __( 'Source URL', 'rwmb' ),
				'id'    => "{$prefix}sourceurl",
				'desc'  => __( 'Paste source URL of quote here.', 'rwmb' ),
				'type'  => 'text',
				'std'   => __( '', 'rwmb' ),
				'clone' => false,
			),
			// COLOR
			array(
				'name' => __( 'Quote Background Color', 'rwmb' ),
				'id'   => "{$prefix}quote_background_color",
				'type' => 'color',
			),
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Layout Options', 'textdomain' ),
		'pages' => array( 'post', 'page' ),
		'fields' => array(
			// Cover Image
			array(
				'name' => __( 'Show Cover Image?', 'rwmb' ),
				'id'   => "{$prefix}post_cover_show",
				'type' => 'checkbox',
				'desc'  => __( 'Check this option to show cover image on this post.', 'rwmb' ),
				// Value can be 0 or 1
				'std'  => 0,
			),
			array(
				'id'       => "{$prefix}layout",
				'name'     => __( 'Layout', 'rwmb' ),
				'type'     => 'image_select',

				// Array of 'value' => 'Image Source' pairs
				'options'  => array(
					'default'  => get_template_directory_uri() . '/inc/meta-box/img/default.png',
					'left'  => get_template_directory_uri() . '/inc/meta-box/img/left.png',
					'right' => get_template_directory_uri() . '/inc/meta-box/img/right.png',
					'none'  => get_template_directory_uri() . '/inc/meta-box/img/none.png',
				),

				// Allow to select multiple values? Default is false
				// 'multiple' => true,
			),
			// CHECKBOX
			array(
				'name' => __( 'Hide Related Posts for this Post?', 'rwmb' ),
				'id'   => "{$prefix}singlerelated",
				'desc'  => __( 'Check this option to hide related posts for this post.', 'rwmb' ),
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Styling Options', 'textdomain' ),
		'pages' => array( 'post', 'page' ),
		'fields' => array(
			// COLOR
			array(
				'name' => __( 'Background Color', 'rwmb' ),
				'id'   => "{$prefix}post_bg_color",
				'type' => 'color',
			),
			array(
				'name'             => __( 'Background Image', 'rwmb' ),
				'id'               => "{$prefix}post_bg_img",
				'type'             => 'thickbox_image',
				'max_file_uploads' => 1,
			),
			// Background Repeat
			array(
				'name'     => __( 'Background Repeat', 'rwmb' ),
				'desc' => __( '', 'rwmb' ),
				'id'       => "{$prefix}post_bg_repeat",
				'type'     => 'select',
				'options'  => array(
					'repeat' => __( 'Repeat', 'rwmb' ),
					'no-repeat' => __( 'No Repeat', 'rwmb' ),
				),
				'multiple'    => false,
				'std'         => '',
			),
			// Background Position
			array(
				'name'     => __( 'Background Position', 'rwmb' ),
				'desc' => __( '', 'rwmb' ),
				'id'       => "{$prefix}post_bg_position",
				'type'     => 'select',
				'options'  => array(
					'left top' => __( 'Left Top', 'rwmb' ),
					'left center' => __( 'Left Center', 'rwmb' ),
					'left bottom' => __( 'Left Bottom', 'rwmb' ),
					'center top' => __( 'Center Top', 'rwmb' ),
					'center bottom' => __( 'Center Bottom', 'rwmb' ),
					'center center' => __( 'Center Center', 'rwmb' ),
					'right top' => __( 'Right Top', 'rwmb' ),
					'right center' => __( 'Right Center', 'rwmb' ),
					'right bottom' => __( 'Right Bottom', 'rwmb' ),
				),
				'multiple'    => false,
				'std'         => '',
			),
			// Background Attachment
			array(
				'name'     => __( 'Background Attachment', 'rwmb' ),
				'desc' => __( '', 'rwmb' ),
				'id'       => "{$prefix}post_bg_attachment",
				'type'     => 'select',
				'options'  => array(
					'scroll' => __( 'Scroll', 'rwmb' ),
					'fixed' => __( 'Fixed', 'rwmb' )
				),
				'multiple'    => false,
				'std'         => '',
			),
			// Background Size
			array(
				'name'     => __( 'Background Size', 'rwmb' ),
				'desc' => __( '', 'rwmb' ),
				'id'       => "{$prefix}post_bg_size",
				'type'     => 'select',
				'options'  => array(
					'inherit' => __( 'Inherit', 'rwmb' ),
					'cover' => __( 'Cover', 'rwmb' ),
					'contain' => __( 'Contain', 'rwmb' )
				),
				'multiple'    => false,
				'std'         => '',
			),
		),
	);

	return $meta_boxes;
}


