<?php

global $data, $is_blog, $is_portfolio, $query_string, $is_category, $is_search;
$order_type = isset($data['order_type']) ? ($data['order_type'] != 'Date' ? $data['order_type'] : 'Date') : 'Date';
$optionss = isset($post->ID) ? get_post_meta($post->ID, 'themeton_additional_options', true) : false;
if ($optionss === false) {
    unset($optionss);
} else if (isset($optionss['order_type']) && $optionss['order_type'] != 'Date') {
    $order_type = $optionss['order_type'] != 'Date' ? $optionss['order_type'] : 'Date';
}

$paged = isset($_REQUEST['infPaged']) ? $_REQUEST['infPaged'] : 1;

//////////////////ABOUT PAGE//////////////////////
if (get_ID_by_slug($data['first_page']) && ($is_portfolio === true || $is_blog === true) && !isset($_REQUEST['infPaged'])) {
    query_posts('page_id=' . get_ID_by_slug($data['first_page']));
    while (have_posts()) : the_post();
        get_template_part('post');
    endwhile;
    wp_reset_query();
}

//////////////////POSTS///////////////////////////
$order = '';
if ($order_type != 'Date') {
    if ($order_type == 'Date ASC')
        $order = '&order=ASC';
    if ($order_type == 'Title')
        $order = '&orderby=title&order=DESC';
    if ($order_type == 'Title ASC')
        $order = '&orderby=title&order=ASC';
    if ($order_type == 'Random')
        $order = '&orderby=rand';
}
if ($is_blog === true || $is_portfolio === true) {
    //Blog page && Portfolio page
    $query = "posts_per_page=10";
    if (isset($optionss['posts_perpage'])) {
        $query = "posts_per_page=" . $optionss['posts_perpage'];
    }
    if (isset($optionss['blog_categories'])) {
        $includecats = implode(',', (array) $optionss['blog_categories']);
        $includecats = $includecats ? "&category_name='" . $includecats . "'" : '';
        $query .= $includecats;
    }
    $query.="&paged=$paged" . $order;
} else {
    $query = $query_string != '' ? $query_string.$order."&paged=$paged" : "paged=$paged" . $order;
}

if(is_single()){$query="order=DESC&paged=$paged";}
query_posts($query);
while (have_posts()) : the_post();
    get_template_part('post');
endwhile;
wp_reset_query();

//////////////////CONTACT PAGE////////////////////
if (get_ID_by_slug($data['last_page']) && ($is_portfolio === true || $is_blog === true) && !isset($_REQUEST['infPaged'])) {
    query_posts('page_id=' . get_ID_by_slug($data['last_page']));
    while (have_posts()) : the_post();
        get_template_part('post');
    endwhile;
    wp_reset_query();
} ?>