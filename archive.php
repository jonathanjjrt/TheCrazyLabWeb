<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
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
	<div class="cat-cover-box archive-cover-box">
		<div class="archive-cover-content">
            <h1 class="category-title uppercase">
                <?php
                    if ( is_tag() ) :
                        printf( __( 'Tag Archives: %s', 'bloompixel' ), single_tag_title( '', false ) );

                    elseif ( is_day() ) :
                        printf( __( 'Daily Archives: %s', 'bloompixel' ), get_the_date() );

                    elseif ( is_month() ) :
                        printf( __( 'Monthly Archives: %s', 'bloompixel' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'bloompixel' ) ) );

                    elseif ( is_year() ) :
                        printf( __( 'Yearly Archives: %s', 'bloompixel' ), get_the_date( _x( 'Y', 'yearly archives date format', 'bloompixel' ) ) );

                    else :
                        _e( 'Archives', 'bloompixel' );

                    endif;
                ?>
            </h1>
		</div>
	</div><!--."cat-cover-box-->
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
						<div class="content content-archive <?php bpxl_masonry_class(); ?>">
							<?php			
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