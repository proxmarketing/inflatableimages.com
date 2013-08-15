<?php
global $blogConf, $permalink, $is_search;
$permalink = false;
$is_search = true;

get_template_part('single','config');

$blogConf['title'] = __('Nothing found', 'themeton');
if (have_posts ()){
    $blogConf['title'] = __('Search result for', 'themeton') . ' : ' . '<span>' . get_search_query() . '</span>';
}?>

<?php get_header();?>

<?php get_template_part('content', 'main');?>

<?php get_footer();?>