<?php
global $featured_image_printed, $blogConf, $is_home, $permalink;

$height = $blogConf['image_height'];
$width  = $blogConf['image_width'];
if($is_home){
    $featured_image_printed = post_image_show($width, $height, $permalink);
}else{?>
    <div class="entry-video clearfix">
        <?php get_format_video_feature($post->ID); ?>
    </div><?php
}