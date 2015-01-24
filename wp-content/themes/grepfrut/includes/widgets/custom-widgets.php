<?php
/**
 * Custom Widgets
 *
 * @package WordPress
 * @subpackage Grepfrut
 * @Grepfrut 1.0
 *
 */

/**
 * Custom Recent Posts Widget
 *
 */
class TCSN_Widget_Recent_Posts extends WP_Widget {
	
    //Register widget with WordPress
	function __construct() {
		$widget_ops = array('classname' => 'tcsn_widget_recent_entries', 'description' => __( 'The most recent posts on your site', 'tcsn_theme') );
		parent::__construct('tcsn-custom-recent-posts', __('Custom - Recent Posts', 'tcsn_theme'), $widget_ops);
		$this->alt_option_name = 'tcsn_widget_recent_entries';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}
	
	// Front-end display of widget
	function widget($args, $instance) {
		$cache = wp_cache_get('tcsn_custom_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
		if ( ! $number )
 			$number = 10;
		$post_thumb = isset( $instance['post_thumb'] ) ? $instance['post_thumb'] : false;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$excerpt = isset( $instance['excerpt'] ) ? $instance['excerpt'] : false;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
?>
<?php echo $before_widget; ?>
<?php if ( !empty($instance['title']) ){
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		} ?>
<ul class="custom-recent-entries">
    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
    <?php ?>
    <li class="clearfix"> <span class="custom-recent-entries-meta clearfix">
        <?php if($instance['post_thumb']){ ?>
        <span class="custom-recent-entries-thumb"> <?php echo get_the_post_thumbnail(); ?></span>
        <?php } ?>
         <?php if($instance['show_date']){ ?>
      
        <span class="custom-recent-entries-date"><?php echo get_the_date(); ?></span>
        <?php } ?>
        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
        <?php if ( get_the_title() ) the_title(); else the_ID(); ?>
        </a> </span>
        <?php if($instance['excerpt']){ ?>
        <span class="custom-recent-entries-excerpt"> <?php echo wp_trim_words( get_the_excerpt() , 15, "... <a class='read-more' href='". get_permalink() ."'> <?php _e( 'Read More', 'tcsn_theme' ); ?></a>" ); ?> </span>
        <?php } ?>
    </li>
    <?php endwhile; ?>
</ul>
<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('tcsn_custom_recent_posts', $cache, 'widget');
	}
	
	// Sanitize widget form values as they are saved
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['post_thumb'] = (bool)$new_instance['post_thumb'];  
		$instance['show_date'] = (bool)$new_instance['show_date'];  
		$instance['excerpt'] = (bool)$new_instance['excerpt'];  

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['tcsn_widget_recent_entries']) )
			delete_option('tcsn_widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('tcsn_custom_recent_posts', 'widget');
	}
	
	// Back-end widget form
	function form( $instance ) {
		// Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number' => 1, 'post_thumb' => 1, 'show_date' => 1, 'excerpt' => 1, ) );
	
?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e( 'Title:', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'number' ); ?>">
        <?php _e( 'Number of posts to show:', 'tcsn_theme' ); ?>
    </label>
    <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $instance['number']; ?>" size="3" />
</p>
<p>
    <input type="checkbox" id="<?php echo $this->get_field_id( 'post_thumb' ); ?>" name="<?php echo $this->get_field_name( 'post_thumb' ); ?>" value="1" <?php echo ($instance['post_thumb'] == "true" ? "checked='checked'" : ""); ?> />
    <label for="<?php echo $this->get_field_id( 'post_thumb' ); ?>">
        <?php _e('Display thumbnail?', 'tcsn_theme') ?>
    </label>
</p>
<p>
    <input type="checkbox" id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" value="1" <?php echo ($instance['show_date'] == "true" ? "checked='checked'" : ""); ?> />
    <label for="<?php echo $this->get_field_id( 'show_date' ); ?>">
        <?php _e('Display post date?', 'tcsn_theme') ?>
    </label>
</p>
<p>
    <input type="checkbox" id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" value="1" <?php echo ($instance['excerpt'] == "true" ? "checked='checked'" : ""); ?> />
    <label for="<?php echo $this->get_field_id( 'excerpt' ); ?>">
        <?php _e('Display excerpt?', 'tcsn_theme') ?>
    </label>
</p>
<?php
	}
} // class TCSN_Widget_Recent_Posts


/**
 * Custom Tag cloud Widget
 *
 */
class TCSN_Widget_Tag_Cloud extends WP_Widget {
	
	//Register widget with WordPress
	function __construct() {
		$widget_ops = array( 'description' => __( 'Your most used tags in cloud format', 'tcsn_theme') );
		parent::__construct('tcsn-custom-tag-cloud', __( 'Custom - Tag Cloud', 'tcsn_theme' ), $widget_ops);
	}

	// Front-end display of widget
	function widget( $args, $instance ) {
		extract( $args );
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags', 'tcsn_theme');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<div class="custom-tagcloud clearfix">';
		wp_tag_cloud( 'number=18', apply_filters('tcsn_widget_tag_cloud_args', array('taxonomy' => $current_taxonomy) ) );
		echo "</div>\n";
		echo $after_widget;
	}
	
	// Sanitize widget form values as they are saved
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		return $instance;
	}
	
	// Back-end widget form
	function form( $instance ) {
		
		$current_taxonomy = $this->_get_current_taxonomy($instance);
?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e( 'Title:', 'tcsn_theme' ) ?>
    </label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('taxonomy'); ?>">
        <?php _e( 'Taxonomy:', 'tcsn_theme' ) ?>
    </label>
    <select class="widefat" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
        <?php foreach ( get_taxonomies() as $taxonomy ) :
				$tax = get_taxonomy($taxonomy);
				if ( !$tax->show_tagcloud || empty($tax->labels->name) )
					continue;
	?>
        <option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo $tax->labels->name; ?></option>
        <?php endforeach; ?>
    </select>
</p>
<?php
	}

	function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
} // class TCSN_Widget_Tag_Cloud

/**
 * Custom Flickr Feed widget
 *
 */

class TCSN_Widget_Flicker_Feed extends WP_Widget {

	 //Register widget with WordPress
	function __construct() {
		$widget_ops = array( 'classname' => 'tcsn_widget_flickr', 'description' => __( 'Flickr photo stream', 'tcsn_theme' ), );
		parent::__construct('tcsn-custom-flickr-feed', __( 'Custom - Flickr Feed', 'tcsn_theme' ), $widget_ops);
	}
	
	//Register widget with WordPress
	function widget( $args, $instance ) {

		extract( $args );
		
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		echo $before_widget;
		
		if ( !empty($instance['title']) ){
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}
		
		echo '<div class="flickr-feed clearfix">';
			echo'<script src="http://www.flickr.com/badge_code_v2.gne?count='. $instance['number'] .'&amp;display='. $instance['sortby'] .'&amp;size=s&amp;layout=x&amp;source=user&amp;user='. $instance['flickr_id'] .'"></script>';
		echo '</div>';

		echo $after_widget;
	}

	// Sanitize widget form values as they are saved
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['sortby'] = strip_tags( $new_instance['sortby'] );
		
		return $instance;
	}
	
	// Back-end widget form
	function form( $instance )
	{   
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'flickr_id' => '52617155@N08', 'number' => '6', 'sortby' => 'latest', ) );
		
 ?>
<p>
  <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
    <?php _e( 'Title :', 'tcsn_theme' ); ?>
  </label>
  <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
</p>
<p>
<p>
  <label for="<?php echo $this->get_field_id('flickr_id'); ?>">
    <?php _e( 'Flickr ID : <a href="http://idgettr.com/" target="_blank">Get your flickr ID</a>', 'tcsn_theme' ); ?>
  </label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" value="<?php echo $instance['flickr_id']; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('number'); ?>">
    <?php _e( 'Number of photos to show (max 10) :', 'tcsn_theme' ) ?>
  </label>
  <input class="widefat" type="text" style="width: 25px;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('sortby'); ?>">
    <?php _e( 'Sort by :', 'tcsn_theme' ); ?>
  </label>
  <select name="<?php echo $this->get_field_name('sortby'); ?>" id="<?php echo $this->get_field_id('sortby'); ?>" class="widefat">
    <option value="latest"<?php selected($instance['sortby'], 'latest'); ?>>
    <?php _e( 'latest', 'tcsn_theme' ); ?>
    </option>
    <option value="random"<?php selected($instance['sortby'], 'random'); ?>>
    <?php _e( 'random', 'tcsn_theme' ); ?>
    </option>
  </select>
</p>
<?php
	}
} // class TCSN_Widget_Flicker_Feed


/**
 * Custom Twitter Feed Widget
 *
 */

class TCSN_Widget_Twitter_Feed extends WP_Widget {
	
	//Register widget with WordPress
	function __construct() {
		$widget_ops = array( 'classname' => 'tcsn_widget_twitter', 'description' => __( 'Twitter feed widget', 'tcsn_theme' ), );
		parent::__construct('tcsn-custom-twitter-feed', __( 'Custom - Twitter Feed', 'tcsn_theme' ), $widget_ops);
	}
	
	// Front-end display of widget
	function widget( $args, $instance )
	{
		extract( $args );
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$consumer_key = $instance['consumer_key'];
		$consumer_secret = $instance['consumer_secret'];
		$user_token = $instance['user_token'];
		$user_secret = $instance['user_secret'];
		$twitter_id = $instance['twitter_id'];
		$count = (int) $instance['count'];

		echo $before_widget;
		
		if ( !empty($instance['title']) ){
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		if( $consumer_key && $consumer_secret && $user_token && $user_secret && $twitter_id && $count ) { 
		$transName = 'list-tweets-'.$args['widget_id'];
		$cacheTime = 10;
		if( false === ( $twitterData = get_transient($transName) ) ) {
		     // require Twitter OAuth class
		     @require_once 'twitteroauth/twitteroauth.php';
		     $twitterConnection = new TwitterOAuth(
							$consumer_key,	   // App Consumer Key
							$consumer_secret,  // App Consumer secret
							$user_token,       // App Access token
							$user_secret       // App Access token secret
							);
		    $twitterData = $twitterConnection->get(
							  'statuses/user_timeline',
							  array(
							    'screen_name'     => $twitter_id,
							    'count'           => $count,
							    'exclude_replies' => false,
							    'include_rts'     => true, // true to include RT's or false to exclude them
							  )
							);
		     if( $twitterConnection->http_code != 200 )
		     {
				 // Get the value of a transient
		          $twitterData = get_transient( $transName );
		     }

		     // Set/update the value of a transient
		     set_transient( $transName, $twitterData, 60 * $cacheTime );
		};
		$tweets = get_transient( $transName );
		if( $tweets && is_array( $tweets ) ) {
			
		?>
<div id="twitter-<?php echo $args['widget_id']; ?>">
    <ul class="list-twitter">
        <?php foreach( $tweets as $tweet ): ?>
        <li>
            <?php
				// Access as an object
				$tweetLatest = $tweet->text;
				
				$tweetLatest = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $tweetLatest);
				// #
        		$tweetLatest = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1<a target="_blank" href="https://twitter.com/search?q=%23\2&src=hash">#\2</a>', $tweetLatest);
				// @
				$tweetLatest = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $tweetLatest);
								echo $tweetLatest;
			?>
            <span class="tweet-time"><small>
        
            <?php
				$tweetTime = strtotime($tweet->created_at);
				$timeAgo = $this->ago($tweetTime);
			?>

            <a href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>"><?php echo $timeAgo; ?></a> </small></span> </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php }}
		
		echo $after_widget;
	}
	
	function ago( $time )
	{
	   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	   $lengths = array("60","60","24","7","4.35","12","10");

	   $now = time();

	       $difference = $now - $time;
	       $tense      = "ago";

	   for( $j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++ ) {
	       $difference /= $lengths[$j];
	   }

	   $difference = round( $difference );

	   if( $difference != 1 ) {
	       $periods[$j].= "s";
	   }

	   return "$difference $periods[$j] $tense ";
	}
	
	// Sanitize widget form values as they are saved
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['consumer_key'] = $new_instance['consumer_key'];
		$instance['consumer_secret'] = $new_instance['consumer_secret'];
		$instance['user_token'] = $new_instance['user_token'];
		$instance['user_secret'] = $new_instance['user_secret'];
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['count'] = $new_instance['count'];

		return $instance;
	}
	
	// Back-end widget form
	function form( $instance )
	{   
			//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'consumer_key' => '', 'consumer_secret' => '', 'user_token' => '', 'user_secret' => '', 'twitter_id' => '', 'count' => '',  ) );
		
 ?>
<p><a href="http://dev.twitter.com/apps" target="_blank">Find or Create your Twitter App</a></p>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e('Title:', 'tcsn_theme'); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('consumer_key'); ?>">
        <?php _e('App Consumer Key :', 'tcsn_theme'); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" type="text" value="<?php echo $instance['consumer_key']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('consumer_secret'); ?>">
        <?php _e('App Consumer Secret :', 'tcsn_theme'); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" type="text" value="<?php echo $instance['consumer_secret']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('user_token'); ?>">
        <?php _e('App Access Token :', 'tcsn_theme'); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('user_token'); ?>" name="<?php echo $this->get_field_name('user_token'); ?>" type="text" value="<?php echo $instance['user_token']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('user_secret'); ?>">
        <?php _e('App Access Token Secret :', 'tcsn_theme'); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('user_secret'); ?>" name="<?php echo $this->get_field_name('user_secret'); ?>" type="text" value="<?php echo $instance['user_secret']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('twitter_id'); ?>">
        <?php _e('Twitter Username :', 'tcsn_theme'); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $instance['twitter_id']; ?>" />
</p>
<label for="<?php echo $this->get_field_id('count'); ?>">
    <?php _e('Number of Tweets :', 'tcsn_theme'); ?>
</label>
<input class="widefat" style="width: 25px;" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $instance['count']; ?>" />
</p>

<?php
	}
} // class TCSN_Widget_Twitter_Feed


/**
 * Custom Facebook Like Widget
 *
 */
class TCSN_Widget_Facebook_Like extends WP_Widget {
	
	//Register widget with WordPress
	function __construct() {
		$widget_ops = array( 'classname' => 'tcsn_widget_facebook_like', 'description' => __( 'Facebook like box', 'tcsn_theme' ), );
		parent::__construct('tcsn-custom-facebook-like', __( 'Custom - Facebook Like Box', 'tcsn_theme' ), $widget_ops);
	}
	
	// Front-end display of widget
	function widget( $args, $instance )
	{
		extract( $args );
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$page_url = $instance['page_url'];
		$color_scheme = $instance['color_scheme'];
		$width = $instance['width'];
		$show_faces = ($instance['show_faces'] == "1" ? "true" : "false"); 
		$show_header = ($instance['show_header'] == "1" ? "true" : "false"); 
		$show_stream = ($instance['show_stream'] == "1" ? "true" : "false"); 
		$show_border = ($instance['show_border'] == "1" ? "true" : "false"); 
		
		$height = '63';
		
		if($show_faces == 'true') {
			$height = '240';
		}
		
		if($show_header == 'true') {
			$height = $height + 30;
		}
		
		if($show_stream == 'true') {
			$height = '400';
		}

		if($show_stream == 'true' && $show_faces == 'true' && $show_header == 'true') {
			$height = '538';
		}

		if($show_stream == 'true' && $show_faces == 'true' && $show_header == 'false') {
			$height = '542';
		}
		
		echo $before_widget;

		if ( !empty($instance['title']) ){
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		if($page_url): ?>
<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($page_url); ?>&amp;width=<?php echo $width; ?>&amp;height=<?php echo $height; ?>&amp;colorscheme=<?php echo $color_scheme; ?>&amp;show_faces=<?php echo $show_faces; ?>&amp;header=<?php echo $show_header; ?>&amp;stream=<?php echo $show_stream; ?>&amp;show_border=<?php echo $show_border; ?><?php if($show_faces == 'true'): ?>&amp;connections=8<?php endif; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
<?php endif;
		
		echo $after_widget;
	}
	
	// Sanitize widget form values as they are saved
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['page_url'] = $new_instance['page_url'];
		$instance['width'] = strip_tags( $new_instance['width'] );  
		$instance['color_scheme'] = $new_instance['color_scheme'];
		$instance['show_faces'] = (bool)$new_instance['show_faces'];  
		$instance['show_header'] = (bool)$new_instance['show_header']; 
		$instance['show_stream'] = (bool)$new_instance['show_stream']; 
		$instance['show_border'] = (bool)$new_instance['show_border'];   
   				
		return $instance;
	}
	
	// Back-end widget form
	function form( $instance )
	{	
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'page_url' => '', 'width' => '300', 'color_scheme' => 'light', 'show_faces' => false, 'show_stream' => false, 'show_header' => false, 'show_border' => true, ) );
		?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e('Title :', 'tcsn_theme') ?>
    </label>
    <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('page_url'); ?>">
        <?php _e('Facebook Page URL :', 'tcsn_theme') ?>
    </label>
    <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('page_url'); ?>" name="<?php echo $this->get_field_name('page_url'); ?>" type="text" value="<?php echo $instance['page_url']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('width'); ?>">
        <?php _e('Like Box Width :', 'tcsn_theme') ?>
    </label>
    <input class="widefat" style="width: 50px;" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $instance['width']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('color_scheme'); ?>">
        <?php _e( 'Color Scheme :', 'tcsn_theme' ); ?>
    </label>
    <select name="<?php echo $this->get_field_name('color_scheme'); ?>" id="<?php echo $this->get_field_id('color_scheme'); ?>" class="widefat">
        <option value="light"<?php selected($instance['color_scheme'], 'light'); ?>>
        <?php _e( 'Light', 'tcsn_theme' ); ?>
        </option>
        <option value="dark"<?php selected($instance['color_scheme'], 'dark'); ?>>
        <?php _e( 'Dark', 'tcsn_theme' ); ?>
        </option>
    </select>
</p>
<p>
    <input type="checkbox" id="<?php echo $this->get_field_id( 'show_faces' ); ?>" name="<?php echo $this->get_field_name( 'show_faces' ); ?>" value="1" <?php echo ($instance['show_faces'] == "true" ? "checked='checked'" : ""); ?> />
    <label for="<?php echo $this->get_field_id( 'show_faces' ); ?>">
        <?php _e('Show Faces', 'tcsn_theme') ?>
    </label>
</p>
<p>
    <input type="checkbox" id="<?php echo $this->get_field_id( 'show_header' ); ?>" name="<?php echo $this->get_field_name( 'show_header' ); ?>" value="1" <?php echo ($instance['show_header'] == "true" ? "checked='checked'" : ""); ?> />
    <label for="<?php echo $this->get_field_id( 'show_header' ); ?>">
        <?php _e('Show Header', 'tcsn_theme') ?>
    </label>
</p>
<p>
    <input type="checkbox" id="<?php echo $this->get_field_id( 'show_stream' ); ?>" name="<?php echo $this->get_field_name( 'show_stream' ); ?>" value="1" <?php echo ($instance['show_stream'] == "true" ? "checked='checked'" : ""); ?> />
    <label for="<?php echo $this->get_field_id( 'show_stream' ); ?>">
        <?php _e('Show Stream', 'tcsn_theme') ?>
    </label>
</p>
<p>
    <input type="checkbox" id="<?php echo $this->get_field_id( 'show_border' ); ?>" name="<?php echo $this->get_field_name( 'show_border' ); ?>" value="1" <?php echo ($instance['show_border'] == "true" ? "checked='checked'" : ""); ?> />
    <label for="<?php echo $this->get_field_id( 'show_border' ); ?>">
        <?php _e('Show border', 'tcsn_theme') ?>
    </label>
</p>
<?php
	}
} // class TCSN_Widget_Facebook_Like

/**
 * Custom Contact info widget
 *
 */

class TCSN_Widget_Contact_Info extends WP_Widget {
	
	//Register widget with WordPress
	function __construct() {
		$widget_ops = array( 'classname' => 'tcsn_widget_conatct_info', 'description' => __( 'Contact info', 'tcsn_theme' ), );
		parent::__construct('tcsn-custom-contact-info', __( 'Custom - Contact Info', 'tcsn_theme' ), $widget_ops);
	}
	
	function widget( $args, $instance )
	{
		extract( $args );
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$address = apply_filters( 'widget_text', empty( $instance['address'] ) ? '' : $instance['address'], $instance );

		echo $before_widget;

		if ( !empty($instance['title']) ){
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}
		?>
<div class="widget-contact-info">
	<?php if($instance['address']): ?>
    <div class="widget-address clearfix"><span class="address-icon"></span><?php echo !empty( $instance['filter'] ) ? wpautop( $address ) : $address; ?></div>
     <?php endif; ?>
    <?php if($instance['phone']): ?>
    <div class="widget-phone"><span class="phone-icon"></span><?php echo $instance['phone']; ?></div>
    <?php endif; ?>
    <?php if($instance['fax']): ?>
    <div class="widget-fax"><span class="fax-icon"></span><?php echo $instance['fax']; ?></div>
    <?php endif; ?>
    <?php if($instance['email']): ?>
    <div class="widget-mail"><span class="mail-icon"></span><a href="mailto:<?php echo $instance['email']; ?>">
        <?php if($instance['emailtxt']) { echo $instance['emailtxt']; } else { echo $instance['email']; } ?>
        </a></div>
    <?php endif; ?>
    <?php if($instance['web']): ?>
    <div class="widget-web"><span class="link-icon"></span><a href="<?php echo $instance['web']; ?>" target="_blank">
        <?php if($instance['webtxt']) { echo $instance['webtxt']; } else { echo $instance['web']; } ?>
        </a></div>
    <?php endif; ?>
    <?php if($instance['twitterlink']): ?>
    <div class="widget-twitter"><span class="twitter-icon"></span><a href="<?php echo $instance['twitterlink']; ?>" target="_blank">
        <?php if($instance['twitterlinktxt']) { echo $instance['twitterlinktxt']; } else { echo $instance['twitterlink']; } ?>
        </a></div>
    <?php endif; ?>
    <?php if($instance['skypelink']): ?>
    <div class="widget-skype"><span class="skype-icon"></span><a href="<?php echo $instance['skypelink']; ?>" target="_blank">
        <?php if($instance['skypelinktxt']) { echo $instance['skypelinktxt']; } else { echo $instance['skypelink']; } ?>
        </a></div>
    <?php endif; ?>
</div>
<?php
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		
		if ( current_user_can('unfiltered_html') )
			$instance['address'] =  $new_instance['address'];
		else
			$instance['address'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['address']) ) ); // wp_filter_post_kses() expects slashed
			
		$instance['filter'] = isset($new_instance['filter']);
		$instance['phone'] = $new_instance['phone'];
		$instance['fax'] = $new_instance['fax'];
		$instance['email'] = $new_instance['email'];
		$instance['emailtxt'] = $new_instance['emailtxt'];
		$instance['web'] = $new_instance['web'];
		$instance['webtxt'] = $new_instance['webtxt'];
		$instance['twitterlink'] = $new_instance['twitterlink'];
		$instance['twitterlinktxt'] = $new_instance['twitterlinktxt'];
		$instance['skypelink'] = $new_instance['skypelink'];
		$instance['skypelinktxt'] = $new_instance['skypelinktxt'];

		return $instance;
	}

	function form( $instance )
	{
		// Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'address' => '', 'phone' => '', 'fax' => '', 'email' => '',  'emailtxt' => '', 'web' => '', 'webtxt' => '', 'twitterlink' => '', 'twitterlinktxt' => '', 'skypelink' => '', 'skypelinktxt' => '',  ) );

 ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e( 'Title :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('address'); ?>">
        <?php _e( 'Address :', 'tcsn_theme' ); ?>
    </label>
    <textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $instance['address']; ?></textarea>
</p>
<p>
    <input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />
    &nbsp;
    <label for="<?php echo $this->get_field_id('filter'); ?>">
        <?php _e( 'Automatically add paragraphs to address', 'tcsn_theme' ); ?>
    </label>
</p>
<p>
    <label for="<?php echo $this->get_field_id('phone'); ?>">
        <?php _e( 'Phone :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $instance['phone']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('fax'); ?>">
        <?php _e( 'Fax :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo $instance['fax']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('email'); ?>">
        <?php _e( 'Email address :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $instance['email']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('emailtxt'); ?>">
        <?php _e( 'Email Link Text :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('emailtxt'); ?>" name="<?php echo $this->get_field_name('emailtxt'); ?>" type="text" value="<?php echo $instance['emailtxt']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('web'); ?>">
        <?php _e( 'Website URL ( with http:// or https:// ) :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('web'); ?>" name="<?php echo $this->get_field_name('web'); ?>" type="text" value="<?php echo $instance['web']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('webtxt'); ?>">
        <?php _e( 'Website URL Text :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('webtxt'); ?>" name="<?php echo $this->get_field_name('webtxt'); ?>" type="text" value="<?php echo $instance['webtxt']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('twitterlink'); ?>">
        <?php _e( 'Twitter Link :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('twitterlink'); ?>" name="<?php echo $this->get_field_name('twitterlink'); ?>" type="text" value="<?php echo $instance['twitterlink']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('twitterlinktxt'); ?>">
        <?php _e( 'Twitter Link text :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('twitterlinktxt'); ?>" name="<?php echo $this->get_field_name('twitterlinktxt'); ?>" type="text" value="<?php echo $instance['twitterlinktxt']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('skypelink'); ?>">
        <?php _e( 'Skype Link :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('skypelink'); ?>" name="<?php echo $this->get_field_name('skypelink'); ?>" type="text" value="<?php echo $instance['skypelink']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('skypelinktxt'); ?>">
        <?php _e( 'Skype Link text :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('skypelinktxt'); ?>" name="<?php echo $this->get_field_name('skypelinktxt'); ?>" type="text" value="<?php echo $instance['skypelinktxt']; ?>" />
</p>
<?php
	}
} // class TCSN_Widget_Contact_Info

/**
 * Social Network Widget
 *
 */
class TCSN_Widget_Social_Network extends WP_Widget {
	
	//Register widget with WordPress
	function __construct() {
		$widget_ops = array( 'classname' => 'tcsn_widget_social_network', 'description' => __( 'Social network', 'tcsn_theme' ), );
		parent::__construct('tcsn-custom-social-network', __( 'Custom - Social Network', 'tcsn_theme' ), $widget_ops);
	}
	
	// Front-end display of widget
	function widget( $args, $instance ) {
	extract( $args );
	$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
	$socialtype['aim'] = $instance['aim'];
	$socialtype['behance'] = $instance['behance'];
	$socialtype['deviantart'] = $instance['deviantart'];
	$socialtype['dribbble'] = $instance['dribbble'];
	$socialtype['dropbox'] = $instance['dropbox'];
	$socialtype['facebook'] = $instance['facebook'];
	$socialtype['flickr'] = $instance['flickr'];
	$socialtype['forrst'] = $instance['forrst'];
	$socialtype['googleplus'] = $instance['googleplus'];
	$socialtype['lastfm'] = $instance['lastfm'];
	$socialtype['linkedin'] = $instance['linkedin'];
	$socialtype['picasa'] = $instance['picasa'];
	$socialtype['pinterest'] = $instance['pinterest'];
	$socialtype['skype'] = $instance['skype'];
	$socialtype['tumblr'] = $instance['tumblr'];
	$socialtype['twitter'] = $instance['twitter'];
	$socialtype['vimeo'] = $instance['vimeo'];
	$socialtype['yahoo'] = $instance['yahoo'];
	$socialtype['yelp'] = $instance['yelp'];
	$socialtype['youtube'] = $instance['youtube'];
	$socialtype['rss'] = $instance['rss'];
	
	echo $before_widget;
	
	if ( !empty($instance['title']) ){
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}
	?>
    
<ul class="social clearfix">
	<?php if($instance['aim']): ?>
    <li><a href="<?php echo $instance['aim']; ?>" target="_blank" class="aim-icon" title="aim"></a></li>
    <?php endif; ?>
    <?php if($instance['behance']): ?>
    <li><a href="<?php echo $instance['behance']; ?>" target="_blank" class="behance-icon" title="behance"></a></li>
    <?php endif; ?>
    <?php if($instance['deviantart']): ?>
    <li><a href="<?php echo $instance['deviantart']; ?>" target="_blank" class="deviantart-icon" title="deviantart"></a></li>
    <?php endif; ?>
    <?php if($instance['dribbble']): ?>
    <li><a href="<?php echo $instance['dribbble']; ?>" target="_blank" class="dribbble-icon"></a></li>
    <?php endif; ?>
    <?php if($instance['dropbox']): ?>
    <li><a href="<?php echo $instance['dropbox']; ?>" target="_blank" class="dropbox-icon"></a></li>
    <?php endif; ?>
    <?php if($instance['facebook']): ?>
    <li><a href="<?php echo $instance['facebook']; ?>" target="_blank" class="facebook-icon" title="facebook"></a></li>
    <?php endif; ?>
    <?php if($instance['flickr']): ?>
    <li><a href="<?php echo $instance['flickr']; ?>" target="_blank" class="flickr-icon" title="flickr"></a></li>
    <?php endif; ?>
     <?php if($instance['forrst']): ?>
    <li><a href="<?php echo $instance['forrst']; ?>" target="_blank" class="forrst-icon" title="forrst"></a></li>
    <?php endif; ?>
    <?php if($instance['googleplus']): ?>
    <li><a href="<?php echo $instance['googleplus']; ?>" target="_blank" class="googleplus-icon" title="googleplus"></a></li>
    <?php endif; ?>
    <?php if($instance['lastfm']): ?>
    <li><a href="<?php echo $instance['lastfm']; ?>" target="_blank" class="lastfm-icon" title="lastfm"></a></li>
    <?php endif; ?>
    <?php if($instance['linkedin']): ?>
    <li><a href="<?php echo $instance['linkedin']; ?>" target="_blank" class="linkedin-icon" title="linkedin"></a></li>
    <?php endif; ?>
    <?php if($instance['picasa']): ?>
    <li><a href="<?php echo $instance['picasa']; ?>" target="_blank" class="picasa-icon" title="picasa"></a></li>
    <?php endif; ?>
    <?php if($instance['pinterest']): ?>
    <li><a href="<?php echo $instance['pinterest']; ?>" target="_blank" class="pinterest-icon" title="pinterest"></a></li>
    <?php endif; ?>
    <?php if($instance['skype']): ?>
    <li><a href="<?php echo $instance['skype']; ?>" target="_blank" class="skype-icon" title="skype"></a></li>
    <?php endif; ?>
    <?php if($instance['tumblr']): ?>
    <li><a href="<?php echo $instance['tumblr']; ?>" target="_blank" class="tumblr-icon" title="tumblr"></a></li>
    <?php endif; ?>
    <?php if($instance['twitter']): ?>
    <li><a href="<?php echo $instance['twitter']; ?>" target="_blank" class="twitter-icon" title="twitter"></a></li>
    <?php endif; ?>
    <?php if($instance['vimeo']): ?>
    <li><a href="<?php echo $instance['vimeo']; ?>" target="_blank" class="vimeo-icon" title="vimeo"></a></li>
    <?php endif; ?>
    <?php if($instance['yahoo']): ?>
    <li><a href="<?php echo $instance['yahoo']; ?>" target="_blank" class="yahoo-icon" title="yahoo"></a></li>
    <?php endif; ?>
    <?php if($instance['yelp']): ?>
    <li><a href="<?php echo $instance['yelp']; ?>" target="_blank" class="yelp-icon" title="yelp"></a></li>
    <?php endif; ?>
    <?php if($instance['youtube']): ?>
    <li><a href="<?php echo $instance['youtube']; ?>" target="_blank" class="youtube-icon" title="youtube"></a></li>
    <?php endif; ?>
    <?php if($instance['rss']): ?>
    <li><a href="<?php echo $instance['rss']; ?>" target="_blank" class="rss-icon" title="rss"></a></li>
    <?php endif; ?>
</ul>
<?php
	echo $after_widget;
	}
	
	// Sanitize widget form values as they are saved
	function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['aim'] = $new_instance['aim'];
	$instance['behance'] = $new_instance['behance'];
	$instance['deviantart'] = $new_instance['deviantart'];
	$instance['dribbble'] = $new_instance['dribbble'];
	$instance['dropbox'] = $new_instance['dropbox'];
	$instance['facebook'] = $new_instance['facebook'];
	$instance['flickr'] = $new_instance['flickr'];
	$instance['forrst'] = $new_instance['forrst'];
	$instance['googleplus'] = $new_instance['googleplus'];
	$instance['lastfm'] = $new_instance['lastfm'];
	$instance['linkedin'] = $new_instance['linkedin'];
	$instance['picasa'] = $new_instance['picasa'];						
	$instance['pinterest'] = $new_instance['pinterest'];						
	$instance['skype'] = $new_instance['skype'];							
	$instance['tumblr'] = $new_instance['tumblr'];								
	$instance['twitter'] = $new_instance['twitter'];								
	$instance['vimeo'] = $new_instance['vimeo'];								
	$instance['yahoo'] = $new_instance['yahoo'];
	$instance['yelp'] = $new_instance['yelp'];
	$instance['youtube'] = $new_instance['youtube'];
	$instance['rss'] = $new_instance['rss'];

	return $instance;
	}
	
	// Back-end widget form
	function form( $instance ) {
		
		// Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'aim' => '', 'behance' => '', 'deviantart' => '', 'dribbble' => '', 'dropbox' => '', 'facebook' => '', 'flickr' => '', 'forrst' => '', 'googleplus' => '', 'lastfm' => '', 'linkedin' => '', 'picasa' => '', 'pinterest' => '', 'skype' => '', 'tumblr' => '', 'twitter' => '', 'vimeo' => '', 'yahoo' => '', 'yelp' => '', 'youtube' => '', 'rss' => '', ) );
		
	?>
<p>Enter the full URL. Leave the field blank, if do not want to display any social link.</p>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e( 'Title :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('aim'); ?>">
        <?php _e( 'Aim URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('aim'); ?>" name="<?php echo $this->get_field_name('aim'); ?>" type="text" value="<?php echo $instance['aim']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('behance'); ?>">
        <?php _e( 'Behance URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('behance'); ?>" name="<?php echo $this->get_field_name('behance'); ?>" type="text" value="<?php echo $instance['behance']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('deviantart'); ?>">
        <?php _e( 'Deviantart URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('deviantart'); ?>" name="<?php echo $this->get_field_name('deviantart'); ?>" type="text" value="<?php echo $instance['deviantart']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('dribbble'); ?>">
        <?php _e( 'Dribbble URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('dribbble'); ?>" name="<?php echo $this->get_field_name('dribbble'); ?>" type="text" value="<?php echo $instance['dribbble']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('dropbox'); ?>">
        <?php _e( 'Dropbox URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('dropbox'); ?>" name="<?php echo $this->get_field_name('dropbox'); ?>" type="text" value="<?php echo $instance['dropbox']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('facebook'); ?>">
        <?php _e( 'Facebook URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $instance['facebook']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('flickr'); ?>">
        <?php _e( 'Flickr URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo $instance['flickr']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('forrst'); ?>">
        <?php _e( 'Forrst URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('forrst'); ?>" name="<?php echo $this->get_field_name('forrst'); ?>" type="text" value="<?php echo $instance['forrst']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('googleplus'); ?>">
        <?php _e( 'Googleplus URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" name="<?php echo $this->get_field_name('googleplus'); ?>" type="text" value="<?php echo $instance['googleplus']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('lastfm'); ?>">
        <?php _e( 'Lastfm URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('lastfm'); ?>" name="<?php echo $this->get_field_name('lastfm'); ?>" type="text" value="<?php echo $instance['lastfm']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('linkedin'); ?>">
        <?php _e( 'Linkedin URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo $instance['linkedin']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('picasa'); ?>">
        <?php _e( 'Picasa URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('picasa'); ?>" name="<?php echo $this->get_field_name('picasa'); ?>" type="text" value="<?php echo $instance['picasa']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('pinterest'); ?>">
        <?php _e( 'Pinterest URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo $instance['pinterest']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('skype'); ?>">
        <?php _e( 'Skype URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" type="text" value="<?php echo $instance['skype']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('tumblr'); ?>">
        <?php _e( 'Tumblr URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" name="<?php echo $this->get_field_name('tumblr'); ?>" type="text" value="<?php echo $instance['tumblr']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('twitter'); ?>">
        <?php _e( 'Twitter URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $instance['twitter']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('vimeo'); ?>">
        <?php _e( 'Vimeo URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo $instance['vimeo']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('yahoo'); ?>">
        <?php _e( 'Yahoo URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('yahoo'); ?>" name="<?php echo $this->get_field_name('yahoo'); ?>" type="text" value="<?php echo $instance['yahoo']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('yelp'); ?>">
        <?php _e( 'Yelp URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('yelp'); ?>" name="<?php echo $this->get_field_name('yelp'); ?>" type="text" value="<?php echo $instance['yelp']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('youtube'); ?>">
        <?php _e( 'Youtube URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo $instance['youtube']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('rss'); ?>">
        <?php _e( 'RSS URL :', 'tcsn_theme' ); ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo $instance['rss']; ?>" />
</p>
<?php
	}
} // class TCSN_Widget_Social_Network

/**
 * Recent Works Widget
 *
 */
class TCSN_Widget_Recent_Works extends WP_Widget {
	
	//Register widget with WordPress
	function __construct() {
		$widget_ops = array( 'classname' => 'tcsn_widget_recent_works', 'description' => __( 'Recent form portfolio', 'tcsn_theme' ), );
		parent::__construct('tcsn-custom-recent-works', __( 'Custom - Recent Works', 'tcsn_theme' ), $widget_ops);
	}
	
	// Front-end display of widget
	function widget( $args, $instance ) {
		extract( $args );
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$number = $instance['number'];
		
		echo $before_widget;

		if ( !empty($instance['title']) ){
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}
		?>
		<div class="recent-works-wrapper clearfix">
		<?php
		$args = array(
			'post_type' => 'tcsn_portfolio',
			'posts_per_page' => $number
		);
		$portfolio = new WP_Query($args);
		if($portfolio->have_posts()):
		?>
		<?php while($portfolio->have_posts()): $portfolio->the_post(); ?>
		<ul class="recent-works">
        <li>
            <?php if (has_post_thumbnail()) { ?>
            	<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
            <?php } ?>
            </li>
       </ul>
		<?php endwhile; endif; ?>
		</div>

		<?php echo $after_widget;
	}
	
	// Sanitize widget form values as they are saved
	function update( $new_instance, $old_instance ) {  
	
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}
	
	// Back-end widget form
	function form( $instance ) {
		
		
		// Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number' => 1, ) );
 ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>">Number of items to show:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number']; ?>" />
		</p>
	<?php
	}
} // class TCSN_Widget_Recent_Works
 
/**
 * Register custom widgets
 *
 */
function tcsn_custom_widgets_init() {
	if ( !is_blog_installed() )
	return;
	
	register_widget( 'TCSN_Widget_Recent_Posts' );
	register_widget( 'TCSN_Widget_Tag_Cloud' );
	register_widget( 'TCSN_Widget_Flicker_Feed' );
	register_widget( 'TCSN_Widget_Twitter_Feed' );
	register_widget( 'TCSN_Widget_Facebook_Like' );
	register_widget( 'TCSN_Widget_Contact_Info' );
	register_widget( 'TCSN_Widget_Social_Network' );
	register_widget( 'TCSN_Widget_Recent_Works' );
}
add_action( 'widgets_init', 'tcsn_custom_widgets_init', 1 );