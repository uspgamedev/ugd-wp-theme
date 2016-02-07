<?php if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) return; ?>
<section id="comments">
	<?php if ( have_comments() ) : 
		global $comments_by_type;
		$comments_by_type = &separate_comments( $comments );
		if ( ! empty( $comments_by_type['comment'] ) ) : ?>
			<section id="comments-list" class="comments">
				<h3 class="comments-title">
					<?php

					comments_number(
						'No comments',
						'Comments (1)',
						'Comments (%)'
					);

					?>
				</h3>
				<?php if ( get_comment_pages_count() > 1 ) : ?>
					<nav id="comments-nav-above" class="comments-navigation" role="navigation">
						<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
					</nav>
				<?php endif; ?>
				<ul class="list-unstyled">
					<?php wp_list_comments( 'type=comment&callback=UGD_comment' ); ?>
				</ul>

				<?php if ( get_comment_pages_count() > 1 ) : ?>
					<nav id="comments-nav-below" class="comments-navigation" role="navigation">
						<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
					</nav>
				<?php endif; ?>

			</section>
		<?php endif; ?>
		
	<?php endif; ?>

	<?php
	$fields =  array(
	  	'author' =>
		    '<div class="form-group comment-form-author"><label for="author">' . __( 'Name', 'UGD' ) . '</label> ' .
		    ( $req ? '<span class="required">*</span>' : '' ) .
		    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		    '" size="30"' . $aria_req . ' /></div>',

	  	'email' =>
		    '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'UGD' ) . '</label> ' .
		    ( $req ? '<span class="required">*</span>' : '' ) .
		    '<input class="form-control"  id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		    '" size="30"' . $aria_req . ' /></div>',

	  	'url' =>
		    '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'UGD' ) . '</label>' .
		    '<input class="form-control"  id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		    '" size="30" /></div>',
	);
	$comment_form_args = array(
		'class_submit' => 'btn white bold black-text',
		'title_reply'       => __( 'Leave a Comment' ),
  		'title_reply_to'    => __( 'Leave a Reply to %s' ),
  		
  		'comment_field' =>  '<div class="form-group comment-form-comment">' . 
			'<label for="comment">' . __( 'Your comment', 'UGD' ) . '</label>' .
			'<textarea class="form-control black-text" id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
		    '</textarea></div>',

		'fields' => apply_filters( 'comment_form_default_fields', $fields ),

		'must_log_in' => '<div class="must-log-in">' .
		    sprintf(
		      __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
		      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		    ) . '</div>',

	  	'logged_in_as' => '<div class="logged-in-as">' .
		    sprintf(
		    __( '<div class="logged-user">Logged in as <a class="greenlue-text" href="%1$s">%2$s</a>.</div><a class="logout-user greenlue-text" href="%3$s" title="Log out of this account">[ Log out ]</a>' ),
		      admin_url( 'profile.php' ),
		      $user_identity,
		      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
		    ) . '</div>',

	  	'comment_notes_before' => '<div class="comment-notes small">' .
		    __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
		    '</div>'

	);
	if ( comments_open() ) comment_form( $comment_form_args ); ?>
</section>










