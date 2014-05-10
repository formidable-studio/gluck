<?php

add_theme_support( 'post-thumbnails' );

if ( function_exists('register_sidebar') )
    register_sidebar(array('name'=>'Sidebar'));

if ( function_exists('register_nav_menus') )
    register_nav_menus(
       array(
          'main_menu'	=> __('Menu principal')
          )
       );


add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(360, 540, true);

add_image_size( 'collection-image', 9999, 540 );

wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'ICanHaz',      get_template_directory_uri() . '/js/ICanHaz.min.js', array(), '0.10.2', true );
wp_enqueue_script( 'jQueryForm',   get_template_directory_uri() . '/js/jquery.form.min.js', array('jquery'), '20131121', true );
wp_enqueue_script( 'skrollr',      get_template_directory_uri() . '/js/skrollr.min.js', array(), '0.6.23', true );
wp_enqueue_script( 'skrollrMenu',  get_template_directory_uri() . '/js/skrollr.menu.min.js', array('skrollr'), '0.1.11', true );
wp_enqueue_script( 'history',      get_template_directory_uri() . '/js/jquery.history.js', array('jquery'), '1', true );
wp_enqueue_script( 'jscrollpane',  get_template_directory_uri() . '/scrollpane/jquery.jscrollpane.min.js', array('jquery'), '2.0.14', true );
wp_enqueue_script( 'mousewheel',   get_template_directory_uri() . '/scrollpane/jquery.mousewheel.js', array('jscrollpane'), '2.0.14', true );
wp_enqueue_script( 'mwheelIntent', get_template_directory_uri() . '/scrollpane/mwheelIntent.js', array('mousewheel'), '1.2', true );
wp_enqueue_script( 'fancybox',     get_template_directory_uri() . '/fancybox/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true );
wp_enqueue_script( 'isotope',      get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '1.5.25', true );
wp_enqueue_script( 'fitvid',        get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.1', true);
//wp_enqueue_script( 'gluck',        get_template_directory_uri() . '/js/script.js', array('jquery','skrollr','isotope','fancybox','history','ICanHaz','jQueryForm','jscrollpane'), '1', true );


/**
 * cf http://www.tcbarrett.com/2011/09/wordpress-the_slug-get-post-slug-function/#.UlcszBYnYhY
 * @param  boolean $echo [description]
 * @return [type]        [description]
 */
function the_slug($echo=true){
	$slug = basename(get_permalink());
	do_action('before_slug', $slug);
	$slug = apply_filters('slug_filter', $slug);
	if( $echo ) echo $slug;
	do_action('after_slug', $slug);
	return $slug;
}




if( ! function_exists (my_register_post_types)) {
	function my_register_post_types() {

		register_post_type(
			'collection',
			array(
				'label' => __('Collections'),
				'singular_label' => __('Collection'),
				'public' => true,
				'show_ui' => true,
				//'show_in_menu' => false,
				//'menu_icon'=> get_bloginfo('template_directory') .'/images/favicon.png',
				'show_in_nav_menus'=> false,
				'capability_type' => 'post',
				'rewrite' => array("slug" => "collection"),
				'hierarchical' => false,
				'query_var' => false,
				'supports' => array('title','thumbnail'),
				//'taxonomies' => 
             )
          );	
	}
}


// on enregistre les types de posts, taxonomies
if ( function_exists('my_register_post_types') )
    add_action( 'init', 'my_register_post_types' );




add_filter( 'rest_api_allowed_post_types', 'allow_my_post_types');

function allow_my_post_types($allowed_post_types) {
	if (! defined('REST_API_REQUEST') || ! REST_API_REQUEST)
		return $allowed_post_types;
	$allowed_post_types[] = 'collection';
	return $allowed_post_types;
}



/**
 * POUR AJOUTER LE SUPPORT DES CHAMPS ACF A L'API JSON
 */
add_filter('json_api_encode', 'json_api_encode_acf');

function json_api_encode_acf($response) 
{
    if (isset($response['posts'])) {
        foreach ($response['posts'] as $post) {
            json_api_add_acf($post); // Add specs to each post
        }
    } 
    else if (isset($response['post'])) {
        json_api_add_acf($response['post']); // Add a specs property
    }

    return $response;
}

function json_api_add_acf(&$post) 
{
    $post->acf = get_fields($post->id);
}


/**
 * sert à vérifier le nom du fichier de gabarit
 * @param  String $filename		le nom du fichier à vérifier
 * @return Boolean           	renvoie true si le nom correspond, false dans le cas contraire
 */
function ckeckTemplate($filename){

	$template_name = basename( get_page_template() );

	if($template_name == $filename){
		return true;
	}else{
		return false;
	}

}

// define( 'SHOPP_TEMP_PATH', dirname( dirname(__FILE__) ) . '/shopp_temp/');


// http://brassblogs.com/tutorials/making-child-categories-recognize-parent-displays
// 
// ** http://wordpress.stackexchange.com/questions/4557/how-can-i-make-all-subcategories-use-the-template-of-its-category-parent
// Use a parent category slug if it exists
/*function child_force_category_template($template) {
    $cat = get_query_var('cat');
    $category = get_category($cat);

    if ( file_exists(TEMPLATEPATH . '/category-' . $category->cat_ID . '.php') ) {
        $cat_template = TEMPLATEPATH . '/category-' . $category ->cat_ID . '.php';
    } elseif ( file_exists(TEMPLATEPATH . '/category-' . $category->slug . '.php') ) {
        $cat_template = TEMPLATEPATH . '/category-' . $category ->slug . '.php';
    } elseif ( file_exists(TEMPLATEPATH . '/category-' . $category->category_parent . '.php') ) {
        $cat_template = TEMPLATEPATH . '/category-' . $category->category_parent . '.php';
    } else {
        // Get Parent Slug
        $cat_parent = get_category($category->category_parent);

        if ( file_exists(TEMPLATEPATH . '/category-' . $cat_parent->slug . '.php') ) {
            $cat_template = TEMPLATEPATH . '/category-' . $cat_parent->slug . '.php';
        } else {
            $cat_template = $template;
        }

    }

    return $cat_template;
}
add_action('category_template', 'child_force_category_template');*/

// make category use parent category template
function load_cat_parent_template($template) {

    $cat_ID = absint( get_query_var('cat') );
    $category = get_category( $cat_ID );

    $templates = array();

    if ( !is_wp_error($category) )
        $templates[] = "category-{$category->slug}.php";

    $templates[] = "category-$cat_ID.php";

    // trace back the parent hierarchy and locate a template
    if ( !is_wp_error($category) ) {
        $category = $category->parent ? get_category($category->parent) : '';

        if( !empty($category) ) {
            if ( !is_wp_error($category) )
                $templates[] = "category-{$category->slug}.php";

            $templates[] = "category-{$category->term_id}.php";
        }
    }

    $templates[] = "category.php";
    $template = locate_template($templates);

    return $template;
}
add_action('category_template', 'load_cat_parent_template');



add_action('shopp_storefront_init', 'shopp_storefront_wp37_compat');

function shopp_storefront_wp37_compat() {
    add_filter('archive_template', array(ShoppStorefront(), 'pages'));
}


// Schedule our callback after the Shopp actions get added
add_action('wp','disable_shopp_resources',100);

function disable_shopp_resources() {
    // prevent errors when Shopp isn't activated
    if ( ! function_exists('shopp') ) return;

    // Disable all of Shopp's CSS
    $Storefront = ShoppStorefront();
    if ($Storefront) {
        remove_action('wp_head',array(&$Storefront,'header'));
        remove_action('wp_print_styles',array(&$Storefront, 'catalogcss'));
    }

    // Disable jQuery completely (for all plugins)
    // wp_deregister_script('jquery');

    // Disable the core Shopp behaviors
    // shopp_deregister_script('shopp');

    // Disable the catalog behaviors (product gallery, slideshows, etc)
    shopp_deregister_script('catalog');

    // Disable the Shopp Colorbox implementation
    shopp_deregister_script('colorbox');

    // Disable the cart behaviors (AJAX-cart, etc)
    shopp_deregister_script('cart');

    // Disable the pop-up calendar behaviors
    shopp_deregister_script('calendar');

    // Disable the Shopp checkout handlers (including form validation)
    // Only loaded on the checkout form page
    shopp_deregister_script('checkout');

}


/*

http://stackoverflow.com/questions/10132685/json-api-to-show-advanced-custom-fields-wordpress


add_filter('json_api_encode', 'json_api_encode_acf');


function json_api_encode_acf($response) 
{
    if (isset($response['posts'])) {
        foreach ($response['posts'] as $post) {
            json_api_add_acf($post); // Add specs to each post
        }
    } 
    else if (isset($response['post'])) {
        json_api_add_acf($response['post']); // Add a specs property
    }

    return $response;
}

function json_api_add_acf(&$post) 
{
    $post->acf = get_fields($post->id);
}
 */