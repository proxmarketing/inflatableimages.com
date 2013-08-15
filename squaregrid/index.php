<?php global $blogConf, $permalink;
$permalink = false; 
ajax_get_post_by(); ?>

<?php get_header();?>

<?php get_template_part('content', 'main');?>

<?php get_footer();?>