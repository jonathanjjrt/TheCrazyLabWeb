<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage travelista
 * @since Travelista 1.0
 */

get_header();

global $bpxl_travelista_options; ?>
<div class="main-wrapper">
	<?php
		$category_ID = get_query_var('cat');
		if( get_tax_meta($category_ID,'bpxl_cat_cover_img') ) {
			$bpxl_cat_bg = get_tax_meta($category_ID,'bpxl_cat_cover_img');
		}
	?>
	<div class="cat-cover-box archive-cover-box" <?php if (!empty($bpxl_cat_bg)) { ?>style="background:url('<?php echo esc_url( $bpxl_cat_bg['src'] ); ?>') no-repeat fixed 0 0 / cover" <?php } ?>>
		<div class="archive-cover-content">
			<h1 class="category-title uppercase">
				<?php printf( __( 'Category Archives: %s', 'bloompixel' ), single_cat_title( '', false ) ); ?>
			</h1>
		</div>
	</div>
	<div id="page">
		<div class="main-content <?php bpxl_layout_class(); ?>">
			<div class="archive-page">
				<?php
					// Include secondary sidebar
					if($bpxl_travelista_options['bpxl_archive_layout'] == 'scblayout') {
						get_template_part('sidebar-secondary');
					}
				?>
				<div id="content" class="content-area archive-content-area" role="main">
					<div class="content-archive">
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
						</div><!--.content-->
						<?php 
							// Previous/next page navigation.
							bpxl_paging_nav();
						?>
					</div><!--.content-archive-->
				</div><!--#content-->
				<?php
					$bpxl_layout_array = array(
						'clayout',
						'glayout',
						'flayout'
					);
					if(!in_array($bpxl_travelista_options['bpxl_archive_layout'],$bpxl_layout_array)) { get_sidebar(); }
				?>
			</div><!--.archive-page-->
		</div><!--.main-content-->
<?php get_footer(); ?>