<?php
/*
    Plugin Name: OCWS Newsbox
    Description: This plugin creates a little box on the page, with a small announcement or news item in it. It is achieved by a custom post type. each newsbox entry has its own shortcode.
    Author: Paul Taylor
    Version: 0.1
    Plugin URI: http://oldcastleweb.com/pws/plugins
    Author URI: http://oldcastleweb.com/pws/about
    License: GPL2
    GitHub Plugin URI: https://github.com/pftaylor61/ocws-newsbox
    GitHub Branch:     master
*/

/* Essential Initialization Definitions */
define('OCWSNB_SLUG', 'ocwsnewsbox');
define('OCWSNB_NAME_SG', 'Newsbox');
define('OCWSNB_NAME_PL', 'Newsboxes');
define("OCWSNB_BASE_DIR",dirname(__FILE__));
define("OCWSNB_BASE_URL",plugins_url( '', __FILE__ ));
define("OCWSNB_IMAGES_URL",OCWSNB__BASE_URL."/images");



function ocwsnb_init() {
    // add_shortcode('ocwssl-shortcode', 'ocwssl_function');
    wp_register_style('newsbox_styles', OCWSNB_BASE_URL.'/ocws-newsbox-styles.css');
    wp_enqueue_style('newsbox_styles');
    $args = array(
        'public' => true,
        'labels' => array(
					'name' => __( OCWSNB_NAME_PL , OCWSNB_SLUG),
					'singular_name' => __( OCWSNB_NAME_SG , OCWSNB_SLUG),
					'add_new' => __( 'Add New', OCWSNB_SLUG ),
					'add_new_item' => __( 'Add New '.OCWSNB_NAME_SG, OCWSNB_SLUG ),
					'edit_item' => __( 'Edit '.OCWSNB_NAME_SG, OCWSNB_SLUG ),
					'new_item' => __( 'New '.OCWSNB_NAME_SG, OCWSNB_SLUG ),
					'view_item' => __( 'View '.OCWSNB_NAME_SG, OCWSNB_SLUG ),
					'search_items' => __( 'Search '.OCWSNB_NAME_PL, OCWSNB_SLUG ),
					'not_found' => __( 'No '.OCWSNB_NAME_PL.' found', OCWSNB_SLUG ),
					'not_found_in_trash' => __( 'No '.OCWSNB_NAME_PL.' found in Trash', OCWSNB_SLUG ),
					'parent_item_colon' => __( 'Parent '.OCWSNB_NAME_SG.':', OCWSNB_SLUG ),
					'menu_name' => __( OCWSNB_NAME_PL, OCWSNB_SLUG ),
                         ),
        'menu_icon'   => 'dashicons-testimonial',
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
        )
    );
    register_post_type('ocwsnb_newsbox', $args);
    
    
    
    
    


} // end function ocwsnb_init

add_action('init', 'ocwsnb_init');


if (!function_exists('ocwsnb_newsbox_output')){
    function ocwsnb_newsbox_output($atts) {
        
        $content_post = get_post($atts['nbid']);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        
        $newsbox = '<div id="ocwsnb_'.$atts['nbid'].'" class="ocwsnb_newsbox">';
        $newsbox .= '<strong>Newsbox:</strong><br />';
        $newsbox .= $content;
        $newsbox .= '</div><!-- end div ocwsnb_'.$atts['nbid'].' -->';
        
        return $newsbox;
    } // end function ocwsnb_newsbox_output
} // end if (protecting ocwsnb_newsbox_output)

add_shortcode( 'newsbox', 'ocwsnb_newsbox_output' );

//----------------edit custom columns display for back-end
add_action("manage_ocwsnewsbox_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-ocwsnewsbox_columns", "my_newsbox_columns");
 
function my_newsbox_columns($columns) //this function display the columns headings
{
    $columns2 = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Newsbox Title",
        "nbsc" => "Shortcode",
        "desc" => "New Content",
        "date" => "Date",
    );
    return $columns2;
}
 
function my_custom_columns($column, $post_id)
{
    $content_post = get_post($post_id);
    $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
    if ("nbsc" == $column) {
        echo $post_id; //displays title
    } elseif ("desc" == $column) {
        echo $content;
    } else {
        echo "x";
    }
}


?>