<?php
// Check if comments are allowed
if (comments_open()) :
    ?>
    <div id="comments" class="contact-form-box mb-50 tp-contact-form">
        <?php
        // Display the comments list
        if (have_comments()) :
            ?>
            <div class="tp-blog-comments mb-75">
                <h3 class="tp-blog-comments-title mb-30">
                    <?php
                    $comment_count = get_comments_number();
                    echo esc_html($comment_count) . ' ' . _n('Comment', 'Comments', $comment_count, 'mindu');
                    ?>
                </h3>
                <div class="tp-blog-comments-main">
                    <ul class="postbox__comment mb-100">
                        <?php
                        wp_list_comments(array(
                            'style'       => 'ul',
                            'short_ping'  => true,
                            'callback' => 'custom_comment_list'
                        ));
                        ?>
                    </ul>
                </div>
            </div>


            <?php
            // Display comment pagination if needed
            the_comments_pagination(array(
                'prev_text' => esc_html__('Previous', 'mindu'),
                'next_text' => esc_html__('Next', 'mindu'),
            ));
        endif;
        
        if ( is_user_logged_in() ) {
            $cl = 'loginformuser';
        } else {
            $cl = '';
        }

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');

        $fields = array(
            'author' => '<div class="row gx-20"><div class="col-lg-4"><input class="tp-input" type="text" name="author"  placeholder="' . esc_attr__('Your name', 'mindu') . '" value="' . esc_attr($commenter['comment_author']) . '" ' . ($req ? 'required' : '') . '>
            </div>',
            'email' => '<div class="col-lg-4"><input class="tp-input" type="email" name="email" placeholder="' . esc_attr__('Email address', 'mindu') . '" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($req ? 'required' : '') . '>
           </div>',
            'url' => '<div class="col-lg-4"><input class="tp-input" type="text" name="url" id="url" placeholder="' . esc_attr__('Website', 'mindu') . '" value="' . esc_attr($commenter['comment_author_url']) . '">
         </div> </div>',
        );


        $defaults = [
            'fields'             => $fields,
            'comment_field' => '<div class="col-12' . $cl . '"><textarea class="tp-input tp-textarea" name="comment" placeholder="' . esc_attr__('Your comment', 'mindu') . '" required></textarea>
                </div>
            ',
            'submit_button' => '<div class="col-12">
                                <button type="submit" class="tp-contact-btn tp-contact-btn-xl">
                                    ' . esc_html__('Post Comment', 'mindu') . '
                                    </button>
                                </div>',

            'cookies' => '<div class="col-xxl-12 mb-30">
                <div class="tp-contact-remember mb-30">' .
                '<input class="tp-checkbox tp-form-label" id="remeber" type="checkbox" name="wp-comment-agree" value="1" checked>' .
                '<label class="e-check-label" for="remeber">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'mindu') . '</label></div></div>'
        ];
        // Display the comment form
        comment_form($defaults);
        ?>
    </div><!-- .comments-area -->
<?php endif; ?>


<?php
// Move the comment textarea to the bottom
function move_comment_textarea_to_bottom($fields) {
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    return $fields;
}

add_action('comment_form_fields', 'move_comment_textarea_to_bottom');
// comments for end 


// custom_comment_list
function custom_comment_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') {
        // Display pingbacks and trackbacks differently if needed
        ?>
        <li class="pingback">
            <p><?php esc_html_e('Pingback:', 'mindu'); ?> <?php comment_author_link(); ?></p>
        </li>
        <?php
    } else {
        // Display regular comments
        ?>
        <li <?php comment_class('comment'); ?> id="comment-<?php comment_ID(); ?>">

            <div class="postbox-comment-box d-flex">
                <div class="postbox-comment-info">
                    <div class="postbox-comment-avater mr-20">
                        <?php echo get_avatar($comment, 50); ?>
                    </div>  
                </div>
                <div class="postbox-comment-text">
                    <div class="postbox-comment-name">
                        <h2><?php comment_author(); ?></h2>
                        <span class="post-meta"><?php comment_date(); ?></span>
                    </div>
                    <div class="fw-500 mb-25"><?php comment_text(); ?></div>
                    <div class="postbox-comment-reply">
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div>
                </div>
            </div>
                  
        <?php
    }
}
