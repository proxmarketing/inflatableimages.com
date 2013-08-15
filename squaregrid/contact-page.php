<?php
/*
 * template name: Contact
 */
global $permalink,$blogConf;
$permalink = true;
if(isset($_REQUEST['single'])){
    if (have_posts ()) {the_post();
        get_template_part('single', 'config');
        $options = get_post_meta($post->ID, 'themeton_additional_options', true);?>
        <?php echo $options['google_map'] ? '<div class="contact-map">'.$options['google_map'].'</div>' :"" ;?>
            <div class="entry-content ">
                <div class='clear'></div><?php
                    if(isset($options['contact_address'])){?>
                        <h6><?php _e('Our Address', 'themeton');?></h6>
                        <div class="contact-info"><?php echo $options['contact_address'];?></div><?php
                    }
				?>
                <div class="contact-form-big"><?php echo contact_form($options); ?></div>
                <?php get_template_part('post', 'edit'); ?>                
            </div><?php
        die();
    }
}else{
    if($post->post_name){
        header("location: ".home_url()."/#".$post->post_name);
    }else{
        header("location: ".home_url());
    }
    die();
}