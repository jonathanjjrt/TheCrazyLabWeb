<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage travelista
 * @since Travelista 1.0
 */

get_header();

global $bpxl_travelista_options; ?>
<?php
	if (have_posts()) : the_post();
	$bpxl_cover = rwmb_meta( 'bpxl_post_cover_show', $args = array('type' => 'checkbox'), $post->ID );
	if($bpxl_cover == '1') {
?>
	<div class="cover-box">
		<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div data-type="background" data-speed="3" class="cover-image" style="background-image: url( <?php echo esc_url( $url ); ?>);">
			<div class="cover-heading">
				<div class="slider-inner">
					<header>
						<h1 class="title f-title">
							<?php the_title(); ?>
						</h1>
					</header><!--.header-->
				</div><!--.slider-inner-->
			</div><!--.cover-heading-->
		</div>
	</div><!--.cover-box-->
<?php } ?>

<div class="main-wrapper">
	<div id="page">
        <?php
            // Include Slider
            if ( is_home() || is_front_page() ) {
                if($bpxl_travelista_options['bpxl_slider'] == '1') {
                    if(!is_paged()) {
                        get_template_part('inc/slider');
                    }
                }
            }
        ?>
		<div class="main-content <?php bpxl_layout_class(); ?>">
			<?php
				// Include secondary sidebar
				if($bpxl_travelista_options['bpxl_single_layout'] == 'scblayout') {
					get_template_part('sidebar-secondary');
				}
			?>
			<div class="content-area single-content-area">
				<div class="content content-page <?php bpxl_masonry_class(); ?>">
					<?php rewind_posts(); while (have_posts()) : the_post(); ?>					
						<?php if($bpxl_travelista_options['bpxl_breadcrumbs'] == '1') { ?>
							<div class="breadcrumbs">
								<?php bpxl_breadcrumb(); ?>
							</div>
						<?php }?>
						<div class="page-content">
							<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
								<div class="post-box">
                                    <?php if($bpxl_cover == '0' || $bpxl_cover == '') { ?>
                                        <header>
                                            <h1 class="title page-title"><?php the_title(); ?></h1>
                                        </header>
                                    <?php } ?>
									
									<div class="post-content single-page-content">
										<?php the_content(); ?>
										<?php edit_post_link( __( 'Edit', 'bloompixel' ), '<span class="edit-link">', '</span>' ); ?>
										<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
									</div>
								</div><!--.post-box-->
							</article><!--blog post-->
						</div>	
						<?php
							comments_template();
							
							endwhile;
							
							else :
								// If no content, include the "No posts found" template.
								get_template_part( 'template-parts/post-formats/content', 'none' );
							endif;
						?>
				</div><!--.content-page-->
			</div><!--.content-area-->
			<?php 
				$sidebar_position = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );
				
				if ($bpxl_travelista_options['bpxl_single_layout'] != 'flayout') {
					if ($sidebar_position == 'left' || $sidebar_position == 'right' || $sidebar_position == 'default' || empty($sidebar_position)) {
						get_sidebar();
					}
				}
			?>
		</div><!--.main-content-->
<?php get_footer();?>