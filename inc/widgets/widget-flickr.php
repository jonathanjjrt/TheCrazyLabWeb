<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Flickr Widget
	Plugin URI: http://www.bloompixel.com
	Description: A widget that displays your Flickr photos.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bp_flickr_ad_widget' );  

// Register Widget
function bp_flickr_ad_widget() {
    register_widget( 'bp_flickr_widget' );
}

// Widget Class
class bp_flickr_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'bp_flickr_widget', 

        // Widget name will appear in UI
        __('(Travelista) Flickr Widget', 'bloompixel'), 

        // Widget description
        array( 'description' => __( 'A widget that displays flickr photos', 'bloompixel' ), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$photos = $instance['photos'];
		$user_id = $instance['user_id'];
        $title_icon = ( ! empty( $instance['title_icon'] ) ) ? $instance['title_icon'] : '';
		
		// Before Widget
		echo $before_widget;
		
		// Display the widget title  
		if ( $title ) {
            if ( $title_icon ) {
                echo $before_title . '<i class="fa fa-'.$title_icon.'"></i>' . $title . $after_title;
            } else {
                echo $before_title . $title . $after_title;
            }
        }
		
		?>
		<!-- START WIDGET -->
		<div class="flickr-widget">
			<?php
				if ( $user_id ) { ?>
					<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $photos; ?>&display=latest&size=s&layout=x&source=user&user=<?php echo $user_id; ?>"></script>
				<?php }
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
		$instance['user_id'] = $new_instance['user_id'];
		$instance['photos'] = $new_instance['photos'];
		$instance['title_icon'] = strip_tags( $new_instance['title_icon'] );
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
            'title' => '',
            'title_icon' => 'flickr',
            'user_id' => '',
            'photos' => '4'
        );
		$title_icon = isset( $instance['title_icon'] ) ? esc_attr( $instance['title_icon'] ) : '';
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if(!empty($instance['title'])) { echo $instance['title']; } ?>" class="widefat" type="text" />
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
			<label for="<?php echo $this->get_field_id( 'user_id' ); ?>"><?php _e('Your Flickr User ID: <small>You can find your ID <a href="http://idgettr.com/" target="_blank">here</a></small>', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>" value="<?php echo $instance['user_id']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'photos' ); ?>"><?php _e('Number of photos to show:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'photos' ); ?>" name="<?php echo $this->get_field_name( 'photos' ); ?>" value="<?php echo $instance['photos']; ?>" class="widefat" type="text" />
		</p>
		<?php
	}
}
?>