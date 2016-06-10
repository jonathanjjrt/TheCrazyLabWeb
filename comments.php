<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage travelista
 * @since Travelista 1.0
 */
 
	// Do not delete these lines
	if ( post_password_required() ) {
		return;
	}

	if ( have_comments() ) : ?>
		<div id="comments" class="comments-area single-box clearfix">
			<h3 class="comments-count section-heading uppercase"><span><?php comments_number(__('No Comments','bloompixel'), __( '1 Comment', 'bloompixel' ), __( '% Comments', 'bloompixel' ) );?></span></h3>
			<?php	
				if (get_option('page_comments')) {
					$comment_pages = paginate_comments_links('echo=0');
					if($comment_pages){
					 echo '<div class="commentnavi pagination">'.$comment_pages.'</div>';
					}
				}
			?>
			<ol class="commentlist">
				<?php
					wp_list_comments( array(
						'callback'      => 'bpxl_comment',
						'type'      => 'comment',
						'short_ping' => true,
						'avatar_size'=> 60,
					) );
				?>
				<?php
					wp_list_comments( array(
						'type'      => 'pingback',
						'short_ping' => true,
						'avatar_size'=> 60,
					) );
				?>
			</ol>
			<?php	
				if (get_option('page_comments')) {
					$comment_pages = paginate_comments_links('echo=0');
					if($comment_pages){
					 echo '<div class="commentnavi pagination">'.$comment_pages.'</div>';
					}
				}
			?>
		</div><!-- #comments -->

	<?php else : // this is displayed if there are no comments so far

	if ('open' == $post->comment_status) :
		// If comments are open, but there are no comments.

	else : // comments are closed
		// If comments are closed.
		
	endif;
	endif;
	global $aria_req; $comments_args = array(
		// remove "Text or HTML to be displayed after the set of comment fields"
		'title_reply'=>'<h4 class="section-heading uppercase"><span>'.__('Leave a Reply','bloompixel').'</span></h4>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => $fields =  array(
			  'author' =>
				'<p class="comment-form-author"><label for="author">' . __( 'Name ', 'bloompixel' ) .
				( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="19"' . $aria_req . ' /></p>',

			  'email' =>
				'<p class="comment-form-email"><label for="email">' . __( 'Email ', 'bloompixel' ) . 
				( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="19"' . $aria_req . ' /></p>',

			  'url' =>
				'<p class="comment-form-url"><label for="url">' . __( 'Website', 'bloompixel' ) . '</label>' .
				'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				'" size="19" /></p>',
			),
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __( 'Comments ', 'bloompixel' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'label_submit' => __( 'Submit ', 'bloompixel' ),
	);
	
	comment_form($comments_args);
	?>