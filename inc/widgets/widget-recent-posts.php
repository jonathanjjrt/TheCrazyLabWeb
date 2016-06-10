<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Recent Posts Widget
	Plugin URI: http://www.bloompixel.com
	Description: A widget that displays recent posts.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bpxl_recent_posts_widget' );  

// Register Widget
function bpxl_recent_posts_widget() {
    register_widget( 'bpxl_recent_widget' );
}

// Widget Class
class bpxl_recent_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'bpxl_recent_widget', 

        // Widget name will appear in UI
        __('(Travelista) Recent Posts', 'bloompixel'), 

        // Widget description
        array( 'description' => __( 'A widget that displays the recent posts of your blog', 'bloompixel' ), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
        $title_icon = ( ! empty( $instance['title_icon'] ) ) ? $instance['title_icon'] : '';
		$posts = $instance['posts'];
		$show_thumb = (int) $instance['show_thumb'];
		$show_cat = (int) $instance['show_cat'];
		$show_author = (int) $instance['show_author'];
		$show_date = (int) $instance['show_date'];
		$show_comments = (int) $instance['show_comments'];
		$widget_style = $instance['widget_style'];
		
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
		<div class="recent-posts-widget recent_posts">
		<ul class="recent-posts">
			<?php
				query_posts( array('orderby' => 'date', 'order' => 'DESC', 'ignore_sticky_posts' => 1, 'showposts' => $posts) );
				if(have_posts()) : while (have_posts()) : the_post(); ?>
				<li>
					<?php if ( $show_thumb == 1 ) { ?>
						<?php if ( $widget_style == 'style-one' ) {
							$thumbnail = 'widgetthumb';
							$thumb_class = '';
						} else {
							$thumbnail = 'related';
							$thumb_class = ' clearfix thumbnail-big';
						}
						?>
						<?php if(has_post_thumbnail()): ?>
							<div class="thumbnail<?php echo $thumb_class; ?>">
								<a class="featured-thumbnail widgetthumb" href='<?php the_permalink(); ?>'>
									<?php the_post_thumbnail( $thumbnail ); ?>
									<div class="fhover"></div>
								</a>
							</div>
						<?php endif; ?>
					<?php
					} ?>
					<div class="info">
						<span class="widgettitle"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></span>
						<span class="meta">
							<?php if ( $show_author == 1 ) { ?>
								<span class="post-author"><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span>
							<?php } ?>
							<?php if ( $show_date == 1 ) { ?>
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><i class="fa fa-clock-o"></i> <?php the_time(get_option( 'date_format' )); ?></time>
							<?php } ?>
							<?php if ( $show_cat == 1 ) { ?>
								<span class="widget-cats"><i class="fa fa-folder-o"></i> <?php the_category(', '); ?></span>
							<?php } ?>
							<?php if ( $show_comments == 1 ) { ?>
								<span class="post-comments"><i class="fa fa-comment-o"></i> <?php comments_popup_link( '0', '1', '%', 'comments-link', ''); ?></span>
							<?php } ?>
						</span>
					</div>
				</li>
			<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_query(); ?>
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
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['title_icon'] = strip_tags( $new_instance['title_icon'] );
		$instance['posts'] = $new_instance['posts'];
		$instance['show_thumb'] = intval( $new_instance['show_thumb'] );
		$instance['show_cat'] = intval( $new_instance['show_cat'] );
		$instance['show_author'] = intval( $new_instance['show_author'] );
		$instance['show_date'] = intval( $new_instance['show_date'] );
		$instance['show_comments'] = intval( $new_instance['show_comments'] );
		$instance['widget_style'] = strip_tags( $new_instance['widget_style'] );
		return $instance;
	}


	//Widget Settings
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			'title' => __('Recent Posts', 'bloompixel'),
            'title_icon' => '',
			'posts' => 4,
			'show_thumb' => 1,
			'show_cat' => 0,
			'show_author' => 0,
			'show_date' => 1,
			'show_comments' => 0
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title_icon = isset( $instance['title_icon'] ) ? esc_attr( $instance['title_icon'] ) : '';
		$show_thumb = isset( $instance[ 'show_thumb' ] ) ? esc_attr( $instance[ 'show_thumb' ] ) : 1;
		$show_cat = isset( $instance[ 'show_cat' ] ) ? esc_attr( $instance[ 'show_cat' ] ) : 1;
		$show_author = isset( $instance[ 'show_author' ] ) ? esc_attr( $instance[ 'show_author' ] ) : 1;
		$show_comments = isset( $instance[ 'show_comments' ] ) ? esc_attr( $instance[ 'show_comments' ] ) : 1;
		$show_date = isset( $instance[ 'show_date' ] ) ? esc_attr( $instance[ 'show_date' ] ) : 1;
		$widget_style = isset( $instance['widget_style'] ) ? esc_attr( $instance['widget_style'] ) : '';

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
			<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e('Number of posts to show:','bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'posts' ); ?>" name="<?php echo $this->get_field_name( 'posts' ); ?>" value="<?php echo intval( $instance['posts'] ); ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'widget_style' ); ?>"><?php _e( 'Widget Style:','bloompixel' ); ?></label> 
			<select id="<?php echo $this->get_field_id( 'widget_style' ); ?>" name="<?php echo $this->get_field_name( 'widget_style' ); ?>" style="width:100%;" >
				<option value="style-one" <?php if ($widget_style == 'style-one') echo 'selected="selected"'; ?>><?php _e( 'Small Thumbnail','bloompixel' ); ?></option>
				<option value="style-two" <?php if ($widget_style == 'style-two') echo 'selected="selected"'; ?>><?php _e( 'Big Thumbnail','bloompixel' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("show_thumb"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_thumb"); ?>" name="<?php echo $this->get_field_name("show_thumb"); ?>" value="1" <?php if (isset($instance['show_thumb'])) { checked( 1, $instance['show_thumb'], true ); } ?> />
				<?php _e( 'Show Thumbnails', 'bloompixel'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("show_cat"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_cat"); ?>" name="<?php echo $this->get_field_name("show_cat"); ?>" value="1" <?php if (isset($instance['show_cat'])) { checked( 1, $instance['show_cat'], true ); } ?> />
				<?php _e( 'Show Categories', 'bloompixel'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("show_author"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_author"); ?>" name="<?php echo $this->get_field_name("show_author"); ?>" value="1" <?php if (isset($instance['show_author'])) { checked( 1, $instance['show_author'], true ); } ?> />
				<?php _e( 'Show Post Author', 'bloompixel'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("show_date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_date"); ?>" name="<?php echo $this->get_field_name("show_date"); ?>" value="1" <?php if (isset($instance['show_date'])) { checked( 1, $instance['show_date'], true ); } ?> />
				<?php _e( 'Show Post Date', 'bloompixel'); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id("show_comments"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_comments"); ?>" name="<?php echo $this->get_field_name("show_comments"); ?>" value="1" <?php if (isset($instance['show_comments'])) { checked( 1, $instance['show_comments'], true ); } ?> />
				<?php _e( 'Show Post Comments', 'bloompixel'); ?>
			</label>
		</p>
		<?php
	}
}
?>