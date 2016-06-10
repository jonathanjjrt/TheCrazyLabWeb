<?php global $bpxl_travelista_options; ?>
<?php ?>
	<div class="post-meta">
	<?php
		if ( is_single() ) {
			if($bpxl_travelista_options['bpxl_single_post_meta_options']['1'] == '1') { ?>
				<span class="post-author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
			<?php } ?>
			<?php if($bpxl_travelista_options['bpxl_single_post_meta_options']['2'] == '1') { ?>
				<span class="post-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><i class="fa fa-clock-o"></i> <?php the_time(get_option( 'date_format' )); ?></time></span>
			<?php } ?>
			<?php if($bpxl_travelista_options['bpxl_single_post_meta_options']['4'] == '1') { ?>
				<?php the_tags('<span class="post-tags"><i class="fa fa-tag"></i> ', ', ', '</span>'); ?>
			<?php } ?>
			<?php if($bpxl_travelista_options['bpxl_single_post_meta_options']['5'] == '1') { ?>
				<span class="post-comments"><i class="fa fa-comments-o"></i> <?php comments_popup_link( __( 'Leave a Comment', 'bloompixel' ), __( '1 Comment', 'bloompixel' ), __( '% Comments', 'bloompixel' ), 'comments-link', __( 'Comments are off', 'bloompixel' )); ?></span>
			<?php } ?>
			<?php if($bpxl_travelista_options['bpxl_single_post_meta_options']['6'] == '1') { ?>
				<span class="post-views"><i class="fa fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?></span>
			<?php } ?>
			<?php edit_post_link( __( 'Edit', 'bloompixel' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</span>' );
		} else {
			if($bpxl_travelista_options['bpxl_post_meta_options']['1'] == '1') { ?>
				<span class="post-author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
			<?php } ?>
			<?php if($bpxl_travelista_options['bpxl_post_meta_options']['2'] == '1') { ?>
				<span class="post-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><i class="fa fa-clock-o"></i> <?php the_time(get_option( 'date_format' )); ?></time></span>
			<?php } ?>
			<?php if($bpxl_travelista_options['bpxl_post_meta_options']['4'] == '1') { ?>
				<?php the_tags('<span class="post-tags"><i class="fa fa-tag"></i> ', ', ', '</span>'); ?>
			<?php } ?>
			<?php if($bpxl_travelista_options['bpxl_post_meta_options']['5'] == '1') { ?>
				<span class="post-comments"><i class="fa fa-comments-o"></i> <?php comments_popup_link( __( 'Leave a Comment', 'bloompixel' ), __( '1 Comment', 'bloompixel' ), __( '% Comments', 'bloompixel' ), 'comments-link', __( 'Comments are off', 'bloompixel' )); ?></span>
			<?php } ?>
			<?php if($bpxl_travelista_options['bpxl_post_meta_options']['6'] == '1') { ?>
				<span class="post-views"><i class="fa fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?></span>
			<?php } ?>
			<?php edit_post_link( __( 'Edit', 'bloompixel' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</span>' );
		}
	?>
	</div><!--.post-meta-->
<?php ?>