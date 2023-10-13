<?php
add_action('in_admin_header', function () {
	$getCurrentScreen = get_current_screen();
	if ('book_page_rswpbs-tutorial' === $getCurrentScreen->id) {
		remove_all_actions('admin_notices');
  		remove_all_actions('all_admin_notices');
	}
}, 1000);

function rswpbs_tutorial_page() {
    // Add the settings page
    add_submenu_page(
        'edit.php?post_type=book', // Parent menu slug
        'RS WP BOOKS SHOWCASE Use Tutorial', // Page title
        'Tutorial', // Menu title
        'manage_options', // Capability
        'rswpbs-tutorial', // Menu slug
        'rswpbs_tutorial_page_content' // Callback function
    );
}
add_action( 'admin_menu', 'rswpbs_tutorial_page', 10);

function rswpbs_tutorial_page_content() {
    ?>
    <div class="tutorial-page-wrapper">
        <div class="tutorial-page-inner">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-5 tutorial-left-column">
                        <div class="tutorial-single-section">
                            <div class="shortcode-title">
                               <h2><?php esc_html_e('Book Gallery Shortcode', RSWPBS_TEXT_DOMAIN); ?></h2>
                               <p><?php esc_html_e('Copy this shortcode and past it in your books page.', RSWPBS_TEXT_DOMAIN);?></p>
                            </div>
                            <div class="shortcode-wrapper">
                               <div class="shortcode-container">
                                    <pre>[rswpbs_book_gallery book_image=true book_title=true book_author=true book_price=true book_buy_button=true book_descriptions=true books_per_page=8 books_per_row=3 show_search_form=true show_sorting_form=true show_pagination=true book_cover_position=top]</pre>
                               </div>
                            </div>
                            <div class="video-title">
                               <h2><?php esc_html_e('How to Use This Shortcode.', RSWPBS_TEXT_DOMAIN); ?></h2>
                               <p><?php esc_html_e( 'By the end of this video, you\'ll learn how to easily add books to your website using the backend and then showcase them in a variety of layouts on your WordPress website using shortcodes. If you\'re not familiar with shortcodes, don\'t worry - we have you covered with our Gutenberg block and Elementor widget. To take advantage of these powerful features, upgrade to RS WP BOOK SHOWCASE Pro today', RSWPBS_TEXT_DOMAIN );?></p>
                            </div>
                            <div class="video-wrapper">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/efF130jkcS8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="tutorial-single-section">
                            <div class="shortcode-title">
                               <h2><?php esc_html_e('Book Slider Shortcode', RSWPBS_TEXT_DOMAIN); ?></h2>
                               <p><?php esc_html_e('Copy this shortcode and past it anywhere of the page/post where you want to show book slider.', RSWPBS_TEXT_DOMAIN);?></p>
                               <p><?php esc_html_e( 'Please watch above video to learn how to use shortcodes. if you are not familiar with shortcodes. do not worry - we also have book slider Gutenberg Block and elementor widget. To take advantage of these features, upgrade to RS WP BOOK SHOWCASE pro today.', RSWPBS_TEXT_DOMAIN );?></p>
                            </div>
                            <div class="shortcode-wrapper">
                               <div class="shortcode-container">
                                    <pre>[rswpbs_book_slider books_per_page=6 show_author=true show_title=true title_type=book_name show_description=true show_image=true image_type=book_cover show_price=true show_buy_button=true sts_l_screen=4 sts_m_screen=3 sts_s_screen=1 book_cover_position=top]</pre>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 tutorial-right-column">
                        <?php
                        if (!class_exists('Rswpbs_Pro')) :
                        ?>
                        <div class="upgradeToPro">
                            <a class="upgradeToProLink" href="<?php echo esc_url('https://rswpthemes.com/rs-wp-books-showcase-wordpress-plugin/');?>"><?php esc_html_e( 'Upgrade To Pro', RSWPBS_TEXT_DOMAIN );?></a>
                        </div>
                        <?php
                        endif;
                        ?>
                        <div class="tutorial-single-section">
                            <div class="shortcode-title">
                               <h2><?php esc_html_e('Book Gallery and Book Slider Gutenberg Block ( Pro ).', RSWPBS_TEXT_DOMAIN); ?></h2>
                               <p><?php esc_html_e('This Block Is Available In The Pro Version Only.', RSWPBS_TEXT_DOMAIN);?></p>
                            </div>
                            <div class="video-title">
                               <h2><?php esc_html_e('How to Use Gutenberg Block.', RSWPBS_TEXT_DOMAIN); ?></h2>
                            </div>
                            <div class="video-wrapper">
                               <iframe width="560" height="315" src="https://www.youtube.com/embed/84gda4bjCa0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="tutorial-single-section">
                            <div class="shortcode-title">
                               <h2><?php esc_html_e('Display Books Using Elementor Page Builder ( Pro ).', RSWPBS_TEXT_DOMAIN); ?></h2>
                               <p><?php esc_html_e('This Widget is Available In The Pro Version Only.');?></p>
                            </div>
                            <div class="video-title">
                               <h2><?php esc_html_e('Design a Stunning Book Gallery with Elementor: A Step-by-Step Guide', RSWPBS_TEXT_DOMAIN); ?></h2>
                            </div>
                            <div class="video-wrapper">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/XiOyJ9x061E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}