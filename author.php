<?php
/**
 * The template for displaying Author archive pages
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
<?php if(get_the_author_meta('author-attachment-url')) {
	$bpxl_author_bg = get_the_author_meta("author-attachment-url");
} ?>
	<div class="archive-cover-box" <?php if (!empty($bpxl_author_bg)) { ?>style="background:url('<?php echo esc_url( $bpxl_author_bg ); ?>') no-repeat fixed 0 0 / cover" <?php } ?>>
		<div class="author-box author-desc-box">
			<div class="author-box-content">
				<div class="author-avtar">
					<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '90' );  } ?>
				</div>
					<div class="author-page-info archive-cover-content">
						<div class="author-head">
							<h5><?php esc_attr( the_author_meta('display_name') ); ?></h5>
						</div>
						<p class="uppercase"><?php the_author_posts(); echo ' '; _e('Articles','bloompixel'); ?></p>
						<?php if(get_the_author_meta('author-loc')) { ?>
							<div class="author-location">
								<span class="author-loc">
									<?php echo esc_attr( get_the_author_meta("author-loc") ); ?>
								</span>
							</div>
						<?php } ?>
						<?php if(get_the_author_meta('description')) { ?>
							<div class="author-desc"><?php esc_attr( the_author_meta('description') ); ?></div>
						<?php } ?>
						<div class="author-social">
							<?php if(get_the_author_meta('facebook')) { ?><span class="author-fb"><a class="fa fa-facebook" href="<?php echo esc_url( get_the_author_meta('facebook') ); ?>"></a></span><?php } ?>
							<?php if(get_the_author_meta('twitter')) { ?><span class="author-twitter"><a class="fa fa-twitter" href="<?php echo esc_url( get_the_author_meta('twitter') ); ?>"></a></span><?php } ?>
							<?php if(get_the_author_meta('googleplus')) { ?><span class="author-gp"><a class="fa fa-google-plus" href="<?php echo esc_url( get_the_author_meta('googleplus') ); ?>"></a></span><?php } ?>
							<?php if(get_the_author_meta('linkedin')) { ?><span class="author-linkedin"><a class="fa fa-linkedin" href="<?php echo esc_url( get_the_author_meta('linkedin') ); ?>"></a></span><?php } ?>
							<?php if(get_the_author_meta('pinterest')) { ?><span class="author-pinterest"><a class="fa fa-pinterest" href="<?php echo esc_url( get_the_author_meta('pinterest') ); ?>"></a></span><?php } ?>
							<?php if(get_the_author_meta('dribbble')) { ?><span class="author-dribbble"><a class="fa fa-dribbble" href="<?php echo esc_url( get_the_author_meta('dribbble') ); ?>"></a></span><?php } ?>
						</div>
					</div>
			</div>
		</div>
	</div><!--.author-desc-box-->
	<div id="page">
		<div class="main-content <?php bpxl_layout_class(); ?>">
			<div class="archive-page">
				<?php
					// Include secondary sidebar
					if($bpxl_travelista_options['bpxl_archive_layout'] == 'scblayout') {
						get_template_part('sidebar-secondary');
					}
				?>
				<div id="content" class="content-area archive-content-area">
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