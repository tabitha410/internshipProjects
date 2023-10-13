<?php
/**
 * All Fields Date Of Book Post Type
 */

function rswpbs_prefix(){
	return '_rsbs_';
}
function rswpbs_get_book_desc($bookId = null, $word_count = 30){
    if ($bookId === null) {
        $bookId = get_the_ID();
    }
    if (is_singular('book')) {
    	$word_count = 100;
    }
    $short_description = get_post_meta( $bookId, rswpbs_prefix() . 'short_description', true );
    $trimmed_description = wp_strip_all_tags(wp_trim_words( $short_description, $word_count, '...' ));
    return $trimmed_description;
}

function rswpbs_get_book_weight($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$book_weight = get_post_meta( $bookId, rswpbs_prefix() . 'book_weight', true );
	return $book_weight;
}

function rswpbs_get_book_dimension($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$book_dimension = get_post_meta( $bookId, rswpbs_prefix() . 'book_dimension', true );
	return $book_dimension;
}

function rswpbs_get_book_file_size($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$book_file_size = get_post_meta( $bookId, rswpbs_prefix() . 'book_file_size', true );
	return $book_file_size;
}

function rswpbs_get_book_file_format($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$book_file_format = get_post_meta($bookId, rswpbs_prefix() . 'book_file_format', true);
	if (!class_exists('Rswpbs_Pro')) {
		$book_file_format = '';
	}
	return $book_file_format;
}

function rswpbs_get_simultaneous_device_usage($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$simultaneous_device_usage = get_post_meta($bookId, rswpbs_prefix() . 'simultaneous_device_usage', true);
	if (!class_exists('Rswpbs_Pro')) {
		$simultaneous_device_usage = '';
	}
	return $simultaneous_device_usage;
}

function rswpbs_get_book_text_to_speech($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$book_text_to_speech = get_post_meta($bookId, rswpbs_prefix() . 'book_text_to_speech', true);
	if (!class_exists('Rswpbs_Pro')) {
		$book_text_to_speech = '';
	}elseif(class_exists('Rswpbs_Pro') && 'blank' == $book_text_to_speech){
		$book_text_to_speech = '';
	}elseif('enabled' == $book_text_to_speech) {
		$book_text_to_speech = __( 'Enabled', RSWPBS_TEXT_DOMAIN );;
	}elseif('not_enabled' == $book_text_to_speech) {
		$book_text_to_speech = __( 'Not Enabled', RSWPBS_TEXT_DOMAIN );;
	}
	return $book_text_to_speech;
}

function rswpbs_get_screen_reader($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$screen_reader = get_post_meta($bookId, rswpbs_prefix() . 'screen_reader', true);
	if (!class_exists('Rswpbs_Pro')) {
		$screen_reader = '';
	}elseif(class_exists('Rswpbs_Pro') && 'blank' == $screen_reader){
		$screen_reader = '';
	}elseif('enabled' == $screen_reader) {
		$screen_reader = __( 'Enabled', RSWPBS_TEXT_DOMAIN );;
	}elseif('not_enabled' == $screen_reader) {
		$screen_reader = __( 'Not Enabled', RSWPBS_TEXT_DOMAIN );;
	}
	return $screen_reader;
}

function rswpbs_get_enhanced_typesetting($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$enhanced_typesetting = get_post_meta($bookId, rswpbs_prefix() . 'enhanced_typesetting', true);
	if (!class_exists('Rswpbs_Pro')) {
		$enhanced_typesetting = '';
	}elseif(class_exists('Rswpbs_Pro') && 'blank' == $enhanced_typesetting){
		$enhanced_typesetting = '';
	}elseif('enabled' == $enhanced_typesetting) {
		$enhanced_typesetting = __( 'Enabled', RSWPBS_TEXT_DOMAIN );;
	}elseif('not_enabled' == $enhanced_typesetting) {
		$enhanced_typesetting = __( 'Not Enabled', RSWPBS_TEXT_DOMAIN );;
	}
	return $enhanced_typesetting;
}

function rswpbs_get_x_ray($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$x_ray = get_post_meta($bookId, rswpbs_prefix() . 'x_ray', true);
	if (!class_exists('Rswpbs_Pro')) {
		$x_ray = '';
	}elseif(class_exists('Rswpbs_Pro') && 'blank' == $x_ray){
		$x_ray = '';
	}elseif('enabled' == $x_ray) {
		$x_ray = __( 'Enabled', RSWPBS_TEXT_DOMAIN );;
	}elseif('not_enabled' == $x_ray) {
		$x_ray = __( 'Not Enabled', RSWPBS_TEXT_DOMAIN );;
	}
	return $x_ray;
}

function rswpbs_get_word_wise($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$word_wise = get_post_meta($bookId, rswpbs_prefix() . 'word_wise', true);
	if (!class_exists('Rswpbs_Pro')) {
		$word_wise = '';
	}elseif(class_exists('Rswpbs_Pro') && 'blank' == $word_wise){
		$word_wise = '';
	}elseif('enabled' == $word_wise) {
		$word_wise = __( 'Enabled', RSWPBS_TEXT_DOMAIN );;
	}elseif('not_enabled' == $word_wise) {
		$word_wise = __( 'Not Enabled', RSWPBS_TEXT_DOMAIN );;
	}
	return $word_wise;
}

function rswpbs_get_sticky_notes($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$sticky_notes = get_post_meta($bookId, rswpbs_prefix() . 'sticky_notes', true);
	if (!class_exists('Rswpbs_Pro')) {
		$sticky_notes = '';
	}
	return $sticky_notes;
}

function rswpbs_get_print_length($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$print_length = get_post_meta($bookId, rswpbs_prefix() . 'print_length', true);
	if (!class_exists('Rswpbs_Pro')) {
		$print_length = '';
	}
	return $print_length;
}

function rswpbs_get_book_translator($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$book_translator = get_post_meta( $bookId, rswpbs_prefix() . 'book_translator', true );
	return $book_translator;
}

function rswpbs_get_book_format($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$book_format = get_post_meta( $bookId, rswpbs_prefix() . 'book_format', true );
	return $book_format;
}

function rswpbs_get_book_name($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookName = get_post_meta( $bookId, rswpbs_prefix() . 'book_name', true );
	return $bookName;
}

function rswpbs_get_book_original_name($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$originalBookName = get_post_meta( $bookId, rswpbs_prefix() . 'original_book_name', true );
	if (!class_exists('Rswpbs_Pro')) {
		$originalBookName = '';
	}
	return $originalBookName;
}

function rswpbs_get_book_pages($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookPages = get_post_meta( $bookId, rswpbs_prefix() . 'book_pages', true );
	return $bookPages;
}

function rswpbs_get_book_publish_date($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookPublishDate = get_post_meta( $bookId, rswpbs_prefix() . 'book_publish_date', true );
	return $bookPublishDate;
}

function rswpbs_get_book_publish_year($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookPublishYear = get_post_meta( $bookId, rswpbs_prefix() . 'book_publish_year', true );
	return $bookPublishYear;
}

function rswpbs_get_book_publisher_name($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookPublisherName = get_post_meta( $bookId, rswpbs_prefix() . 'book_publisher_name', true );
	return $bookPublisherName;
}

function rswpbs_get_book_country($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookcountry = get_post_meta( $bookId, rswpbs_prefix() . 'book_country', true );
	return $bookcountry;
}

function rswpbs_get_book_language($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookLanguage = get_post_meta( $bookId, rswpbs_prefix() . 'book_language', true );
	return $bookLanguage;
}

function rswpbs_get_book_isbn($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookIsbn = get_post_meta( $bookId, rswpbs_prefix() . 'book_isbn', true );
	return $bookIsbn;
}

function rswpbs_get_book_isbn_10($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookIsbn_10 = get_post_meta( $bookId, rswpbs_prefix() . 'book_isbn_10', true );
	return $bookIsbn_10;
}

function rswpbs_get_book_isbn_13($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookIsbn_13 = get_post_meta( $bookId, rswpbs_prefix() . 'book_isbn_13', true );
	return $bookIsbn_13;
}

function rswpbs_get_book_asin($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookAsin = get_post_meta( $bookId, rswpbs_prefix() . 'book_asin', true );
	return $bookAsin;
}

function rswpbs_get_book_author($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$aIndex = 0;
	$getBookAuthors = get_the_terms( $bookId, 'book-author' );
	if (is_array($getBookAuthors)) {
		$countAuthors = count($getBookAuthors);
	}
	$bookauthor = '';
	if (!empty($getBookAuthors)) :
		foreach($getBookAuthors as $author){
			$aIndex++;
			$bookauthor .= '<a href="'.esc_url(get_term_link($author->term_id)).'">'.esc_html($author->name).'</a>';
			if ($aIndex !== $countAuthors) {
				$bookauthor .= ', ';
			}
		}
	endif;
	return $bookauthor;
}

function rswpbs_get_book_author_id($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookAuthors = get_the_terms( $bookId, 'book-author' );
	$authorIndex = 0;
	$outline = 0;
	if (is_array($bookAuthors) && !empty($bookAuthors)) {
		foreach($bookAuthors as $author){
			$authorIndex++;
			if (1 === $authorIndex) {
				$outline = $author->term_id;
			}
		}
	}
	return $outline;
}

function rswpbs_get_book_categories($bookId = null, $sep = true) {
	if ($bookId === null) {
		$bookId = get_the_ID();
	}

	$bookCategories = get_the_terms($bookId, 'book-category');
	$cIndex = 0;

	$outline = '';

	if ($bookCategories && is_array($bookCategories)) { // Check if $bookCategories is not empty and is an array
		$countCats = count($bookCategories);

		foreach ($bookCategories as $category) {
			$cIndex++;
			$outline .= '<a href="'.esc_url(get_term_link($category->term_id)).'">'.esc_html($category->name).'</a>';

			if ($sep && $cIndex !== $countCats) {
				$outline .= ', '; // Added a comma separator except for the last item
			}
		}
	}

	return $outline;
}


function rswpbs_get_book_image($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$bookImage = get_the_post_thumbnail($bookId, 'full');
	return $bookImage;
}

function rswpbs_get_book_price($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$currenySign = '$';
	if (class_exists('Rswpbs_Pro')) {
		$currenySign = get_field('price_currency', 'option');
	}
	$bookRegularPrice = str_replace('$', '', get_post_meta( $bookId, rswpbs_prefix() . 'book_price', true ));
	$bookSalePrice = str_replace('$', '', get_post_meta( $bookId, rswpbs_prefix() . 'book_sale_price', true ));
	$bookPrice = '';
	if (!empty($bookRegularPrice)) {
		$bookPrice .= '<div class="regular-price'.(!empty($bookSalePrice) ? ' previous-price' : '').'">
						<strong>'.$currenySign.''.esc_html($bookRegularPrice).'</strong>
					</div>';
	}
	if (!empty($bookSalePrice)) {
		$bookPrice .= '<div class="sale-price"><strong>'.$currenySign.''.esc_html($bookSalePrice).'</strong></div>';
	}

	return $bookPrice;
}

function rswpbs_get_book_buy_btn($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$buy_btn_text = get_post_meta( $bookId, rswpbs_prefix() . 'buy_btn_text', true );
	$buy_btn_link = get_post_meta( $bookId, rswpbs_prefix() . 'buy_btn_link', true );
	$output = '';
	if (!empty($buy_btn_text)) :
		$output = '<a href="'.esc_url($buy_btn_link).'" target="_blank" class="rswpthemes-book-buy-now-button">'.$buy_btn_text.'</a>';
	endif;
	return $output;
}

function rswpbs_get_book_availability_status($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$book_availability_status = get_post_meta( $bookId, rswpbs_prefix() . 'book_availability_status', true );
	return $book_availability_status;
}

function rswpbs_get_avg_rate($bookId = null){
    if ($bookId === null) {
        $bookId = get_the_ID();
    }
    $average_book_rating = get_post_meta( $bookId, rswpbs_prefix() . 'average_book_rating', true );
    $totalRatings = get_post_meta($bookId, rswpbs_prefix() . 'total_book_ratings', true);
    $ratingLink = get_post_meta($bookId, rswpbs_prefix() . 'book_rating_links', true);
    $rounded_rating = round( intval($average_book_rating) * 2 ) / 2;
    $html_output = '<div class="star-rating-inner">';
    for ( $i = 1; $i <= 5; $i++ ) {
        if ( $rounded_rating >= $i ) {
            $html_output .= '<i class="fas fa-star"></i>';
        } elseif ( $rounded_rating >= $i - 0.5 ) {
            $html_output .= '<i class="fas fa-star-half-alt"></i>';
        } else {
            $html_output .= '<i class="far fa-star"></i>';
        }
    }
   if (!empty($totalRatings)) {
    	$html_output .= '<span class="total-ratings">' . esc_html__( $totalRatings . ' ratings', 'text-domain' ) . '</span>';
   }
    $html_output .= '</div>';
    if ( $ratingLink ) {
        $html_output = '<a class="rating-link" href="' . esc_url( $ratingLink ) . '">' . $html_output . '</a>';
    }
    return $html_output;
}

function rswpbs_ext_website_list($bookId = null, $extclass = 'website-list-container'){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	$external_website_lists = get_post_meta( $bookId, rswpbs_prefix() . 'external_website_lists', true );
	$outline = '<ul class="'.$extclass.'">';
	if($external_website_lists){
		foreach($external_website_lists as $external_website){
			$outline .= '<li><a target="_blank" href="'.esc_url($external_website['external_website_url']).'">'.esc_html( $external_website['external_website_name'] ).'</a></li>';
		}
	}
	$outline .= '</ul>';
	return $outline;
}

function rswpbs_author_profile_picture($bookId = null){
	if ($bookId === null) {
		$bookId = get_the_ID();
	}
	if ('book' === get_post_type() && is_singular( 'book' )) {
		$get_author_id = rswpbs_get_book_author_id(get_the_ID());
	}elseif(is_tax( 'book-author')){
		$get_author_id = get_queried_object_id();
	}
	$get_author = get_term($get_author_id);
	$authorImageId = get_term_meta($get_author->term_id, 'author_profile_picture', true );

	$outline = wp_get_attachment_image_url( $authorImageId, 'full' );
	return $outline;
}

function rswpbs_get_meta_data($meta_field_name){
	$metafielddata = array();
	$args = array(
		'post_type'	=>	'book',
		'numberposts'	=>	-1,
	);
	$booksQuery = get_posts( $args );
	foreach($booksQuery as $query) :
		$get_fields_data = get_post_meta($query->ID, rswpbs_prefix() . $meta_field_name, true );
		if (!in_array($get_fields_data, $metafielddata) && '' != $get_fields_data) {
			$metafielddata[] = strtolower($get_fields_data);
		}
	endforeach;
	return $metafielddata;
	wp_reset_query();
}

function rswpbs_navigation() {
	$next_icon            = __( 'Next', RSWPBS_TEXT_DOMAIN );;
	$prev_icon            = __( 'Prev', RSWPBS_TEXT_DOMAIN );;
	echo '<div class="rswpbs-pagination text-center">';
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => $prev_icon,
				'next_text' => $next_icon,
			)
		);
	echo '</div>';
}

function rswpbs_ct_pagination($mainQuery, $paged){
	$total_pages = $mainQuery->max_num_pages;
    if ($total_pages > 1){
        $current_page = max(1, $paged);
        echo paginate_links(array(
            'base' => add_query_arg( 'paged', '%#%' ),
            'format' => '',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => '«',
            'next_text'    => '»',
        ));
    }
}


if ( ! function_exists( 'rswpbs_ctp_pub_time' ) ) {
	function rswpbs_ctp_pub_time() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		echo '<i class="time-wrapper">' . wp_kses_post( $time_string ) . '</i>';
	}
}

function rswpbs_shorting_form_global($queryName, $bookPerPage, $search_form_displayed = true){
	 global $post;
	  // Attributes
	  if (is_post_type_archive('book')) {
	    $actionUrl = get_post_type_archive_link('book');
	  }else{
	    $actionUrl = get_the_permalink($post->ID);
	  }
	  $search_fields = rswpbs_search_fields();
	?>
	<div class="rswpbs-sorting-sections-wrapper">
		<div class="row justify-content-between">
		  <div class="col-md-6 align-self-center">
		    <?php
		      echo wp_kses_post(rswpbs_total_books_message($queryName, $bookPerPage));
		    ?>
		  </div>
		  <div class="col-md-6 align-self-center">
		    <div class="rswpbs-books-sorting-field" id="rswpbs-books-sorting-field">
		      <?php
		      if (true == $search_form_displayed) {
		        ?>
		        <form action="<?php echo esc_url($actionUrl);?>" method="get" id="rswpthemes-book-sort-form">
		          <input type="hidden" name="sortby" id="rswpbs-sortby" value="">
		        <?php
		      }
		      ?>
		      <select id="rswpbs-sort">
		          <option value="default"><?php esc_html_e('Default Sorting', RSWPBS_TEXT_DOMAIN);?></option>
		          <option value="price_asc"<?php echo ($search_fields['sortby'] == 'price_asc' ? 'selected="selected"' : ''); ?>><?php esc_html_e( 'Price (Low to High)', RSWPBS_TEXT_DOMAIN );?></option>
		          <option value="price_desc"<?php echo ($search_fields['sortby'] == 'price_desc' ? 'selected="selected"' : ''); ?>><?php esc_html_e( 'Price (High to Low)', RSWPBS_TEXT_DOMAIN );?></option>
		          <option value="title_asc"<?php echo ($search_fields['sortby'] == 'title_asc' ? 'selected="selected"' : ''); ?>><?php esc_html_e( 'Title (A-Z)', RSWPBS_TEXT_DOMAIN );?></option>
		          <option value="title_desc"<?php echo ($search_fields['sortby'] == 'title_desc' ? 'selected="selected"' : ''); ?>><?php esc_html_e( 'Title (Z-A)', RSWPBS_TEXT_DOMAIN );?></option>
		          <option value="date_asc"<?php echo ($search_fields['sortby'] == 'date_asc' ? 'selected="selected"' : ''); ?>><?php esc_html_e( 'Date (Oldest to Newest)', RSWPBS_TEXT_DOMAIN );?></option>
		          <option value="date_desc"<?php echo ($search_fields['sortby'] == 'date_desc' ? 'selected="selected"' : ''); ?>><?php esc_html_e( 'Date (Newest to Oldest)', RSWPBS_TEXT_DOMAIN );?></option>
		      </select>
		      <?php
		      if (true == $search_form_displayed) {
		        ?>
		        </form>
		        <?php
		      }
		       ?>
		    </div>
		  </div>
		</div>
	</div>
<?php
}

function rswpbs_book_loop_content_container(){
	$bookCoverPosition = 'top';
	if (class_exists('Rswpbs_Pro')) {
		$bookCoverPosition = get_field('book_cover_position', 'option');
	}
	$wrapperClass = '';
	$thumbnailWrapperStart = '';
	$thumbnailWrapperEnd = '';
	$contentWrapperStart = '';
	$contentWrapperEnd = '';
	if ('top' != $bookCoverPosition) {
		$wrapperClass = ' row ml-0 mr-0';
		$thumbnailWrapperStart = '<div class="col-lg-5 pl-0 pr-0">';
		$thumbnailWrapperEnd = '</div>';
		$contentWrapperStart = '<div class="col-lg-7 pl-0 pr-0">';
		$contentWrapperEnd = '</div>';
	}
	if ('right' == $bookCoverPosition) {
		$wrapperClass = ' row ml-0 mr-0 flex-row-reverse';
	}
	?>
	<div class="book-content-wraper<?php echo esc_attr($wrapperClass);?>">
		<?php
		echo $thumbnailWrapperStart;
		do_action('rswpbs_book_loop_image');
		echo $thumbnailWrapperEnd;
		echo $contentWrapperStart;
		?>
		<div class="rswpthemes-book-loop-content-wrapper">
			<?php do_action('rswpbs_book_loop_content'); ?>
		</div>
		<?php
		echo $contentWrapperEnd;
		?>
	</div>
	<?php
}