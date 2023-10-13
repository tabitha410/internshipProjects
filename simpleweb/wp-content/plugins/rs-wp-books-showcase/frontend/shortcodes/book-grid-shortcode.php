<?php
/**
 * Book Showcase Grid Layout
 */

add_shortcode( 'rswpbs_book_gallery', 'rswpbs_books_showcase_grid_layout' );
function rswpbs_books_showcase_grid_layout( $atts ) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'book_image' => 'true',
			'book_cover_position' => 'top',
			'book_image_type' => 'cover_image',
			'book_title' => 'true',
			'book_author' => 'true',
			'book_price' => 'true',
			'book_buy_button'	=> 'true',
			'book_descriptions'	=> 'true',
			'descriptions_limit'	=> '60',
			'books_per_page'	=> '8',
			'books_per_row'	=> '3',
			'show_search_form'	=> 'true',
			'show_sorting_form'	=> 'true',
			'show_pagination' => 'true',
	        'show_msl' => 'true',
	        'msl_title_align' => 'center',
	        'msl_title' => 'Also Available On:',
	        'show_masonry_layout' => 'true',
		),$atts
	);
	ob_start();
	$bookColumn = $atts['books_per_row'];
	$bookColumnClases = 'col-lg-3 col-md-4';
	if ('1' == $bookColumn) {
		$bookColumnClases = 'col-lg-12';
	}elseif('2' == $bookColumn){
		$bookColumnClases = 'col-md-6';
	}elseif('3' == $bookColumn){
		$bookColumnClases = 'col-lg-6 col-xl-4 col-md-6';
	}elseif('4' == $bookColumn){
		$bookColumnClases = 'col-lg-4 col-xl-3 col-md-6';
	}elseif('6' == $bookColumn){
		$bookColumnClases = 'col-lg-3 col-xl-2 col-md-4';
	}
	$paged = rswpbs_paged();
	$bookPerPage = intval($atts['books_per_page']);
	$bookQueryArgs = array(
		'post_type'	=> 'book',
		'posts_per_page' => $bookPerPage,
		'paged'	=> $paged,
	);
	if (isset($_GET['search_type']) && 'book' === $_GET['search_type']) {
	    $bookQueryArgs = array_merge( $bookQueryArgs, rswpbs_search_query_args() );
	    $bookQueryArgs = array_merge( $bookQueryArgs, rswpbs_sorting_form_args() );
	}elseif (isset($_GET['sortby']) && 'default' != $_GET['sortby']) {
		$bookQueryArgs = array_merge( $bookQueryArgs, rswpbs_sorting_form_args() );
	}

	$book_container_classes = '';
	$thumbnail_wrapper_classes	= '';
	$content_wrapper_classes	= '';
	if ('left' === $atts['book_cover_position']) {
		$book_container_classes = ' row mr-0 ml-0 post-list-layout thumbnail-position-left';
		$thumbnail_wrapper_classes	= ' book-cover-column col-md-6 col-lg-4 pl-0 pr-4';
		$content_wrapper_classes	= ' book-content-column col-md-6 col-lg-8';
	}elseif ('right' === $atts['book_cover_position']) {
		$book_container_classes = ' row flex-row-reverse post-list-layout thumbnail-position-right';
		$thumbnail_wrapper_classes	= ' book-cover-column col-md-6 col-lg-4 pl-4 pr-0 text-right';
		$content_wrapper_classes	= ' book-content-column col-md-6 col-lg-8';
	}elseif ('top' === $atts['book_cover_position']) {
		$thumbnail_wrapper_classes	= ' thumbnail-position-top';
	}

	$wrapperRowClass = '';
	if ( class_exists('Rswpbs_Pro') && true == $atts['show_masonry_layout']) {
		$wrapperRowClass = ' masonry_layout_active_for_books';
	}

	$booksQuery = new WP_Query($bookQueryArgs);
	$display_sorting_form_wrapper = true;
	if ('true' == $atts['show_search_form']) :
		$display_sorting_form_wrapper = false;
	?>
	<div class="rswptheme-advanced-search-form-area">
		<?php echo do_shortcode('[rswpbs_advanced_search]'); ?>
	</div>
	<?php
	endif;
	if ('true' == $atts['show_sorting_form']) :
	?>
	<div class="rswpthemes-books-shorting-form-area">
		<?php rswpbs_shorting_form_global($booksQuery, $bookPerPage, $display_sorting_form_wrapper); ?>
	</div>
	<?php
	endif;
	?>
	<div class="rswpthemes-books-showcase-area">
		<!-- Start Books Loop Container -->
		<div class="rswpthemes-books-showcase-book-loop-container">
			<div class="row<?php echo esc_attr($wrapperRowClass);?>">
				<?php
				if ($booksQuery->have_posts())  :
					while($booksQuery->have_posts()) :
						$booksQuery->the_post();
				?>
				<div class="<?php echo esc_attr($bookColumnClases);?>">
					<div class="rswpthemes-book-container<?php echo esc_attr($book_container_classes);?>">
						<?php
						if ('true' == $atts['book_image']) :
						?>
						<div class="rswpthemes-book-loop-image<?php echo esc_attr($thumbnail_wrapper_classes);?>">
							<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post(rswpbs_get_book_image(get_the_ID())); ?></a>
						</div>
						<?php
						endif;
						?>
						<div class="rswpthemes-book-loop-content-wrapper<?php echo esc_attr($content_wrapper_classes);?>">
							<?php
							if ('true' == $atts['book_title']):
							?>
							<h2 class="book-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html(rswpbs_get_book_name(get_the_ID())); ?></a></h2>
							<?php
							endif;
							if ('true' == $atts['book_author']) :
							?>
							<h4 class="book-author"><strong><?php echo rswpbs_static_text_by(); ?></strong>
								<?php
								echo wp_kses_post(rswpbs_get_book_author(get_the_ID()));
								?>
							</h4>
							<?php
							endif;
							if ('true' == $atts['book_price']) :
							?>
							<div class="book-price d-flex">
								<?php echo wp_kses_post(rswpbs_get_book_price(get_the_ID())); ?>
							</div>
							<?php endif;
							if ('true' == $atts['book_descriptions']) :
							?>
							<div class="book-desc d-flex">
						      <p><?php echo wp_kses_post(rswpbs_get_book_desc(get_the_ID(), intval($atts['descriptions_limit']))); ?></p>
						    </div>
						    <?php
							endif;
							if ('true' == $atts['book_buy_button']) :
						    ?>
						    <div class="book-buy-btn d-flex">
						      <?php echo wp_kses_post(rswpbs_get_book_buy_btn()); ?>
						    </div>
						    <?php
							endif;
							if ( class_exists('Rswpbs_Pro') && 'true' == $atts['show_msl']) :
						    ?>
						    <div class="book-multiple-sales-links d-flex">
						     <?php echo wp_kses_post(rswpbs_pro_book_also_availeble_web_list(rswpbs_static_text_also_available_on(), get_the_ID(), $atts['msl_title_align'])); ?>
						    </div>
						    <?php
							endif;
						    ?>
						</div>
					</div>
				</div>
				<?php
					endwhile;
				endif;
				?>
			</div>
			<?php
			if ('true' == $atts['show_pagination']) :
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="rswpthemes-books-pagination">
						<?php rswpbs_ct_pagination($booksQuery, $paged);?>
					</div>
				</div>
			</div>
			<?php
			endif;
			?>
		</div>
	</div>
	<?php
	wp_reset_postdata();
	return ob_get_clean();
}
