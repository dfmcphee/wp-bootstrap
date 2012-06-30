<?php

class Seeds_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'socialize_bootstrap_widget', // Base ID
			'Socialize Bootstrap Widget', // Name
			array( 'description' => __( 'Seeds Widget', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		
		global $post;
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo '<hr/>';
		
		if (isset( $instance['twitter'] )) {
			$link = 'http://twitter.com/' . $instance['twitter'];
			$this->display_link($link, 'twitter', 'Follow on Twitter', 'btn-info');
		}
		
		if (isset( $instance['linkedin'] )) {
			$link = $instance['linkedin'];
			$this->display_link($link, 'linkedin', 'Connect on Linked In', 'btn-primary');
		}
		
		if (isset( $instance['github'] )) {
			$link = 'http://github.com/' . $instance['github'];
			$this->display_link($link, 'github', 'Follow on Github');
		}
		
		echo '<hr/>';
		
		if ($link = get_post_meta($post->ID, 'github-url', true)) {
			$this->display_github_link($link);
		}

		if ($link = get_post_meta($post->ID, 'site-link-url', true)) {
			$this->display_link($link, 'leaf', 'View Site');
		}
	}
	
	/**
	 * Output Socialize Link
	 *
	 * @param string $link URL for link href
	 * @param string $network Network link is for 
	 * @param string $text Message to display
	 * @param string $network (Optional) Add class to btn    
	 */
	public function display_link( $link, $network, $text, $class = '' ) {
		?>		
				<div class="social-link">
					<a href=" <?= $link ?>" class="btn btn-large btn-icons <?= $class ?>"><i class="icon-<?= $network ?>"></i> <?= $text ?></a>
				</div>
		<?php
	}
	
	/**
	 * Output Socialize Download Link
	 *
	 * @param string $network Socialize value saved     
	 */
	public function display_github_link( $link ) {
		?>		
			<div class="btn-group">
			  <a class="btn btn-main" href="<?= $link ?>"> <i class="icon-github"></i> View on Github</a>
			  <a class="btn btn-sub dropdown-toggle" data-toggle="dropdown" href="#">
			    <i class="icon-download-alt"></i>
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
			    <a href="<?= $link ?>"></i></a>
			    <a href="<?= $link ?>/zipball/master"> Download from Github</a>
			  </ul>
			</div>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		// Check if any fields have been saved
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		
		if ( isset( $instance[ 'twitter' ] ) ) {
			$twitter = $instance[ 'twitter' ];
		}
		else {
			$twitter = __( '', 'text_domain' );
		}
		
		if ( isset( $instance[ 'linkedin' ] ) ) {
			$linkedin = $instance[ 'linkedin' ];
		}
		else {
			$linkedin = __( '', 'text_domain' );
		}
		
		if ( isset( $instance[ 'github' ] ) ) {
			$github = $instance[ 'github' ];
		}
		else {
			$github = __( '', 'text_domain' );
		}
		
			
		// Output the inputs
?>		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter Username:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'Linked In Profile URL:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'github' ); ?>"><?php _e( 'Github Username:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'github' ); ?>" name="<?php echo $this->get_field_name( 'github' ); ?>" type="text" value="<?php echo esc_attr( $github ); ?>" />
		</p>
		
<?php }
	
}