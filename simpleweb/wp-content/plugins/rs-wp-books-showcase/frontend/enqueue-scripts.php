<?php
/**
 * Book Showcase Enqueue Assets
 */

// add_action('enqueue_block_editor_assets', 'rswpbs_block_editor_assets');
// function rswpbs_block_editor_assets(){
// 	$getRswpThemesSlug = get_stylesheet();
// 	if ('author-portfolio-pro' != $getRswpThemesSlug) :
// 		wp_enqueue_style( 'rswpbs-bootstrap-grid', RSWPBS_PLUGIN_URL . 'includes/assets/css/bootstrap-grid.css' );
// 		wp_enqueue_style( 'rswpbs-selectize', RSWPBS_PLUGIN_URL . 'frontend/assets/css/selectize.css' );
// 		wp_enqueue_style( 'rswpbs-style', RSWPBS_PLUGIN_URL . 'frontend/assets/css/style.css' );
// 	endif;
// }
add_action('enqueue_block_editor_assets', 'rswpbs_assets');
add_action('wp_enqueue_scripts', 'rswpbs_assets');
function rswpbs_assets(){
 	$getRswpThemesSlug = get_stylesheet();
	wp_enqueue_style( 'fontawesome-v6', RSWPBS_PLUGIN_URL . 'frontend/assets/css/fontawesome.css' );
	wp_enqueue_style( 'rswpbs-selectize', RSWPBS_PLUGIN_URL . 'frontend/assets/css/selectize.css' );
	if ('author-portfolio' != $getRswpThemesSlug || 'author-portfolio-pro' != $getRswpThemesSlug || 'book-author-blog' != $getRswpThemesSlug || 'author-personal-blog' != $getRswpThemesSlug) {
		wp_enqueue_style( 'rswpbs-bootstrap-grid', RSWPBS_PLUGIN_URL . 'includes/assets/css/bootstrap-grid.css' );
	}
 	if ('author-portfolio-pro' != $getRswpThemesSlug) {
		wp_enqueue_style( 'slick-slider', RSWPBS_PLUGIN_URL . 'frontend/assets/css/slick.css' );
 	}
	wp_enqueue_style( 'rswpbs-style', RSWPBS_PLUGIN_URL . 'frontend/assets/css/style.css' );
	if (!wp_script_is( 'masonry' )) {
		wp_enqueue_script('masonry');
	}
	if ('author-portfolio-pro' != $getRswpThemesSlug) {
		wp_enqueue_script('slick-slider', RSWPBS_PLUGIN_URL . 'frontend/assets/js/slick.js', array('jquery'), '2.3.4', true);
	}
	wp_enqueue_script('rswpbs-selectize', RSWPBS_PLUGIN_URL . 'frontend/assets/js/selectize.js', array('jquery'), '1.0', true);
	wp_enqueue_script('rswpbs-slider', RSWPBS_PLUGIN_URL . 'frontend/assets/js/slider.js', array('jquery'), '1.0', true);
	wp_enqueue_script('rswpbs-custom-scripts', RSWPBS_PLUGIN_URL . 'frontend/assets/js/custom.js', array('jquery'), '1.0', true);
	if (!is_admin() || !wp_doing_ajax() ) {
		if ('book' === get_post_type() && is_singular('book')) {
			wp_enqueue_script('rswpbs-review-form', RSWPBS_PLUGIN_URL . 'frontend/assets/js/review-form.js', array('jquery'), '1.0', true);
			wp_localize_script( 'rswpbs-review-form', 'rswpbs', array(
				'ajaxurl' => admin_url('admin-ajax.php'),
			) );
		}
	}
}