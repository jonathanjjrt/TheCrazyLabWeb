<?php global $bpxl_travelista_options; ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
		<?php
			$bpxl_link_url = rwmb_meta( 'bpxl_linkurl', $args = array('type' => 'text'), $post->ID );
			$bpxl_link_bg = rwmb_meta( 'bpxl_link_background', $args = array('type' => 'text'), $post->ID );
			
			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id,'featured');
			
			$status_bg = $thumb_url[0];
			if(!empty($status_bg)) {
				$status_bg_code = 'style="background-image: url('.$status_bg.'); background-size: cover;"';
			} else if(!empty($bpxl_link_bg)) {
				$status_bg_code = 'style=" background:'.$bpxl_link_bg.'"';
			} else {
				$status_bg_code = '';
			}
		?>
		<header>
			<?php
			if($bpxl_travelista_options['bpxl_post_meta'] == '1') {
				if($bpxl_travelista_options['bpxl_post_meta_options']['3'] == '1') { ?>
					<div class="post-cats uppercase">
						<?php
							// Post Format Icons
							get_template_part('template-parts/post-format-icons'); 
							
							// Categories
							$categories = get_the_category();
							$separator = '';
							$output = '';
							if($categories){
								foreach($categories as $category) {
									$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s","bloompixel" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
								}
							echo trim($output, $separator);
							}
						?>
					</div><?php
				}
			} ?>
			<h2 class="title entry-title title32">
				<a href="<?php echo esc_url( $bpxl_link_url ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php
				if($bpxl_travelista_options['bpxl_post_meta'] == '1') {
					// Post Meta			
					get_template_part('template-parts/post-meta');
				}
			?>
		</header><!--.header-->
		<div class="post-inner">
			<a href="<?php echo esc_url( $bpxl_link_url ); ?>">
				<div class="post-content post-format-link" <?php echo $status_bg_code; ?>>
					<div class="post-content-format">
						<i class="fa fa-link post-format-icon"></i>
						<div class="post-format-link-content">
							<?php echo esc_url( $bpxl_link_url ); ?>
						</div>
					</div>
				</div><!--.post-content-->
			</a>
			<div class="post-content">
				<?php
					if ( is_search() ) { ?>
						<div class="post-content entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
					<?php } else { ?>
						<?php $bpxl_link_excerpt_home = rwmb_meta( 'bpxl_link_excerpt_home', $args = array('type' => 'checkbox'), $post->ID );
						if(empty($bpxl_link_excerpt_home)) { ?>
							<div class="post-content entry-content">
								<?php
								$excerpt_length = $bpxl_travelista_options['bpxl_excerpt_length'];
								if($bpxl_travelista_options['bpxl_home_content'] == '2') {
									the_content( __('Read More','bloompixel') );
								} else { ?>
									<p><?php echo excerpt($excerpt_length); ?></p>
										<div class="read-more">
											<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php _e('Read More','bloompixel'); ?></a>
										</div>
									<?php
								} ?>
							</div><!--post-content-->
						<?php } ?>	
					<?php } ?>
			</div>
		</div><!--.post-inner-->
		<?php 
			if($bpxl_travelista_options['bpxl_show_home_share_buttons'] == '1') {
				get_template_part('template-parts/share-buttons');
			}
		?>
	</div><!--.post excerpt-->
</article><!--.post-box-->