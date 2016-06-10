<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Video Widget
	Plugin URI: http://www.bloompixel.com
	Description: A widget that displays video.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bpxl_videos_widget' );  

// Register Widget
function bpxl_videos_widget() {
    register_widget( 'bpxl_video_widget' );
}

// Widget Class
class bpxl_video_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'bpxl_video_widget', 

        // Widget name will appear in UI
        __('(Travelista) Video Widget', 'bloompixel'), 

        // Widget description
        array( 'description' => __( 'A widget that displays the video', 'bloompixel' ), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
        $title_icon = ( ! empty( $instance['title_icon'] ) ) ? $instance['title_icon'] : '';
		$id = $instance['id'];
		$host = $instance['host'];
		
		// Before Widget
		echo $before_widget;
		
		?>
		<!-- START WIDGET -->
		<div id="video-widget">
			<?php		
				// Display the widget title  
                if ( $title ) {
                    if ( $title_icon ) {
                        echo $before_title . '<i class="fa fa-'.$title_icon.'"></i>' . $title . $after_title;
                    } else {
                        echo $before_title . $title . $after_title;
                    }
                }
			?>
			<?php $src = 'http://www.youtube-nocookie.com/embed/'.$id; ?>
			<?php 
				if($id) :
					if ( $host == "youtube" ) { 
						$src = 'http://www.youtube-nocookie.com/embed/'.$id;
					}
					if ( $host == "vimeo" ) { 
						$src = 'http://player.vimeo.com/video/'.$id;;
					}
					if ( $host == "dailymotion" ) { 
						$src = 'http://www.dailymotion.com/embed/video/'.$id;
					}
					if ( $host == "metacafe" ) { 
						$src = 'http://www.metacafe.com/embed/11333715/'.$id;
					}
					if ( $host == "veoh" ) { 
						$src = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay=0&permalinkId='.$id;;
					}
					if ( $host == "bliptv" ) { 
						$src = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$id;;
					}
					if ( $id != '' ) {
						echo '<iframe src="'. $src .'" class="vid iframe-'. $host .'"></iframe>';
					}
				endif;
			?>
		</div>
		<!-- END WIDGET -->
		<?php
		
		// After Widget
		echo $after_widget;
	}
	
	// Update the widget
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['title_icon'] = strip_tags( $new_instance['title_icon'] );
		$instance['id'] = stripslashes( $new_instance['id']);
		$instance['host'] = strip_tags( $new_instance['host'] );
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'title' => __('Latest Video', 'bloompixel'),
            'title_icon' => '',
			'id' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title_icon = isset( $instance['title_icon'] ) ? esc_attr( $instance['title_icon'] ) : '';
		$host = isset( $instance['host'] ) ? esc_attr( $instance['host'] ) : '';

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

        <!-- Widget Icon: Select -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title_icon' ); ?>"><?php _e('Title Icon', 'bloompixel') ?></label>
			<select id="<?php echo $this->get_field_id('title_icon'); ?>" class="title-icon" name="<?php echo $this->get_field_name('title_icon'); ?>" class="widefat" style="width:100%;">
                
                <option <?php if(empty($iconselect) || $iconselect == 'none') { echo 'selected="selected"'; } ?>><?php _e('No Icon','bloompixel'); ?></option>
                    <?php
                    global $icons_list;
                    $iconselect = $instance['title_icon'];
                    foreach ($icons_list as $icon_type => $icons_array ) { ?>
                        <optgroup label="<?php echo $icon_type; ?>">
                            <?php foreach ($icons_array as $icon ) { ?>
                                <option value="<?php echo $icon; ?>" <?php if($iconselect == $icon) { echo 'selected="selected"'; } ?>><?php echo $icon; ?></option>
                            <?php } ?>
                        </optgroup>
                    <?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('Video ID:','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'host' ); ?>"><?php _e( 'Video Host:','bloompixel' ); ?></label> 
			<select id="<?php echo $this->get_field_id( 'host' ); ?>" name="<?php echo $this->get_field_name( 'host' ); ?>" style="width:100%;" >
				<option value="youtube" <?php if ($host == 'youtube') echo 'selected="selected"'; ?>><?php _e( 'YouTube','bloompixel' ); ?></option>
				<option value="vimeo" <?php if ($host == 'vimeo') echo 'selected="selected"'; ?>><?php _e( 'Vimeo','bloompixel' ); ?></option>
				<option value="dailymotion" <?php if ($host == 'dailymotion') echo 'selected="selected"'; ?>><?php _e( 'Dailymotion','bloompixel' ); ?></option>
				<option value="metacafe" <?php if ($host == 'metacafe') echo 'selected="selected"'; ?>><?php _e( 'Metacafe','bloompixel' ); ?></option>
				<option value="veoh" <?php if ($host == 'veoh') echo 'selected="selected"'; ?>><?php _e( 'Veoh','bloompixel' ); ?></option>
				<option value="bliptv" <?php if ($host == 'bliptv') echo 'selected="selected"'; ?>><?php _e( 'Blip.tv','bloompixel' ); ?></option>
			</select>
		</p>
		<?php
	}
}
?>