<?php global $bpxl_travelista_options; ?>
<?php $bpxl_cover = rwmb_meta( 'bpxl_post_cover_show', $args = array('type' => 'checkbox'), $post->ID ); ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
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
		<?php }
			$bpxl_videourl = rwmb_meta( 'bpxl_videourl', $args = array('type' => 'text'), $post->ID );
			$bpxl_videohost = rwmb_meta( 'bpxl_videohost', $args = array('type' => 'text'), $post->ID );
			$bpxl_hosted_video = rwmb_meta( 'bpxl_hostedvideourl', $args = array('type' => 'file_advanced'), $post->ID );
			$bpxl_videocode = rwmb_meta( 'bpxl_videocode', $args = array('type' => 'textarea'), $post->ID );
			
			$bpxl_video_single = rwmb_meta( 'bpxl_video_single_hide', $args = array('type' => 'checkbox'), $post->ID );
			if($bpxl_travelista_options['bpxl_single_featured'] == '1') {
				if(empty($bpxl_video_single)) {
					if ($bpxl_videocode != '') {
						echo $bpxl_videocode;
					} elseif($bpxl_videohost != '') {
						if ($bpxl_videohost == 'youtube') {
							$src = 'http://www.youtube-nocookie.com/embed/'.$bpxl_videourl;
						} elseif ($bpxl_videohost == 'vimeo') {
							$src = 'http://player.vimeo.com/video/'.$bpxl_videourl;
						} elseif ($bpxl_videohost == 'dailymotion') {
							$src = 'http://www.dailymotion.com/embed/video/'.$bpxl_videourl;
						} elseif ($bpxl_videohost == 'metacafe') {
							$src = 'http://www.metacafe.com/embed/'.$bpxl_videourl;
						} ?>
							<div class="post-format-content">
								<iframe src="<?php echo esc_url( $src ); ?>" class="vid iframe-<?php echo esc_attr( $bpxl_videohost ); ?>"></iframe>
							</div>
						<?php
					} elseif ($bpxl_hosted_video != NULL) { ?>
						<div class="post-format-content">
							<?php
								foreach ($bpxl_hosted_video as $bpxl_hosted_video_id) {
									echo do_shortcode( '[video src="'. esc_url( $bpxl_hosted_video_id['url'] ) .'"][/video]' );
								}
							?>
						</div>
					<?php }
				}
			}
		?>
		<div class="post-inner">
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