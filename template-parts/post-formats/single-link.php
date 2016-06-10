<?php global $bpxl_travelista_options; ?>
<?php $bpxl_cover = rwmb_meta( 'bpxl_post_cover_show', $args = array('type' => 'checkbox'), $post->ID ); ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
		<?php
			$bpxl_link_url = rwmb_meta( 'bpxl_linkurl', $args = array('type' => 'text'), $post->ID );
			$bpxl_link_bg = rwmb_meta( 'bpxl_link_background', $args = array('type' => 'text'), $post->ID );
			
			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id,'featured');
			
			$status_bg = $thumb_url[0];
			if(!empty($status_bg)) {
				$status_bg_code = 'style="background-image: url('.esc_url( $status_bg ).'); background-size: cover;"';
			} else if(!empty($bpxl_link_bg)) {
				$status_bg_code = 'style=" background:'.$bpxl_link_bg.'"';
			} else {
				$status_bg_code = '';
			}
		?>
		<?php 
			if($bpxl_cover == '0' || $bpxl_cover == '') { ?>
			<header>
				<?php
					if($bpxl_travelista_options['bpxl_single_meta'] == '1') { 
						if($bpxl_travelista_options['bpxl_single_post_meta_options']['3'] == '1') { ?>
							<div class="post-cats uppercase">
								<?php
									// Post Format Icon
									get_template_part('template-parts/post-format-icons'); 
								
									// Post Category
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
					<h1 class="title entry-title"><?php the_title(); ?></h1><?php

					if($bpxl_travelista_options['bpxl_single_meta'] == '1') {
						// Post Meta
						get_template_part('template-parts/post-meta');
					} ?>
			</header><!--.header-->
		<?php } ?>
		<div class="post-inner">
			<?php
				$bpxl_link_single = rwmb_meta( 'bpxl_link_single_hide', $args = array('type' => 'checkbox'), $post->ID );
				if($bpxl_travelista_options['bpxl_single_featured'] == '1') {
					if(empty($bpxl_link_single)) {
				// Single
			?>
				<a href="<?php echo $bpxl_link_url; ?>">
					<div class="post-content post-format-link" <?php echo $status_bg_code; ?>>
						<i class="fa fa-link post-format-icon"></i>
						<div class="post-format-link-content">
							<?php echo esc_url( $bpxl_link_url ); ?>
						</div>
					</div>
				</a>
			<?php }
				}
			?>
			<div class="post-content entry-content single-post-content">
				<?php if($bpxl_travelista_options['bpxl_below_title_ad'] != '') { ?>
					<div class="single-post-ad">
						<?php echo $bpxl_travelista_options['bpxl_below_title_ad']; ?>
					</div>
				<?php } ?>
					
				<?php the_content(); ?>
				
				<?php if($bpxl_travelista_options['bpxl_below_content_ad'] != '') { ?>
					<div class="single-post-ad">
						<?php echo $bpxl_travelista_options['bpxl_below_content_ad']; ?>
					</div>
				<?php } ?>
					
				<?php bpxl_wp_link_pages() ?>
			</div><!--.single-post-content-->
		</div><!--.post-inner-->
		<?php
			if($bpxl_travelista_options['bpxl_show_share_buttons'] == '1') {
				get_template_part('template-parts/share-buttons');
			}
		?>
	</div><!--.post excerpt-->
</article><!--.post-box-->