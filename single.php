<?php get_header(); ?>
<?php global $bpxl_travelista_options; ?>
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
					<div class="post-cats slider-cat uppercase">
						<?php
							$category = get_the_category();
							if ($category) {										
								echo '<span>' . $category[0]->name.'</span> ';										
							}
						?>
					</div>
					<header>
						<h1 class="title f-title">
							<?php the_title(); ?>
						</h1>
					</header><!--.header-->
					<div class="slider-meta post-meta">
						<?php if($bpxl_travelista_options['bpxl_post_meta_options']['2'] == '1') { ?>
							<span class="post-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><i class="fa fa-clock-o"></i> <?php the_time(get_option( 'date_format' )); ?></time></span>
						<?php } ?>
						<?php if($bpxl_travelista_options['bpxl_post_meta_options']['5'] == '1') { ?>
							<span class="post-comments"><i class="fa fa-comments-o"></i> <?php comments_number( __( 'No Comments Yet', 'bloompixel' ), __( '1 Comment', 'bloompixel' ), __( '% Comments', 'bloompixel' ) ); ?></span>
						<?php } ?>
					</div>
				</div><!--.slider-inner-->
			</div><!--.cover-heading-->
		</div>
	</div><!--.cover-box-->
<?php } ?>
<div class="main-wrapper">
	<div id="page">
		<div class="main-content <?php bpxl_layout_class(); ?>">
			<?php
				// Include secondary sidebar
				$sidebar_small_position = rwmb_meta( 'bpxl_layout', $args = array('type' => 'image_select'), get_the_ID() );
				if($bpxl_travelista_options['bpxl_single_layout'] == 'scblayout') {
					if ($sidebar_small_position == 'default' || empty($sidebar_small_position)) {
						get_template_part('sidebar-secondary');
					}
			} ?>
			<div id="content" class="content-area single-content-area">
				<div class="content content-single <?php bpxl_masonry_class(); ?>">
					<?php if($bpxl_travelista_options['bpxl_breadcrumbs'] == '1') { ?>
						<div class="breadcrumbs">
							<?php bpxl_breadcrumb(); ?>
						</div>
					<?php }
					
						rewind_posts(); while (have_posts()) : the_post();
						
						if ( !current_user_can( 'edit_post' , get_the_ID() ) ) { setPostViews(get_the_ID()); } ?>
						
						<div class="single-content">
							<?php get_template_part( 'template-parts/post-formats/single', get_post_format() ); ?>
						</div><!--.single-content-->
						
						<?php							
							endwhile;
							
							else :
								// If no content, include the "No posts found" template.
								get_template_part( 'template-parts/post-formats/content', 'none' );
								
							endif;
							
						if($bpxl_travelista_options['bpxl_next_prev_article'] == '1') {
						
							// Previous/next post navigation.
							bpxl_post_nav();
							
						}
					?>

					<?php if($bpxl_travelista_options['bpxl_author_box'] == '1') { ?>
						<div class="author-box single-box">
							<h3 class="section-heading uppercase"><span><?php _e('About Author','bloompixel'); ?></span></h3>
							<div class="author-box-avtar">
								<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '100' );  } ?>
							</div>
							<div class="author-info-container">
								<div class="author-info">
									<div class="author-head">
										<h5><?php esc_attr( the_author_meta('display_name') ); ?></h5>
									</div>
									<p><?php esc_attr( the_author_meta('description') ); ?></p>
									<div class="author-social">
										<?php if(get_the_author_meta('facebook')) { ?><span class="author-fb"><a class="fa fa-facebook" href="<?php echo esc_url( get_the_author_meta('facebook') ); ?>"></a></span><?php } ?>
										<?php if(get_the_author_meta('twitter')) { ?><span class="author-twitter"><a class="fa fa-twitter" href="<?php echo esc_url( get_the_author_meta('twitter') ); ?>"></a></span><?php } ?>
										<?php if(get_the_author_meta('googleplus')) { ?><span class="author-gp"><a class="fa fa-google-plus" href="<?php echo esc_url( get_the_author_meta('googleplus') ); ?>"></a></span><?php } ?>
										<?php if(get_the_author_meta('linkedin')) { ?><span class="author-linkedin"><a class="fa fa-linkedin" href="<?php echo esc_url( get_the_author_meta('linkedin') ); ?>"></a></span><?php } ?>
										<?php if(get_the_author_meta('pinterest')) { ?><span class="author-pinterest"><a class="fa fa-pinterest" href="<?php echo esc_url( get_the_author_meta('pinterest') ); ?>"></a></span><?php } ?>
										<?php if(get_the_author_meta('dribbble')) { ?><span class="author-dribbble"><a class="fa fa-dribbble" href="<?php echo esc_url( get_the_author_meta('dribbble') ); ?>"></a></span><?php } ?>
									</div><!--.author-social-->
								</div><!--.author-info-->
							</div>
						</div><!--.author-box-->
					<?php }
					
					$related = rwmb_meta( 'bpxl_singlerelated', $args = array('type' => 'checkbox'), $post->ID );
					
					if($related == '1') {
					} else if($bpxl_travelista_options['bpxl_related_posts'] == '1') {
						$orig_post = $post;
						global $post;
						
						//Related Posts By Categories
						if ($bpxl_travelista_options['bpxl_related_posts_by'] == '1') {
							$categories = get_the_category($post->ID);
							if ($categories) {
								$category_ids = array();
								foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
								$args=array(
									'category__in' => $category_ids,
									'post__not_in' => array($post->ID),
									'posts_per_page'=> $bpxl_travelista_options['bpxl_related_posts_count'], // Number of related posts that will be shown.
									'ignore_sticky_posts'=>1
								);
							}
						}
						//Related Posts By Tags
						else {
							$tags = wp_get_post_tags($post->ID);        
							if ($tags) {
								$tag_ids = array();  
								foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
								$args=array(
									'tag__in' => $tag_ids,  
									'post__not_in' => array($post->ID),  
									'posts_per_page'=> $bpxl_travelista_options['bpxl_related_posts_count'], // Number of related posts to display.  
									'ignore_sticky_posts'=>1 
								); 
							}
						}
						$my_query = new wp_query( $args );
						if( $my_query->have_posts() ) {
							echo '<div class="relatedPosts single-box"><h3 class="section-heading uppercase"><span>' . __('Related Posts','bloompixel') . '</span></h3><ul class="slides">';
							while( $my_query->have_posts() ) {
								$my_query->the_post();?>
								<li>
									<a class="featured-thumbnail" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow">
										<?php if ( has_post_thumbnail() ) { ?> 
											<div class="relatedthumb"><?php the_post_thumbnail('related'); ?></div>
										<?php } else { ?>
											<div class="relatedthumb"><img width="240" height="185" src="<?php echo esc_url ( get_template_directory_uri() ); ?>/images/240x185.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>"></div>
										<?php } ?>
										<div class="fhover"></div>
									</a>
									<?php
										$post_title = the_title('','',false);
										$short_title = substr($post_title,0,38);
										
										if ( $short_title != $post_title ) {
											$short_title .= "...";
										} else {
											$short_title = $post_title;
										}
									?>
									<div class="related-content">
										<header>
											<h2 class="widgettitle">
												<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
											</h2>
										</header><!--.header-->		
										<?php
											if($bpxl_travelista_options['bpxl_single_meta'] == '1') {
												if(isset($bpxl_travelista_options['bpxl_single_post_meta_options']['2']) == '1') { ?>
												<div class="r-meta">
													<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><i class="fa fa-clock-o"></i> <?php echo esc_html( get_the_date() ); ?></time>
												</div>
											<?php }
											}
										?>
									</div>
								</li>
								<?php
							}
							echo '</ul></div>';
						}
						$post = $orig_post;
						wp_reset_query();
					} 
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					} ?>
				</div>
			</div>
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