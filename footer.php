<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the .main-wrapper and #page div elements.
 *
 * @package WordPress
 * @subpackage travelista
 * @since Travelista 1.0
 */

global $bpxl_travelista_options; ?>
		</div><!--#page-->
	</div><!--.main-wrapper-->
	<?php if ($bpxl_travelista_options['bpxl_footer_social_links'] == '1') { bpxl_social_links( 'footer' ); } ?>
	<footer class="footer">
		<div class="container">
            <?php if ($bpxl_travelista_options['bpxl_show_footer_widgets'] == '1') { ?>
                <?php if ($bpxl_travelista_options['bpxl_footer_columns'] == 'footer_4') { ?>
                    <div class="footer-widgets clearfix footer-columns-4">
                        <div class="footer-widget footer-widget-1">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
                            <?php endif; ?>
                        </div>
                        <div class="footer-widget footer-widget-2">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
                            <?php endif; ?>
                        </div>
                        <div class="footer-widget footer-widget-3">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?>
                            <?php endif; ?>
                        </div>
                        <div class="footer-widget footer-widget-4 last">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 4') ) : ?>
                            <?php endif; ?>
                        </div>
                    </div><!-- .footer-widgets -->
                <?php } elseif ($bpxl_travelista_options['bpxl_footer_columns'] == 'footer_3') { ?>
                    <div class="footer-widgets clearfix footer-columns-3">
                        <div class="footer-widget footer-widget-1">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
                            <?php endif; ?>
                        </div>
                        <div class="footer-widget footer-widget-2">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
                            <?php endif; ?>
                        </div>
                        <div class="footer-widget footer-widget-3 last">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?>
                            <?php endif; ?>
                        </div>
                    </div><!-- .footer-widgets -->
                <?php } elseif ($bpxl_travelista_options['bpxl_footer_columns'] == 'footer_2') { ?>
                    <div class="footer-widgets clearfix footer-columns-2">
                        <div class="footer-widget footer-widget-1">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
                            <?php endif; ?>
                        </div>
                        <div class="footer-widget footer-widget-2 last">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
                            <?php endif; ?>
                        </div>
                    </div><!-- .footer-widgets -->
                <?php } else { ?>
                    <div class="footer-widgets clearfix footer-columns-1">
                        <div class="footer-widget footer-widget-1">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
                            <?php endif; ?>
                        </div>
                    </div><!-- .footer-widgets -->
                <?php } ?>
			<?php } ?>
		</div><!-- .container -->
	</footer>
	<?php if($bpxl_travelista_options['bpxl_footer_logo_btn'] == '1') { ?>
		<div class="footer-logo-wrap">
			<?php if (!empty($bpxl_travelista_options['bpxl_footer_logo']['url'])) { ?>
				<div class="logo" class="uppercase">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_url( $bpxl_travelista_options['bpxl_footer_logo']['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
					</a>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<div class="copyright">
		<div class="copyright-inner textcenter">
			<?php if($bpxl_travelista_options['bpxl_footer_text'] != '') { ?><div class="copyright-text"><?php echo $bpxl_travelista_options['bpxl_footer_text']; ?></div><?php } ?>
		</div>
	</div><!-- .copyright -->
	</div><!-- .st-pusher -->
</div><!-- .main-container -->
<?php if ($bpxl_travelista_options['bpxl_scroll_btn'] == '1') { ?>
	<div class="back-to-top"><i class="fa fa-arrow-up"></i></div>
<?php } ?>
</div>
<?php wp_footer(); ?>
</body>
</html>