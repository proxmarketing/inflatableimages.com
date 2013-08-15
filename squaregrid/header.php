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

        </script>

<?php
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

    <body <?php body_class(" $full $dark_style"); ?> >
       
<div id="fullwhite">
<?php
        if ($data['search_form']) {
            echo "<div class='search-content clearfix'><div class='search-form'>";
            get_search_form();
            echo "</div><div class='search-button'></div></div>";
        }
        ?>
            <!-- START HEADER -->

            <div id="header">
                <div class="row clearfix">
                    <div class="branding">
                        <?php logo_init(); ?>
                    </div>
		<div class="top-float ">
                   <div class="phone-search">1-800-783-5717 &nbsp;&nbsp;&nbsp;&nbsp;<a class="redbtn" href="http://0prx9.com/ii/request-a-quote-for-inflatables/">Request a Quote</a></div>
                        <div class="top-nav"><?php navigation(); ?></div>
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