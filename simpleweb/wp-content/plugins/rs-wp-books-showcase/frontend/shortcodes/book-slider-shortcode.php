<?php
add_shortcode( 'rswpbs_book_slider', 'rswpbs_book_slider_shortcode' );
function rswpbs_book_slider_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'books_per_page' => '6',
        'categories_include' => '',
        'categories_exclude' => '',
        'authors_include' => '',
        'authors_exclude' => '',
        'book_offset' => '',
        'show_author' => 'true',
        'show_title' => 'true',
        'title_type' => 'book_name',
        'excerpt_type' => 'book_excerpt_type',
        'show_description' => 'true',
        'description_limit' => '60',
        'show_image' => 'true',
        'image_type' => 'book_cover',
        'show_price' => 'true',
        'show_buy_button' => 'true',
        'sts_l_screen' => '4',
        'sts_m_screen' => '3',
        'sts_s_screen' => '1',
        'book_cover_position' => 'top',
        'show_msl' => 'true',
        'msl_title_align' => 'center',
        'msl_title' => 'Also Available:',
        'order' => 'DESC',
        'ordery' => 'date'
    ), $atts );
    ob_start();
    $booksQargs = array(
			'post_type'	=> array('book'),
		);
	if (!empty($atts['books_per_page'])) {
		$booksQargs['posts_per_page'] = intval($atts['books_per_page']);
	}
	if (!empty($atts['ordery'])) {
		$booksQargs['ordery'] = $atts['ordery'];
	}
	if (!empty($atts['order'])) {
		$booksQargs['order'] = $atts['order'];
	}
	if (!empty($atts['categories_include'])) {
		$includeBookCategories = array_map('intval', explode(',' , $atts['categories_include']));
		$booksQargs['tax_query'] = array(
		        array(
		            'taxonomy' => 'book-category',
		            'field'    => 'term_id',
		            'terms'    => $includeBookCategories,
		        ),
		    );
	}

	if (!empty($atts['authors_include'])) {
		$includeBookAuthors = array_map('intval', explode(',' , $atts['authors_include']));
		$booksQargs['tax_query'] = array(
	        array(
	            'taxonomy' => 'book-author',
	            'field'    => 'term_id',
	            'terms'    => $includeBookAuthors,
	        ),
	    );
	}

	if (!empty($atts['categories_include']) && !empty($atts['authors_include'])) {
		$booksQargs['tax_query'] = array(
        	'relation' => 'AND',
	        array(
	            'taxonomy' => 'book-author',
	            'field'    => 'term_id',
	            'terms'    => $includeBookAuthors,
	        ),
	        array(
	            'taxonomy' => 'book-category',
	            'field'    => 'term_id',
	            'terms'    => $includeBookCategories,
	        ),
    	);
	}

	if (!empty($atts['categories_exclude']) || !empty($atts['authors_exclude'])) {
		$excludeBookCategories = array_map('intval', explode(',' , $atts['categories_exclude']));
		$excludeBookAuthors = array_map('intval', explode(',' , $atts['authors_exclude']));
 		$exclude_tax_query = array();
 		if (!empty($atts['authors_exclude'])) {
	        $exclude_tax_query[] = array(
	            'taxonomy' => 'book-author',
	            'field'    => 'term_id',
	            'terms'    => $excludeBookAuthors,
	            'operator' => 'NOT IN',
	        );
	    }
	    if (!empty($atts['categories_exclude'])) {
	        $exclude_tax_query[] = array(
	            'taxonomy' => 'book-category',
	            'field'    => 'term_id',
	            'terms'    => $excludeBookCategories,
	            'operator' => 'NOT IN',
	        );
	    }
	    $booksQargs['tax_query']['relation'] = 'AND';
		$booksQargs['tax_query'] = array_merge($booksQargs['tax_query'], $exclude_tax_query);
	}

	if (!empty($atts['book_offset'])) {
		$booksQargs['offset'] = $atts['book_offset'];
	}

	$sliderItemClasses = array();

	if ($atts['show_author'] == 'true') {
	    $sliderItemClasses[] = 'has-book-author';
	} else {
	    $sliderItemClasses[] = 'no-book-author';
	}
	if ($atts['show_title'] == 'true') {
	    $sliderItemClasses[] = 'has-book-title';
	} else {
	    $sliderItemClasses[] = 'no-book-title';
	}

	if ($atts['show_description'] == 'true') {
	    $sliderItemClasses[] = 'has-book-description';
	} else {
	    $sliderItemClasses[] = 'no-book-description';
	}

	if ($atts['show_image'] == 'true') {
	    $sliderItemClasses[] = 'has-book-image';
	} else {
	    $sliderItemClasses[] = 'no-book-image';
	}

	if ($atts['show_price'] == 'true') {
	    $sliderItemClasses[] = 'has-book-price';
	} else {
	    $sliderItemClasses[] = 'no-book-price';
	}

	if ($atts['show_buy_button'] == 'true') {
	    $sliderItemClasses[] = 'has-book-buy-button';
	} else {
	    $sliderItemClasses[] = 'no-book-buy-button';
	}

	if (!empty($atts['sts_l_screen'])) {
	    $sliderItemClasses[] = 'slider-large-screen-item-' . $atts['sts_l_screen'];
	}
	$sliderItemClasess_string = implode(' ', $sliderItemClasses);

	$loopContentWrapper = false;
	if ($atts['show_author'] === 'true' || $atts['show_title'] === 'true' || $atts['show_description'] === 'true' || $atts['show_image'] === 'true' || $atts['show_price'] === 'true' || $atts['show_buy_button'] === 'true') {
	    $loopContentWrapper = true;
	}

	$book_container_classes = 'container-full';
	$book_list_row_classes = '';
	$thumbnail_wrapper_classes	= '';
	$content_wrapper_classes	= '';
	if ('left' === $atts['book_cover_position']) {
		$book_list_row_classes = ' row mr-0 ml-0 align-items-center justify-content-between post-list-layout thumbnail-position-left';
		$book_container_classes = 'container';
		$thumbnail_wrapper_classes	= ' book-cover-column col-md-6 col-lg-4 pr-4 pl-0';
		$content_wrapper_classes	= ' book-content-column col-md-6 col-lg-8';
	}elseif ('right' === $atts['book_cover_position']) {
		$book_list_row_classes = ' row mr-0 ml-0 align-items-center justify-content-between flex-row-reverse post-list-layout thumbnail-position-right';
		$book_container_classes = 'container';
		$thumbnail_wrapper_classes	= ' book-cover-column col-md-6 col-lg-4 pr-0 pl-4 text-right';
		$content_wrapper_classes	= ' book-content-column col-md-6 col-lg-8';
	}elseif ('top' === $atts['book_cover_position']) {
		$book_container_classes = 'container-full';
		$thumbnail_wrapper_classes	= ' thumbnail-position-top';
	}

	$getSlider_attributes = array(
	    'lscreen' => $atts['sts_l_screen'],
	    'mscreen' => $atts['sts_m_screen'],
	    'sscreen' => $atts['sts_s_screen'],
	);

	$sliderAttr = '';
	foreach ($getSlider_attributes as $key => $value) {
	    $sliderAttr .= ' data-' . $key . '="' . esc_attr($value) . '"';
	}
	$bookQuery = new WP_Query($booksQargs);
	$activateSlider = '';
	if ($bookQuery->post_count > 1) {
	    $activateSlider = ' book-slider-activate';
	}
    ?>
    <div class="rswpbs-book-slider <?php echo esc_attr($sliderItemClasess_string);?>">
    	<div class="container">
    		<div class="rswpbs-book-slider__slider-wrapper-row<?php echo esc_attr($activateSlider);?>" <?php echo $sliderAttr;?>>
    			<?php
    			if ($bookQuery->have_posts()) :
    				while( $bookQuery->have_posts() ) :
    					$bookQuery->the_post();
		    			?>
		    			<div class="rswpbs-book-slider__slider-item">
		    				<div class="rswpthemes-book-container<?php echo esc_attr($book_list_row_classes);?>">
								<?php
								if ('true' == $atts['show_image']) :
								?>
								<div class="rswpthemes-book-loop-image<?php echo esc_attr($thumbnail_wrapper_classes);?>">
									<a href="<?php the_permalink(); ?>"><?php
									if ('book_cover' == $atts['image_type']) :
										echo wp_kses_post(rswpbs_get_book_image(get_the_ID()));
									else:
										if (class_exists('Rswpbs_Pro')) {
											$bookMockup = get_field('mockup_image');
											?>
											<img src="<?php echo esc_url($bookMockup);?>" alt="<?php echo esc_attr(get_the_title());?>">
											<?php
										}
									endif;
									?></a>
								</div>
								<?php
								endif;
								if (true === $loopContentWrapper) :
								?>
								<div class="rswpthemes-book-loop-content-wrapper<?php echo esc_attr($content_wrapper_classes);?>">
									<?php
									if ('true' == $atts['show_title']):
									?>
									<h2 class="book-title"><a href="<?php the_permalink(); ?>"><?php
									if ('book_name' == $atts['title_type']) :
									 echo esc_html(rswpbs_get_book_name(get_the_ID()));
									else:
										the_title();
									endif;
									?></a></h2>
									<?php
									endif;
									if ('true' == $atts['show_author']) :
									?>
									<h4 class="book-author"><strong><?php esc_html_e('By ', RSWPBS_TEXT_DOMAIN); ?></strong>
										<?php
										echo wp_kses_post(rswpbs_get_book_author(get_the_ID()));
										?>
									</h4>
									<?php
									endif;
									if ('true' == $atts['show_price']) :
									?>
									<div class="book-price d-flex">
										<?php echo wp_kses_post(rswpbs_get_book_price(get_the_ID())); ?>
									</div>
									<?php endif;
									if ('true' == $atts['show_description']) :
										if ('excerpt' == $atts['excerpt_type']) :
										?>
										<div class="book-desc d-flex">
									      <p><?php echo wp_kses_post(rswpbs_get_book_desc(get_the_ID(), intval($atts['description_limit']))); ?></p>
									    </div>
									    <?php
										elseif('fullcontent' == $atts['excerpt_type']):
											?>
											<div class="book-full-content-as-excerpt">
												<?php the_content(); ?>
											</div>
											<?php
										endif;
									endif;
									if ('true' == $atts['show_buy_button']) :
								    ?>
								    <div class="book-buy-btn d-flex">
								      <?php echo wp_kses_post(rswpbs_get_book_buy_btn()); ?>
								    </div>
								    <?php
									endif;
									if (class_exists('Rswpbs_Pro') && 'true' == $atts['show_msl']) :
								    ?>
								    <div class="book-multiple-sales-links d-flex">
								      <?php echo wp_kses_post(rswpbs_pro_book_also_availeble_web_list(rswpbs_static_text_also_available_on(), get_the_ID(), $atts['msl_title_align'])); ?>
								    </div>
								    <?php
									endif;
								    ?>
								</div>
								<?php
								endif;
								?>
							</div>
		    			</div>
		    			<?php
    				endwhile;
    			endif;
    			?>
    		</div>
    	</div>
    </div>
    <?php
    wp_reset_postdata();
   return ob_get_clean();
}
