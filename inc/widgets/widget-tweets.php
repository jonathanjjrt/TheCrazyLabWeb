<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Tweets Widget
	Plugin URI: http://www.bloompixel.com
	Description: A widget that displays recent tweets from your Twitter profile.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bpxl_recent_tweets_widget' );  

// Register Widget
function bpxl_recent_tweets_widget() {
    register_widget( 'bpxl_tweets_widget' );
}

// Widget Class
class bpxl_tweets_widget extends WP_Widget {
    
    /**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'bpxl_tweets_widget',
			'(Travelista) Tweets Widget',
			array(
				'classname'		=>	'bpxl_facebook_widget',
				'description'	=>	__('A widget that displays recent tweets from your Twitter profile.', 'bloompixel')
			)
		);

	} // end constructor

	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$width = $instance['width'];
		$height = $instance['height'];
		$link_color = $instance['link_color'];
		$border_color = $instance['border_color'];
		$noheader = (int) $instance['noheader'];
		$nofooter = (int) $instance['nofooter'];
		$noborders = (int) $instance['noborders'];
		$noscrollbar = (int) $instance['noscrollbar'];
		$transparent = (int) $instance['transparent'];
		$widget_id = $instance['widget_id'];
		$theme = $instance['theme'];
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
		<div class="tweets-widget">
			<?php if ( $widget_id ) { ?>
				<a class="twitter-timeline" 
					<?php if ( $height ) { echo 'height="'. $height .'"'; } ?> 
					<?php if ( $width ) { echo 'width="'. $width .'"'; } ?> 
					<?php if ( $width ) { echo 'data-link-color="'. $link_color .'"'; } ?> 
					<?php if ( $border_color ) { echo 'data-border-color="'. $border_color .'"'; } ?> 
					<?php echo 'data-theme="'. $theme .'"'; ?> 
					data-chrome="<?php if ( $noheader == 1 ) { echo "noheader"; } ?> <?php if ( $nofooter == 1 ) { echo "nofooter"; } ?> <?php if ( $noborders == 1 ) { echo "noborders"; } ?> <?php if ( $noscrollbar == 1 ) { echo "noscrollbar"; } ?> <?php if ( $transparent == 1 ) { echo "transparent"; } ?>" 
					data-widget-id="<?php echo $widget_id; ?>">
				</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			<?php } ?>
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
		$instance['widget_id'] = $new_instance['widget_id'];
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		$instance['link_color'] = $new_instance['link_color'];
		$instance['border_color'] = $new_instance['border_color'];
		$instance['noheader'] = intval( $new_instance['noheader'] );
		$instance['nofooter'] = intval( $new_instance['nofooter'] );
		$instance['noborders'] = intval( $new_instance['noborders'] );
		$instance['noscrollbar'] = intval( $new_instance['noscrollbar'] );
		$instance['transparent'] = intval( $new_instance['transparent'] );
		$instance['theme'] = strip_tags( $new_instance['theme'] );
		$instance['title_icon'] = strip_tags( $new_instance['title_icon'] );
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
            'title_icon' => 'twitter',
			'noheader' => 0,
			'nofooter' => 0,
			'noborders' => 0,
			'noscrollbar' => 0,
			'transparent' => 0,
			'widget_id' => '',
			'link_color' => '#0084b4',
			'border_color' => '#e8e8e8',
			'height' => '400',
			'width' => '325'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title_icon = isset( $instance['title_icon'] ) ? esc_attr( $instance['title_icon'] ) : '';
		$theme = isset( $instance['theme'] ) ? esc_attr( $instance['theme'] ) : '';
		$noheader = isset( $instance[ 'noheader' ] ) ? esc_attr( $instance[ 'noheader' ] ) : 1;
		$nofooter = isset( $instance[ 'nofooter' ] ) ? esc_attr( $instance[ 'nofooter' ] ) : 1;
		$noborders = isset( $instance[ 'noborders' ] ) ? esc_attr( $instance[ 'noborders' ] ) : 1;
		$noscrollbar = isset( $instance[ 'noscrollbar' ] ) ? esc_attr( $instance[ 'noscrollbar' ] ) : 1;
		$transparent = isset( $instance[ 'transparent' ] ) ? esc_attr( $instance[ 'transparent' ] ) : 1;
		?>
        <!-- Widget Title: Text Input -->
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
			<label for="<?php echo $this->get_field_id( 'widget_id' ); ?>"><?php _e('Widget ID:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'widget_id' ); ?>" name="<?php echo $this->get_field_name( 'widget_id' ); ?>" value="<?php echo $instance['widget_id']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height:', 'bloompixel') ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_color' ); ?>"><?php _e('Link Color (Hex Code):', 'bloompixel') ?></label><br>
			<input id="<?php echo $this->get_field_id( 'link_color' ); ?>" class="color-picker" name="<?php echo $this->get_field_name( 'link_color' ); ?>" value="<?php echo $instance['link_color']; ?>" class="widefat" type="text" data-default-color="#0084b4" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'border_color' ); ?>"><?php _e('Border Color (Hex Code):', 'bloompixel') ?></label><br>
			<input id="<?php echo $this->get_field_id( 'border_color' ); ?>" class="color-picker" name="<?php echo $this->get_field_name( 'border_color' ); ?>" value="<?php echo $instance['border_color']; ?>" class="widefat" type="text" data-default-color="#e8e8e8" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _e('Layout Options:', 'bloompixel') ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("noheader"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("noheader"); ?>" name="<?php echo $this->get_field_name("noheader"); ?>" value="1" <?php if (isset($instance['noheader'])) { checked( 1, $instance['noheader'], true ); } ?> />
				<?php _e( 'No Header', 'bloompixel'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("nofooter"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("nofooter"); ?>" name="<?php echo $this->get_field_name("nofooter"); ?>" value="1" <?php if (isset($instance['nofooter'])) { checked( 1, $instance['nofooter'], true ); } ?> />
				<?php _e( 'No Footer', 'bloompixel'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("noborders"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("noborders"); ?>" name="<?php echo $this->get_field_name("noborders"); ?>" value="1" <?php if (isset($instance['noborders'])) { checked( 1, $instance['noborders'], true ); } ?> />
				<?php _e( 'No Borders', 'bloompixel'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("noscrollbar"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("noscrollbar"); ?>" name="<?php echo $this->get_field_name("noscrollbar"); ?>" value="1" <?php if (isset($instance['noscrollbar'])) { checked( 1, $instance['noscrollbar'], true ); } ?> />
				<?php _e( 'No Scrollbar', 'bloompixel'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("transparent"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("transparent"); ?>" name="<?php echo $this->get_field_name("transparent"); ?>" value="1" <?php if (isset($instance['transparent'])) { checked( 1, $instance['transparent'], true ); } ?> />
				<?php _e( 'Transparent Background', 'bloompixel'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'theme' ); ?>"><?php _e( 'Timeline Theme:','bloompixel' ); ?></label> 
			<select id="<?php echo $this->get_field_id( 'theme' ); ?>" name="<?php echo $this->get_field_name( 'theme' ); ?>" style="width:100%;" >
				<option value="light" <?php if ($theme == 'light') echo 'selected="selected"'; ?>><?php _e( 'Light','bloompixel' ); ?></option>
				<option value="dark" <?php if ($theme == 'dark') echo 'selected="selected"'; ?>><?php _e( 'Dark','bloompixel' ); ?></option>
			</select>
		</p>
		<?php
	}
}
?>