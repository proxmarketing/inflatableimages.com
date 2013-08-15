<?php 
global $blogConf, $is_home, $data; 
get_template_part('single', 'config');  
$is_home=true;
$contact_page_class = (is_page_template('contact-page.php'))? "contact_page " : "";

$filter_cats='';
$cats = get_the_category( $post->ID );
foreach($cats as $cat){
    if($cat->category_parent){
        $parentCat = get_category($cat->category_parent);
        $filter_cats .= "category-".$parentCat->slug." ";
    }
}
$clr = torgb($blogConf['bg_color']);
$opacity = isset($data['item_opacity']) ? $data['item_opacity'] : '1';
$format = get_post_format();
$format = (false === $format) ? ' format-standard' : ' format-'.$format;
?>
<div id="post-<?php the_ID(); ?>" <?php post_class($filter_cats.$contact_page_class.$blogConf['square_layout']." item ".$blogConf['post_text_color']) ?> data-slug="<?php echo $post->post_name; ?>">
    <div class="itemButton<?php echo $format;?>"></div>
    <div class="small-info" data-permalink="<?php the_permalink(); ?>" data-title="<?php the_title();echo " | ".get_option('blogname'); ?>"><?php
        get_template_part('post', 'featuredimage');?>
        <div class="item_hover"  <?php if($blogConf['bg_color']!="") echo 'style="background:'.$blogConf['bg_color'].';background:rgba('.$clr[0].','.$clr[1].','.$clr[2].','.$opacity.')"'; ?>>
            <h2><a class="show-link" href="<?php the_permalink(); ?>"><?php the_title();?></a></h2><?php
            echo "<span class='post-category'>";
            printf(get_the_category_list(', ')); echo "</span>"; ?>
        </div>
    </div>
    <div class='large-info' <?php if(""!=$blogConf['bg_color'])echo 'style="background:'.$blogConf['bg_color'].'"'; ?> ></div>
</div>