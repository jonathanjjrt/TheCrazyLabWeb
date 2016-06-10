<?php
/**
 * Custom template tags for Travelista
 *
 * @package WordPress
 * @subpackage travelista
 * @since Travelista 1.0
 */

/*-----------------------------------------------------------------------------------*/
/*	Post and Header Classes
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'bpxl_masonry_class' ) ) :
	function bpxl_masonry_class() {
		global $bpxl_travelista_options;
		
		$bpxl_class_mason = '';
		
		if( is_home() || is_front_page() || is_search() ) {
			if($bpxl_travelista_options['bpxl_layout'] == 'clayout' || $bpxl_travelista_options['bpxl_layout'] == 'gslayout' || $bpxl_travelista_options['bpxl_layout'] == 'sglayout' || $bpxl_travelista_options['bpxl_layout'] == 'glayout') {
				$bpxl_class_mason = 'masonry';
			}
		}
		elseif(is_archive() || is_author()) {
			if($bpxl_travelista_options['bpxl_archive_layout'] == 'clayout' || $bpxl_travelista_options['bpxl_archive_layout'] == 'gslayout' || $bpxl_travelista_options['bpxl_archive_layout'] == 'sglayout' || $bpxl_travelista_options['bpxl_archive_layout'] == 'glayout') {
				$bpxl_class_mason = 'masonry';
			}
		}
		elseif( is_single() || is_page() ) {

		}
		
		echo $bpxl_class_mason;
	}
endif;

if ( ! function_exists( 'bpxl_layout_class' ) ) :
	function bpxl_layout_class() {
		global $bpxl_travelista_options;
		
		$bpxl_class = '';
		
		if( is_home() || is_front_page() || is_search() || is_404() ) {
			if($bpxl_travelista_options['bpxl_layout'] == 'clayout' || $bpxl_travelista_options['bpxl_layout'] == 'gslayout' || $bpxl_travelista_options['bpxl_layout'] == 'sglayout' || $bpxl_travelista_options['bpxl_layout'] == 'glayout') {
				$bpxl_class = 'masonry-home ' . $bpxl_travelista_options['bpxl_layout'];
			} else {
				$bpxl_class = $bpxl_travelista_options['bpxl_layout'];
			}
		}
		elseif(is_archive() || is_author()) {
			if($bpxl_travelista_options['bpxl_archive_layout'] == 'clayout' || $bpxl_travelista_options['bpxl_archive_layout'] == 'gslayout' || $bpxl_travelista_options['bpxl_archive_layout'] == 'sglayout' || $bpxl_travelista_options['bpxl_archive_layout'] == 'glayout') {
				$bpxl_class = 'masonry-archive ' . $bpxl_travelista_options['bpxl_archive_layout'];
			} else {
				$bpxl_class = $bpxl_travelista_options['bpxl_archive_layout'];
			}
		}
		elseif( is_single() || is_page() || is_page_template('template-archive.php') ) {
			$bpxl_class = $bpxl_travelista_options['bpxl_single_layout'];
		}
		
		echo $bpxl_class;
	}
endif;

if ( ! function_exists( 'bpxl_header_class' ) ) :
	function bpxl_header_class() {
		global $bpxl_travelista_options;
		
		$bpxl_header_class = '';
		
		if ($bpxl_travelista_options['bpxl_header_style'] == 'header_two') { $bpxl_header_class = 'header-two'; }
		
		echo $bpxl_header_class;
	}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Add Span tag Around Categories and Archives Post Count
/*-----------------------------------------------------------------------------------*/
if(!function_exists('bpxl_cat_count')){ 
	function bpxl_cat_count($links) {
		return str_replace(array('</a> (',')'), array('<span class="cat-count">','</span></a>'), $links);
	}
}
add_filter('wp_list_categories', 'bpxl_cat_count');

if(!function_exists('bpxl_archive_count')){ 
	function bpxl_archive_count($links) {
	  	return str_replace(array('</a>&nbsp;(',')'), array('<span class="cat-count">','</span></a>'), $links);
	}
}
add_filter('get_archives_link', 'bpxl_archive_count');

/*-----------------------------------------------------------------------------------*/
/*	Modify <!--more--> Tag in Posts
/*-----------------------------------------------------------------------------------*/
// Prevent Page Scroll When Clicking the More Link
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'bpxl_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Travelista 1.0
 */
function bpxl_paging_nav() {
	global $bpxl_travelista_options;
	
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => ( '&larr; ' ) . __( 'Previous', 'bloompixel' ),
		'next_text' => __( 'Next', 'bloompixel' ) . ' &rarr;',
	) );
	if ($bpxl_travelista_options['bpxl_pagination_type'] == '1') :
		if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<div class="pagination loop-pagination">
				<?php echo $links; ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	else:
	?>
		<nav class="norm-pagination" role="navigation">
			<div class="nav-previous"><?php next_posts_link( '&larr; ' . __( 'Older posts', 'bloompixel' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'bloompixel' ).' &rarr;' ); ?></div>
		</nav>
	<?php
	endif;
}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Post Navigation
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'bpxl_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Travelista 1.0
 */
function bpxl_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation single-box clearfix" role="navigation">
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				next_post_link('<div class="alignleft post-nav-links prev-link-wrapper"><div class="next-link"><span class="uppercase">'. __("Published In","bloompixel") .'</span> %link'."</div></div>");
			else :
				previous_post_link('<div class="alignleft post-nav-links prev-link-wrapper"><div class="prev-link"><span class="uppercase">'. __("Previous Article","bloompixel").'</span> %link'."</div></div>");
				next_post_link('<div class="alignright post-nav-links next-link-wrapper"><div class="next-link"><span class="uppercase">'. __("Next Article","bloompixel") .'</span> %link'."</div></div>");
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Track Post Views
/*-----------------------------------------------------------------------------------*/
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return __('0 View','bloompixel');
    }
    return $count.' '.__('Views','bloompixel');
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Facebook Open Graph Data
/*-----------------------------------------------------------------------------------*/
if ($bpxl_travelista_options['bpxl_fb_og'] == '1') {
	//Adding the Open Graph in the Language Attributes
	function add_opengraph_doctype( $output ) {
		return $output . ' prefix="og: http://ogp.me/ns#"';
	}
	add_filter('language_attributes', 'add_opengraph_doctype');

	// Add Facebook Open Graph Tags
	function fb_og_tags() {
	    global $bpxl_travelista_options;
		global $post;
		
		if ( have_posts() ):while(have_posts()):the_post(); endwhile; endif;
			
		if ( is_single() || is_page() ){
			
			if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
				$thumbnail_id = get_post_thumbnail_id($post->ID);
				$thumbnail_object = get_post($thumbnail_id);
				$image = $thumbnail_object->guid;
			} else {	
				$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
			}
			
			echo '<meta property="og:title" content="' . get_the_title() . '"/>';
			echo '<meta property="og:url" content="' . get_permalink() . '"/>';
			echo '<meta property="og:type" content="article" />';
			echo '<meta property="og:description" content="' . strip_tags(get_the_excerpt()) . '" />';
			if (!empty($image)) {
				echo '<meta property="og:image" content="' . $image . '" />';
			}
			
		} elseif( is_home() ){
			if (!empty($bpxl_travelista_options['bpxl_logo']['url'])) {
				$image = $bpxl_travelista_options['bpxl_logo']['url'];
			} else {	
				$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
			}
			echo '<meta property="og:title" content="' . get_bloginfo('name') . ' - ' . get_bloginfo('description') . '"/>';
			echo '<meta property="og:url" content="' . home_url() . '"/>';
			if (!empty($image)) {
				echo '<meta property="og:image" content="' . $image . '" />';
			}
			echo '<meta property="og:type" content="website" />';
		}
		
		echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '" />';
	}
	add_action( 'wp_head', 'fb_og_tags', 5 );
}

/*-----------------------------------------------------------------------------------*/
/*	Social Links
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'bpxl_social_links' ) ) :

function bpxl_social_links( $social_links_pos ) {
	global $bpxl_travelista_options;
	if ($bpxl_travelista_options['bpxl_social_links'] == '1' || $bpxl_travelista_options['bpxl_footer_social_links'] == '1') {
		
		if ($social_links_pos == 'header') { ?>
			<div class="social-links header-links"><?php
			$bpxl_social_link_array = $bpxl_travelista_options['bpxl_social_links_sort'];
		} else { ?>
			<div class="social-links footer-links"><?php
			$bpxl_social_link_array = $bpxl_travelista_options['bpxl_social_links_footer_sort'];
		}

		foreach ($bpxl_social_link_array as $key=>$value) {
			//echo "<span>$value</span> <br>";	  
			if($key == "fb" && $value == "1") { ?>
				<!-- Facebook -->
				<?php if ($bpxl_travelista_options['bpxl_facebook'] != '') { ?><a class="facebook" href="<?php echo esc_url($bpxl_travelista_options['bpxl_facebook']); ?>" target="_blank"><i class="fa fa-facebook" ></i> <span><?php _e('Facebook','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "twitter" && $value == "1") { ?>
				<!-- Twitter -->
				<?php if ($bpxl_travelista_options['bpxl_twitter'] != '') { ?><a class="twitter" href="<?php echo esc_url($bpxl_travelista_options['bpxl_twitter']); ?>" target="_blank"><i class="fa fa-twitter" ></i> <span><?php _e('Twitter','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "gplus" && $value == "1") { ?>
				<!-- Google+ -->
				<?php if ($bpxl_travelista_options['bpxl_googleplus'] != '') { ?><a class="gplus" href="<?php echo esc_url($bpxl_travelista_options['bpxl_googleplus']); ?>" target="_blank"><i class="fa fa-google-plus" ></i> <span><?php _e('Google+','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "pinterest" && $value == "1") { ?>
				<!-- Pinterest -->
				<?php if ($bpxl_travelista_options['bpxl_pinterest'] != '') { ?><a class="pinterest" href="<?php echo esc_url($bpxl_travelista_options['bpxl_pinterest']); ?>" target="_blank"><i class="fa fa-pinterest" ></i> <span><?php _e('Pinterest','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "linkedin" && $value == "1") { ?>
				<!-- LinkedIn -->
				<?php if ($bpxl_travelista_options['bpxl_linked'] != '') { ?><a class="linkedin" href="<?php echo esc_url($bpxl_travelista_options['bpxl_linked']); ?>" target="_blank"><i class="fa fa-linkedin" ></i> <span><?php _e('Linkedin','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "youtube" && $value == "1") { ?>
				<!-- YouTube -->
				<?php if ($bpxl_travelista_options['bpxl_youtube'] != '') { ?><a class="youtube" href="<?php echo esc_url($bpxl_travelista_options['bpxl_youtube']); ?>" target="_blank"><i class="fa fa-youtube-play" ></i> <span><?php _e('Youtube','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "instagram" && $value == "1") { ?>
				<!-- Instagram -->
				<?php if ($bpxl_travelista_options['bpxl_instagram'] != '') { ?><a class="instagram" href="<?php echo esc_url($bpxl_travelista_options['bpxl_instagram']); ?>" target="_blank"><i class="fa fa-instagram" ></i> <span><?php _e('Instagram','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "rss" && $value == "1") { ?>
				<!-- RSS -->
				<?php if ($bpxl_travelista_options['bpxl_rss'] != '') { ?><a class="rss" href="<?php echo esc_url($bpxl_travelista_options['bpxl_rss']); ?>" target="_blank"><i class="fa fa-rss" ></i> <span><?php _e('RSS','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "reddit" && $value == "1") { ?>
				<!-- Reddit -->
				<?php if ($bpxl_travelista_options['bpxl_reddit'] != '') { ?><a class="reddit" href="<?php echo esc_url($bpxl_travelista_options['bpxl_reddit']); ?>" target="_blank"><i class="fa fa-reddit" ></i> <span><?php _e('Reddit','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "tumblr" && $value == "1") { ?>
				<!-- Tumblr -->
				<?php if ($bpxl_travelista_options['bpxl_tumblr'] != '') { ?><a class="tumblr" href="<?php echo esc_url($bpxl_travelista_options['bpxl_tumblr']); ?>" target="_blank"><i class="fa fa-tumblr" ></i> <span><?php _e('Tumblr','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "flickr" && $value == "1") { ?>
				<!-- Flickr -->
				<?php if ($bpxl_travelista_options['bpxl_flickr'] != '') { ?><a class="flickr" href="<?php echo esc_url($bpxl_travelista_options['bpxl_flickr']); ?>" target="_blank"><i class="fa fa-flickr" ></i> <span><?php _e('Flickr','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "git" && $value == "1") { ?>
				<!-- GitHub -->
				<?php if ($bpxl_travelista_options['bpxl_git'] != '') { ?><a class="git" href="<?php echo esc_url($bpxl_travelista_options['bpxl_git']); ?>" target="_blank"><i class="fa fa-github" ></i> <span><?php _e('Github','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "dribbble" && $value == "1") { ?>
				<!-- Dribbble -->
				<?php if ($bpxl_travelista_options['bpxl_dribbble'] != '') { ?><a class="dribbble" href="<?php echo esc_url($bpxl_travelista_options['bpxl_dribbble']); ?>" target="_blank"><i class="fa fa-dribbble" ></i> <span><?php _e('Dribbble','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "vimeo" && $value == "1") { ?>
				<!-- Vimeo -->
				<?php if ($bpxl_travelista_options['bpxl_vimeo'] != '') { ?><a class="vimeo" href="<?php echo esc_url($bpxl_travelista_options['bpxl_vimeo']); ?>" target="_blank"><i class="fa fa-vimeo" ></i> <span><?php _e('Vimeo','bloompixel'); ?></span></a><?php } ?>
			<?php }
			elseif($key == "") {
				echo "";
			}
		} ?>
		</div>
	<?php }
}

endif;

/*-----------------------------------------------------------------------------------*/
/*	Add Extra Fields to User Profiles
/*-----------------------------------------------------------------------------------*/
add_action( 'show_user_profile', 'bpxl_user_profile_fields' );
add_action( 'edit_user_profile', 'bpxl_user_profile_fields' );

function bpxl_user_profile_fields( $user ) { ?>

<h3><?php _e("Author Page Settings", "bloompixel"); ?></h3>

<table class="form-table">
	<tr>
        <th><label for="user_meta_image"><?php _e( 'Cover Image', 'bloompixel' ); ?></label></th>
        <td>
        	<?php $bpxl_author_attachment = get_the_author_meta( 'author-attachment-url', $user->ID );
        	if ( !empty( $bpxl_author_attachment ) ) { ?>
        		<img class="author_bg_image" src="<?php echo esc_url( get_the_author_meta( 'author-attachment-url', $user->ID ) ); ?>" width="400" /><br />
        	<?php } else { ?>
        		<img class="hide author_bg_image" src="<?php echo esc_url( get_the_author_meta( 'author-attachment-url', $user->ID ) ); ?>" width="400" /><br />
        	<?php } ?>
            <input class="author-media-url regular-text" type="text" id="author-attachment-url" name="author-attachment-url" value="<?php echo esc_url( get_the_author_meta( 'author-attachment-url', $user->ID ) ); ?>">
            <input type='button' class="custom_media_upload button-primary" value="<?php _e( 'Upload Image', 'bloompixel' ); ?>" id="uploadimage"/>
            <input type='button' class="author-image-remove button-primary" value="<?php _e( 'Remove Image', 'bloompixel' ); ?>" id="removeimage"/><br />
            <span class="description"><?php _e( 'Upload cover image for your author page. This image will be displayed as background of author box on author page.', 'bloompixel' ); ?></span>
        </td>
    </tr>
	<tr>
		<th><label for="author-loc"><?php _e("Author Location","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="author-loc" id="author-loc" value="<?php echo esc_attr( get_the_author_meta( 'author-loc', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your location here.","bloompixel"); ?></span>
		</td>
	</tr>
</table>

<h3><?php _e("Social Profiles", "bloompixel"); ?></h3>

<table class="form-table">
	<tr>
		<th><label for="facebook"><?php _e("Facebook","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your facebook profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="twitter"><?php _e("Twitter","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your twitter profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="googleplus"><?php _e("Google+","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="googleplus" id="googleplus" value="<?php echo esc_attr( get_the_author_meta( 'googleplus', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your Google+ profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="linkedin"><?php _e("LinkedIn","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your LinkedIn profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="pinterest"><?php _e("Pinterest","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your Pinterest profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
	<tr>
		<th><label for="dribbble"><?php _e("Dribbble","bloompixel"); ?></label></th>
		<td>
		<input type="text" name="dribbble" id="dribbble" value="<?php echo esc_attr( get_the_author_meta( 'dribbble', $user->ID ) ); ?>" class="regular-text" /><br />
		<span class="description"><?php _e("Enter your Dribbble profile URL.","bloompixel"); ?></span>
		</td>
	</tr>
</table>
<?php }

add_action( 'personal_options_update', 'save_bpxl_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_bpxl_user_profile_fields' );

function save_bpxl_user_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

	update_user_meta( $user_id, 'author-attachment-url', $_POST['author-attachment-url'] );
	update_user_meta( $user_id, 'author-loc', $_POST['author-loc'] );
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'googleplus', $_POST['googleplus'] );
	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
	update_user_meta( $user_id, 'dribbble', $_POST['dribbble'] );
}

function load_wp_media_files() {
  wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );
