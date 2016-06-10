<?php global $bpxl_travelista_options; ?>
<div class="fs-wrap clearfix">
    <div class="featuredslider flexslider loading clearfix">
        <ul class="slides">
            <?php
                if ( $bpxl_travelista_options['bpxl_slider_type'] == 'posts_by_cat' ) {
                    $featured_slider_cats = $bpxl_travelista_options['bpxl_slider_cat'];
                    $featured_slider_posts = $bpxl_travelista_options['bpxl_slider_posts_count'];
                    $featured_slider_cat = implode(",", $featured_slider_cats);
                    $featured_posts = new WP_Query("cat=".$featured_slider_cat."&orderby=date&order=DESC&showposts=".$featured_slider_posts);

                    if($featured_posts->have_posts()) : while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail f-thumb">
                            <?php if ( has_post_thumbnail() ) {
                                    the_post_thumbnail('slider');
                                } else {
                                    echo '<img alt="Featured Image" src="' . get_stylesheet_directory_uri() . '/images/1170x500.png" width="1170"/>';
                                } ?>
                            <div class="center-width clearfix">
                                <div class="post-inner">
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
                                            <h2 class="title f-title title24">
                                                <?php the_title(); ?>
                                            </h2>
                                        </header><!--.header-->
                                        <div class="slider-meta post-meta">
                                            <?php if($bpxl_travelista_options['bpxl_post_meta_options']['2'] == '1') { ?>
                                                <span class="post-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><i class="fa fa-clock-o"></i> <?php the_time(get_option( 'date_format' )); ?></time></span>
                                            <?php } ?>
                                            <?php if($bpxl_travelista_options['bpxl_post_meta_options']['5'] == '1') { ?>
                                                <span class="post-comments"><i class="fa fa-comments-o"></i> <?php comments_number( __( 'No Comments Yet','bloompixel' ), __( '1 Comments','bloompixel' ), __( '% Comments','bloompixel' ) ); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div><!--.center-width-->
                        </a>
                    </li>
                    <?php
                    endwhile;
                    endif;
                } elseif ( $bpxl_travelista_options['bpxl_slider_type'] == 'custom_slides' ) {
                    $bpxl_slides_array = $bpxl_travelista_options['bpxl_custom_slidess'];
                        foreach ($bpxl_slides_array as $value) { ?>
                            <li>
                                <?php
                                    if ( !empty($value['url'])) { ?>
                                        <a href="<?php echo $value['url']; ?>" class="featured-thumbnail f-thumb">
                                            <img src="<?php echo $value['image']; ?>">
                                                <div class="post-inner">
                                                    <div class="slider-inner">
                                                        <header>
                                                        <?php if($value['url'] != '') {
                                                            echo '<h2 class="title f-title title24">'. $value['title'] . '</h2>';
                                                        } else {
                                                            if($value['title'] != '') { ?>
                                                            <h2 class="title f-title title24"><?php echo $value['title']; ?></h2>
                                                        <?php } } ?>
                                                        </header><!--.header-->
                                                        <?php if($value['description'] != '') { ?>
                                                            <div class="slider-desc"><?php echo do_shortcode($value['description']); ?></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                        </a>
                                    <?php } else { ?>
                                        <img src="<?php echo $value['image']; ?>">
                                            <div class="post-inner">
                                                <div class="slider-inner">
                                                    <header>
                                                        <?php if($value['url'] != '') {
                                                            echo '<h2 class="title f-title title24">'. $value['title'] . '</h2>';
                                                        } else {
                                                        if($value['title'] != '') { ?>
                                                            <h2 class="title f-title title24"><?php echo $value['title']; ?></h2>
                                                        <?php } } ?>
                                                    </header><!--.header-->
                                                    <?php if($value['description'] != '') { ?>
                                                        <div class="slider-desc"><?php echo do_shortcode($value['description']); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                    <?php }
                                ?>
                            </li>
                        <?php }
                }  elseif ( $bpxl_travelista_options['bpxl_slider_type'] == 'sel_posts' ) {

                    $bpxl_slider_posts = $bpxl_travelista_options['bpxl_slider_posts'];

                    $featured_posts = new WP_Query( array( 'post_type' => 'post', 'post__in' => $bpxl_slider_posts, 'ignore_sticky_posts' => 1 ) );

                    if($featured_posts->have_posts()) : while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail f-thumb">
                            <?php if ( has_post_thumbnail() ) {
                                    the_post_thumbnail('slider');
                                } else {
                                    echo '<img alt="Featured Image" src="' . esc_url( get_stylesheet_directory_uri() ) . '/images/1170x500.png" width="1170"/>';
                                } ?>
                            <div class="center-width clearfix">
                                <div class="post-inner">
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
                                            <h2 class="title f-title title24">
                                                <?php the_title(); ?>
                                            </h2>
                                        </header><!--.header-->
                                        <div class="slider-meta post-meta">
                                            <?php if($bpxl_travelista_options['bpxl_post_meta_options']['2'] == '1') { ?>
                                                <span class="post-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><i class="fa fa-clock-o"></i> <?php the_time(get_option( 'date_format' )); ?></time></span>
                                            <?php } ?>
                                            <?php if($bpxl_travelista_options['bpxl_post_meta_options']['5'] == '1') { ?>
                                                <span class="post-comments"><i class="fa fa-comments-o"></i> <?php comments_number( __( 'No Comments Yet','bloompixel' ), __( '1 Comments','bloompixel' ), __( '% Comments','bloompixel' ) ); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div><!--.center-width-->
                        </a>
                    </li>
                    <?php
                    endwhile;
                    endif;
                } ?>
        </ul>
    </div><!--.featuredslider-->
</div><!--.featuredslider-->