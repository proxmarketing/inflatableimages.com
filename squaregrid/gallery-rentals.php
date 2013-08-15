<?php

/*

 * template name: Gallery - Rentals

 */

global $post, $blogConf, $permalink, $is_blog;

$permalink = false;

$is_blog = true;

ajax_get_post_by();

get_template_part('single', 'config');

$blogConf['title'] = $post->post_title;?>



<?php get_header();?>

<br /><br /><br />

<div style="margin:0 auto; width:80%; overflow:hidden; display:block;">

<div style="float:left; margin:0; width:70%;">

<div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

               <div class="post" id="post-<?php the_ID(); ?>">

               <h2 class="sub"><?php the_title(); ?></h2>

               <div class="entry">

                    <?php the_content(); ?>

               </div>

          </div>

          <?php endwhile; endif; ?>

</div>



<?php get_template_part('content', 'main');?>

</div>

<div style="float:left; margin:0; width:30%; height:auto;">

<?php if ( function_exists('yoast_breadcrumb') ) {

yoast_breadcrumb('<p id="breadcrumbs">','</p>');

} ?>

<ul class="side-nav">

<li class="active"><a href="http://0prx9.com/ii/inflatable-rentals/">Rentals</a></li>

<li><a href="http://0prx9.com/ii/holiday-inflatables/">Holiday Characters & Shapes</a></li>

<li><a href="http://0prx9.com/ii/hot-air-balloon-inflatables/">
Hot Air Balloons</a></li>

<li><a href="http://0prx9.com/ii/inflatable-tents/">Tents</a></li>

<li><a href="http://0prx9.com/ii/traditional-inflatables/">Traditional Characters & Shapes</a></li>



</ul>

</div>

</div>

<?php get_footer();?>