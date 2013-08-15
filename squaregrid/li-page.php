<?php

/*

 * template name: Lawn Inflatables page

 */

global $post, $blogConf, $permalink, $is_blog;

ajax_get_post_by();

get_template_part('single', 'config');

$blogConf['title'] = $post->post_title;?>



<?php get_header();?>



<br /><br /><br />

<div style="margin:0 auto; width:80%; overflow:hidden; display:block;">

<div style="float:left; margin:0; width:60%; padding:20px;">



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

               <div class="post" id="post-<?php the_ID(); ?>">

               <h2 class="sub"><?php the_title(); ?></h2>

               <div class="entry sub">

                    <?php the_content(); ?>

               </div>

          </div>

          <?php endwhile; endif; ?>









</div>

<div style="float:left; margin:0; width:30%; height:auto;">

<?php if ( function_exists('yoast_breadcrumb') ) {

yoast_breadcrumb('<p id="breadcrumbs">','</p>');

} ?>

<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'side-nav', 'theme_location' => 'lawn') ); ?>

</div>

</div>

<?php get_footer();?>