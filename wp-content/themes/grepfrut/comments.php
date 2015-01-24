<?php
/**
 * The template for displaying Comments.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */

/*
 * If the current post is password protected and the visitor has not yet
 * entered password, will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
    <h3 class="comments-title"><?php printf( _nx( 'Comments ( %2$s )', 'Comments ( %1$s )', get_comments_number(), 'tcsn_theme' ), 
	 	number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></h3>
    <ul class="comment-list">
        <?php
			wp_list_comments( array(
				'style'       => 'ul',
				'short_ping'  => true,
				'avatar_size' => 58,
				'callback'    => 'tcsn_comment',
			) );
			?>
    </ul>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav class="navigation comment-navigation" role="navigation"> 
        <!--<h1 class="screen-reader-text section-heading">
            <?php // _e( 'Comment navigation', 'tcsn_theme' ); ?>
        </h1>-->
        <ul class="pager">
            <li class="previous">
                <?php previous_comments_link( __( '<div class="prev-arrow"></div> Older Comments', 'tcsn_theme' ) ); ?>
            </li>
            <li class="next">
                <?php next_comments_link( __( 'Newer Comments <div class="next-arrow"></div>', 'tcsn_theme' ) ); ?>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
    <?php if ( ! comments_open() && get_comments_number() ) : ?>
    <p class="no-comments">
        <?php _e( 'Comments are closed.' , 'tcsn_theme' ); ?>
    </p>
    <?php endif; ?>
    <?php endif; ?>
    <!-- comment form -->
    <?php if ( comments_open() ) : ?>
    <?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		'author' =>
		'<p class="comment-form-author"><label for="author">' . __( 'Name', 'tcsn_theme' ) . '</label> ' .
		'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		'" size="30"' . $aria_req . ' placeholder="Name (required)"/></p>',
    	'email' =>
		'<p class="comment-form-email"><label for="email">' . __( 'Email', 'tcsn_theme' ) . '</label> ' .
		'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		'" size="30"' . $aria_req . ' placeholder="Email (required)"/></p>',
		'url' =>
		'<p class="comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
		'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		'" size="30" placeholder="Website"/></p>',
	);

	$comments_args = array(
		'fields' => $fields,
				'title_reply'       => __( 'Leave a Reply', 'tcsn_theme' ),
				'label_submit' => __('Post comment','tcsn_theme'),
				'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'tcsn_theme' ) .
		'</label><textarea id="comment" name="comment" cols="45" rows="6" aria-required="true" placeholder="Comment here">' .
		'</textarea></p>',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
		);
	comment_form($comments_args); ?>
    <?php endif; ?>
</div>
<!-- #comments -->