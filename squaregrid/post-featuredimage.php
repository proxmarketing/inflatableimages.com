<?php
    global $featured_image_printed, $blogConf, $permalink, $is_home, $format;
    $format = get_post_format();
    if($is_home){
        switch($blogConf['square_layout']){
            case'shape11': $blogConf['image_width']  = 156; 
                           $blogConf['image_height'] = 156; 
                           break;
            case'shape21': $blogConf['image_width']  = 156;
                           $blogConf['image_height'] = 316; 
                           break;
            case'shape12': $blogConf['image_width']  = 316; 
                           $blogConf['image_height'] = 156; 
                           break;
            case'shape22': $blogConf['image_width']  = 316;
                           $blogConf['image_height'] = 316; 
                           break;
            case'shape23': $blogConf['image_width']  = 476;
                           $blogConf['image_height'] = 316;
                           break;
        }
    }else{
        $blogConf['image_width']  = 476;
        $blogConf['image_height'] = 316;
    }
    if(false === $format){
        $height = $blogConf['image_height'];
        $width  = $blogConf['image_width'];
		if(is_single()) $height = 'auto';
        $featured_image_printed = post_image_show($width, $height, $permalink);
    }else{
        get_template_part('format', $format);
    }
?>