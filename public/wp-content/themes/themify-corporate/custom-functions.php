<?php

// custom excerpt length
function themify_custom_excerpt_length( $length ) {
return 25;
}
add_filter( 'excerpt_length', 'themify_custom_excerpt_length', 999 );

// add more link to excerpt
function themify_custom_excerpt_more($more) {
global $post;
return '<a class="more-link" href="'. get_permalink($post->ID) . '">'. __('<br>Leia mais...', 'themify') .'</a>';
}
add_filter('excerpt_more', 'themify_custom_excerpt_more');
?>
<?php //
//function breadcrumbs_on_post_start(){
//if(function_exists('bcn_display')){
//echo '<div class="breadcrumbs">';
//bcn_display();
//echo '</div>';
//}
//}
//add_action('themify_post_start', 'breadcrumbs_on_post_start');
?>