<?php
/*
 * template name:Home page
 */
global $post, $blogConf, $permalink, $is_blog;
ajax_get_post_by();
get_template_part('single', 'config');
$blogConf['title'] = $post->post_title;?>

<?php get_header();?>
<?php the_post();?>
<div class="row">
	<div class="sixteen columns">
	<?php the_content();?>
	</div>
</div>

<?php get_footer();?>