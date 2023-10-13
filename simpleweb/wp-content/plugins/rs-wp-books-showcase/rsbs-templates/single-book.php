<?php
/**
 * Single Template
 */
get_header();
do_action('rswpbs_book_page_before');
?>
<div class="rswpthemes-book-single-wrapper">
	<div class="container">
		<div class="rswpthemes-book-single-header-content-container">
			<?php do_action('rswpbs_single_book_before_header_row'); ?>
			<div class="row justify-content-center m-0">
				<div class="col-lg-5 col-md-5 text-center">
					<?php do_action('rswpbs_single_book_before_thumbnail'); ?>
					<div class="rswpthemes-book-image-wrapper">
						<?php
						 echo wp_kses_post(rswpbs_get_book_image()); ?>
					</div>
					<?php do_action('rswpbs_single_book_after_thumbnail'); ?>
				</div>
				<div class="col-lg-6 col-md-7 pl-lg-5">
					<div class="rswpthemes-book-content-wrapper">
						<?php if(!empty(rswpbs_get_book_name())) : ?>
						<h1 class="book-name"><?php echo esc_html( rswpbs_get_book_name() );?></h1>
						<?php
						endif;
						if(!empty(rswpbs_get_book_author())) : ?>
						<h4 class="book-author"><strong><?php echo rswpbs_static_text_by(); ?> </strong>
							<?php
							echo wp_kses_post(rswpbs_get_book_author());
							?>
						</h4>
						<?php endif;
						if(!empty(rswpbs_get_avg_rate())) : ?>
						<div class="book-ratings">
							<?php
							echo wp_kses_post(rswpbs_get_avg_rate());
							?>
						</div>
						<?php endif;
						if(!empty(rswpbs_get_book_desc())) :
						?>
						<div class="rswpthemes-book-short-description mb-3">
							<p><?php echo wp_kses_post( rswpbs_get_book_desc() );?></p>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_price())) :
						?>
						<div class="book-price d-flex justify-content-start">
							<strong><?php echo rswpbs_static_text_price(); ?></strong>&nbsp;&nbsp;<?php echo wp_kses_post(rswpbs_get_book_price()); ?>
						</div>
						<?php endif;
						if (class_exists('Rswpbs_Pro') && !empty(rswpbs_get_book_buy_btn())) :
						?>
						<div class="rswpthemes-buy-now-button-wrapper d-flex justify-content-start">
							<?php echo rswpbs_get_book_buy_btn(); ?>
						</div>
						<?php
						endif;
						do_action('rswpbs_after_book_main_details');
						?>
					</div>
				</div>
			</div>
			<?php do_action('rswpbs_single_book_after_header_row'); ?>
		</div>
		<!-- End Book Header Content Container Div -->
		<div class="rswpthemes-book-overview-section">
			<div class="row">
				<div class="col-lg-8 pl-0">
					<div class="rswpthemes-book-overview">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="col-lg-4 pl-0 pr-0">
					<div class="rswpthemes-book-information-container">
						<?php
						if (!empty(rswpbs_get_book_availability_status())):
						 ?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_availability();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html( rswpbs_get_book_availability_status() );?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_original_name())):
						 ?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_original_title();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html( rswpbs_get_book_original_name() );?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_categories())):
						 ?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_categories();?></h4>
							</div>
							<div class="information-content">
								<h4>
									<?php
									echo wp_kses_post(rswpbs_get_book_categories());
									?>
								</h4>
							</div>
						</div>
						<?php endif;
						if(!empty(rswpbs_get_book_publish_date())) :
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_publish_date();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_publish_date()); ?></h4>
							</div>
						</div>
						<?php endif;
						if(!empty(rswpbs_get_book_publish_year())) :
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_published_year();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_publish_year()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_publisher_name())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_publisher_name();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_publisher_name()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_pages())) :
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_total_pages();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_pages()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_isbn())) :
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_isbn();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_isbn()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_isbn_10())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_isbn_10();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_isbn_10()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_isbn_13())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_isbn_13();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_isbn_13()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_asin())) :
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_asin();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_asin()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_format())) :
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_format();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_format()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_country())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_country();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_country()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_language())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_language();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_language()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_translator())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_translator();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_translator()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_file_size())) :
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_file_size();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_file_size()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_dimension())) :
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_dimension();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_dimension()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_weight())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_weight();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_weight()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_file_format())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_file_format();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_file_format()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_simultaneous_device_usage())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_simultaneous_device_usage();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_simultaneous_device_usage()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_book_text_to_speech())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_text_to_speech();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_book_text_to_speech()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_screen_reader())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_screen_reader();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_screen_reader()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_enhanced_typesetting())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_enhanced_typesetting();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_enhanced_typesetting()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_x_ray())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_x_ray();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_x_ray()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_word_wise())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_word_wise();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_word_wise()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_sticky_notes())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_sticky_notes();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_sticky_notes()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_print_length())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_print_length();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo esc_html(rswpbs_get_print_length()); ?></h4>
							</div>
						</div>
						<?php endif;
						if (!empty(rswpbs_get_avg_rate())):
						?>
						<div class="information-list">
							<div class="information-label">
								<h4><?php echo rswpbs_static_text_avarage_ratings();?></h4>
							</div>
							<div class="information-content">
								<h4><?php echo wp_kses_post(rswpbs_get_avg_rate()); ?></h4>
							</div>
						</div>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Testimonial Area -->
<?php
do_action('rswpbs_book_page_after');
get_footer();
