<?php
/*
 * @package themeton
 */
global $permalink, $blogConf, $is_home, $is_blog, $is_page, $data;
$permalink = true;
$is_home = false;
$is_blog = false;
if (isset($_REQUEST['single']) && $_REQUEST['single'] == "single") {
    ///////////////////////// PORTFOLIO SINGLE //////////////////
    if (have_posts()) {
        the_post();
        get_template_part('single', 'config');?>
            <?php $blogConf['hide_image'] ? '' : get_template_part('post', 'featuredimage'); ?>
        <h2 class="entry-title"><?php the_title(); ?></h2>
            <?php get_template_part('post', 'socials'); ?>
        <div class="entry-content" <?php print $blogConf['hide_image'] ? 'style="height:412px;"' : ''; ?>>
            <div class="entry_touch" <?php print $blogConf['hide_image'] ? 'style="height:412px;"' : ''; ?>>
                <div>
            <?php the_content(); ?>
           
                </div>
                
            </div>
        </div><?php
        die();
    }
} elseif (isset($_REQUEST['single']) && $_REQUEST['single'] == "blog_single") {
    ///////////////////////// BLOG SINGLE ////////////////////////
    $is_blog = true;
    if (have_posts()) {
        the_post();
        get_template_part('single', 'config');?>
            <?php $blogConf['hide_image'] ? '' : get_template_part('post', 'featuredimage'); ?>

        <h2 class="entry-title"><?php the_title(); ?> - <strong align="center">(Click image to enlarge.)</strong></h2>
            <?php get_template_part('post', 'socials'); ?>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php get_template_part('post', 'edit'); ?>
        
        </div><?php
        die();
    }
}elseif (isset($_REQUEST['replytocom'])) {
    ///////////////////////// COMMENT - REFLY ////////////////////////
    if (have_posts()) {
        the_post();
        comments_template('', true);
    }
    die();
} else {
    get_template_part('index');
} ?>