<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage travelista
 * @since Travelista 1.0
 */

get_header(); ?>
<div class="main-wrapper">
	<div id="page">
		<div class="main-content <?php bpxl_layout_class(); ?>">
            <?php
                // Include secondary sidebar
                if($bpxl_travelista_options['bpxl_layout'] == 'scblayout') {
                    get_template_part('sidebar-secondary');
                }
            ?>
			<div class="content-area">
				<div class="content content-page">
					<div class="content-detail">
						<div class="page-content">
							<div class="post-box error-page-content">
								<div class="error-head"><span><?php _e('Oops, This Page Could Not Be Found!','bloompixel'); ?></span></div>
								<div class="error-text"><?php _e('404','bloompixel'); ?></div>
								<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Back to Homepage','bloompixel'); ?></a></p>
								<p>
									<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bloompixel' ); ?>
								</p>
								<?php get_search_form(); ?>
							</div>
						</div><!--.page-content-->
					</div>
				</div>
			</div>
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
		</div><!--.main-content-->
<?php get_footer();?>