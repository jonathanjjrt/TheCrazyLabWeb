<?php global $bpxl_travelista_options; ?>
<?php $bpxl_cover = rwmb_meta( 'bpxl_post_cover_show', $args = array('type' => 'checkbox'), $post->ID ); ?>
<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
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
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php
				if($bpxl_travelista_options['bpxl_post_meta'] == '1') {
					// Post Meta			
					get_template_part('template-parts/post-meta');
				}
			?>
		</header><!--.header-->
		<?php
			$bpxl_audio_url = rwmb_meta( 'bpxl_audiourl', $args = array('type' => 'text'), $post->ID );
			$bpxl_audio_host = rwmb_meta( 'bpxl_audiohost', $args = array('type' => 'text'), $post->ID );
			$bpxl_audio_mp3 = rwmb_meta( 'bpxl_mp3url', $args = array('type' => 'file_advanced'), $post->ID );
			$bpxl_audio_embed_code = rwmb_meta( 'bpxl_audiocode', $args = array('type' => 'textarea'), $post->ID );
		?>
		<div class="audio-box clearfix">
			<?php if ($bpxl_audio_embed_code != '') {
				echo $bpxl_audio_embed_code;
			} else if($bpxl_audio_host == 'soundcloud') { ?>
				<iframe border="no" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php if($bpxl_audio_url != '') { echo esc_url( $bpxl_audio_url ); } ?>&auto_play=false&hide_related=false&visual=true"></iframe>
			<?php } else if ($bpxl_audio_host == 'mixcloud') { ?>
				<iframe src="//www.mixcloud.com/widget/iframe/?feed=<?php if($bpxl_audio_url != '') { echo esc_url( $bpxl_audio_url ); } ?>&embed_type=widget_standard&embed_uuid=43f53ec5-65c0-4d1f-8b55-b26e0e7c2288&hide_tracklist=1&hide_cover=0" frameborder="0"></iframe>
			<?php } else if ($bpxl_audio_mp3 != NULL) {
				foreach ($bpxl_audio_mp3 as $bpxl_audio_mp3_id) {
					echo do_shortcode( '[audio src="'. $bpxl_audio_mp3_id['url'] .'"][/audio]' );
				}
			} ?>
		</div>
		<div class="post-inner">
			<?php if ( is_search() ) { ?>
				<div class="post-content entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			<?php } else { ?>
				<?php $bpxl_audio_excerpt_home = rwmb_meta( 'bpxl_audio_excerpt_home', $args = array('type' => 'checkbox'), $post->ID );
				if(empty($bpxl_audio_excerpt_home)) { ?>
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
		</div><!--.post-inner-->
		<?php 
			if($bpxl_travelista_options['bpxl_show_home_share_buttons'] == '1') {
				get_template_part('template-parts/share-buttons');
			}
		?>
	</div><!--.post excerpt-->
</article><!--.post-box-->