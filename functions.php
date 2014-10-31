<?php
/*
*  Functions built by Mayconnect.
*/

add_action('after_setup_theme','launch_this_trispel_theme');

// Setup contet
if ( ! isset( $content_width ) )
  $content_width = 960;

function launch_this_trispel_theme() {
  // remove_filter( 'excerpt_length', 'custom_excerpt_length', 999);
  // add_filter( 'excerpt_length', 'custom_excerpt_length', 999);
  // remove_filter( 'excerpt_more', 'new_excerpt_more');
  // add_filter( 'excerpt_more', 'new_excerpt_more');
}

remove_action( 'wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'feed_links_extra'); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links'); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version


function remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 ); // remove WP version from css
add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 ); // remove Wp version from scripts

function disable_version() {
   return '';
}
add_filter('the_generator','disable_version');

///=============================================
// SCRIPTS AND STYLES ENQUEUING
//=============================================


// Deregistering styles and scripts that might be in the wp core.
// Registering all kinds of cool styles and scripts.

function scripts_and_styles() {
  if (!is_admin()) {

    wp_deregister_script('jquery');
    wp_deregister_style( 'functions-style-css');
    wp_deregister_style( 'twentythirteen-style-css');

    if ( ! is_page( 'contact' ) ) {
      wp_deregister_style( 'contact-form-7' );
    }
    // register main stylesheets
    wp_register_style( 'stylesheet', get_stylesheet_directory_uri() . '/stylesheets/style.css', array(), '', 'all' );

    // Add Google Webfonts to your site, used in the main stylesheet.
    wp_enqueue_style( 'googleweb-fonts', googleweb_fonts_url(), array(), null );

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
    wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/js/jquery.min.js', array(), '', false );
    wp_register_script( 'html5-script', get_stylesheet_directory_uri() . '/js/html5.js', array( 'jquery' ), '', false );
    wp_register_script( 'modern-script', get_stylesheet_directory_uri() . '/js/modernizr.custom.min.js', array( 'jquery' ), '', false );
    wp_register_script( 'trispel-script', get_stylesheet_directory_uri() . '/js/trispel.js', array(  ), '', false );

    // enqueue styles and scripts
    wp_enqueue_style( 'stylesheet' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'html5-script' );
    wp_enqueue_script( 'modern-script' );
    wp_enqueue_script( 'trispel-script' );
  }
}

function deregister_contact_form() {
    if ( ! is_page( 'contact' ) ) {
      remove_action('wp_enqueue_scripts', 'wpcf7_enqueue_scripts');
    }
}

add_action('wp_enqueue_scripts', 'scripts_and_styles', 999);
add_action( 'wp', 'deregister_contact_form');

///=============================================
// 1A. LOAD GOOGLE WEBFONTS
//=============================================
// Copied from TwentyThirteen Theme

function googleweb_fonts_url() {
  $fonts_url = '';

  /* Translators: If there are characters in your language that are not
   * supported by Source Sans Pro, translate this to 'off'. Do not translate
   * into your own language.
   */
  $source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'jeroentrispe;' );

  /* Translators: If there are characters in your language that are not
   * supported by Oswald, translate this to 'off'. Do not translate into your
   * own language.
   */
  $oswald = _x( 'on', 'Oswald font: on or off', 'jeroentrispel' );

  $lora =  _x( 'on', 'Lora font: on or off', 'jeroentrispel' );

    if ( 'off' !== $source_sans_pro || 'off' !== $oswald || 'off' !== $lora ) {
      $font_families = array();

    if ( 'off' !== $source_sans_pro )
      $font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

    if ( 'off' !== $oswald )
      $font_families[] = 'Oswald:400,700,300';

    if ( 'off' !== $lora )
      $font_families[] = 'Lora:400,700,400italic,700italic';

    $query_args = array(
      'family' => urlencode( implode( '|', $font_families ) ),
      'subset' => urlencode( 'latin,latin-ext' ),
    );
    $fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
  }

  return $fonts_url;
}

//=============================================
// Add edit button for any specific content you
// wish to edit.
//=============================================
function jeroentrispel_edit_link() {
  if ( ! post_password_required()) :
    edit_post_link( __( 'Edit', '' ), '<span class="edit-link">', '</span>' );
    endif;
}

//============================================
// Theme Support
//============================================
add_theme_support( 'post-formats', array( 'none', 'gallery', 'link', 'image', 'quote', 'video' ) );
add_theme_support( 'custom-background' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

add_post_type_support( 'work', 'post-formats' );
$args = array(
  'supports' => array('title', 'editor', 'author', 'post-formats')
);
register_post_type('work', $args);


// the main menu
function main_menu(){
  wp_nav_menu(
    array(
      'theme_location'  => 'main-menu',
      'menu'            => 'main-menu',
      'container'       => false,
      'container_class' => '',
      'container_id'    => '',
      'menu_class'      => 'main-menu',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul>%3$s</ul>',
      'depth'           => 0,
      'walker'          => ''
    ),
    array(
      'theme_location'  => 'social-menu',
      'menu'            => '',
      'container'       => false,
      'container_class' => '',
      'container_id'    => '',
      'menu_class'      => 'social-menu',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul>%3$s</ul>',
      'depth'           => 0,
      'walker'          => ''
    ));
  } /* end mayconnect main nav */

function register_all_menus() {
  register_nav_menus(array( // Using array to specify more menus if needed
    'main-menu' => __('Main Menu', 'jeroentrispel'), // Main Navigation
    'social-menu' => __('Social Menu', 'jeroentrispel'), // Menu for the social icons
    // 'extra-menu' => __('Extra Menu', 'classy') // Extra Navigation if needed (duplicate as many as you need!)
  ));
}
add_action( 'init', 'register_all_menus' );


function main_sidebar() {
  register_sidebar( array(
    'name'          => __( 'Sidebar Menu', 'jeroentrispel' ),
    'id'            => 'sidebar-menu',
    'description'   => __( 'Sidebar that goes on the default pages', 'text_domain' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'main_sidebar' );


// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
  return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}


//=============================================
// META INFORMATION
//=============================================
// This was taken from the twentythirteen theme. I adapted it.
if ( ! function_exists( 'classy_entry_meta' ) ) :

  function classy_entry_meta() {
    if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
        mayconnect_entry_date();

      // Translators: used between list items, there is a space after the comma.
      $categories_list = get_the_category_list( __( ', ', 'mayconnect' ) );
      if ( $categories_list ) {
        echo '<span class="categories-links">' . $categories_list . '</span>';
      }

      // Translators: used between list items, there is a space after the comma.
      // $tag_list = get_the_tag_list( '', __( ', ', 'mayconnect' ) );
      // if ( $tag_list ) {
      //   echo '<span class="tags-links">' . $tag_list . '</span>';
      // }

      // Post author
      if ( 'post' == get_post_type() ) {
        printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
          esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
          esc_attr( sprintf( __( 'View all posts by %s', 'classy' ), get_the_author() ) ),
          get_the_author()
        );
      }
    }
  endif;

if ( ! function_exists( 'classy_entry_date' ) ) :

  function trispel_entry_date( $echo = true ) {
    if ( has_post_format( array( 'chat', 'status' ) ) )
      $format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'trispel' );
    else
      $format_prefix = '%2$s';

    $date = sprintf( '<span class="date"><time class="entry-date" datetime="%3$s">%4$s</time></span>',
      esc_url( get_permalink() ),
      esc_attr( sprintf( __( 'Permalink to %s', 'classy' ), the_title_attribute( 'echo=0' ) ) ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
    );

    if ( $echo )
      echo $date;
    return $date;
  }

endif;


?>
