<?php 

function UGD_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	} ?>

	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>

	<div class="comment-author vcard">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
		<br />
	<?php endif; ?>

	<div class="comment-meta commentmetadata">
		<small class="small">
			<div class="comment-date grey-text">
				<?php /* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?>
			</div>
			<div class="comment-controls">
				<div class="edit-comment">
					<?php edit_comment_link( __( 'Edit' ), '  ', '' ); ?>
				</div>
				<div class="reply-comment">
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
			</div>
		</small>
	</div>
	
	<div class="comment-content">
		<?php comment_text(); ?>
	</div>
	
	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
<?php
}

add_filter('comment_form_field_comment', 'UGD_comment_field_erase');
function UGD_comment_field_erase( $comment_field ) {
	if ( !is_user_logged_in() ) {
		$comment_field = "";
	}
	return $comment_field;
}

add_action('comment_form_after_fields', 'UGD_comment_fields');
function UGD_comment_fields() {
	if ( !is_user_logged_in() ) {
		echo '<div class="form-group comment-form-comment">' . 
			'<label for="comment">' . __( 'Your comment', 'UGD' ) . '</label>' .
			'<textarea class="form-control black-text" id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
		    '</textarea></div>';
	}
}

?>