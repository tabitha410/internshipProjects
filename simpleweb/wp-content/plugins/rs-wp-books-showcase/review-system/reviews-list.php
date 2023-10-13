<?php
add_action('rswpbs_book_page_after', 'rswpbs_book_reviews', 10);
function rswpbs_book_reviews(){
	$showReviewList = true;
	if (class_exists('Rswpbs_Pro')) {
		$showReviewList = get_field('show_book_reviews', 'option');
	}else{
		$showReviewList = true;
	}
	if (true === $showReviewList) :
	$reviewsArgs = array(
		'post_type'	=> 'book_reviews',
		'posts_per_page' => 10,
		'meta_key'	=> '_rswpbs_reviewed_book',
		'meta_value'	=> get_the_ID(),
		'post_status'	=> 'publish',
	);
	$reviewesQuery = new WP_Query($reviewsArgs);
	if ($reviewesQuery->have_posts()) :
	?>
	<div class="rswpbs-book-reviews-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="rswpbs-book-reviews-inner">
						<div class="section-title-area">
							<div class="row">
								<div class="col-md-12 text-center text-md-left">
									<div class="section-title">
										<h2><?php esc_html_e('Readers Feedback', RSWPBS_TEXT_DOMAIN);?></h2>
									</div>
								</div>
							</div>
						</div>
						<div class="book-review-list">
							<div class="row rswpbs-testimonial-masonry">
								<?php
								while( $reviewesQuery->have_posts()) :
									$reviewesQuery->the_post();
								 ?>
								<div class="col-12 col-md-6 col-lg-4 testimonial-item-col">
									<div class="testimonial__item-inner">
										<?php
										$reviewerEmail = get_post_meta( get_the_ID(), '_rswpbs_reviewer_email', true);
										$reviewerName = get_post_meta( get_the_ID(), '_rswpbs_reviewer_name', true);
										$reviewerImage = get_avatar($reviewerEmail, 70, 'wavatar', $reviewerName );
										if (!empty(get_the_title( get_the_ID() ))):
										?>
										<h5 class="review-title"><?php echo esc_html( get_the_title(get_the_ID()) );?></h5>
										<?php endif;
										$reviewerRating = get_post_meta(get_the_ID(), '_rswpbs_rating', true);
										if (!empty($reviewerRating)) :
										?>
										<div class="client-rating">
											<?php
											for ($i=0; $i < $reviewerRating; $i++) {
												echo wp_kses_post('<span class="fa-regular fa-star fa-solid"></span>');
											}
											?>
										</div>
										<?php
										endif;
										if(!empty(get_the_content())) :
										?>
										<p class="client-feedback"><?php echo wp_kses_post( get_the_content(get_the_ID()) ); ?></p>
										<?php endif; ?>
										<div class="reviewer-wrapper">
											<?php
											if (!empty($reviewerImage)) :?>
											<div class="client-image">
												<?php
													echo wp_kses_post( $reviewerImage );
												?>
											</div>
											<?php endif;
											if(!empty($reviewerName)) :
											?>
											<div class="name-and-date">
												<h4 class="client-name"><?php echo esc_html( $reviewerName );?></h4>
												<div class="review-time">
													<?php rswpbs_ctp_pub_time(); ?>
												</div>
											</div>
											<?php endif;?>
										</div>
									</div>
								</div>
								<?php endwhile; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	endif;
	wp_reset_postdata();
	endif;
}