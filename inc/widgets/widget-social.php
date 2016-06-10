<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Social Widget
	Plugin URI: http://www.bloompixel.com
	facebookription: A widget that displays links to your social profiles.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bpxl_social_widget' );  

// Register Widget
function bpxl_social_widget() {
    register_widget( 'bpxl_social_widget' );
}

// Widget Class
class bpxl_social_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'bpxl_social_widget', 

        // Widget name will appear in UI
        __('(Travelista) Social Widget', 'bloompixel'), 

        // Widget description
        array( 'description' => __( 'A widget that displays links to your social profiles', 'bloompixel' ), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
        $title_icon = ( ! empty( $instance['title_icon'] ) ) ? $instance['title_icon'] : '';
		$social_target = (int) $instance['social_target'];
		$facebook = $instance['facebook'];
		$twitter = $instance['twitter'];
		$gplus = $instance['gplus'];
		$rss = $instance['rss'];
		$pinterest = $instance['pinterest'];
		$linkedin = $instance['linkedin'];
		$flickr = $instance['flickr'];
		$instagram = $instance['instagram'];
		$youtube = $instance['youtube'];
		$tumblr = $instance['tumblr'];
		$dribble = $instance['dribble'];
		$git = $instance['git'];
		$xing = $instance['xing'];
		
		// Before Widget
		echo $before_widget;
		
		?>
		<!-- START WIDGET -->
		<div class="social-widget">
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
			<ul>
				<?php if ( $facebook ) { ?>
					<li class="facebook uppercase"><a href="<?php echo esc_url( $facebook ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-facebook"></span></a></li>
				<?php } ?>
				<?php if ( $twitter ) { ?>
					<li class="twitter uppercase"><a href="<?php echo esc_url( $twitter ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-twitter"></span></a></li>
				<?php } ?>
				<?php if ( $gplus ) { ?>
					<li class="gplus uppercase"><a href="<?php echo esc_url( $gplus ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-google-plus"></span></a></li>
				<?php } ?>
				<?php if ( $rss ) { ?>
					<li class="rss uppercase"><a href="<?php echo esc_url( $rss ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-rss"></span></a></li>
				<?php } ?>
				<?php if ( $pinterest ) { ?>
					<li class="pinterest uppercase"><a href="<?php echo esc_url( $pinterest ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-pinterest"></span></a></li>
				<?php } ?>
				<?php if ( $linkedin ) { ?>
					<li class="linkedin uppercase"><a href="<?php echo esc_url( $linkedin ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-linkedin"></span></a></li>
				<?php } ?>
				<?php if ( $flickr ) { ?>
					<li class="flickr uppercase"><a href="<?php echo esc_url( $flickr ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-flickr"></span></a></li>
				<?php } ?>
				<?php if ( $instagram ) { ?>
					<li class="instagram uppercase"><a href="<?php echo esc_url( $instagram ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-instagram"></span></a></li>
				<?php } ?>
				<?php if ( $youtube ) { ?>
					<li class="youtube uppercase"><a href="<?php echo esc_url( $youtube ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-youtube-play"></span></a></li>
				<?php } ?>
				<?php if ( $tumblr ) { ?>
					<li class="tumblr uppercase"><a href="<?php echo esc_url( $tumblr ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-tumblr"></span></a></li>
				<?php } ?>
				<?php if ( $git ) { ?>
					<li class="git uppercase"><a href="<?php echo esc_url( $git ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-github"></span></a></li>
				<?php } ?>
				<?php if ( $dribble ) { ?>
					<li class="dribble uppercase"><a href="<?php echo esc_url( $dribble ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-dribbble"></span></a></li>
				<?php } ?>
				<?php if ( $xing ) { ?>
					<li class="xing uppercase"><a href="<?php echo esc_url( $xing ); ?>" <?php if ( $social_target == 1 ) { echo 'target="_blank"'; } ?>><span class="fa fa-xing-square"></span></a></li>
				<?php } ?>
			</ul>
		</div>
		<!-- END WIDGET -->
		<?php
		
		// After Widget
		echo $after_widget;
	}
	
	// Update the widget
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['social_target'] = intval( $new_instance['social_target'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['title_icon'] = strip_tags( $new_instance['title_icon'] );
		$instance['id'] = stripslashes( $new_instance['id']);
		$instance['facebook'] = $new_instance['facebook'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['gplus'] = $new_instance['gplus'];
		$instance['rss'] = $new_instance['rss'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['instagram'] = $new_instance['instagram'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['tumblr'] = $new_instance['tumblr'];
		$instance['dribble'] = $new_instance['dribble'];
		$instance['git'] = $new_instance['git'];
		$instance['xing'] = $new_instance['xing'];
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'title' => __('Social Media', 'bloompixel'),
            'title_icon' => '',
			'social_target' => 1,
			'facebook' => '',
			'twitter' => '',
			'gplus' => '',
			'rss' => '',
			'pinterest' => '',
			'linkedin' => '',
			'flickr' => '',
			'instagram' => '',
			'youtube' => '',
			'tumblr' => '',
			'dribble' => '',
			'git' => '',
			'xing' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title_icon = isset( $instance['title_icon'] ) ? esc_attr( $instance['title_icon'] ) : '';
		$social_target = isset( $instance[ 'social_target' ] ) ? esc_attr( $instance[ 'social_target' ] ) : 1;

		// Widget Title: Text Input
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','bloompixel'); ?></label>
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
			<label for="<?php echo $this->get_field_id("social_target"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("social_target"); ?>" name="<?php echo $this->get_field_name("social_target"); ?>" value="1" <?php if (isset($instance['social_target'])) { checked( 1, $instance['social_target'], true ); } ?> />
				<?php _e( 'Open Links in New Window', 'bloompixel'); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_url( $instance['facebook'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_url( $instance['twitter'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'gplus' ); ?>"><?php _e('Google+ URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" value="<?php echo esc_url( $instance['gplus'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('RSS URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo esc_url( $instance['rss'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('Pinterest URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo esc_url( $instance['pinterest'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e('LinkedIn URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo esc_url( $instance['linkedin'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e('Flickr URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo esc_url( $instance['flickr'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e('Instagram URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo esc_url( $instance['instagram'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('YouTube URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo esc_url( $instance['youtube'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'tumblr' ); ?>"><?php _e('tumblr URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'tumblr' ); ?>" name="<?php echo $this->get_field_name( 'tumblr' ); ?>" value="<?php echo esc_url( $instance['tumblr'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'dribble' ); ?>"><?php _e('Dribbble URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'dribble' ); ?>" name="<?php echo $this->get_field_name( 'dribble' ); ?>" value="<?php echo esc_url( $instance['dribble'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'git' ); ?>"><?php _e('GitHub URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'git' ); ?>" name="<?php echo $this->get_field_name( 'git' ); ?>" value="<?php echo esc_url( $instance['git'] ); ?>" class="widefat" type="text" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'xing' ); ?>"><?php _e('Xing URL','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'xing' ); ?>" name="<?php echo $this->get_field_name( 'xing' ); ?>" value="<?php echo esc_url( $instance['xing'] ); ?>" class="widefat" type="text" />
		</p>
		<?php
	}
}
?>