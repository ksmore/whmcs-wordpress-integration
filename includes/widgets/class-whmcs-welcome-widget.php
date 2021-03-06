<?php
class WHMCS_Welcome_Widget extends WP_Widget{

	public function __construct(){

		parent::__construct(
			'whmcs-welcome-widget',
			'WHMCS Welcome' ,
			array( 'description' => __('Displays the current WHMCS user, my details and WHMCS logout link, If not logged in prompts for the user to login.',WHMCS_TEXT_DOMAIN) ) );

	}

	public function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title;

		echo do_shortcode( '[wcp_welcome]' );

		echo $after_widget;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

}