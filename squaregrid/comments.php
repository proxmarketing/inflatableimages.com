<?php
global $blogConf, $data, $user_identity;

// Do not delete these lines
if (comments_open ())
    if (isset($data['facebook_comment'])&&$data['facebook_comment']) {
?>

    <div id="fb-root"></div>
    <fb:comments migrated="1" data-href="<?php the_permalink(); ?>" xid="<?php the_ID();?>" numposts="<?php echo isset($data['comment_perpage'])?$data['comment_perpage']:"4"; ?>" width="440" publish_feed="true"></fb:comments>


<?php } else {
 ?>
        <div id="comments" class="comment-box">
    <?php
        if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
            die('Please do not load this page directly. Thanks!');

        if (post_password_required ()) {
    ?>
            <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'themeton'); ?></p>
    <?php
            return;
        }
    ?>

        <!-- You can start editing here. -->
                
    <?php if (have_comments ()) : ?>
            <h3 class="comment-box-title"><?php printf(_n(__('One Response to', 'themeton') . ' %2$s', '%1$s ' . __('Responses to', 'themeton') . ' %2$s', get_comments_number()),
                    number_format_i18n(get_comments_number()), '&#8220;' . get_the_title() . '&#8221;'); ?></h3>

        <div class="comment-list">
        <?php wp_list_comments(array('style' => '', 'callback' => 'mytheme_comment')); ?>
        </div><!-- post-comments -->

        <div class="navigation">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </div>
    <?php else : // this is displayed if there are no comments so far  ?>

    <?php if (comments_open ()) : ?>
                    <!-- If comments are open, but there are no comments. -->

    <?php else : // comments are closed  ?>

    <?php endif; ?>
    <?php endif; ?>


    <?php if (comments_open ()) : ?>

                            <div id="comments-form" class="comments">

                                <h3 id="reply-title"><?php comment_form_title(__('Leave a Reply', 'themeton'), __('Leave a Reply to %s', 'themeton')); ?></h3>

                                <div id="cancel-comment-reply">
                                    <small><?php cancel_comment_reply_link() ?></small>
                                </div>

        <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                                <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'themeton'), wp_login_url(get_permalink())); ?></p>
        <?php else : ?>
                                    <form class="cmxform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
            <?php if (is_user_logged_in ()) : ?>
                                        <p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'themeton'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'themeton'); ?>"><?php _e('Log out &raquo;', 'themeton'); ?></a></p>
            <?php else : ?>
                                            <div class="overlabel-wrapper">
                                                <input type="text" name="author" id="author" class="textInput required" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req)
                                                echo "aria-required='true'"; ?> />
                                     <label for="author" class="overlabel"><?php _e('Name', 'themeton'); ?> (*)</label>
                                 </div>

                                 <div class="overlabel-wrapper">
                                     <input type="text" name="email" id="email" class="textInput required email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req)
                                                echo "aria-required='true'"; ?> />
                                     <label for="email" class="overlabel"><?php _e('Email', 'themeton'); ?> (*)</label>
                                 </div>

                                 <div class="overlabel-wrapper">
                                     <input type="text" name="url" id="url" class="textInput" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
                                     <label for="url" class="overlabel"><?php _e('Website', 'themeton'); ?></label>
                                 </div>

            <?php endif; ?>

                                            <div class="comment-form-comment">
                                                <textarea name="comment" id="comment" class="textInput required" cols="45" rows="8" tabindex="4"></textarea>
                                                <label for="comment" class="overlabel"><?php _e('Comment', 'themeton'); ?> (*)</label>
                                            </div>

                                            <div class="form-submit">
                                                <input name="submit" type="submit" id="submit" class="button" tabindex="5" value="<?php _e('Submit Comment', 'themeton'); ?>" />
                                                <label id="loader" style="display:none;"><img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="Loading..." id="LoadingGraphic" /></label>
                                                <p id="Note" style="display:none"></p>
                <?php comment_id_fields(); ?>
                                        </div>
            <?php do_action('comment_form', $post->ID); ?>
                                            <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
                                        </form>

        <?php endif; // If registration required and not logged in  ?>
                                        </div><!-- comment-box -->

    <?php endif; // if you delete this the sky will fall on your head  ?>
                                        </div>
<?php } ?>