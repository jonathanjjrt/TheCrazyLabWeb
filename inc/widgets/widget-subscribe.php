<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Subscribe Widget
	Plugin URI: http://www.bloompixel.com
	Description: A widget that displays subscription box.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bpxl_subscription_widget' );  

// Register Widget
function bpxl_subscription_widget() {
    register_widget( 'bpxl_subscribe_widget' );
}

// Widget Class
class bpxl_subscribe_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'bpxl_subscribe_widget', 

        // Widget name will appear in UI
        __('(Travelista) Subscribe Widget', 'bloompixel'), 

        // Widget description
        array( 'description' => __( 'A widget that displays the subscribe box', 'bloompixel' ), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
        $title_icon = ( ! empty( $instance['title_icon'] ) ) ? $instance['title_icon'] : '';
		$id = $instance['id'];
		$desc = $instance['desc'];
		
		// Before Widget
		echo $before_widget;
		
		?>
		<!-- START WIDGET -->
		<div class="subscribe-widget">
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
			<p><?php echo $desc; ?></p>
			<form style="" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
				<input type="text" value="" placeholder="Email Address" name="email">
				<input type="hidden" value="<?php echo $id; ?>" name="uri"><input type="hidden" name="loc" value="en_US"><input type="submit" value="Subscribe">
			</form>
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
		$instance['desc'] = $new_instance['desc'];
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
            'title' => __('Subscribe', 'bloompixel'),
            'title_icon' => '',
            'id' => '',
            'desc' => ''
        );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title_icon = isset( $instance['title_icon'] ) ? esc_attr( $instance['title_icon'] ) : '';

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
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
			<label for="<?php echo $this->get_field_id( 'id' ); ?>">Feedburner ID:</label>
			<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>">Subscribe Text:</label>
			<input id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo $instance['desc']; ?>" class="widefat" type="text" />
		</p>
		<?php
	}
}
?>