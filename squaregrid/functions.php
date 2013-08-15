<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$themename = 'SquareGrid';
$shortname = 'squaregrid';
define('FRAMEWORKPATH', TEMPLATEPATH . '/framework');
define('FRAMEWORKURL', get_template_directory_uri() . '/framework');
define('TT_SHORTNAME', 'squaregrid');
define('THEMENAME', 'SquareGrid');

// This was not meant not to replace your functions.php file. Just copy and paste the codes below into your own functions.php file.

/* ----------------------------------------------------------------------------------- */
// Options Framework
/* ----------------------------------------------------------------------------------- */
require_once (TEMPLATEPATH . '/admin/index.php');

$shape = Array(
    array('title' => 'Shape 1x1', 'value' => 'shape11', 'image' => FRAMEWORKURL . '/images/layouts/shape11.png'),
    array('title' => 'Shape 2x1', 'value' => 'shape21', 'image' => FRAMEWORKURL . '/images/layouts/shape21.png'),
    array('title' => 'Shape 1x2', 'value' => 'shape12', 'image' => FRAMEWORKURL . '/images/layouts/shape12.png'),
    array('title' => 'Shape 2x2', 'value' => 'shape22', 'image' => FRAMEWORKURL . '/images/layouts/shape22.png'),
    array('title' => 'Shape 2x3', 'value' => 'shape23', 'image' => FRAMEWORKURL . '/images/layouts/shape23.png'),
);

require_once FRAMEWORKPATH . '/framework.php';
require_once TEMPLATEPATH . '/includes/' . TT_SHORTNAME . '.php';
if (!function_exists("get_post_image")) {

    function get_post_image() {
        global $post;
        $first_img = '';

        if (has_post_thumbnail($post->ID)) {
            $post_image_tumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
            return $post_image_tumb[0];
        }

        $slide_imgs = get_post_meta($post->ID, 'tt_slide_images', true);
        if ($slide_imgs != '' && count($slide_imgs) > 0) {
            return $slide_imgs[0]['image'];
        }

        if (!is_single()) {
            $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
            $first_img = isset($matches[1][0]) ? $matches[1][0] : '';
        }
        return $first_img;
    }

}
if (!function_exists("get_post_og_image")) {

    function get_post_og_image() {
        global $post;
        $first_img = get_post_image();
        if (!$first_img && get_post_format() == 'video') {
            $videoThumb = get_youtube_vimeo_thumb_url(get_post_meta($post->ID, 'tt-video-embed', true));
            if ($videoThumb !== false) {
                $first_img = $videoThumb;
            }
        }
        return $first_img;
    }

}

 
add_action( 'init', 'register_my_menus' );
 
function register_my_menus() {
	register_nav_menus(
		array(
			'products' => __( 'Product Page' ),
			'services' => __( 'Services Page' ),
			'company' => __( 'Company Page' ),
			'giant' => __( 'Giant Inflatables Page' ),
			'gorilla' => __( 'Gorilla Graphics Page' ),
			'lawn' => __( 'Lawn Inflatables Page' ),
			'fire' => __( 'Fire Safety Inflatables Page' ),
			'armed' => __( 'Armed Forces Inflatables Page' )
		

		)
	);
}

register_nav_menus(array(
    'primary-menu' => __('Primary Navigation', 'themeton')
));
if (!function_exists("navigation")) {

    function navigation() {
        $args = array('theme_location' => 'primary-menu',
            'container' => false,
            'menu_class' => 'main-menu',
            'echo' => true,
            'fallback_cb' => 'nomenu',
            'depth' => 0);
        wp_nav_menu($args);
    }

}
if (!function_exists("nomenu")) {

    function nomenu() {
        global $data, $post;
        echo '<ul><li><a href="' . home_url() . '">' . __('HOME', 'themeton') . '</a></li>';
        if (get_ID_by_slug($data['first_page'])) {
            query_posts('page_id=' . get_ID_by_slug($data['first_page']));
            while (have_posts()) : the_post();
                echo '<li><a class="show_page" href="#' . $post->post_name . '">' . get_the_title() . '</a></li>';
            endwhile;
            wp_reset_query();
        }
        if (get_ID_by_slug($data['last_page'])) {
            query_posts('page_id=' . get_ID_by_slug($data['last_page']));
            while (have_posts()) : the_post();
                echo '<li><a class="show_page" href="#' . $post->post_name . '">' . get_the_title() . '</a></li>';
            endwhile;
            wp_reset_query();
        }
        echo '</ul>';
    }

}
add_filter('nav_menu_css_class', 'current_page_type_nav_class', 10, 2);
if (!function_exists("current_page_type_nav_class")) {

    function current_page_type_nav_class($classes, $item) {
        if ($item->object == 'page') {
            $temp = get_post_meta($item->object_id, '_wp_page_template', true);
            if ($temp == 'contact-page.php' || $temp == 'default') {
                array_push($classes, 'default-page');
                array_push($classes, '=' . get_slug_by_ID($item->object_id) . "=");
            }
        };
        return $classes;
    }

}

add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('video', 'audio'));
add_image_size('theme-thumb', 520, 497, true);
add_filter('widget_text', 'do_shortcode');
add_filter('wp_get_attachment_link', 'gallery_prettyPhoto');
if (!function_exists("gallery_prettyPhoto")) {

    function gallery_prettyPhoto($content) {
        // add checks if you want to add prettyPhoto on certain places (archives etc).
        return str_replace("<a", "<a title='' alt='' rel='prettyPhoto[x]'", $content);
    }

}

add_action('after_setup_theme', 'themeton_setup');
if (!function_exists('themeton_setup')) {

    function themeton_setup() {
        add_editor_style();
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        load_theme_textdomain('themeton', TEMPLATEPATH . '/languages');
    }

}
if (!isset($content_width))
    $content_width = 900;
if (!function_exists("convert_multisite")) {

    function convert_multisite($theImageSrc) {
        global $blog_id;
        if (isset($blog_id) && $blog_id > 1) {
            $imageParts = explode('/files/', $theImageSrc);
            if (isset($imageParts[1])) {
                $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
            }
        }
        return $theImageSrc;
    }

}
if (!function_exists("mytheme_comment")) {

    function mytheme_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        //print "<div class='tt_reply'>";
        //print "<div>";
        ?>	
        <div class="comment">
            <div class="comment-author">
                <?php print get_avatar($comment, $size = '28', $default = '<path_to_url>', $class = ''); ?>
                <span class="comment-author-link"><span class="author-link-span">
                        <?php print get_comment_author_link(); ?></span>
                </span>
                <div class="comment-meta">
                    <span class="comment-date"><?php printf(__('%1$s', 'themeton'), get_comment_date()) ?></span>
                    <span class="comment-replay-link"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="comment-body">
                <?php comment_text() ?>
            </div>
        </div>
        <?php
    }

}
if (!function_exists("get_sticky_posts_count")) {

    function get_sticky_posts_count() {
        global $wpdb;
        $sticky_posts = array_map('absint', (array) get_option('sticky_posts'));
        return count($sticky_posts) > 0 ? $wpdb->get_var($wpdb->prepare("SELECT COUNT( 1 ) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND ID IN (" . implode(',', $sticky_posts) . ")")) : 0;
    }

}
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(150, 250); // default Post Thumbnail dimensions
}

if (function_exists('add_image_size')) {
    add_image_size('post-thumb', 310, 9999); //300 pixels wide (and unlimited height)
    add_image_size('widget-thumb', 220, 180, true); //(cropped)
}
if (!function_exists("give_linked_images_class")) {

    /**     * Attach a class to linked images' parent anchors * e.g. a img => a.img img */
    function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '') {
        $classes = 'preload'; // separated by spaces, e.g. 'img image-link'
        //// check if there are already classes assigned to the anchor
        if (preg_match('/<a.*? class=".*?">/', $html)) {
            $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', 'rel="prettyphoto" title="" $1 ' . $classes . '$2', $html);
        } else {
            $html = preg_replace('/(<a.*?)>/', '$1 class="preload" rel="prettyphoto" title="" >', $html);
        }
        return $html;
    }

}
add_filter('image_send_to_editor', 'give_linked_images_class', 10, 8);

if (!function_exists("import_scripts")) {

    function import_scripts() {
        wp_register_script('jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js');
        wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js');
        wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js');
        wp_register_script('hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.js');
        wp_register_script('preloader', get_template_directory_uri() . '/js/jquery.preloader.js');
        wp_register_script('tools', get_template_directory_uri() . '/js/jquery.tools.min.js');
        wp_register_script('theme', get_template_directory_uri() . '/js/scripts.js');
        wp_register_script('jcycle', get_template_directory_uri() . '/js/jquery.cycle.min.js');
        wp_register_script('validate', get_template_directory_uri() . '/js/jquery.validate.min.js');
        wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js');
        wp_register_script('scroll', get_template_directory_uri() . '/js/jquery.tinyscrollbar.min.js');
        wp_register_script('buttons', get_template_directory_uri() . '/js/buttons.js');
wp_register_script('shortcodes', get_template_directory_uri() . '/js/scripts_shortcode.js');        
wp_register_script('touchSwipe', get_template_directory_uri() . '/js/jquery.touchSwipe-1.2.5.js');
        wp_register_script('autocomplete', get_template_directory_uri() . '/js/jquery.autocomplete-min.js');
        wp_register_script('infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js');
        wp_register_script('nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js');
        wp_register_script('css3-mediaqueries', get_template_directory_uri() . '/js/css3-mediaqueries.js');

        wp_enqueue_script('jquery');
        wp_enqueue_script('jcycle');
        wp_enqueue_script('validate');
        wp_enqueue_script('jplayer');
        wp_enqueue_script('prettyPhoto');
        wp_enqueue_script('easing');
        wp_enqueue_script('jcarousel');
        wp_enqueue_script('preloader');
        wp_enqueue_script('tools');
        wp_enqueue_script('shortcodes');
        wp_enqueue_script('theme');
        wp_enqueue_script('isotope');
        wp_enqueue_script('scroll');
        wp_enqueue_script('buttons');
        wp_enqueue_script('touchSwipe');
        wp_enqueue_script('autocomplete');
        wp_enqueue_script('infinitescroll');
        wp_enqueue_script('nicescroll');
        wp_enqueue_script('css3-mediaqueries');
    }

}
if (!function_exists("portfolio_scripts")) {

    function portfolio_scripts() {
        wp_register_script('masonry', get_template_directory_uri() . '/js/jquery.masonry.min.js');
        wp_register_script('portfolio', get_template_directory_uri() . '/js/portfolio_script.js');
        wp_enqueue_script('masonry');
        wp_enqueue_script('portfolio');
    }

}
if (!function_exists("get_format_video_feature")) {

    function get_format_video_feature($current_post_id) {
        echo get_post_meta($current_post_id, 'tt-video-embed', true);
    }

}
if (!function_exists("get_format_audio_feature")) {

    function get_format_audio_feature($current_post_id) {
        ?>
        <div id="jquery_jplayer_<?php echo $current_post_id; ?>" pid="<?php echo $current_post_id; ?>" class="jp-jplayer jp-jplayer-audio" src="<?php echo get_post_meta($current_post_id, 'tt-audio-link', true); ?>" style="width: 0px; height: 0px; "><img id="jp_poster_0" style="width: 0px; height: 0px; display: none; "><audio id="jp_audio_0" preload="metadata" src="http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"></audio></div>
        <div class="jp-audio-container">
            <div class="jp-audio">
                <div class="jp-type-single">
                    <div id="jp_interface_<?php echo $current_post_id; ?>" class="jp-interface">
                        <ul class="jp-controls">
                            <li><div class="seperator-first"></div></li>
                            <li><div class="seperator-second"></div></li>
                            <li><a href="#" class="jp-play" tabindex="1" style="display: block; ">play</a></li>
                            <li><a href="#" class="jp-pause" tabindex="1" style="display: none; ">pause</a></li>
                            <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                            <li><a href="#" class="jp-unmute" tabindex="1" style="display: none; ">unmute</a></li>
                        </ul>
                        <div class="jp-progress-container">
                            <div class="jp-progress">
                                <div class="jp-seek-bar" style="width: 100%; ">
                                    <div class="jp-play-bar" style="width: 1.18944845234691%; "></div>
                                </div>
                            </div>
                        </div>
                        <div class="jp-volume-bar-container">
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value" style="width: 80%; "></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <?php
    }

}
if (!function_exists("get_ID_by_slug")) {

    function get_ID_by_slug($slug) {
        $p = get_page_by_path($slug);
        if ($p) {
            return $p->ID;
        } else {
            return null;
        }
    }

}
if (!function_exists("get_slug_by_ID")) {

    function get_slug_by_ID($ID) {
        $post_data = get_post($ID, ARRAY_A);
        if (isset($post_data['post_name'])) {
            return $post_data['post_name'];
        } else {
            return null;
        }
    }

}
if (!function_exists("not_found_content")) {

//Not Found
    function not_found_content() {
        ?>
        <div id="not-found" class="not-found">
            <h1><?php _e('Oops. Page Not Found', 'themeton'); ?></h1>
            <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'themeton'); ?></p>
            <?php get_search_form(); ?>
            <div class="not-found-close"></div>
        </div><?php
    }

}

if (isset($_REQUEST['get_not_found_content'])) {
    not_found_content();
    die;
}
if (!function_exists("torgb")) {

    function torgb($color) {
        if ($color[0] == '#')
            $color = substr($color, 1);

        if (strlen($color) == 6)
            list($r, $g, $b) = array($color[0] . $color[1],
                $color[2] . $color[3],
                $color[4] . $color[5]);
        elseif (strlen($color) == 3)
            list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        else
            return false;

        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);

        return array($r, $g, $b);
    }

}
global $data;
if (isset($data['facebook_comment']) && $data['facebook_comment']) {
    add_action('wp_print_scripts', 'fb_comment', 11);
}
if (!function_exists("fb_comment")) {

    function fb_comment() {
        global $data;
        $fb = 'http://connect.facebook.net/en_US/all.js#appId=' . $data['facebook_appid'] . '&amp;xfbml=1';
        wp_register_script('facebook', $fb);
        wp_enqueue_script('facebook');
    }

}

if (!function_exists("contact_form")) {

// Contact Form
    function contact_form($options) {
        extract($options);
        $out = '';
        $email_adress_reciever = $contact_email != "" ? $contact_email : get_option('admin_email');

        $tnxmsg = isset($contact_tnxmsg) ? $contact_tnxmsg : __('<strong>Thanks!</strong> Your email was successfully sent.', 'themeton');

        //If the form is submitted
        if (isset($_POST['submittedContact'])) {
            require(TEMPLATEPATH . "/framework/contact-submit.php");
        }

        if (isset($emailSent) && $emailSent == true) {
            $out .= '<p id="Note" style="display:none"></p>';
            $out .= '<p class="thanks">' . $tnxmsg . '</p>';
        } else {

            if (isset($captchaError)) {
                $out .= '<p id="Note" style="display:none"></p>';
                $out .= '<p class="error">There was an error submitting the form.<p>';
            }
            $out .= '<p id="Note" style="display:none"></p>';
            $out .= '<form action="' . get_permalink() . '" class="cmxform" id="contactform" method="post"><fieldset>';

            //  CONTACT NAME

            $out .= '<div class="overlabel-wrapper left"><label class="overlabel overlabel-apply" for="ContactName">' . __('Name', 'themeton') . ' </label>';
            $out .= '<input type="text" name="ContactName" id="ContactName" value="';
            if (isset($_POST['ContactName'])) {
                $out .= $_POST['ContactName'];
            }
            $out .= '"';
            $out .= ' class="textInput required';
            if (isset($emailError) && $emailError != '') {
                $out .= ' inputError';
            }
            $out .= '"';
            $out .= ' /></div>';

            //  CONTACT EMAIL

            $out .= '<div class="overlabel-wrapper right"><label class="overlabel overlabel-apply" for="ContactEmail">' . __('Email', 'themeton') . ' </label><input type="text" name="ContactEmail" id="ContactEmail" value="';

            if (isset($_POST['ContactEmail'])) {
                $out .= $_POST['ContactEmail'];
            }
            $out .= '"';
            $out .= ' class="textInput ' . 'required email';
            if (isset($emailError) && $emailError != '') {
                $out .= ' inputError';
            }
            $out .= '"';
            $out .= ' /></div>';

            if (isset($contact_web_phone)) {
                $out .= '<div class="clear"></div><div class="overlabel-wrapper"><label class="overlabel overlabel-apply" for="ContactWeb">' . __('Website', 'themeton') . ' </label><input type="text" name="ContactWeb" id="ContactWeb" value="';
                if (isset($_POST['ContactWeb'])) {
                    $out .= $_POST['ContactWeb'];
                }
                $out .= '"';
                $out .= ' class="textInput ';
                $out .= isset($require_web_phone) ? 'required' : '';
                if (isset($emailError) && $emailError != '') {
                    $out .= ' inputError';
                }
                $out .= '"';
                $out .= ' /></div>';
                //}
                //if (isset($contact_phone)) {
                $out .= '<div class="overlabel-wrapper right"><label class="overlabel overlabel-apply" for="ContactPhone">' . __('Phone', 'themeton') . ' </label><input type="text" name="ContactPhone" id="ContactPhone" value="';

                if (isset($_POST['ContactPhone'])) {
                    $out .= $_POST['ContactPhone'];
                }
                $out .= '"';
                $out .= ' class="textInput ';
                $out .= isset($require_web_phone) ? 'required number' : '';
                if (isset($emailError) && $emailError != '') {
                    $out .= ' inputError';
                }
                $out .= '"';
                $out .= ' /></div>';
            }
            if (isset($contact_addresss)) {
                $out .= '<div class="overlabel-wrapper"><label class="overlabel overlabel-apply" for="ContactAddress">' . __('Address', 'themeton') . ' </label><input type="text" name="ContactAddress" id="ContactAddress" value="';

                if (isset($_POST['ContactAddress'])) {
                    $out .= $_POST['ContactAddress'];
                }
                $out .= '"';
                $out .= ' class="textInput ';
                $out .= isset($contact_addressr) ? 'required' : '';
                if (isset($emailError) && $emailError != '') {
                    $out .= ' inputError';
                }
                $out .= '"';
                $out .= ' /></div>';
            }
            $out .= '<div class="clear"></div><div class="overlabel-wrapper center"><label class="overlabel overlabel-apply" for="ContactMessage">' . __('Message', 'themeton') . ' </label><textarea name="ContactMessage" id="ContactMessage" class="textInput required';

            if (isset($messageError) && $emailError != '') {
                $out .= ' inputError';
            }
            $out .= '" rows="10" cols="40">';

            if (isset($_POST['ContactMessage'])) {
                if (function_exists('stripslashes')) {
                    $out .= stripslashes($_POST['ContactMessage']);
                } else {
                    $out .= $_POST['ContactMessage'];
                }
            }
            $out .= '</textarea></div>';
            $out .= '<button name="submittedContact" type="submit" class="btn"><span>' . __('Send now', 'themeton') . '</span></button><label id="loader" style="display:none;"><img src="' . get_template_directory_uri() . '/images/ajax-loader.gif" alt="Loading..." id="LoadingGraphic" /></label>';
            $out .= '<p class="screenReader"><input id="submitUrl" type="hidden" name="submitUrl" value="' . get_template_directory_uri() . '/includes/contact-submit.php" /></p>';
            $out .= '<p class="screenReader"><input id="emailAddress" type="hidden" name="emailAddress" value="' . $email_adress_reciever . '" /></p>';
            $out .= '<p class="screenReader"><input id="tnxmsg" type="hidden" name="tnxmsg" value="' . $tnxmsg . '" /></p>';
            $out .= '</fieldset></form>';
        }
        return $out;
    }

}
if (!function_exists("get_youtube_vimeo_thumb_url")) {

    function get_youtube_vimeo_thumb_url($embed) {
        $search = 'src="http://www.youtube.com/embed/';
        $posStart = strpos($embed, $search);
        $thumb_url = false;
        if ($posStart !== false) {
            $posStart+=strlen($search);
            $posEnd = (strpos($embed, '?', $posStart) > -1) ? strpos($embed, '?', $posStart) : strpos($embed, '"', $posStart);
            if ($posEnd !== false) {
                $thumb_url = substr($embed, $posStart, $posEnd - $posStart);
                $thumb_url = 'http://img.youtube.com/vi/' . $thumb_url . '/0.jpg';
            }
        }

        if ($thumb_url === false) {
            $search = 'src="http://player.vimeo.com/video/';
            $posStart = strpos($embed, $search);
            if ($posStart !== false) {
                $posStart+=strlen($search);
                $posEnd = strpos($embed, '?', $posStart);
                if ($posEnd !== false) {
                    $thumb_url = substr($embed, $posStart, $posEnd - $posStart);
                    $thumb_url = unserialize(file_get_contents("http://vimeo.com/api/v2/video/" . $thumb_url . ".php"));
                    $thumb_url = $thumb_url[0]['thumbnail_large'];
                }
            }
        }
        return $thumb_url;
    }

}

if (!function_exists("style_search_form")) {

    // Customize the search form
    function style_search_form($form) {
        $form = '<form role="search" method="get" id="searchform" class="form-search " action="' . get_option('home') . '/" >
            <div>';
        if (is_search()) {
            $form .='<input type="text" value="' . attribute_escape(apply_filters('the_search_query', get_search_query())) . '" name="s" autocomplete="off" id="s" />';
        } else {
            $form .='<input type="text" value="' . __("Search for:", "themeton") . '" name="s" id="s"  onfocus="if(this.value==this.defaultValue)this.value=\'\';" onblur="if(this.value==\'\')this.value=this.defaultValue;"/>';
        }
        $form .= '<input type="submit" id="searchsubmit" value="' . __("Search", "themeton") . '" />
            </div>
            </form>';
        return $form;
    }

}

add_filter('get_search_form', 'style_search_form');
if (!function_exists("tt_social")) {

    function tt_social() {
        global $data;
        if (isset($data['social'])) {
            if (is_array($data['social'])) {
                $showSocial = false;
                foreach ($data['social'] as $currentSocial) {
                    if ($currentSocial['title'] && $currentSocial['link']) {
                        $showSocial = true;
                    }
                }
                if ($showSocial) {
                    ?>
                    <div class="top-social">
                        <ul><?php
                    foreach ($data['social'] as $currentSocial) {
                        if ($currentSocial['title'] && $currentSocial['link']) {
                            echo '<li><a target="_blank" class="' . $currentSocial['title'] . '_profile_url" href="';
                            echo (strpos($currentSocial['link'], 'http:') === false) ? "http://" : "";
                            echo $currentSocial['link'] . '">' . strtoupper($currentSocial['title']) . '</a></li>';
                        }
                    }
                    ?>
                        </ul>
                    </div><?php
                }
            }
        }
    }

}
if (!function_exists("tt_headertext")) {

    function tt_headertext() {
        global $data;
        if ($data['headertext']) {
            echo '<div class="top-text"><p>' . do_shortcode($data['headertext']) . '</p></div>';
        }
    }

}
if (!function_exists("tt_title_filter")) {

    function tt_title_filter() {
        global $blogConf;

        if (!isset($blogConf['title'])) {
            $blogConf['hide_title'] = true;
        }if (!isset($blogConf['hide_title'])) {
            $blogConf['hide_title'] = true;
        }if (!isset($blogConf['hide_filter'])) {
            $blogConf['hide_filter'] = true;
        }
        if (!$blogConf['hide_title'] || !$blogConf['hide_filter']) {
            ?>
            <div class="row clearfix tt_grid_menu <?php echo (!$blogConf['hide_title'] && !$blogConf['hide_filter']) ? 'title_with_filter' : '' ?>">
            <?php if (!$blogConf['hide_title']) { ?>
                    <div class="title-container">
                        <h1 class="title"><?php echo $blogConf['title']; ?></h1>
                    </div>
                <?php } ?>
                <?php if (!$blogConf['hide_filter']) { ?>
                    <?php
                    $args = array(
                        'type' => 'post',
                        'orderby' => 'name',
                        'order' => 'ASC');

                    $categories = get_categories($args);
                    $blog_cats = $blogConf['blog_categories'] ? $blogConf['blog_categories'] : false;
                    ?>
                <?php if ($blogConf['filter_type'] == 'category') { ?>
                        <!-- FILTER BY CATEGORY -->
                        <section id="options" class="clearfix">
                            <h3><?php _e('Filters', 'themeton') ?></h3>
                            <ul id="filters" class="option-set clearfix" data-option-key="filter">
                                <li><a href="#filter" data-option-value="*" class="selected"><?php _e('Show all', 'themeton') ?></a></li><?php
                    if ($blog_cats) {
                        $i = 0;
                        foreach ($categories as $category) {
                            if (isset($blog_cats[$i]) && $blog_cats[$i] == $category->slug) {
                                echo'<li><a href="#filter" data-option-value=".category-' . $category->slug . '">' . $category->name . '</a></li>';
                                $i++;
                            }
                        }
                    } else {
                        foreach ($categories as $category) {
                            echo'<li><a href="#filter" data-option-value=".category-' . $category->slug . '">' . $category->name . '</a></li>';
                        }
                    }
                    ?>
                            </ul>
                        </section>
                        <section id="mobile-filter" class="clearfix">
                            <select id="filters" name="filters" data-option-key="filter">
                                <option selected="selected" value="*"><?php _e('Show all', 'themeton') ?></option><?php
                    if ($blog_cats) {
                        $i = 0;
                        foreach ($categories as $category) {
                            if (isset($blog_cats[$i]) && $blog_cats[$i] == $category->slug) {
                                echo '<option value=".category-' . $category->slug . '">' . $category->name . '</option>';
                                $i++;
                            }
                        }
                    } else {
                        foreach ($categories as $category) {
                            echo '<option value=".category-' . $category->slug . '">' . $category->name . '</option>';
                        }
                    }
                    ?>
                            </select>
                        </section>
                <?php } else { ?>
                        <!-- FILTER BY TAG -->
                        <section id="options" class="clearfix">
                            <h3><?php _e('Filters', 'themeton') ?></h3>
                            <ul id="filters" class="option-set clearfix" data-option-key="filter">
                                <li><a href="#filter" data-option-value="*" class="selected"><?php _e('Show all', 'themeton') ?></a></li><?php
                    $all_tag_cats = array();
                    $all_tags_arr = array();
                    if ($blog_cats) {
                        $i = 0;
                        foreach ($categories as $category) {
                            if (isset($blog_cats[$i]) && $blog_cats[$i] == $category->slug) {
                                $all_tag_cats[] = $category->slug;
                                $i++;
                            }
                        }
                    } else {
                        foreach ($categories as $category) {
                            $all_tag_cats[] = $category->slug;
                        }
                    }


                    foreach ($all_tag_cats as $tag_cats) {
                        query_posts('category_name=' . $tag_cats);
                        while (have_posts()) : the_post();
                            $posttags = get_the_tags();
                            if ($posttags) {
                                foreach ($posttags as $tag) {
                                    $all_tags_arr[$tag->name] = $tag->slug; //USING JUST $tag MAKING $all_tags_arr A MULTI-DIMENSIONAL ARRAY, WHICH DOES WORK WITH array_unique
                                }
                            }
                        endwhile;
                        wp_reset_query();
                    }

                    $tags = array_unique($all_tags_arr); //REMOVES DUPLICATES

                    foreach ($tags as $key => $tag) {
                        echo'<li><a href="#filter" data-option-value=".tag-' . $tag . '">' . $key . '</a></li>';
                    }
                    ?>
                            </ul>
                        </section>
                        <section id="mobile-filter" class="clearfix">
                            <select id="filters" name="filters" data-option-key="filter">
                                <option selected="selected" value="*"><?php _e('Show all', 'themeton') ?></option><?php
                    foreach ($tags as $key => $tag) {
                        echo '<option value=".tag-' . $tag . '">' . $key . '</option>';
                    }
                    ?>
                            </select>
                        </section>
                    <?php } ?>
            <?php } ?>
            </div><?php
        }
    }

}
if (!function_exists("ajax_get_post_by")) {

    function ajax_get_post_by(){
        if (isset($_REQUEST['get_post_by_slug'])) {
            $tt_slug = $_REQUEST['get_post_by_slug'];
            //////////////////GET PAGE//////////////////////
            $tt_query = 'page_id=' . get_ID_by_slug($tt_slug);
            query_posts($tt_query);
            if (have_posts() && get_ID_by_slug($tt_slug)) {
                the_post();
                if(is_page_template('blog-page.php')||is_page_template( 'gallery-green.php')||is_page_template( 'gallery-news.php')||is_page_template( 'armed-page.php')||is_page_template( 'gallery-armed.php')||is_page_template( 'fire-safe.php')||is_page_template( 'gallery-fire-safe.php')||is_page_template( 'rentals.php')||is_page_template( 'gallery-rentals.php')||is_page_template( 'products.php')||is_page_template( 'li-page.php')||is_page_template( 'gallery-li.php')||is_page_template( 'gi-page.php' )||is_page_template( 'green.php' )||isis_page_template('services.php')||is_page_template('full-page.php')||is_page_template('portfolio-page.php')){
                    echo "%category%";
                }else{
                    get_template_part('post');
                }
            } else {
                //////////////////GET POST//////////////////////
                $tt_query = 'name=' . $tt_slug;
                query_posts($tt_query);
                if (have_posts()) {
                    the_post();
                    get_template_part('post');
                }
                wp_reset_query();
            }
            wp_reset_query();
            die();
        }elseif (isset($_REQUEST['get_post_by_permalink'])) {
            $tt_permalink = $_REQUEST['get_post_by_permalink'];
            if(url_to_postid($tt_permalink)===0){
                echo "%category%";
            }else{
                //////////////////GET PAGE//////////////////////
                $tt_query = 'page_id=' . url_to_postid($tt_permalink);
                query_posts($tt_query);
                if (have_posts() && url_to_postid($tt_permalink)) {
                    the_post();
                    if(is_page_template('blog-page.php')||is_page_template( 'gallery-green.php')||is_page_template( 'gallery-news.php')||is_page_template( 'armed-page.php')||is_page_template( 'gallery-armed.php')||is_page_template( 'fire-safe.php')||is_page_template( 'gallery-fire-safe.php')||is_page_template( 'rentals.php')||is_page_template( 'gallery-rentals.php')||is_page_template( 'products.php')||is_page_template( 'li-page.php')||is_page_template( 'gallery-li.php')||is_page_template( 'gi-page.php' )||is_page_template( 'green.php' )||is_page_template('services.php')||is_page_template('full-page.php')||is_page_template('portfolio-page.php')){
                        echo "%category%";
                    }else{
                        get_template_part('post');
                    }
                } else {
                    //////////////////GET POST//////////////////////
                    $tt_query = 'p=' . url_to_postid($tt_permalink);
                    query_posts($tt_query);
                    if (have_posts()) {
                        the_post();
                        get_template_part('post');
                    }
                    wp_reset_query();
                }
                wp_reset_query();
            }
            die();
        }
    }

}

// Fixing duplicating issue when has Ramdom post order
global $data;
if (!is_admin() && isset($data['order_type']) && $data['order_type'] == 'Random') {

    session_start();
    add_filter('posts_orderby', 'edit_posts_orderby');

    function edit_posts_orderby($orderby_statement) {
        if (isset($_SESSION['expiretime'])) {
            if ($_SESSION['expiretime'] < time())
                session_unset();
        } else
            $_SESSION['expiretime'] = time() + 300;

        $seed = $_SESSION['seed'];
        if (empty($seed)) {
            $seed = rand();
            $_SESSION['seed'] = $seed;
        }
        $orderby_statement = 'RAND(' . $seed . ')';

        return $orderby_statement;
    }

}