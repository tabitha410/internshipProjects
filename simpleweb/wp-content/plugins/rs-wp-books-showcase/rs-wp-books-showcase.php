<?php
/**
 * Plugin Name:       RS WP Books Showcase
 * Plugin URI:        https://rswpthemes.com/rs-wp-books-showcase-wordpress-plugin/
 * Description:       The RS WP BOOKS SHOWCASE WordPress plugin is a comprehensive solution for authors and publishers who want to create a website for publishing and showcasing books.
 * Version:           6.0.5
 * Requires at least: 4.9
 * Requires PHP:      5.6
 * Author:            RS WP THEMES
 * Author URI:        https://rswpthemes.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       rswpbs
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!defined('RSWPBS_PLUGIN_PATH')) {
    define('RSWPBS_PLUGIN_PATH', plugin_dir_path( __file__ ));
}
if (!defined('RSWPBS_PLUGIN_URL')) {
    define('RSWPBS_PLUGIN_URL', plugin_dir_url( __file__ ));
}
if (!defined('RSWPBS_TEXT_DOMAIN')) {
    define('RSWPBS_TEXT_DOMAIN', 'rswpbs');
}

class Rswpbs{
    public function __construct(){
        require_once RSWPBS_PLUGIN_PATH . '/includes/opt-in/opt-in.php';
        require_once RSWPBS_PLUGIN_PATH . '/admin/init.php';
        require_once RSWPBS_PLUGIN_PATH . '/admin/register-cpt.php';
        require_once RSWPBS_PLUGIN_PATH . '/admin/register-cmb.php';
        require_once RSWPBS_PLUGIN_PATH . '/admin/tutorial.php';
        require_once RSWPBS_PLUGIN_PATH . '/frontend/enqueue-scripts.php';
        require_once RSWPBS_PLUGIN_PATH . '/frontend/rswpbs-shortcodes.php';
        require_once RSWPBS_PLUGIN_PATH . '/includes/template-hook.php';
        require_once RSWPBS_PLUGIN_PATH . '/includes/widgets/featured-book.php';
        require_once RSWPBS_PLUGIN_PATH . '/includes/widgets/books-list.php';
        require_once RSWPBS_PLUGIN_PATH . '/includes/functions.php';
        require_once RSWPBS_PLUGIN_PATH . '/includes/default-loop-modify.php';
        require_once RSWPBS_PLUGIN_PATH . '/includes/AdvancedSearch.php';
        require_once RSWPBS_PLUGIN_PATH . '/includes/static-text.php';
        require_once RSWPBS_PLUGIN_PATH . '/review-system/review.php';
        add_action('plugin_loaded', [$this, 'rswpbs_plugin_loaded']);
        add_filter('body_class', [$this, 'rswpbs_body_classes']);
    }

    public function rswpbs_plugin_loaded(){
        $metafieldForBook = new Rswpbs_Cmb_For_Book();
        $registerBookPostType = new Rswpbs_Register_Book_Post_Type();
        load_plugin_textdomain(
            'rswpbs',
            false,
            dirname( plugin_basename( __FILE__ ) ) . '/languages/'
        );
    }
   public function rswpbs_body_classes($default_classes){
        $default_classes[] = 'rs-wp-books-showcase-activated';
        if (is_singular( 'book' )) {
            $default_classes[] = 'rs-wp-books-showcase-single-page';
        }elseif (is_tax( 'book-author' )) {
            $default_classes[] = 'rs-wp-books-showcase-author-tax-page';
        }elseif (is_tax('book-category')) {
            $default_classes[] = 'rs-wp-books-showcase-category-tax-page';
        }elseif (is_post_type_archive('book')) {
            $default_classes[] = 'rs-wp-books-showcase-archive-page';
        }
        return $default_classes;
    }
}

$rsbookShowcase = new Rswpbs();

function rswpbs_set_sttings_default_value(){
    $default_settings = array(
        'show_books_page_header' => false,
        'show_search_form' => true,
        'show_sorting_section' => true,
        'book_per_page' => 8,
        'book_column' => 4,
        'show_book_title' => true,
        'show_book_author_name' => true,
        'show_book_price' => true,
        'show_book_buy_now_button' => true,
        'show_book_short_description' => true,
    );
    update_option( 'book_layouts_settings', $default_settings );
}
function rswpbs_book_author_role() {
    add_role( 'rswpbs_book_author','Book Author', array('read', true) );
}
function rswpbs_set_book_author_role(){
    $roles = array('rswpbs_book_author', 'administrator');
    foreach($roles as $the_role){
        $role = get_role( $the_role );
        $role->add_cap('read');
        $role->add_cap('edit_books');
        $role->add_cap('edit_published_books');
        $role->add_cap('delete_published_books');
        if ('rswpbs_book_author' === $the_role) {
            $role->add_cap('publish_books', false);
            $role->add_cap('edit_others_books', false);
            $role->add_cap('read_private_books', false);
            $role->add_cap('edit_private_books', false);
            $role->add_cap('delete_private_books', false);
            $role->add_cap('delete_others_books', false);
            $role->add_cap('manage_book_author', false);
            $role->add_cap('delete_book_author', false);
            $role->add_cap('manage_book_category', false);
            $role->add_cap('delete_book_category', false);
        }else{
            $role->add_cap('publish_books', true);
            $role->add_cap('delete_books', true);
            $role->add_cap('delete_book', true);
            $role->add_cap('edit_others_books', true);
            $role->add_cap('delete_others_books', true);
            $role->add_cap('read_private_books', true);
            $role->add_cap('edit_private_books', true);
            $role->add_cap('delete_private_books', true);
            $role->add_cap('manage_book_author', true);
            $role->add_cap('delete_book_author', true);
            $role->add_cap('manage_book_category', true);
            $role->add_cap('delete_book_category', true);
        }
        $role->add_cap('edit_book_author');
        $role->add_cap('assign_book_author');
        $role->add_cap('edit_book_category');
        $role->add_cap('assign_book_category');
    }
}
/**
 * Saving Settings Page Value
 */

add_action( 'admin_init', 'rswpbs_active' );
function rswpbs_active() {
    rswpbs_book_author_role();
    rswpbs_set_book_author_role();
    rswpbs_set_sttings_default_value();
}

/**
 * Removed Role When This Plugin is Deactivated
 */
register_deactivation_hook( __FILE__,  'rswpbs_remove_book_author_role' );
function rswpbs_remove_book_author_role(){
    remove_role( 'rswpbs_book_author' );
}

/**
 * Turn False woocommerce_prevent_admin_access
 */
add_filter('woocommerce_prevent_admin_access', 'rswpbs_allow_admin_access', 20, 1);
function rswpbs_allow_admin_access($prevent_admin_access) {
    if(current_user_can( 'rswpbs_book_author' )){
        $prevent_admin_access = false;
    }
    return $prevent_admin_access;
}

if (!class_exists('Rswpbs_Pro')) :
    function rswpbs_upgrade_to_pro_link_pal( $links ) {
        $upgradetoProLink = sprintf('<a target="_blank" class="rswpbs-pal-link-ugtp" href="%1$s">%2$s</a>', esc_url( 'https://rswpthemes.com/rs-wp-books-showcase-wordpress-plugin/' ), esc_html__('Book Gallery Upgrade to Pro', RSWPBS_TEXT_DOMAIN) );
        $settings = sprintf('<a href="%1$s">%2$s</a>', esc_url(admin_url('edit.php?post_type=book&page=book-showcase-settings')), esc_html__('Settings', RSWPBS_PLUGIN_PATH));
        array_splice( $links, 0, 0, $upgradetoProLink );
        array_splice( $links, 1, 0, $settings );
        return $links;
    }
    add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'rswpbs_upgrade_to_pro_link_pal' );
endif;

function rswpbs_upgrade_to_pro_admin_menu() {
    if (!class_exists('Rswpbs_Pro')) :
        add_submenu_page(
            'edit.php?post_type=book',
            '',
            'Upgrade to Pro',
            'manage_options',
            esc_url( 'https://rswpthemes.com/rs-wp-books-showcase-wordpress-plugin/' ),
            ''
        );
    endif;
}
add_action( 'admin_menu', 'rswpbs_upgrade_to_pro_admin_menu' );

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Book Showcase Settings',
        'menu_title'    => 'Book Showcase Settings',
        'menu_slug'     => 'book-showcase-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'parent_slug'   => 'edit.php?post_type=book', // The menu slug of your custom post type
    ));
}
