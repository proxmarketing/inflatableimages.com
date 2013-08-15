<?php
global $featured_image_printed, $is_home, $blogConf, $permalink;

$height = $blogConf['image_height'];
$width  = $blogConf['image_width'];
$featured_image_printed = post_image_show($width, $height, $permalink);
if(!$is_home){?>
    <div class="entry-audio clearfix">
        <?php get_format_audio_feature($post->ID); ?>
    </div><?php
}