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
											$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'bloompixel' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
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
			$bpxl_gallery_images = rwmb_meta( 'bpxl_galleryimg', $args = array('type' => 'image'), $post->ID );
			$bpxl_gallery_type = rwmb_meta( 'bpxl_gallerytype', $args = array('type' => 'select'), $post->ID );
			$bpxl_gallery_single = rwmb_meta( 'bpxl_gallery_single_hide', $args = array('type' => 'checkbox'), $post->ID );
			
			if($bpxl_travelista_options['bpxl_single_featured'] == '1') {
				if(empty($bpxl_gallery_single)) {
					if ($bpxl_gallery_images != NULL) {
						if ($bpxl_gallery_type == 'slider') { ?>
							<div class="flexslider galleryslider loading">
                                <ul class="slides">
                                    <?php foreach ($bpxl_gallery_images as $bpxl_image_id) {
                                        $bpxl_image = wp_get_attachment_image_src($bpxl_image_id['ID'],'featured');
                                        $alt_text = get_post_meta($bpxl_image_id['ID'], '_wp_attachment_image_alt', true);
                                        echo "<li><img src='" . esc_url( $bpxl_image[0] ) . "' alt='" . esc_attr( $alt_text ) . "' width='770' height='355' ></li>";
                                    } ?>
                                </ul>
							</div>
						<?php } else { ?>
							<div class="gallerytiled">
								<ul>
									<?php foreach ($bpxl_gallery_images as $bpxl_image_id) {
										$bpxl_image_thumb = wp_get_attachment_image_src($bpxl_image_id['ID'],'thumbnail');
										$bpxl_image_large = wp_get_attachment_image_src($bpxl_image_id['ID'],'large');
										$alt_text = get_post_meta($bpxl_image_id['ID'], '_wp_attachment_image_alt', true);
								echo "<li><a class='featured-thumbnail featured-thumb-gallery' href='" . esc_url( $bpxl_image_large[0] ) . "'><img src='" . esc_url( $bpxl_image_thumb[0] ) . "' alt='" . esc_attr( $alt_text ) . "' width='150' height='150' ><div class='fhover'></div></a></li>";
									} ?>
								</ul>
							</div>
						<?php }
					}
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