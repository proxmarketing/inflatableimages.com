<?php 
global $data;
if ($data['social_media'] == 1) {
    echo "<div class='lazy-share-widget clearfix' id='sharing-1'>"; 
        if ($data['social_facebook'] == 1) 
            echo "<span class='st_facebook_hcount' displayText='Facebook'></span>";
        if ($data['social_twitter'] == 1) 
            echo "<span class='st_twitter_hcount' displayText='Tweet'></span>";
        if ($data['social_googlePlus'] == 1)
            echo "<span class='st_plusone_hcount' displayText='Google +1'></span>";
        if ($data['social_linkedin'] == 1)
            echo "<span class='st_linkedin_hcount' displayText='LinkedIn'></span>";
        if ($data['social_pinterest'] == 1)
            echo "<span class='st_pinterest_hcount' displayText='Pinterest'></span>";
    echo "</div>";    
}
?>