<?php 

/* =================== 
* Shortcode to show sub category items with there thumbnails
* =================== */
function skr_prod_cats_thumb_nav( $atts ) {

    $cate = get_queried_object();
    $cateID = $cate->term_id;

    $args_query = array(
        'taxonomy' => 'product_cat', 
        'hide_empty' => false, 
        'child_of' => $cate->term_id
    );

    $args_query_get_trm = get_terms( $args_query );

    foreach( $args_query_get_trm as $args_query_get_trm_v ){
      // echo '<pre>'; print_r($args_query_get_trm_v); echo '</pre>'; 
        $cat_link = get_term_link( $args_query_get_trm_v->term_id, 'product_cat' );
        
        $thumbnail_id = get_term_meta( $args_query_get_trm_v->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        if ( $image ) {
            echo '<a href="'. $cat_link .'">'. $args_query_get_trm_v->name .'<img src="' . $image . '" alt="' . $args_query_get_trm_v->name . '" /></a><br>';
        }
    }
}
add_shortcode( 'skr_products_by_category', 'skr_prod_cats_thumb_nav' );



/* =================== 
* To show category menu in category page top
* =================== */
add_action('woocommerce_before_main_content', 'skr_cat_nav_in_cat_arc', 333);
function skr_cat_nav_in_cat_arc(){

    wp_nav_menu( 
        array( 
            'theme_location' => 'category_primary_nav'
        ) 
    );
}

/* =================== 
* register_nav_menu
* =================== */
function skr_custom_menu() {
    register_nav_menu('category_primary_nav',__( 'Category primary nav' ));
}
add_action( 'init', 'skr_custom_menu' );

