<?php
/*
* Actions
*/
function msr_footer_text(){
    echo 'coppy right &copy; 2025. MSR Plugin';
}
add_action('wp_footer','msr_footer_text', 20);

function msr_meta_info(){
    if ( is_singular('post') ) {
        $title = get_the_title();
        $desc  = get_the_excerpt();
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($desc) . '" />' . "\n";
    }
}
add_action('wp_head', 'msr_meta_info');


/*
* Filters
*/
function msr_post_title($title){
    if(is_singular('post')){
    $emoji = '🤪';
    return $emoji . $title;
    }
    return $title;
}
add_filter('the_title','msr_post_title');

function msr_excerpt_length($excerpt){
 return 20;
}
add_filter('excerpt_length','msr_excerpt_length',999);

function msr_post_content($title){
    if(is_singular('post')){
    $emoji = '<h1>Overview</h1>';
    return $emoji . $title;
    }
    return $title;
}
add_filter('the_content','msr_post_content');