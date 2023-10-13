<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Adds widget: Rs Author Info Box
class Rswpbs_Books_List_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'books_list',
			esc_html__( '[ RS WP THEMES ] Books List', 'rswpbs' )
		);

	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['widget_title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['widget_title'] ) . $args['after_title'];
		}

		$show_book_image = isset($instance['show_book_image']) ? $instance['show_book_image'] : false;
		$show_book_title = isset($instance['show_book_title']) ? $instance['show_book_title'] : false;
		$show_author_name = isset($instance['show_author_name']) ? $instance['show_author_name'] : false;
		$show_book_price = isset($instance['show_book_price']) ? $instance['show_book_price'] : false;
		$booksPerPage = isset($instance['books_posts_per_page']) ? $instance['books_posts_per_page'] : 10;

		$booksQargs = array(
			    'post_type'      => 'book',
			    'post_status'    => 'publish',
			    'posts_per_page' => absint( $booksPerPage ),
			    'orderby'	=> 'date',
			);
		$getBooks = get_posts($booksQargs);
		?>
		<div class="rswpthemes-book-list-widget-area-wrapper">
			<?php
			if ($getBooks) :
				foreach($getBooks as $book) :
					$bookImage = rswpbs_get_book_image($book->ID);
					$bookName = rswpbs_get_book_name($book->ID);
					$bookAuthor = rswpbs_get_book_author($book->ID);
					$bookprice = rswpbs_get_book_price($book->ID);

			?>
			<div class="rswpthemes-book-list-widget-area-inner">
				<?php
				if ($show_book_image) :
				?>
				<div class="book-image">
					<a href="<?php echo esc_url(get_the_permalink($book->ID)); ?>"><?php echo wp_kses_post($bookImage); ?></a>
					<div class="book-view-button">
						<a href="<?php echo esc_url(get_the_permalink($book->ID)); ?>"><?php esc_html_e( 'View Book', 'rswpbs' );?></a>
					</div>
				</div>
				<?php
				endif;
				if ($show_book_title) :
				?>
				<div class="book-name">
					<h2><a href="<?php echo esc_url(get_the_permalink($book->ID));?>"><?php echo esc_html($bookName);?></a></h2>
				</div>
				<?php
				endif;
				if ($show_author_name) :
				?>
				<div class="book-author">
					<h4><strong><?php esc_html_e('By ', 'rswpbs'); ?></strong> <?php echo wp_kses_post($bookAuthor); ?> </h4>
				</div>
				<?php endif;
				if($show_book_price) :
				?>
				<div class="book-price">
					<?php echo wp_kses_post($bookprice); ?>
				</div>
				<?php endif; ?>
			</div>
			<?php
			endforeach;
		endif; ?>
		</div>
		<?php
		echo $args['after_widget'];
		wp_reset_query();
	}

	public function form( $instance ) {
	    $widget_title = ! empty( $instance['widget_title'] ) ? $instance['widget_title'] : __( 'Book List', 'text_domain' );
	    $show_book_image = ! empty( $instance['show_book_image'] ) ? $instance['show_book_image'] : false;
	    $show_book_title = ! empty( $instance['show_book_title'] ) ? $instance['show_book_title'] : false;
	    $show_author_name = ! empty( $instance['show_author_name'] ) ? $instance['show_author_name'] : false;
	    $show_book_price = ! empty( $instance['show_book_price'] ) ? $instance['show_book_price'] : false;
	    $show_buy_now_button = ! empty( $instance['show_buy_now_button'] ) ? $instance['show_buy_now_button'] : false;
	    $books_posts_per_page = ! empty( $instance['books_posts_per_page'] ) ? $instance['books_posts_per_page'] : 4;
	    ?>
	    <p>
	      <label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php _e( 'Widget Title:' ); ?></label>
	      <input class="widefat" id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>">
	    </p>
	    <p>
	    <label for="<?php echo esc_attr( $this->get_field_id( 'books_posts_per_page' ) ); ?>"><?php esc_attr_e( 'Books Posts Per Page:', RSWPBS_TEXT_DOMAIN ); ?></label>
	    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'books_posts_per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'books_posts_per_page' ) ); ?>" type="number" value="<?php echo esc_attr( $books_posts_per_page ); ?>">
	  	</p>
	    <p>
		    <input class="checkbox" type="checkbox" <?php checked( $show_book_image ); ?> id="<?php echo $this->get_field_id( 'show_book_image' ); ?>" name="<?php echo $this->get_field_name( 'show_book_image' ); ?>" />
		    <label for="<?php echo $this->get_field_id( 'show_book_image' ); ?>"><?php _e( 'Show Book Image' ); ?></label>
		 </p>
		<p>
	      <input class="checkbox" type="checkbox" <?php checked( $show_book_title ); ?> id="<?php echo $this->get_field_id( 'show_book_title' ); ?>" name="<?php echo $this->get_field_name( 'show_book_title' ); ?>" />
	      <label for="<?php echo $this->get_field_id( 'show_book_title' ); ?>"><?php _e( 'Show Book Title' ); ?></label>
	    </p>
	    <p>
	      <input class="checkbox" type="checkbox" <?php checked( $show_author_name ); ?> id="<?php echo $this->get_field_id( 'show_author_name' ); ?>" name="<?php echo $this->get_field_name( 'show_author_name' ); ?>" />
	      <label for="<?php echo $this->get_field_id( 'show_author_name' ); ?>"><?php _e( ' Show Book Author' ); ?></label>
	    </p>
	    <p>
	      <input class="checkbox" type="checkbox" <?php checked( $show_book_price ); ?> id="<?php echo $this->get_field_id( 'show_book_price' ); ?>" name="<?php echo $this->get_field_name( 'show_book_price' ); ?>" />
	      <label for="<?php echo $this->get_field_id( 'show_book_price' ); ?>"><?php _e( ' Show Book Price' ); ?></label>
	    </p>
	    <?php
  }
	public function update( $new_instance, $old_instance ) {
	  $instance = array();
	  $instance['widget_title'] = ( ! empty( $new_instance['widget_title'] ) ) ? sanitize_text_field( $new_instance['widget_title'] ) : '';
	  $instance['books_posts_per_page'] = ( ! empty( $new_instance['books_posts_per_page'] ) ) ? intval( $new_instance['books_posts_per_page'] ) : '';
	  $instance['show_book_image'] = ! empty( $new_instance['show_book_image'] ) ? 1 : 0;
	  $instance['show_book_title'] = ! empty( $new_instance['show_book_title'] ) ? 1 : 0;
	  $instance['show_author_name'] = ! empty( $new_instance['show_author_name'] ) ? 1 : 0;
	  $instance['show_book_price'] = ! empty( $new_instance['show_book_price'] ) ? 1 : 0;
	  return $instance;
	}

}

function rswpbs_books_list_widget_register() {
	register_widget( 'Rswpbs_Books_List_Widget' );
}
add_action( 'widgets_init', 'rswpbs_books_list_widget_register' );