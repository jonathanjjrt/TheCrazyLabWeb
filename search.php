<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage travelista
 * @since Travelista 1.0
 */

global $bpxl_travelista_options;

get_header(); ?>

<div class="main-wrapper">
	<div class="cat-cover-box archive-cover-box">
		<div class="archive-cover-content">
            <h1 class="category-title uppercase">
                <?php _e('Search Results for', 'bloompixel'); echo '&nbsp;"' . get_search_query() . '"'; ?>
            </h1>
		</div>
	</div><!--."cat-cover-box-->
	<div id="page">
		<div class="main-content <?php bpxl_layout_class(); ?>">
		<?php
			// Include secondary sidebar
			if($bpxl_travelista_options['bpxl_layout'] == 'scblayout') {
				get_template_part('sidebar-secondary');
			}
		?>
		<div class="content-area home-content-area">
			<div class="content-home">
				<div class="content <?php bpxl_masonry_class(); ?>">
					<?php
						// Start the Loop.
						if (have_posts()) : while (have_posts()) : the_post();
						
						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'template-parts/post-formats/content', get_post_format() );
						
						endwhile;
								
						else:
							// If no content, include the "No posts found" template.
							get_template_part( 'template-parts/post-formats/content', 'none' );

						endif;
					?>
				</div><!--content-->
				<?php 
					// Previous/next page navigation.
					bpxl_paging_nav();
				?>
			</div><!--content-page-->
		</div><!--content-area-->
		<?php
			$bpxl_layout_array = array(
				'clayout',
				'glayout',
				'flayout'
			);

			if(!in_array($bpxl_travelista_options['bpxl_layout'],$bpxl_layout_array)) {
				get_sidebar();
			}
		?>
		</div><!--.main-->
<?php get_footer(); ?>