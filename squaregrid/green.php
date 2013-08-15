<?php
/*
 * template name: Green page
 */
global $post, $blogConf, $permalink, $is_blog;


ajax_get_post_by();
get_template_part('single', 'config');
$blogConf['title'] = $post->post_title;?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <title><?php current_title(); ?></title>
        <?php favicon(); ?>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Mobile Specific Metas
          ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Favicons
        ================================================== -->
        <link rel="shortcut icon" href="<?php print get_template_directory_uri(); ?>/images/favicon.ico">
        <link rel="apple-touch-icon" href="<?php print get_template_directory_uri(); ?>/images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php print get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php print get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png">
        <?php blog_keywords(); ?>
        <?php blog_description(); ?>
        <?php meta_robots(); ?>
        <!-- IMPORTING CSS FILES -->
        <link rel="stylesheet" href="<?php print get_template_directory_uri() . '/css/prettyPhoto.css'; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php print get_template_directory_uri() . '/css/shortcodes.css'; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php print get_stylesheet_directory_uri() . '/style.css'; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php print get_stylesheet_directory_uri() . '/css/options.css'; ?>" type="text/css" />

        <?php global $data, $blogConf, $is_blog; ?>
<script type="text/javascript" src="//use.typekit.net/qim2dcc.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        <script type="text/javascript">
            var tt_theme_uri = '<?php echo get_template_directory_uri(); ?>';
            var tt_infinite_loadingMsg = '<?php _e('Loading the next set of posts...', 'themeton'); ?>';
            var tt_infinite_finishedMsg = '<?php _e('No more pages to load.', 'themeton'); ?>';
            var tt_infinite_img = '<?php echo get_template_directory_uri() . '/images/ajax-loader.gif'; ?>';
            var tt_sharethis = '<?php echo (isset($data['social_media']) && $data['social_media']) ? "true" : "false"; ?>';

        </script><?php
        add_action('wp_print_scripts', 'import_scripts');
        wp_head();

        blog_open_graph_meta();
        ?>
<?php if (isset($data['social_media']) && $data['social_media']) { ?>
            <script type="text/javascript">
                stLight.options({publisher: '<?php echo isset($data['sharethis_key']) ? $data['sharethis_key'] : ""; ?>'});
            </script>
    <?php } ?>
    </head>
    <?php
    $full = isset($blogConf['sidebar_position']) ? ($blogConf['sidebar_position'] == " right" ? 'right-sidebar' : 'left-sidebar') : '';
    $dark_style = (isset($data['dark_style']) && $data['dark_style']) ? "dark_style" : "";
    ?>

    <body <?php body_class(" $full $dark_style"); ?> data-sitetitle="<?php current_title(); ?>" data-siteurl="<?php echo home_url(); ?>">
       
<div id="fullwhite">
<?php
        if ($data['search_form']) {
            echo "<div class='search-content clearfix'><div class='search-form'>";
            get_search_form();
            echo "</div><div class='search-button'></div></div>";
        }
        ?> -
            <!-- START HEADER -->

            <div id="header">
                <div class="row clearfix">
                    <div class="branding">
                       <img class="logo-img-green" src="http://0prx9.com/ii/wp-content/uploads/2013/07/Gorilla-Head-logo_horizontal-white-small.jpg" alt="">
                    </div>
                    <div class="top-float">
<div class="phone-search-green">1-800-783-5717 &nbsp;&nbsp;&nbsp;&nbsp;<a class="redbtn-green" href="http://0prx9.com/ii/request-a-quote-for-inflatables/">Request a Quote</a></div>
                        <div class="top-nav-green"><?php navigation(); ?></div>
                <?php tt_social(); ?>
                <?php tt_headertext(); ?>
                    </div>
                </div>
                    <?php tt_title_filter(); ?>
            </div>

            <!-- END HEADER -->
</div>
<div class="outer">
<div class="container">        

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
yoast_breadcrumb('<p id="breadcrumbs-green">','</p>');
} ?>
<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'side-nav-green', 'theme_location' => 'gorilla') ); ?>
</div>
</div>
<!-- START FOOTER-->
<?php global $footerGrid, $data; ?>
    <div id="footer">
        
      
<div id="contentBox" style="margin:40px auto; width:80%">

   <div id="column1">
     <span class="foot-head">Home</span>
<ul class="sitemap">
<li><a href="http://0prx9.com/ii/request-a-quote-for-inflatables/">Request a Quote</a></li>
<li><a href="http://www.inflatableimages.com/Account.aspx/LogOn">Employee Log On</a></li>
<li><a href="http://scherba.mybigcommerce.com/">Shop Online</a></li>
</ul>
    </div>

    <div id="column2">
     <span class="foot-head">News</span>
<ul class="sitemap">
<?php

global $post;

$args = array( 'posts_per_page' => 1, 'offset'=> 1, 'category' => 17 );

$myposts = get_posts( $args );

foreach( $myposts as $post ) : setup_postdata($post); ?>
	<li>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
<?php endforeach; ?>
</ul>
    </div>

    <div id="column3">
     <span class="foot-head"><a href="http://0prx9.com/ii/inflatable-products/">Products</a></span>
<ul class="sitemap">
<li><a href="http://0prx9.com/ii/giant-inflatables/">Giant Inflatables</a></li>
<li><a href="http://0prx9.com/ii/gorilla-graphics/">Gorilla Graphics</a></li>
<li><a href="http://0prx9.com/ii/lawn-inflatables/">Lawn Inflatables</a></li>
<li><a href="http://0prx9.com/ii/inflatable-rentals/">Rentals</a></li>
<li><a href="http://0prx9.com/ii/fire-safety-inflatables/">Fire & Safety</a></li>
<li><a href="http://0prx9.com/ii/armed-forces-inflatables/">Armed Forces</a></li>
</ul>
    </div>

<div id="column4">
     <span class="foot-head"><a href="http://0prx9.com/ii/inflatable-services/">Services</a></span>
<ul class="sitemap">
<li><a href="http://0prx9.com/ii/inflatable-management-program/">Management</a></li>
<li><a href="http://0prx9.com/ii/inflatable-maintenance-and-repair/">Maintenance</a></li>
<li><a href="http://0prx9.com/ii/inflatable-installations/">Installations</a></li>
<li><a href="http://0prx9.com/ii/promotion-fulfillment/">Promotion Fulfillment</a></li>
</ul>
    </div>

    <div id="column5">
     <span class="foot-head"><a href="http://0prx9.com/ii/inflatables-company/">Company</a></span>
<ul class="sitemap">
<li><a href="http://0prx9.com/ii/our-people/">Our People</a></li>
<li><a href="http://0prx9.com/ii/inflatables-corporate-profile/">Corporate Profile</a></li>
<li><a href="http://0prx9.com/ii/inflatables-company-services/">Capabilities</a></li>
<li><a href="http://0prx9.com/ii/start-to-finish/">Start To Finish</a></li>
</ul>
    </div>

    <div id="column6">
     <ul class="social-list">
<li><a href="https://www.facebook.com/InflatableImages"><img src="http://0prx9.com/ii/wp-content/themes/squaregrid/images/facebook.fw.png" /></a></li>
<li><a href="https://twitter.com/InflatableImage"><img src="http://0prx9.com/ii/wp-content/themes/squaregrid/images/twitter.fw.png" /></a></li>
<li><a href="http://pinterest.com/source/inflatableimages.com/"><img src="http://0prx9.com/ii/wp-content/themes/squaregrid/images/pin.fw.png" /></a></li>
<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="http://0prx9.com/ii/wp-content/themes/squaregrid/images/rss.fw.png" /></a></li>
</ul>
    </div>
 <div id="column7">
<h4>Get More Information</h4>
    <?php echo do_shortcode('[gravityform id="1" name="Footer Form" title="false" description="false"]'); ?>
    </div>

</div>

        </div>
<div class="foot-logo">
<img src="http://0prx9.com/ii/wp-content/uploads/2013/07/Gorilla-Head-logo_horizontal-white-small.jpg" alt="">
</div>
    </div>
</div>
</div>
<!-- END FOOTER -->
<?php wp_footer(); ?>
<?php
//Google Analytics Code
if ($data['google_analytics']) {
    echo stripslashes($data['google_analytics']);
}?>
</body>
</html>