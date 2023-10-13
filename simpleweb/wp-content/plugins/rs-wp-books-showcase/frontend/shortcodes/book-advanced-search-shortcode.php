<?php
add_shortcode('rswpbs_advanced_search', 'rswpbs_advanced_search');
function rswpbs_advanced_search($atts){
	global $post;
	$atts = shortcode_atts(array(
		'show_name_field'	=>	'',
		), $atts
	);
	ob_start();
	$book_formats = array();
	$book_publishers = array();
	$book_publish_years = array();
	$args = array(
		'post_type'	=>	'book',
		'numberposts'	=>	-1,
	);
	$booksQuery = get_posts( $args );
	foreach($booksQuery as $query) :
		$format = strtolower(rswpbs_get_book_format($query->ID));
		$publisher = strtolower(rswpbs_get_book_publisher_name($query->ID));
		$year = strtolower(rswpbs_get_book_publish_year($query->ID));
		if (!in_array($format, $book_formats) && '' != $format) {
			$book_formats[] = strtolower($format);
		}
		if (!in_array($publisher, $book_publishers) && '' != $publisher) {
			$book_publishers[] = strtolower($publisher);
		}
		if (!in_array($year, $book_publish_years) && '' != $year) {
			$book_publish_years[] = strtolower($year);
		}
	endforeach;
	$bookAuthors = get_terms( array(
				    'taxonomy' => 'book-author',
				    'hide_all' => false,
				) );
	$bookCategories = get_terms( array(
				    'taxonomy' => 'book-category',
				    'hide_all' => false,
				) );
	$search_fields = rswpbs_search_fields();

	if (is_post_type_archive('book')) {
		$actionUrl = get_post_type_archive_link('book');
	}else{
		$actionUrl = get_the_permalink($post->ID);
	}
	?>
		<div class="rswpthemes-books-showcase-search-form-container">
			<form class="rswpthemes-books-search-form" id="rswpthemes-books-search-form" action="<?php echo esc_url( $actionUrl ); ?>" method="get">
				<input type="hidden" name="search_type" value="book">
				<input type="hidden" name="sortby" id="rswpbs-sortby" value="">
				<div class="rswpthemes-search-form row">
					<div class="col-lg-3 col-6 col-md-6">
						<div class="search-field">
							<input type="text" name="book_name" id="book-name" placeholder="<?php echo rswpbs_static_text_book_name();?>" value="<?php echo $search_fields['name']?>">
						</div>
					</div>
					<div class="col-lg-3 col-6 col-md-6">
						<div class="search-field">
							<select name="author" id="book-author" class="rswpthemes-select-field">
								<option value="all"><?php echo rswpbs_static_text_all_authors();?></option>
								<?php foreach( $bookAuthors as $author ) : ?>
								<option value="<?php echo esc_attr( $author->slug );?>" <?php selected( $author->slug, $search_fields['author'], true );?>>
									<?php echo esc_html( $author->name );?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-6 col-md-6">
						<div class="search-field">
							<select name="category" id="book-category" class="rswpthemes-select-field">
								<option value="all"><?php echo rswpbs_static_text_all_categories();?></option>
								<?php foreach($bookCategories as $category) : ?>
								<option value="<?php echo esc_attr($category->slug);?>" <?php selected($category->slug, $search_fields['category'], true);?> >
									<?php echo esc_html( $category->name );?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-6 col-md-6">
						<div class="search-field">
							<select name="format" id="book-format" class="rswpthemes-select-field">
								<option value="all"><?php echo rswpbs_static_text_all_formats();?></option>
								<?php foreach($book_formats as $bookFormat) : ?>
								<option value="<?php echo esc_html($bookFormat) ?>" <?php echo selected( $bookFormat, $search_fields['format'], true );?>>
									<?php echo esc_html($bookFormat);?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-6 col-md-6">
						<div class="search-field">
							<select name="publisher" id="book-publisher" class="rswpthemes-select-field">
								<option value="all"><?php echo rswpbs_static_text_all_publishers();?></option>
								<?php foreach($book_publishers as $publisher) : ?>
								<option value="<?php echo esc_html($publisher) ?>" <?php selected( $publisher, $search_fields['publisher'], true ); ?>>
									<?php echo esc_html($publisher);?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-6 col-md-6">
						<div class="search-field">
							<select name="publish_year" id="publish_year" class="rswpthemes-select-field">
								<option value="all"><?php echo rswpbs_static_text_all_years();?></option>
								<?php foreach($book_publish_years as $year) : ?>
								<option value="<?php echo esc_html($year) ?>" <?php selected( $year, $search_fields['publish_year'], true ); ?>>
									<?php echo esc_html($year);?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-2 col-6 col-md-6">
						<div class="search-field">
							<input type="submit" value="<?php echo rswpbs_static_text_search();?>">
						</div>
					</div>
					<div class="col-lg-1 col-3">
						<div class="search-field">
							<button type="button" class="reset-search-form"><i class="fa-solid fa-arrows-rotate"></i></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	<?php
	wp_reset_postdata();
	return ob_get_clean();
}