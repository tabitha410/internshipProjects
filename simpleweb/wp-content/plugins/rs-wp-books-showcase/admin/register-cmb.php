<?php
/**
 * Register Custom Meta Box For Book Post Type
 */

class Rswpbs_Cmb_For_Book
{

	private $prefix = '_rsbs_';
	public function __construct()
	{
		add_action('add_meta_boxes', array($this, 'register_meta_boxes_for_book'));
		add_action('save_post', array($this, 'book_information_save'));
	}

	public function register_meta_boxes_for_book()
	{
		/**
		 * Added New Meta Box For Book Information
		 */
		add_meta_box(
			'book_information',
			esc_html__( 'Book Information', RSWPBS_TEXT_DOMAIN ),
			array($this, 'book_information_fields_render'),
			'book',
			'advanced',
			'high'
		);
	}
	/**
	 * Pro Feild Tag
	 */
	public function book_pro_field()
	{
		if (!class_exists('Rswpbs_Pro')) {
			?>
			<div class="set_overlay_for_pro_field">
				<div class="pro_tag_text">
					<a target="_blank" href="<?php echo esc_url('https://rswpthemes.com/cart/?add-to-cart=2040'); ?>" class="pro_badge"><?php esc_html_e('Buy Now', 'rswpbs'); ?></a>
				</div>
			</div>
			<?php
		}
		return;
	}
	/**
	 * Creating Book Information Meta Box Fields
	 */
	public function book_information_fields_render($post)
	{
		wp_nonce_field( 'Book_Information_Data', 'Book_Information_Nonce' );
		$original_book_name = get_post_meta( $post->ID, $this->prefix . 'original_book_name', true );
		$book_name = get_post_meta( $post->ID, $this->prefix . 'book_name', true );
		$book_price = str_replace('$', '', get_post_meta( $post->ID, $this->prefix . 'book_price', true ));
		$book_sale_price = str_replace('$', '', get_post_meta( $post->ID, $this->prefix . 'book_sale_price', true ));
		$book_isbn = get_post_meta( $post->ID, $this->prefix . 'book_isbn', true );
		$book_asin = get_post_meta( $post->ID, $this->prefix . 'book_asin', true );
		$book_isbn_10 = get_post_meta( $post->ID, $this->prefix . 'book_isbn_10', true );
		$book_isbn_13 = get_post_meta( $post->ID, $this->prefix . 'book_isbn_13', true );
		$book_translator = get_post_meta( $post->ID, $this->prefix . 'book_translator', true );
		$book_file_size = get_post_meta( $post->ID, $this->prefix . 'book_file_size', true );
		$simultaneous_device_usage = get_post_meta( $post->ID, $this->prefix . 'simultaneous_device_usage', true );
		$book_file_format = get_post_meta( $post->ID, $this->prefix . 'book_file_format', true );
		$book_text_to_speech = get_post_meta( $post->ID, $this->prefix . 'book_text_to_speech', true );
		$screen_reader = get_post_meta( $post->ID, $this->prefix . 'screen_reader', true );
		$enhanced_typesetting = get_post_meta( $post->ID, $this->prefix . 'enhanced_typesetting', true );
		$x_ray = get_post_meta( $post->ID, $this->prefix . 'x_ray', true );
		$word_wise = get_post_meta( $post->ID, $this->prefix . 'word_wise', true );
		$sticky_notes = get_post_meta( $post->ID, $this->prefix . 'sticky_notes', true );
		$print_length = get_post_meta( $post->ID, $this->prefix . 'print_length', true );
		$book_dimension = get_post_meta( $post->ID, $this->prefix . 'book_dimension', true );
		$book_weight = get_post_meta( $post->ID, $this->prefix . 'book_weight', true );
		$book_publish_date = get_post_meta( $post->ID, $this->prefix . 'book_publish_date', true );
		$book_publish_year = get_post_meta( $post->ID, $this->prefix . 'book_publish_year', true );
		$book_publisher_name = get_post_meta( $post->ID, $this->prefix . 'book_publisher_name', true );
		$book_country = get_post_meta( $post->ID, $this->prefix . 'book_country', true );
		$book_language = get_post_meta( $post->ID, $this->prefix . 'book_language', true );
		$book_format = get_post_meta( $post->ID, $this->prefix . 'book_format', true );
		$book_pages = get_post_meta( $post->ID, $this->prefix . 'book_pages', true );
		$short_description = get_post_meta( $post->ID, $this->prefix . 'short_description', true );
		$average_book_rating = get_post_meta( $post->ID, $this->prefix . 'average_book_rating', true );
		$book_availability_status = get_post_meta( $post->ID, $this->prefix . 'book_availability_status', true );
		$total_book_ratings = get_post_meta( $post->ID, $this->prefix . 'total_book_ratings', true );
		$book_rating_links = get_post_meta( $post->ID, $this->prefix . 'book_rating_links', true );
		$buy_btn_text = get_post_meta( $post->ID, $this->prefix . 'buy_btn_text', true );
		$buy_btn_link = get_post_meta( $post->ID, $this->prefix . 'buy_btn_link', true );

		$bookCategories = get_terms(
			'book-category',
			array(
				'hide_empty' => false
			)
		);

		$bookAuthors = get_terms(
			'book-author',
			array(
				'hide_empty' => false
			)
		);
	?>
		<div class="book-information-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<?php
								echo wp_kses_post($this->book_pro_field());
								?>
								<label for="original-book-name"><?php esc_html_e( 'Original Book Name', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="original_book_name" class="w-100 regular-text" id="original-book-name" value="<?php echo esc_attr($original_book_name);?>" placeholder="Original Book Name">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="book-name"><?php esc_html_e( 'Book Name', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_name" class="w-100 regular-text" id="book-name" value="<?php echo esc_attr($book_name);?>" placeholder="Book Name">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="publish-date"><?php esc_html_e( 'Publish Date', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="date" name="book_publish_date" class="w-100 regular-text" id="publish-date" value="<?php echo esc_attr($book_publish_date);?>">
								<input type="hidden" name="book_publish_year" class="w-100 regular-text" id="publish-year" value="<?php echo esc_attr($book_publish_year);?>">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="publisher-name"><?php esc_html_e( 'Publisher Name', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_publisher_name" class="w-100 regular-text" id="publisher-name" value="<?php echo esc_attr($book_publisher_name);?>" placeholder="Publisher Name">
							</div>
						</div>
						<div class="col-lg-8 mb-20">
							<div class="book-field-container">
								<label for="short-description"><?php esc_html_e( 'Book Short Description', RSWPBS_TEXT_DOMAIN );?></label>
								<textarea type="text" rows="5" class="w-100 regular-text" name="short_description" id="short-description" value="<?php echo esc_attr($short_description); ?>" placeholder="Short Description"><?php echo esc_attr($short_description); ?></textarea>
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="publish-country"><?php esc_html_e( 'Country', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_country" class="w-100 regular-text" id="book-country" value="<?php echo esc_attr($book_country); ?>" placeholder="Country">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="publish-language"><?php esc_html_e( 'Book language', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_language" class="w-100 regular-text" id="book-language" value="<?php echo esc_attr($book_language); ?>" placeholder="Book language">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="book-format"><?php esc_html_e( 'Book Format', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_format" class="w-100 regular-text" id="book-format" value="<?php echo esc_attr($book_format); ?>" placeholder="Example: Hardcover">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="publish-date"><?php esc_html_e( 'Book Pages', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_pages" class="w-100 regular-text" id="book-pages" value="<?php echo esc_attr($book_pages); ?>" placeholder="Book Pages">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="book-isbn"><?php esc_html_e( 'ISBN', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_isbn" class="w-100 regular-text" id="book-isbn" value="<?php echo esc_attr($book_isbn); ?>" placeholder="Book ISBN">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="book-isbn-10"><?php esc_html_e( 'ISBN-10', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_isbn_10" class="w-100 regular-text" id="book-isbn-10" value="<?php echo esc_attr($book_isbn_10); ?>" placeholder="ISBN 10">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="book-isbn-13"><?php esc_html_e( 'ISBN-13', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_isbn_13" class="w-100 regular-text" id="book-isbn-13" value="<?php echo esc_attr($book_isbn_13); ?>" placeholder="ISBN 13">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="book-translator"><?php esc_html_e( 'Translator Name', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_translator" class="w-100 regular-text" id="book-translator" value="<?php echo esc_attr($book_translator); ?>" placeholder="Translator">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="book-dimension"><?php esc_html_e( 'Dimension', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_dimension" class="w-100 regular-text" id="book-dimension" value="<?php echo esc_attr($book_dimension); ?>" placeholder="Book Dimension">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="book-weight"><?php esc_html_e( 'Weight', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_weight" class="w-100 regular-text" id="book-weight" value="<?php echo esc_attr($book_weight); ?>" placeholder="Book Weight">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="book-file-size"><?php esc_html_e( 'File size (If Ebook)', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_file_size" class="w-100 regular-text" id="book-file-size" value="<?php echo esc_attr($book_file_size); ?>" placeholder="File Size">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="simultaneous-device-usage"><?php esc_html_e( 'Simultaneous device usage', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="simultaneous_device_usage" class="w-100 regular-text" id="simultaneous-device-usage" value="<?php echo esc_attr($simultaneous_device_usage); ?>" placeholder="Up to 5 simultaneous devices, per publisher limits">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<?php
								echo wp_kses_post($this->book_pro_field());
								?>
								<label for="book-file-format"><?php esc_html_e( 'File Format (If Ebook)', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_file_format" class="w-100 regular-text" id="book-file-format" value="<?php echo esc_attr($book_file_format); ?>" placeholder="PDF">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<label for="book-asin"><?php esc_html_e( 'ASIN', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="book_asin" class="w-100 regular-text" id="book-asin" value="<?php echo esc_attr($book_asin); ?>" placeholder="ASIN">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<?php
								echo wp_kses_post($this->book_pro_field());
								?>
								<label for="book-text-to-speech"><?php esc_html_e( 'Text-To-Speech', RSWPBS_TEXT_DOMAIN );?></label>
								<select name="book_text_to_speech" class="w-100" id="book-text-to-speech">
									<option value="blank" <?php echo selected( $book_text_to_speech, 'blank', false );?>>
										<?php esc_html_e( 'Choose an option', RSWPBS_TEXT_DOMAIN );?>
									</option>
									<option value="enabled" <?php echo selected( $book_text_to_speech, 'enabled', false );?>>
										<?php esc_html_e( 'Enabled', RSWPBS_TEXT_DOMAIN );?>
									</option>
									<option value="not_enabled" <?php echo selected( $book_text_to_speech, 'not_enabled', false);?>>
										<?php esc_html_e( 'Not Enabled', RSWPBS_TEXT_DOMAIN );?>
									</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<?php
								echo wp_kses_post($this->book_pro_field());
								?>
								<label for="screen-reader"><?php esc_html_e( 'Screen Reader', RSWPBS_TEXT_DOMAIN );?></label>
								<select name="screen_reader" class="w-100" id="screen-reader">
									<option value="blank" <?php echo selected( $screen_reader, 'blank', false );?>>
										<?php esc_html_e( 'Choose an option', RSWPBS_TEXT_DOMAIN );?>
									</option>
									<option value="supported" <?php echo selected( $screen_reader, 'supported', false );?>>
										<?php esc_html_e( 'Supported', RSWPBS_TEXT_DOMAIN );?>
									</option>
									<option value="unsupported" <?php echo selected( $screen_reader, 'unsupported', false);?>>
										<?php esc_html_e( 'Unsupported', RSWPBS_TEXT_DOMAIN );?>
									</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<?php
								echo wp_kses_post($this->book_pro_field());
								?>
								<label for="enhanced-typesetting"><?php esc_html_e( 'Enhanced typesetting', RSWPBS_TEXT_DOMAIN );?></label>
								<select name="enhanced_typesetting" class="w-100" id="enhanced-typesetting">
									<option value="blank" <?php echo selected( $enhanced_typesetting, 'blank', false );?>>
										<?php esc_html_e( 'Choose an option', RSWPBS_TEXT_DOMAIN );?>
									</option>
									<option value="enabled" <?php echo selected( $enhanced_typesetting, 'enabled', false );?>>
										<?php esc_html_e( 'Enabled', RSWPBS_TEXT_DOMAIN );?>
									</option>
									<option value="not_enabled" <?php echo selected( $enhanced_typesetting, 'not_enabled', false);?>>
										<?php esc_html_e( 'Not Enabled', RSWPBS_TEXT_DOMAIN );?>
									</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<?php
								echo wp_kses_post($this->book_pro_field());
								?>
								<label for="x-ray"><?php esc_html_e( 'X-Ray', RSWPBS_TEXT_DOMAIN );?></label>
								<select name="x_ray" class="w-100" id="x-ray">
									<option value="blank" <?php echo selected( $x_ray, 'blank', false );?>>
										<?php esc_html_e( 'Choose an option', RSWPBS_TEXT_DOMAIN );?>
									</option>
									<option value="enabled" <?php echo selected( $x_ray, 'enabled', false );?>>
										<?php esc_html_e( 'Enabled', RSWPBS_TEXT_DOMAIN );?>
									</option>
									<option value="not_enabled" <?php echo selected( $x_ray, 'not_enabled', false);?>>
										<?php esc_html_e( 'Not Enabled', RSWPBS_TEXT_DOMAIN );?>
									</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<?php
								echo wp_kses_post($this->book_pro_field());
								?>
								<label for="word-wise"><?php esc_html_e( 'Word Wise', RSWPBS_TEXT_DOMAIN );?></label>
								<select name="word_wise" class="w-100" id="word-wise">
									<option value="blank" <?php echo selected( $word_wise, 'blank', false );?>>
										<?php esc_html_e( 'Choose an option', RSWPBS_TEXT_DOMAIN );?>
									</option>
									<option value="enabled" <?php echo selected( $word_wise, 'enabled', false );?>>
										<?php esc_html_e( 'Enabled', RSWPBS_TEXT_DOMAIN );?>
									</option>
									<option value="not_enabled" <?php echo selected( $word_wise, 'not_enabled', false);?>>
										<?php esc_html_e( 'Not Enabled', RSWPBS_TEXT_DOMAIN );?>
									</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<?php
								echo wp_kses_post($this->book_pro_field());
								?>
								<label for="sticky-notes"><?php esc_html_e( 'Sticky Notes', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="sticky_notes" class="w-100 regular-text" id="sticky-notes" value="<?php echo esc_attr($sticky_notes); ?>" placeholder="On Kindle Scribe">
							</div>
						</div>
						<div class="col-lg-4 mb-20">
							<div class="book-field-container">
								<?php
								echo wp_kses_post($this->book_pro_field());
								?>
								<label for="print-length"><?php esc_html_e( 'Print length', RSWPBS_TEXT_DOMAIN );?></label>
								<input type="text" name="print_length" class="w-100 regular-text" id="print-length" value="<?php echo esc_attr($print_length); ?>" placeholder="128 Pages">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-lg-3">
					<div class="book-field-container">
						<label for="book-availability-status"><?php esc_html_e( 'Book Availability Status', RSWPBS_TEXT_DOMAIN );?></label>
						<select name="book_availability_status" class="w-100" id="book-availability-status">
							<option value="blank" <?php echo selected( $book_availability_status, 'blank', false );?>>
								<?php esc_html_e( 'Choose an option', RSWPBS_TEXT_DOMAIN );?>
							</option>
							<option value="available" <?php echo selected( $book_availability_status, 'available', false );?>>
								<?php esc_html_e( 'Available', RSWPBS_TEXT_DOMAIN );?>
							</option>
							<option value="upcoming" <?php echo selected( $book_availability_status, 'upcoming', false);?>>
								<?php esc_html_e( 'Upcoming', RSWPBS_TEXT_DOMAIN );?>
							</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="book-field-container">
						<label for="average-book-rating"><?php esc_html_e( 'Average Book Rating', RSWPBS_TEXT_DOMAIN );?></label>
						<select name="average_book_rating" class="w-100" id="average-book-rating">
							<option value="5" <?php echo selected( $average_book_rating, '5', false );?>>
								<?php esc_html_e( '5 Star', RSWPBS_TEXT_DOMAIN );?>
							</option>
							<option value="4.5" <?php echo selected( $average_book_rating, '4.5', false );?>>
								<?php esc_html_e( '4.5 Star', RSWPBS_TEXT_DOMAIN );?>
							</option>
							<option value="4" <?php echo selected( $average_book_rating, '4', false );?>>
								<?php esc_html_e( '4 Star', RSWPBS_TEXT_DOMAIN );?>
							</option>
							<option value="3.5" <?php echo selected( $average_book_rating, '3.5', false);?>>
								<?php esc_html_e( '3.5 Star', RSWPBS_TEXT_DOMAIN );?>
							</option>
							<option value="3" <?php echo selected( $average_book_rating, '3', false);?>>
								<?php esc_html_e( '3 Star', RSWPBS_TEXT_DOMAIN );?>
							</option>
							<option value="2.5" <?php echo selected( $average_book_rating, '2.5', false);?>>
								<?php esc_html_e( '2.5 Star', RSWPBS_TEXT_DOMAIN );?>
							</option>
							<option value="2" <?php echo selected( $average_book_rating, '2', false);?>>
								<?php esc_html_e( '2 Star', RSWPBS_TEXT_DOMAIN );?>
							</option>
							<option value="1.5" <?php echo selected( $average_book_rating, '1.5', false);?>>
								<?php esc_html_e( '1.5 Star', RSWPBS_TEXT_DOMAIN );?>
							</option>
							<option value="1" <?php echo selected( $average_book_rating, '1', false);?>>
								<?php esc_html_e( '1 Star', RSWPBS_TEXT_DOMAIN );?>
							</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="book-field-container">
						<label for="total-book-ratings"><?php esc_html_e( 'Total Book Ratings', RSWPBS_TEXT_DOMAIN );?></label>
						<input type="text" name="total_book_ratings" class="w-100 regular-text" id="total-book-ratings" value="<?php echo esc_attr($total_book_ratings); ?>" placeholder="4500">
					</div>
				</div>
				<div class="col-lg-3">
					<div class="book-field-container">
						<label for="book-rating-links"><?php esc_html_e( 'Book Rating Links', RSWPBS_TEXT_DOMAIN );?></label>
						<input type="text" name="book_rating_links" class="w-100 regular-text" id="book-rating-links" value="<?php echo esc_attr($book_rating_links); ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 mb-20">
							<div class="row">
								<div class="col-lg-12 mb-20">
									<div class="book-field-container">
										<label for="book-price"><?php esc_html_e( 'Book Price', RSWPBS_TEXT_DOMAIN );?></label>
										<div class="row">
											<div class="col-md-6">
												<div class="currency-sign">$</div>
												<input type="text" name="book_price" class="w-100 regular-text" id="book-price" value="<?php echo esc_attr($book_price);?>" placeholder="Book Regular Price">
											</div>
											<div class="col-md-6">
												<div class="currency-sign">$</div>
												<input type="text" name="book_sale_price" class="w-100 regular-text" id="book-sale-price" value="<?php echo esc_attr($book_sale_price);?>" placeholder="Book Sale Price">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 mb-20">
							<div class="row">
								<div class="col-lg-12 mb-20">
									<div class="book-field-container">
										<?php
										echo wp_kses_post($this->book_pro_field());
										?>
										<div class="row">
											<div class="col-md-6">
												<label for="buy-now-btn-text"><?php esc_html_e( 'Buy Button Text', RSWPBS_TEXT_DOMAIN );?></label>
												<input type="text" name="buy_btn_text" class="w-100 regular-text" id="buy-now-btn-text" value="<?php echo esc_attr($buy_btn_text);?>" placeholder="Buy Now">
											</div>
											<div class="col-md-6">
												<label for="buy-now-btn-link"><?php esc_html_e( 'Buy Button Link', RSWPBS_TEXT_DOMAIN );?></label>
												<input type="text" name="buy_btn_link" class="w-100 regular-text" id="buy-now-btn-link" value="<?php echo esc_attr($buy_btn_link);?>" placeholder="Book Purchase Link">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			if (!class_exists('Rswpbs_Pro')) :
			?>
			<div class="row pro-item-spacer">
				<div class="col-md-12">
					<div class="book-field-container no-border">
						<?php
						echo wp_kses_post($this->book_pro_field());
						?>
						<div class="book-field-wrapper">
							<img src="<?php echo esc_url( RSWPBS_PLUGIN_URL . '/includes/assets/img/sales-links.png');?>" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="row pro-item-spacer">
				<div class="col-md-12">
					<div class="book-field-container no-border">
						<?php
						echo wp_kses_post($this->book_pro_field());
						?>
						<div class="book-field-wrapper">
							<img src="<?php echo esc_url( RSWPBS_PLUGIN_URL . '/includes/assets/img/book-formates.png');?>" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="row pro-item-spacer">
				<div class="col-md-12">
					<div class="book-field-container no-border">
						<?php
						echo wp_kses_post($this->book_pro_field());
						?>
						<div class="book-field-wrapper">
							<img src="<?php echo esc_url( RSWPBS_PLUGIN_URL . '/includes/assets/img/readers-feedback.png');?>" alt="">
						</div>
					</div>
				</div>
			</div>
			<?php
			endif;
			?>
		</div>
	<?php
	}

	/**
	 * Saving Book Information Meta Fields Data
	 */
	public function book_information_save($post_id)
	{
		if (! isset($_POST['Book_Information_Nonce'])) {
			return $post_id;
		}
		if (! wp_verify_nonce( $_POST['Book_Information_Nonce'], 'Book_Information_Data' ) ) {
			return $post_id;
		}
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		$meta_fields = array(
			'original_book_name' => (isset($_POST['original_book_name']) ? sanitize_text_field($_POST['original_book_name']) : ''),
			'book_name' => (isset($_POST['book_name']) ? sanitize_text_field($_POST['book_name']) : ''),
			'book_price' => (isset($_POST['book_price']) ? str_replace('$', '', sanitize_text_field($_POST['book_price'])) : ''),
			'book_sale_price' => (isset($_POST['book_sale_price']) ? str_replace('$', '', sanitize_text_field($_POST['book_sale_price'])) : ''),
			'book_country' => (isset($_POST['book_country']) ? sanitize_text_field($_POST['book_country']) : ''),
			'book_language' => (isset($_POST['book_language']) ? sanitize_text_field($_POST['book_language']) : ''),
			'book_publish_date' => (isset($_POST['book_publish_date']) ? sanitize_text_field($_POST['book_publish_date']) : ''),
			'book_publish_year' => (isset($_POST['book_publish_year']) ? sanitize_text_field($_POST['book_publish_year']) : ''),
			'book_publisher_name' => (isset($_POST['book_publisher_name']) ? sanitize_text_field($_POST['book_publisher_name']) : ''),
			'short_description' => (isset($_POST['short_description']) ? sanitize_textarea_field($_POST['short_description']) : ''),
			'book_pages' => (isset($_POST['book_pages']) ? sanitize_text_field($_POST['book_pages']) : ''),
			'book_isbn' => (isset($_POST['book_isbn']) ? sanitize_text_field($_POST['book_isbn']) : ''),
			'book_isbn_10' => (isset($_POST['book_isbn_10']) ? sanitize_text_field($_POST['book_isbn_10']) : ''),
			'book_isbn_13' => (isset($_POST['book_isbn_13']) ? sanitize_text_field($_POST['book_isbn_13']) : ''),
			'book_asin' => (isset($_POST['book_asin']) ? sanitize_text_field($_POST['book_asin']) : ''),
			'book_translator' => (isset($_POST['book_translator']) ? sanitize_text_field($_POST['book_translator']) : ''),
			'book_dimension' => (isset($_POST['book_dimension']) ? sanitize_text_field($_POST['book_dimension']) : ''),
			'book_file_size' => (isset($_POST['book_file_size']) ? sanitize_text_field($_POST['book_file_size']) : ''),
			'simultaneous_device_usage' => (isset($_POST['simultaneous_device_usage']) ? sanitize_text_field($_POST['simultaneous_device_usage']) : ''),
			'book_file_format' => (isset($_POST['book_file_format']) ? sanitize_text_field($_POST['book_file_format']) : ''),
			'book_text_to_speech' => (isset($_POST['book_text_to_speech']) ? sanitize_text_field($_POST['book_text_to_speech']) : ''),
			'screen_reader' => (isset($_POST['screen_reader']) ? sanitize_text_field($_POST['screen_reader']) : ''),
			'enhanced_typesetting' => (isset($_POST['enhanced_typesetting']) ? sanitize_text_field($_POST['enhanced_typesetting']) : ''),
			'x_ray' => (isset($_POST['x_ray']) ? sanitize_text_field($_POST['x_ray']) : ''),
			'word_wise' => (isset($_POST['word_wise']) ? sanitize_text_field($_POST['word_wise']) : ''),
			'sticky_notes' => (isset($_POST['sticky_notes']) ? sanitize_text_field($_POST['sticky_notes']) : ''),
			'print_length' => (isset($_POST['print_length']) ? sanitize_text_field($_POST['print_length']) : ''),
			'book_weight' => (isset($_POST['book_weight']) ? sanitize_text_field($_POST['book_weight']) : ''),
			'book_format' => (isset($_POST['book_format']) ? sanitize_text_field($_POST['book_format']) : ''),
			'book_availability_status' => (isset($_POST['book_availability_status']) ? sanitize_text_field($_POST['book_availability_status']) : ''),
			'total_book_ratings' => (isset($_POST['total_book_ratings']) ? sanitize_text_field($_POST['total_book_ratings']) : ''),
			'average_book_rating' => (isset($_POST['average_book_rating']) ? sanitize_text_field($_POST['average_book_rating']) : ''),
			'book_rating_links' => (isset($_POST['book_rating_links']) ? sanitize_text_field($_POST['book_rating_links']) : ''),
			'buy_btn_text' => (isset($_POST['buy_btn_text']) ? sanitize_text_field($_POST['buy_btn_text']) : ''),
			'buy_btn_link' => (isset($_POST['buy_btn_link']) ? sanitize_text_field($_POST['buy_btn_link']) : ''),
		);

		if (!class_exists('Rswpbs_Pro')) {
			unset($meta_fields['original_book_name']);
			unset($meta_fields['simultaneous_device_usage']);
			unset($meta_fields['book_file_format']);
			unset($meta_fields['book_text_to_speech']);
			unset($meta_fields['screen_reader']);
			unset($meta_fields['enhanced_typesetting']);
			unset($meta_fields['x_ray']);
			unset($meta_fields['word_wise']);
			unset($meta_fields['sticky_notes']);
			unset($meta_fields['print_length']);
		}

		$meta_fields['book_query_price'] = ( ! isset($meta_fields['book_sale_price']) ? $meta_fields['book_price'] : $meta_fields['book_sale_price'] );

		foreach($meta_fields as $key => $value):
			$keyWithPrefix = $this->prefix . $key;
			$prevValue = get_post_meta($post_id, $keyWithPrefix, true);
			if ($prevValue) {
				update_post_meta($post_id, $keyWithPrefix, $value, $prevValue);
			}else{
				add_post_meta( $post_id, $keyWithPrefix, $value );
			}
			if ( !$value) {
				delete_post_meta( $post_id, $keyWithPrefix );
			}
		endforeach;
	}
}