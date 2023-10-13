<?php
/**
 * Review Form For Front End
 */
add_shortcode( 'rswpbs_review_form', 'rswpbs_review_form_callback' );
function rswpbs_review_form_callback(){
  ob_start();
  global $post;
  $currentPostId = $post->ID;
  ?>
  <div class="rswpbs-review-form-wrapper">
  	<div class="review-section-title">
	    <h3><?php esc_html_e('Submit Your Review', RSWPBS_TEXT_DOMAIN); ?>
      <?php
      if (!is_user_logged_in()) {
        echo sprintf('<small>%1$s <a href="%3$s">%2$s</a></small>',
          __( 'You are not allowed to submit review. please', RSWPBS_TEXT_DOMAIN ),
          __( 'Log In', RSWPBS_TEXT_DOMAIN ),
          esc_url(wp_login_url()),
        );
      }
      ?>
      </h3>
	</div>
    <form action="" id="rswpbs-review-form">
      <?php wp_nonce_field( 'rswpbs_submit_review', '_rswpbs_submit_review_nonce' ); ?>
      <div class="current-post-id">
        <input type="hidden" name="current_post_id" value="<?php echo esc_attr($currentPostId);?>">
      </div>
      <div class="rswpbs-review-form-inner row">
        <div class="rswpbs-review-form-field col-md-4 mb-4">
        	<label for="review_title"><?php esc_html_e('Review Title: ', RSWPBS_TEXT_DOMAIN); ?></label>
            <input class="form-control" type="text" name="review_title" id="review_title" required>
        </div>
        <div class="rswpbs-review-form-field col-md-4 mb-4">
        	<label for="reviewer_name"><?php esc_html_e('Full Name: ', RSWPBS_TEXT_DOMAIN); ?></label>
            <input class="form-control" type="text" name="reviewer_name" id="reviewer_name" required>
        </div>
        <div class="rswpbs-review-form-field col-md-4 mb-4">
        	<label for="reviewer_email"><?php esc_html_e('Email Address: ', RSWPBS_TEXT_DOMAIN); ?></label>
            <input class="form-control" id="reviewer_email" type="email" name="reviewer_email" required>
        </div>
        <div class="rswpbs-review-form-field col-md-12 mb-4">
          <label for="rating"><?php esc_html_e('Rating: ', RSWPBS_TEXT_DOMAIN); ?></label>
           <span class="stars">
		        <i class="fa-regular fa-star" data-value="1"></i>
		        <i class="fa-regular fa-star" data-value="2"></i>
		        <i class="fa-regular fa-star" data-value="3"></i>
		        <i class="fa-regular fa-star" data-value="4"></i>
		        <i class="fa-regular fa-star" data-value="5"></i>
		        <input type="hidden" name="rating" id="rating" value="" required>
	      </span>
        </div>
        <div class="rswpbs-review-form-field col-md-12 mb-4">
          <label for="reviewer_comment"><?php esc_html_e('Review: ', RSWPBS_TEXT_DOMAIN); ?></label>
          <textarea class="form-control" id="reviewer_comment" name="reviewer_comment" cols="30" rows="5" required></textarea>
        </div>
        <div class="rswpbs-review-form-field col-md-12 mb-4">
          <input type="submit" value="submit" class="submit-btn"<?php echo (!is_user_logged_in() ? ' disabled="disabled"' : '')?>>
        </div>
      </div>
    </form>
  </div>
  <?php
  return ob_get_clean();
}

/**
 * Review Form Ajax Handler
 */

add_action('wp_ajax_nopriv_rswpbs_submit_review_form', 'rswpbs_submit_review_form');
add_action('wp_ajax_rswpbs_submit_review_form', 'rswpbs_submit_review_form');

function rswpbs_submit_review_form(){
    $formFeilds = array();
    wp_parse_str( $_POST['rswpbs_submit_review_form'], $formFeilds );
    if ( !is_user_logged_in() && wp_verify_nonce( $formFeilds['_rswpbs_submit_review_nonce'], 'rswpbs_submit_review' ) ) {
      wp_send_json_error( array(
        'message' => 'You are not allowed to submit review please login and then submit review',
      ) );
      wp_die('Invalid request');
    }else{
        $review_title = sanitize_text_field($formFeilds['review_title']);
        $reviewer_name = sanitize_text_field($formFeilds['reviewer_name']);
        $reviewer_email = sanitize_email($formFeilds['reviewer_email']);
        $rating = intval($formFeilds['rating']);
        $reviewer_comment = wp_kses_post($formFeilds['reviewer_comment']);
        $currentPostId = intval($formFeilds['current_post_id']);
        if (empty($review_title)) {
          $error = 'Please enter your name.';
        } elseif (empty($reviewer_name)) {
          $error = 'Please enter your name.';
        } elseif (empty($reviewer_email)) {
          $error = 'Please enter your email.';
        } elseif (!is_email($reviewer_email)) {
          $error = 'Please enter a valid email.';
        } elseif (empty($rating) || $rating < 1 || $rating > 5) {
          $error = 'Please enter a valid rating.';
        } elseif (empty($reviewer_comment)) {
          $error = 'Please enter your review.';
        }
        $review = array(
            'post_title' => $review_title,
            'post_content' => $reviewer_comment,
            'post_type' => 'book_reviews',
            'post_status' => 'pending',
            'meta_input' => array(
              '_rswpbs_reviewer_name' => $reviewer_name,
              '_rswpbs_reviewer_email' => $reviewer_email,
              '_rswpbs_rating' => $rating,
              '_rswpbs_reviewed_book' => $currentPostId,
          )
        );
        $post_id = wp_insert_post($review);
        if ($post_id) {
            wp_send_json_success(array('message' => 'Your review has been submitted and is pending approval.'));
        }else{
            wp_send_json_error(array('message' => $error));
        }
    }
  wp_die();
}

add_action('rswpbs_book_page_after', 'rswpbs_book_review_form', 15);
function rswpbs_book_review_form(){
  $showReviewForm = true;
  if (class_exists('Rswpbs_Pro')) {
    $showReviewForm = get_field('show_review_form', 'option');
  }else{
    $showReviewForm = true;
  }
  if (true === $showReviewForm) :
    ?>
    <div class="rswpbs-book-review-form-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php echo do_shortcode('[rswpbs_review_form]'); ?>
          </div>
        </div>
      </div>
    </div>
    <?php
  endif;
}