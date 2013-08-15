<?php
global $post, $blogConf, $is_blog, $is_portfolio;

if(isset($post->ID)){
    $optionss = get_post_meta($post->ID, 'themeton_additional_options', true);
}else{
    $optionss=array();
}
$blogConf['square_layout']=isset($optionss['square_layout'])? $optionss['square_layout']:"shape11";
$blogConf['post_text_color'] = isset($optionss['post_text_color']) ? 'dark':'light';
$blogConf['bg_color']=isset($optionss['bg_color'])? $optionss['bg_color']:"#FFFFFF";
$blogConf['blog_categories']=isset($optionss['blog_categories'])? $optionss['blog_categories']:"";
$blogConf['hide_title']=isset($optionss['hide_title'])  ? true : false;
$blogConf['hide_filter']=isset($optionss['hide_filter'])? true : false;
$blogConf['filter_type']=isset($optionss['filter_type'])? $optionss['filter_type'] : 'category';
$blogConf['hide_image']=isset($optionss['hide_image'])? 1 : 0;

if($is_blog!==true&& $is_portfolio!==true){
    $blogConf['hide_filter']=true;
}