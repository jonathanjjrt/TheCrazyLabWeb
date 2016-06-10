<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Homepage: Module A Widget
	Plugin URI: http://www.bloompixel.com
	Description: A widget that displays module A posts.
	Version: 1.0
	Author: Simrandeep Singh
	Author URI: http://www.simrandeep.com

-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bloompixel_slider_widget' );

function bloompixel_slider_widget() {
	register_widget( 'bpxl_widget_slider' );
}

class bpxl_widget_slider extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'bpxl_widget_slider', 

        // Widget name will appear in UI
        __('(Travelista) Slider Widget', 'bloompixel'), 

        // Widget description
        array( 'description' => __( 'A widget that displays the slider', 'bloompixel' ), ) 
        );
    }
	
	public function widget( $args, $instance ) {
		$bp_options = get_option('revista');
		extract( $args );
		
		//$title = apply_filters('widget_title', $instance['title'] );
		$posts = $instance['posts'];
		$cats = $instance['cats'];

		echo $before_widget;
			
		?>
		<!-- START WIDGET -->
        <div class="widgetslider flexslider loading">
            <ul class="slides">
                <?php $module_b = new WP_Query("cat=".$cats."&orderby=date&order=DESC&showposts=".$posts) ?>
                <?php if($module_b->have_posts()) : while ($module_b->have_posts()) : $module_b->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail featured-widgetslider">
                            <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail('featuredthumb');
                                } else {
                                    echo '<img src="' . get_stylesheet_directory_uri() . '/images/395x175.png" />';
                                }
                            ?>
                            <div class="post-inner slider-post-inner textcenter">
                                <header>
                                    <h2 class="ws-title">
                                        <?php the_title(); ?>
                                    </h2>
                                </header><!--.header-->
                            </div>
                        </a>
                    </li>
                <?php endwhile; ?>
                <?php endif; ?>
            </ul>
		</div><!--.widgetslider-->
		<!-- END WIDGET -->
		<?php

		echo $after_widget;

	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		/* $instance['title'] = strip_tags( $new_instance['title'] ); */
		$instance['posts'] = strip_tags( $new_instance['posts'] );
		$instance['cats'] = implode(',' , $new_instance['cats']  );

		return $instance;
	}
	
	public function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array(
			/* 'cat' => $this->cat */
			'cats' => 1,
			'posts' => 4,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_all = get_categories();
		$bpxl_categories = array();

		foreach ($categories_all as $bpxl_cat) {
			$bpxl_categories[$bpxl_cat->cat_ID] = $bpxl_cat->cat_name;
		}
		?>
		<?php //Number of Posts ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e('Number of posts:', 'bloompixel'); ?></label>
			<input id="<?php echo $this->get_field_id( 'posts' ); ?>" name="<?php echo $this->get_field_name( 'posts' ); ?>" value="<?php echo $instance['posts']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<?php $cats = explode ( ',' , $instance['cats'] ) ; ?>
			<label for="<?php echo $this->get_field_id( 'cats' ); ?>"><?php _e('Category: ','bloompixel'); ?></label>
			<select multiple="multiple" id="<?php echo $this->get_field_id( 'cats' ); ?>[]" name="<?php echo $this->get_field_name( 'cats' ); ?>[]" class="widefat" >
				<?php foreach ($bpxl_categories as $bpxl_category => $bpxl_option) { ?>
				<option value="<?php echo $bpxl_category ?>" <?php if ( in_array( $bpxl_category , $cats ) ) { echo ' selected="selected"' ; } ?>><?php echo $bpxl_option; ?></option>
				<?php } ?>
			</select>
		</p>
		<?php
	}
}

?>