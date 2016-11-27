<?php
class Post_Tabs_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'posts_widget',
			__( 'magazine Post Tabs', 'tophot' ),
			array( 'description' => esc_html__( 'A Post Widget', 'tophot' ), )
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		$item_nr = "";
		$category = "";
		$title = "";
		$orderby = "";
		$widget_id = "";

		if ( ! empty( $instance['item_nr'] ) ) { $item_nr = $instance['item_nr'];	}
		if ( ! empty( $instance['category'] ) ) { $category = $instance['category'];	}
		if ( ! empty( $instance['title'] ) ) { $title = $instance['title'];	}
		if ( ! empty( $instance['orderby'] ) ) { $orderby = $instance['orderby'];	}

		echo do_shortcode("[posts_tabs item_nr='$item_nr' orderby='$orderby' category='$category' title='$title']");

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$item_nr = ! empty( $instance['item_nr'] ) ? $instance['item_nr'] : esc_html__( '', 'tophot' );
		$category = ! empty( $instance['category'] ) ? $instance['category'] : esc_html__( '', 'tophot' );
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'tophot' );
		$orderby = ! empty( $instance['orderby'] ) ? $instance['orderby'] : esc_html__( '', 'tophot' );
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'item_nr' ) ); ?>"><?php _e( esc_attr( 'Item Nr:' ) ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'item_nr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item_nr' ) ); ?>" type="text" value="<?php echo esc_attr( $item_nr ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php _e( esc_attr( 'Category slug:' ) ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" type="text" value="<?php echo esc_attr( $category ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php _e( esc_attr( 'OrderBy:' ) ); ?></label>
			<select class='widefat' id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" type="text">
				<option value='date'<?php echo ($orderby=='date')?'selected':''; ?>>Date</option>
				<option value='popular'<?php echo ($orderby=='popular')?'selected':''; ?>>Most Viewed</option>
				<option value='comment_count'<?php echo ($orderby=='comment_count')?'selected':''; ?>>Comment Count</option>
				<option value='rand'<?php echo ($orderby=='rand')?'selected':''; ?>>Random</option>
				<option value='title'<?php echo ($orderby=='title')?'selected':''; ?>>Title</option>
				<option value='shares'<?php echo ($orderby=='shares')?'selected':''; ?>>Shares</option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>



		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['item_nr'] = ( ! empty( $new_instance['item_nr'] ) ) ? strip_tags( $new_instance['item_nr'] ) : '';
		$instance['category'] = ( ! empty( $new_instance['category'] ) ) ? strip_tags( $new_instance['category'] ) : '';
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
		return $instance;
	}

}

function register_post_tabs_widget() {
    register_widget( 'Post_Tabs_Widget' );
}
add_action( 'widgets_init', 'register_post_tabs_widget' );
?>
