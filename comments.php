<?php
/**
 * The template for displaying comments
 *
 * @package Master_Pro
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area" style="margin-top: 3rem; padding-top: 3rem; border-top: 2px solid var(--color-border);">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title" style="margin-bottom: 2rem;">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('Ein Kommentar zu &ldquo;%1$s&rdquo;', 'master-therapy-pro'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    esc_html(_nx('%1$s Kommentar zu &ldquo;%2$s&rdquo;', '%1$s Kommentare zu &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'master-therapy-pro')),
                    number_format_i18n($comment_count),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list" style="list-style: none; padding: 0;">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
                'callback'    => 'master_comment_callback',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if (!comments_open()) :
            ?>
            <p class="no-comments" style="padding: 1.5rem; background: var(--color-background); border-radius: var(--radius-md); text-align: center;">
                <?php esc_html_e('Kommentare sind geschlossen.', 'master-therapy-pro'); ?>
            </p>
        <?php
        endif;

    endif;

    comment_form(array(
        'title_reply'         => __('Kommentar schreiben', 'master-therapy-pro'),
        'title_reply_to'      => __('Antwort auf %s', 'master-therapy-pro'),
        'cancel_reply_link'   => __('Antwort abbrechen', 'master-therapy-pro'),
        'label_submit'        => __('Kommentar absenden', 'master-therapy-pro'),
        'comment_field'       => '<p class="comment-form-comment"><label for="comment">' . _x('Kommentar', 'noun', 'master-therapy-pro') . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" style="width: 100%; padding: 0.75rem; border: 2px solid var(--color-border); border-radius: var(--radius-sm); font-family: var(--font-body); font-size: 1rem;"></textarea></p>',
        'class_submit'        => 'btn-primary',
    ));
    ?>

</div>

<?php
/**
 * Custom comment callback
 */
function master_comment_callback($comment, $args, $depth) {
    $tag = ('div' === $args['style']) ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> style="margin-bottom: 2rem; padding: 1.5rem; background: var(--color-background); border-radius: var(--radius-md);">
        
        <div style="display: flex; gap: 1rem;">
            <?php if (0 != $args['avatar_size']) : ?>
                <div style="flex-shrink: 0;">
                    <?php echo get_avatar($comment, $args['avatar_size'], '', '', array('style' => 'border-radius: 50%;')); ?>
                </div>
            <?php endif; ?>
            
            <div style="flex: 1;">
                <div class="comment-meta" style="margin-bottom: 1rem;">
                    <div class="comment-author vcard" style="font-weight: 600; color: var(--color-primary); margin-bottom: 0.25rem;">
                        <?php
                        printf('<span class="fn">%s</span>', get_comment_author_link($comment));
                        ?>
                    </div>
                    <div class="comment-metadata" style="font-size: 0.9rem; color: var(--color-text-light);">
                        <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>" style="color: inherit;">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php
                                printf(
                                    _x('%1$s um %2$s', '1: date, 2: time', 'master-therapy-pro'),
                                    get_comment_date('', $comment),
                                    get_comment_time()
                                );
                                ?>
                            </time>
                        </a>
                        <?php edit_comment_link(__('Bearbeiten', 'master-therapy-pro'), ' <span class="edit-link">', '</span>'); ?>
                    </div>
                </div>

                <?php if ('0' == $comment->comment_approved) : ?>
                    <em class="comment-awaiting-moderation" style="display: block; padding: 0.75rem; background: #fff3cd; border-radius: var(--radius-sm); margin-bottom: 1rem;">
                        <?php _e('Ihr Kommentar wartet auf Freigabe.', 'master-therapy-pro'); ?>
                    </em>
                <?php endif; ?>

                <div class="comment-content" style="line-height: 1.7; margin-bottom: 1rem;">
                    <?php comment_text(); ?>
                </div>

                <?php
                comment_reply_link(array_merge($args, array(
                    'add_below' => 'div-comment',
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '<div class="reply" style="margin-top: 1rem;">',
                    'after'     => '</div>',
                )));
                ?>
            </div>
        </div>
    <?php
}
