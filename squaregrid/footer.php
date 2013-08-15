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
<img src="http://0prx9.com/ii/wp-content/uploads/2013/07/ii2005_hz-st2.png" />
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