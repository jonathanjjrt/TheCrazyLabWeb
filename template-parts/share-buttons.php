<?php global $bpxl_travelista_options; ?>
<div class="share-buttons">
	<?php if(is_single()) { ?>
		<div class="social-buttons clearfix">
			<?php
				$bpxl_social_array = $bpxl_travelista_options['bpxl_share_buttons'];
				
				foreach ($bpxl_social_array as $key=>$value) {
					if($key == "twitter" && $value == "1") { ?>
						<!-- Twitter -->
						<div class="social-btn social-twitter">
							<a rel="nofollow" href="http://twitter.com/home?status=<?php echo urlencode(get_the_title($id)); ?>+<?php the_permalink() ?>" target="_blank" title="<?php _e('Share on Twitter','bloompixel'); ?>">
								<i class="fa fa-twitter"></i>
							</a>
						</div>
					<?php }
					elseif($key == "fb" && $value == "1") { ?>
						<!-- Facebook -->
						<div class="social-btn social-fb">
							<a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>" target="_blank" title="<?php _e('Share on Facebook','bloompixel'); ?>">
								<i class="fa fa-facebook"></i>
							</a>
						</div>
					<?php }
					elseif($key == "gplus" && $value == "1") { ?>
						<!-- Google+ -->
						<div class="social-btn social-gplus">
							<a rel="nofollow" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank" title="<?php _e('Share on Google+','bloompixel'); ?>">
								<i class="fa fa-google-plus"></i>
							</a>
						</div>
					<?php }
					elseif($key == "linkedin" && $value == "1") { ?>
						<!-- LinkedIn -->
						<div class="social-btn social-linkedin">
							<a rel="nofollow" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>&amp;source=<?php echo esc_url( home_url() ); ?>" target="_blank" title="<?php _e('Share on LinkedIn','bloompixel'); ?>">
								<i class="fa fa-linkedin"></i>
							</a>
						</div>
					<?php }
					elseif($key == "pinterest" && $value == "1") { ?>
						<!-- Pinterest -->
						<?php $pin_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); $pin_url = $pin_thumb['0']; ?>
						<div class="social-btn social-pinterest">
							<a rel="nofollow" href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $pin_url; ?>&amp;url=<?php the_permalink() ?>&amp;is_video=false&amp;description=<?php echo urlencode(get_the_title($id)); ?>" target="_blank" title="<?php _e('Share on Pinterest','bloompixel'); ?>">
								<i class="fa fa-pinterest"></i>
							</a>
						</div>
					<?php }
					elseif($key == "stumbleupon" && $value == "1") { ?>
						<!-- StumbleUpon -->
						<div class="social-btn social-stumbleupon">
							<a rel="nofollow" href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&amp;title=<?php _e(urlencode(the_title('','',false))); ?>" target="_blank" title="<?php _e('Share on StumbleUpon','bloompixel'); ?>">
								<i class="fa fa-stumbleupon"></i>
							</a>
						</div>
					<?php }
					elseif($key == "reddit" && $value == "1") { ?>
						<!-- Reddit -->
						<div class="social-btn social-reddit">
							<a rel="nofollow" href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php _e(urlencode(the_title('','',false))); ?>" target="_blank" title="<?php _e('Share on Reddit','bloompixel'); ?>">
								<i class="fa fa-reddit"></i>
							</a>
						</div>
					<?php }
					elseif($key == "tumblr" && $value == "1") { ?>
						<!-- Tumblr -->
						<div class="social-btn social-tumblr">
							<a rel="nofollow" href="http://www.tumblr.com/share?v=3&amp;u=<?php the_permalink() ?>&amp;t=<?php echo urlencode(get_the_title($id)); ?>" target="_blank" title="<?php _e('Share on Tumblr','bloompixel'); ?>">
								<i class="fa fa-tumblr"></i>
							</a>
						</div>
					<?php }
					elseif($key == "delicious" && $value == "1") { ?>
						<!-- Delicious -->
						<div class="social-btn social-delicious">
							<a rel="nofollow" href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>&amp;notes=<?php echo urlencode(get_the_title($id)); ?>" target="_blank" title="<?php _e('Share on Delicious','bloompixel'); ?>">
								<i class="fa fa-delicious"></i>
							</a>
						</div>
					<?php }
					else {
						echo "";
					}
				}
			?>
		</div>
	<?php } else { ?>
		<div class="social-buttons clearfix">
			<?php
				$bpxl_social_array_home = $bpxl_travelista_options['bpxl_share_buttons_home'];
				
				foreach ($bpxl_social_array_home as $key=>$value) {
					if($key == "twitter" && $value == "1") { ?>
						<!-- Twitter -->
						<div class="social-btn social-twitter">
							<a rel="nofollow" href="http://twitter.com/home?status=<?php echo urlencode(get_the_title($id)); ?>+<?php the_permalink() ?>" target="_blank" title="<?php _e('Share on Twitter','bloompixel'); ?>">
								<i class="fa fa-twitter"></i>
							</a>
						</div>
					<?php }
					elseif($key == "fb" && $value == "1") { ?>
						<!-- Facebook -->
						<div class="social-btn social-fb">
							<a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>" target="_blank" title="<?php _e('Share on Facebook','bloompixel'); ?>">
								<i class="fa fa-facebook"></i>
							</a>
						</div>
					<?php }
					elseif($key == "gplus" && $value == "1") { ?>
						<!-- Google+ -->
						<div class="social-btn social-gplus">
							<a rel="nofollow" href="https://plus.google.com/share?url=<?php the_permalink() ?>" target="_blank" title="<?php _e('Share on Google+','bloompixel'); ?>">
								<i class="fa fa-google-plus"></i>
							</a>
						</div>
					<?php }
					elseif($key == "linkedin" && $value == "1") { ?>
						<!-- LinkedIn -->
						<div class="social-btn social-linkedin">
							<a rel="nofollow" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>&amp;source=<?php echo esc_url( home_url() ); ?>" target="_blank" title="<?php _e('Share on LinkedIn','bloompixel'); ?>">
								<i class="fa fa-linkedin"></i>
							</a>
						</div>
					<?php }
					elseif($key == "pinterest" && $value == "1") { ?>
						<!-- Pinterest -->
						<?php $pin_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); $pin_url = $pin_thumb['0']; ?>
						<div class="social-btn social-pinterest">
							<a rel="nofollow" href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $pin_url; ?>&amp;url=<?php the_permalink() ?>&amp;is_video=false&amp;description=<?php echo urlencode(get_the_title($id)); ?>" target="_blank" title="<?php _e('Share on Pinterest','bloompixel'); ?>">
								<i class="fa fa-pinterest"></i>
							</a>
						</div>
					<?php }
					elseif($key == "stumbleupon" && $value == "1") { ?>
						<!-- StumbleUpon -->
						<div class="social-btn social-stumbleupon">
							<a rel="nofollow" href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&amp;title=<?php _e(urlencode(the_title('','',false))); ?>" target="_blank" title="<?php _e('Share on StumbleUpon','bloompixel'); ?>">
								<i class="fa fa-stumbleupon"></i>
							</a>
						</div>
					<?php }
					elseif($key == "reddit" && $value == "1") { ?>
						<!-- Reddit -->
						<div class="social-btn social-reddit">
							<a rel="nofollow" href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php _e(urlencode(the_title('','',false))); ?>" target="_blank" title="<?php _e('Share on Reddit','bloompixel'); ?>">
								<i class="fa fa-reddit"></i>
							</a>
						</div>
					<?php }
					elseif($key == "tumblr" && $value == "1") { ?>
						<!-- Tumblr -->
						<div class="social-btn social-tumblr">
							<a rel="nofollow" href="http://www.tumblr.com/share?v=3&amp;u=<?php the_permalink() ?>&amp;t=<?php echo urlencode(get_the_title($id)); ?>" target="_blank" title="<?php _e('Share on Tumblr','bloompixel'); ?>">
								<i class="fa fa-tumblr"></i>
							</a>
						</div>
					<?php }
					elseif($key == "delicious" && $value == "1") { ?>
						<!-- Delicious -->
						<div class="social-btn social-delicious">
							<a rel="nofollow" href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(get_the_title($id)); ?>&amp;notes=<?php echo urlencode(get_the_title($id)); ?>" target="_blank" title="<?php _e('Share on Delicious','bloompixel'); ?>">
								<i class="fa fa-delicious"></i>
							</a>
						</div>
					<?php }
					else {
						echo "";
					}
				}		
			?>
		</div>
	<?php } ?>
</div><!--.share-buttons-->