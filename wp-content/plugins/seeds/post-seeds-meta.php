<?php
/** 
 * The meta data for the Socialize post meta box when editing posts
 */
class SeedsBox {
    const LANG = 'some_textdomain';

    public function __construct() {
        add_action( 'add_meta_boxes', array( &$this, 'add_social_post_meta_box' ) );
    }

    /**
     * Adds the meta box container
     */
    public function add_social_post_meta_box() {
        add_meta_box( 
             'SeedsBoxBox'
            ,__( 'Social Links', self::LANG )
            ,array( &$this, 'render_meta_box_content' )
            ,'post' 
            ,'advanced'
            ,'high'
        );
    }
    
    /**
     * Render Meta Box content
     */
    public function render_meta_box_content() {
	    $link = get_post_meta($_GET['post'], 'site-link-url', true);
	    $github = get_post_meta($_GET['post'], 'github-url', true);
	    
	    ?>
	    
	    <p>
	    	<label for="site-link-url">External URL: </label>
	    	<input name="site-link-url" class="seed-input" type="text" value="<?= $link ?>" />
	    </p>
	    
	    <p>
	    	<label for="github-url">GitHub: </label>
	    	<input name="github-url" class="seed-input" type="text" value="<?= $github ?>" />
	    </p>
	    
	    <?php
    }
}

// register Socialize widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Seeds_Widget" );' ) );

/**
 * Enqueue JavaScript in footer
 */
function seeds_admin_js() {
    wp_enqueue_script('seeds_main', plugins_url('js/main.js', __FILE__));
}

/**
 * Calls the class on the post edit screen
 */
function callSeedsBox() {
    return new SeedsBox();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'callSeedsBox' );
    add_action('admin_footer', 'seeds_admin_js');
}