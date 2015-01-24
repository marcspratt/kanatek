<?php
/**
 * Grepfrut functions and definitions.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @since Grepfrut 1.0
 */

define( 'THEME_NAME', 'Grepfrut' );
define( 'THEME_VERSION', '2.0.5' );

// Helper functions
require_once (get_template_directory() . '/includes/helpers.php');

// Meta boxes
require_once (get_template_directory() . '/includes/meta-box/meta-box.php');

// Image resizer
require_once ( get_template_directory() . '/includes/aq_resizer.php' );

// Theme widgets / Sidebars
require_once (get_template_directory() . '/includes/widgets/sidebars.php');
require_once (get_template_directory() . '/includes/widgets/custom-widgets.php');

// Custom styles / Google fonts
require_once (get_template_directory() . '/includes/custom-styles.php');
require_once (get_template_directory() . '/includes/googlefonts.php');

// Custom Post Types
require_once (get_template_directory() . '/includes/plugins/portfolio-post-types.php');
require_once (get_template_directory() . '/includes/plugins/pricing-post-types.php');

// Social Share
require_once( get_template_directory() .'/includes/templates/social-share.php' );

// Recommend some useful plugins for this theme via TGMA script
require_once( get_template_directory() .'/includes/include-plugins.php' );

/**
 * Sets up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) )
	$content_width = 970;

/**
 * Theme only works in WordPress 3.6 or later.
 *
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/includes/bk-compatiblity.php';

/**
 * Sets up theme defaults and registers the various WordPress features that theme supports.
 *
 */
function tcsn_theme_setup() {
	
	// Makes theme available for translation.
	// Translations can be added to the /languages/ directory.
	load_theme_textdomain( 'tcsn_theme', get_template_directory() . '/languages' );
	
    //  Styles the visual editor to resemble the theme style,
	add_editor_style('css/editor-style.css');

    //  Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

    // Switches default core markup for search form, comment form, and comments 
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	// This theme supports all available post formats by default.
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'gallery', 'image', 'link', 'video'
	) );

	// Add Menu Support
    register_nav_menus( array(
        'primary_menu'   => 'Primary menu',
        'secondary_menu' => 'Secondary Menu'
    ) );

    // Thumbnail support
	add_theme_support( 'post-thumbnails' );
	add_image_size('portfolio-thumb', 530, 370, true);

}
add_action( 'after_setup_theme', 'tcsn_theme_setup' );

/**
 * Enqueue Scripts and Styles
 *
 */
function tcsn_theme_scripts_styles() {

		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array('jquery'), '2.6.2', false );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.0.2', true );
		wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'theme-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true );
		wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css', null, '3.0.2', 'all' );
		wp_enqueue_style( 'font', get_template_directory_uri() . '/css/iconfont.css' );
		wp_enqueue_style( 'style-main', get_stylesheet_directory_uri() . '/style.css', null, '1.0.0' );
		wp_enqueue_style( 'prettyPhoto-style', get_template_directory_uri() . '/css/prettyPhoto.css', null, '3.1.4', 'all ');
		wp_enqueue_style( 'owlcarousel-style', get_template_directory_uri() . '/css/owl.carousel.css' );
		wp_enqueue_style( 'elastislide-style', get_template_directory_uri() . '/css/elastislide.css', null, '1.0.0', 'all' );
		wp_enqueue_style( 'isotope-style', get_template_directory_uri() . '/css/isotope.css', null, '1.5.25' );
		wp_enqueue_style( 'bootstrap-override', get_template_directory_uri() . '/css/bootstrap-override.css', null, '1.0.0' );
		wp_enqueue_style( 'rev-custom-style', get_template_directory_uri() . '/css/rev-custom.css', null, '1.0.0', 'all' );
		wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', null, '1.0.0', 'all' );
		
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
		
		// To disable responsiveness
		wp_register_style( 'bootstrap-nonrs-style', get_template_directory_uri() . '/css/non-responsive.css', null, '1.0.0', 'all' );
		global $smof_data;
		if( $smof_data['tcsn_layout_responsive'] == 0 ) {
			wp_enqueue_style( 'bootstrap-nonrs-style' );
		}
}
add_action( 'wp_enqueue_scripts', 'tcsn_theme_scripts_styles' );

/**
 * Include SMOF
 *
 */
require_once('admin/index.php'); // Slightly Modified Options Framework

/**
 * Allow shortcodes in sidebar widgets	
 *
 */
add_filter( 'widget_text', 'do_shortcode' );


if ( ! function_exists( 'tcsn_post_meta' ) ) :
/**
 *
 * Prints HTML with meta information for current post: post format, author, date, categories and tags.
 *
 */
function tcsn_post_meta() {

	global $post;
	if ( ! is_page() && 'page' != $post->post_type ) {
		$post_footer_metadata = ( get_post_format() ? '<a class="post-format-meta" href="' . get_post_format_link( get_post_format() ) . '">' . get_post_format_string( get_post_format() ) . '</a>' : '' 		);
	} 
		echo '<span class="post-meta">' . $post_footer_metadata. '</span>'; 
		
	// Post author
	if ( 'post' == get_post_type() ) {
		printf( 'By <span class="author vcard margin-less"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span><span class="text-sep">/</span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'tcsn_theme' ), get_the_author() ) ),
			get_the_author()
		);
	}
	
	// Post date
	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		tcsn_post_date();
		
	// Categories
	$categories_list = get_the_category_list( __( ', ', 'tcsn_theme' ) );
	if ( $categories_list ) {
		echo 'in <span class="categories-links">' . $categories_list . '</span>';
	}
	
	// Tags
	if ( ! is_single() ) {
		$tag_list = get_the_tag_list( '', __( ', ', 'tcsn_theme' ) );
		if ( $tag_list ) {
			echo '<span class="text-sep">/</span> tags <span class="tags-links">' . $tag_list . '</span>';
		}
	}
	
	else {
		$tag_list = get_the_tag_list( '', __( ', ', 'tcsn_theme' ) );
	    if ( $tag_list ) {
		echo '<span class="text-sep">/</span> tags <span class="tags-links">' . $tag_list . '</span>';
	    }   
	}
}
endif;

if ( ! function_exists( 'tcsn_post_date' ) ) :
/**
 *
 * Prints HTML with date information for current post.
 *
 */
function tcsn_post_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'tcsn_theme' );
	else
		$format_prefix = '%2$s';
	$date = sprintf( '<span class="date updated">on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span><span class="text-sep">/</span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'tcsn_theme' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);
	if ( $echo )
		echo $date;
	return $date;
}
endif;

/**
 * Permalink for aside post format
 *
 */
add_filter( 'the_content', 'tcsn_aside_infinity', 9 ); // run before wpautop
function tcsn_aside_infinity( $content ) {
	if ( has_post_format( 'aside' ) && !is_singular() )
		$content .= '<a href="' . get_permalink() . '" class="aside-permalink"><span class="glyphicon glyphicon-link"></a>';
	return $content;
}

/**
 * Custom callback function for comment display
 *
 */
function tcsn_comment( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <div class="comment-author vcard">
            <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div>
        <?php printf( __( '<cite class="fn custom-fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
        <div class="comment-meta comment-metadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php
		/* translators: 1: date, 2: time */
		printf( __( '%1$s at %2$s', 'tcsn_theme' ), get_comment_date(),  get_comment_time() ); ?>
            </a>
            <?php edit_comment_link( __( '(Edit)', 'tcsn_theme' ), '&nbsp;&nbsp;', '' );
	?>
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
        </div>
        <div class="comment-text">
            <?php comment_text() ?>
        </div>
        <?php if ( '0' == $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation">
            <?php _e( 'Your comment is awaiting moderation.', 'tcsn_theme' ) ?>
        </p>
        <?php endif; ?>
    </div>
    <?php
} // end comment callback function


/**
 *
 * Visual Composer
 *
 */
if( function_exists('vc_set_as_theme') ) {
	
	//  Initialize Visual Composer as a part of theme
	vc_set_as_theme(true);

	// Remove elements from visual composer
	vc_remove_element("vc_separator");
	vc_remove_element("vc_text_separator");
	vc_remove_element("vc_button");
	vc_remove_element("vc_cta_button");
	vc_remove_element("vc_gallery");
	vc_remove_element("vc_images_carousel");
	vc_remove_element("vc_carousel");
	vc_remove_element("vc_button2");
	vc_remove_element("vc_cta_button2");
	vc_remove_element("vc_posts_grid");
	vc_remove_element("vc_posts_slider");
			
	// Remove VC Custom Teaser metabox
	if ( is_admin() ) {
		if ( ! function_exists('tcsn_remove_vc_custom_teaser') ) {
			function tcsn_remove_vc_custom_teaser(){
				$post_types = get_post_types( '', 'names' ); 
				foreach ( $post_types as $post_type ) {
					remove_meta_box('vc_teaser',  $post_type, 'side');
				}
			} 
		} 
	add_action('do_meta_boxes', 'tcsn_remove_vc_custom_teaser');
	}

/**
 * Custom Shortcodes in Visual Composer
 */

// Recent Posts Carousel
function tcsn_recentpost_sc( $atts, $content = null ) {
    extract ( shortcode_atts( array(
		'title'     => '',
		'thumbnail'	=> '',
		'excerpt'   => '',
		'date'   	=> '',
		'limit'     => -1,
		'order'     => '',
		'orderby'   => '',
		'cat'	    => '',
	), $atts ) );

	$cat = str_replace(' ','-',$cat);
	 
	global $post;
	$args = array(
		'post_type'      => '',
		'posts_per_page' => esc_attr( $limit ),
		'order'          => esc_attr( $order ), 
		'orderby'        => $orderby,
		'post_status'    => 'publish',
		'category_name'  => $cat, 
	);

	query_posts( $args );
	$output = '';
	if( have_posts() ) : 
		$output .= '<div class="recentpost-carousel wpb_custom_element">';
		while ( have_posts() ) : the_post();
			$output .= '<div class="item clearfix">';
			$permalink		= get_permalink();
			$thumb     		= get_post_thumbnail_id(); 
			$img_url   		= wp_get_attachment_url( $thumb, 'full' ); 
			$image       	= aq_resize( $img_url, 350, 220, true );
			$thumb_title	= get_the_title();	

			// thumbnail
			if( $thumbnail !== 'yes' ):
				if( has_post_thumbnail() ) { 
					$output .=  '<a href="' . $permalink . '" rel="bookmark"><img src="' . $image . '" alt="' . $thumb_title . '"/></a>';
				} 
			endif;	
			
			// title
			if( $title !== 'yes' ):
				$output .= '<h4 class="recentpost-heading"><a href="' . $permalink . '" rel="bookmark">' . get_the_title() . '</a></h4>';
			endif;	
			if( $date !== 'yes' ):
				$output .= '<span class="recentpost-date">' . get_the_date() . '</span>';
			endif;	
			// excerpt
			if($excerpt!=='yes'):	
				$output .= '<div class="recentpost-excerpt">';
				$content = get_the_excerpt();
				$content = wp_trim_words( $content , '35' );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$output .= $content;
				$output .= '<a href="' . $permalink . '" rel="bookmark" class="link-underline">Read More</a>';
				$output .= '</div>';
			endif;	

			$output .= '</div>';
		endwhile;
		$output .= '</div>';
		wp_reset_query();
	endif;
	return $output;
}
add_shortcode('recent_post', 'tcsn_recentpost_sc');

vc_map( array(
   "name"     => __( "Recent Post", "tcsn_theme" ),
   "base"     => "recent_post",
   "class"    => '',
   "icon"	  => "icon-wpb-bartag",
   "category" => __( 'Content', 'tcsn_theme' ),
   "params"   => array(
   	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Number of Posts to Show in Carousel", "tcsn_theme" ),
		"param_name"  => "limit",
		"value"       => __( "2", "tcsn_theme" ),
		"description" => '',
		),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Filter by Category", "tcsn_theme" ),
		"param_name"  => "cat",
		"value"       => '',
		"description" => "Filter output by posts categories, enter category names here. Separate with commas.",
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Sort Posts By", "tcsn_theme" ),
		"param_name"  => "orderby",
		"value"       => array ( 
			"Date"   => "date", 
			"Random" => "rand", 
			"Author" => "author", 
			"Title"  => "title", 
			),
		"description" => '',
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Arrange Sorted Posts", "tcsn_theme" ),
		"param_name"  => "order",
		"value"       => array ( "Descending" => "DESC", "Ascending" => "ASC" ),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Title", "tcsn_theme" ),
		"param_name"  => "title",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Date", "tcsn_theme" ),
		"param_name"  => "date",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Thumbnail", "tcsn_theme" ),
		"param_name"  => "thumbnail",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Post Excerpt", "tcsn_theme" ),
		"param_name"  => "excerpt",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => '',
		),
	)
) );

// Pricing
function tcsn_gr_pricing_sc( $atts, $content = null ) {
	extract ( shortcode_atts( array(
		'limit'     => '',
		'tax'       => '',
		'order'     => '',
		'orderby'   => '',
	), $atts ) );
	
	global $post;
	$args = array(
		'post_type'        => 'tcsn_pricing',
		'tcsn_pricingtags' => $tax,
		'posts_per_page'   => esc_attr( $limit ),
		'order'            => esc_attr( $order ), 
		'orderby'          => $orderby,
		'post_status'      => 'publish',
	);
	query_posts( $args );
	$output = '';
	if( have_posts() ) :
		$output .= '<div class="pricing  col-' . $limit . ' wpb_custom_element clearfix">';	
			while ( have_posts() ) : the_post();
				$pricing_type = rwmb_meta('rw_pricing_type', 'type=select');
				$pricing_slug = rwmb_meta('rw_pricing_slug', 'type=text'); 
				$pricing_currency = rwmb_meta('rw_pricing_currency', 'type=text'); 
				$pricing_price = rwmb_meta('rw_pricing_price', 'type=text'); 
				$pricing_cents = rwmb_meta('rw_pricing_cents', 'type=text'); 
	
				if ( $pricing_type == 1 ) { 
					$output .= '<div class="price-column focused">';
    			} else { 
	                $output .= '<div class="price-column">';
			 	}
				$output .='<div class="table-th">';
				
				if( $pricing_slug != ''  ) {
					$output .= '<p class="table-slug">' . $pricing_slug . '</p>';		
				}
				$output .='<h4>' . get_the_title() .'</h4><sup>' . $pricing_currency . '</sup>' . $pricing_price . '<sup>' . $pricing_cents . '</sup></div><div class="clearfix"></div>';
				$output .= '<div class="table-content clearfix">';
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$output .= $content;
				$output .= '</div>';
				$output .= '</div>';
			endwhile;
		$output .= '</div>';
		wp_reset_query();
	endif;
	return $output;
}
add_shortcode('pricing-table', 'tcsn_gr_pricing_sc');

vc_map( array(
   "name"                    => __( "Pricing", "tcsn_theme" ),
   "base"                    => "pricing-table",
   "class"                   => '',
   "icon"	                 => "icon-wpb-bartag",
   "category"                => __( 'Content', 'tcsn_theme' ),
    "params"     => array(
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Number of Columns", "tcsn_theme" ),
		"param_name"  => "limit",
		"value"       => array ( 
			"Three" => "3", 
			"Four"  => "4", 
			),
		"description" => '',
		),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Filter by Category", "tcsn_theme" ),
		"param_name"  => "tax",
		"value"       => '',
		"description" => "Enter --- <strong>CATEGORY SLUG</strong> --- here. Separate with commas.<br>Filter output by pricing categories.<br>This will help to group selected pricing columns in one table",
		),
		
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Sort Pricing Columns By", "tcsn_theme" ),
		"param_name"  => "orderby",
		"value"       => array ( 
			"Date"   => "date", 
			"Title"  => "title", 
			),
		"description" => '',
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Arrange Sorted Pricing Columns", "tcsn_theme" ),
		"param_name"  => "order",
		"value"       => array ( "Descending" => "DESC", "Ascending" => "ASC" ),
		"description" => '',
		),
	)
) );

// Portfolio Carousel
function tcsn_kr_portfolio_sc( $atts, $content = null ) {
    extract ( shortcode_atts( array(
		'heading'     => '',
		'limit'       => -1,
		'order'	      => '',
		'orderby'     => '',
		'tax'         => '',
	), $atts ) );

	global $post;
	$args = array(
		'post_type'          => 'tcsn_portfolio',
		'tcsn_portfoliotags' => $tax,
		'posts_per_page'     => esc_attr( $limit ),
		'order'              => esc_attr( $order ), 
		'orderby'            => $orderby,
		'post_status'        => 'publish',
	);
	
	query_posts( $args );
	$output = '';
	if( have_posts() ) :
		$output .= '<div class="portfolio-carousel wpb_custom_element">';	
		while ( have_posts() ) : the_post();
			$output .= '<div class="item clearfix">';
		 		$thumb       	= get_post_thumbnail_id(); 
				$img_url     	= wp_get_attachment_url( $thumb, 'full' ); 
				$image       	= aq_resize( $img_url, 300, 200, true );
				$thumb_title 	= get_the_title();
				$img_link    	=  get_permalink($post->ID);
				$permalink   	= get_permalink();
				$external_link	= rwmb_meta('rw_external_link', 'type=checkbox'); 
				$link_url 		= rwmb_meta('rw_link_url', 'type=text'); 

				if ( $external_link == 1 ) { 			
				  $return_style = '<div class="folio-thumb"><a href="' . $link_url . '"><img src="' . $image . '" alt="' . $thumb_title . '"/></div>';
				  } else { 
				  $return_style = '<div class="folio-thumb"><a href="' . $permalink . '"><img src="' . $image . '" alt="' . $thumb_title . '"/></div>';
				  }	
   				$output .= $return_style;	

				if( $heading !== 'yes' ):	
				$permalink = get_permalink();
				$output .= '<div class="item-title"><h5><a href="' . $permalink . '" rel="bookmark">' . get_the_title() .'</a></h5></div>';
				endif;	
				
			$output .= '</div>';
		endwhile;
		$output .= '</div>';
		wp_reset_query();
	endif;
	return $output;
}
add_shortcode('portfolio_carousel', 'tcsn_kr_portfolio_sc');

vc_map( array(
   "name"     => __( "Portfolio Carousel", "tcsn_theme" ),
   "base"     => "portfolio_carousel",
   "class"    => '',
   "icon"	  => "icon-wpb-bartag",
   "category" => __( 'Content', 'tcsn_theme' ),
   "params"   => array(
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Number of posts to show in carousel", "tcsn_theme" ),
		"param_name"  => "limit",
		"value"       => __( "6", "tcsn_theme" ),
		"description" => '',
		),
	array(
		"type"        => "textfield",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Filter by Category", "tcsn_theme" ),
		"param_name"  => "tax",
		"value"       => '',
		"description" => "Enter --- <strong>CATEGORY SLUG</strong> --- here. Separate with commas.<br>Find category slug here : Portfolio Items > Portfolio Categories<br>This will help to group portfolio items from selected categories in one carousel.",
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Sort Posts By", "tcsn_theme" ),
		"param_name"  => "orderby",
		"value"       => array (
			"Date"   => "date", 
			"Random" => "rand", 
			"Title"  => "title", 
			),
		"description" => '',
		),
	array(
		"type"        => "dropdown",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Arrange Sorted Posts", "tcsn_theme" ),
		"param_name"  => "order",
		"value"       => array ( "Descending" => "DESC", "Ascending" => "ASC"),
		"description" => '',
		),
	array(
		"type"        => "checkbox",
		"holder"      => "div",
		"class"       => '',
		"heading"     => __( "Hide Heading", "tcsn_theme" ),
		"param_name"  => "heading",
		"value"       => array ( "Yes, please" => "yes" ),
		"description" => "",
		),
	)
) );

// Add new shortcode
}