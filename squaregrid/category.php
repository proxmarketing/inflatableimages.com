<?php
global $blogConf, $permalink, $is_category;
$permalink = false;
$is_category = true;

get_template_part('single', 'config');
$blogConf['title'] = __("Category", "themeton") . " : " . single_cat_title("", false);?>

<?php get_header();?>

<?php get_template_part('content', 'main');?>

<?php get_footer();?>