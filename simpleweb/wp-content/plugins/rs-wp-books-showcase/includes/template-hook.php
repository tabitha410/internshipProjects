<?php
if (wp_is_block_theme()) {
  return;
}

add_filter('template_include', 'rswpbs_archive_template');

function rswpbs_archive_template( $template ) {
  if ( is_post_type_archive('book') ) {
    $theme_files = array('archive-book.php', 'rsbs-templates/archive-book.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } else {
      return RSWPBS_PLUGIN_PATH . 'rsbs-templates/archive-book.php';
    }
  }
  if(is_tax( 'book-author' )){
    $theme_files = array('taxonomy-book-author.php', 'rsbs-templates/taxonomy-book-author.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } else {
      return RSWPBS_PLUGIN_PATH . 'rsbs-templates/taxonomy-book-author.php';
    }
  }
  if(is_tax( 'book-category' )){
    $theme_files = array('taxonomy-book-category.php', 'rsbs-templates/taxonomy-book-category.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } else {
      return RSWPBS_PLUGIN_PATH . 'rsbs-templates/taxonomy-book-category.php';
    }
  }
  return $template;
}

function rswpbs_load_book_template( $template ) {
    global $post;
    if ( 'book' === $post->post_type ) {
        $theme_files = array('single-book.php', 'rsbs-templates/single-book.php');
        $exists_in_theme = locate_template($theme_files, false);
        if ( $exists_in_theme != '' ) {
          return $exists_in_theme;
        } else {
          return RSWPBS_PLUGIN_PATH . 'rsbs-templates/single-book.php';
        }
    }

    return $template;
}

add_filter( 'single_template', 'rswpbs_load_book_template' );


add_action( 'rswpbs_author_taxonomy_page_header', 'rswpbs_author_taxonomy_page_header_author_info', 10 );

function rswpbs_author_taxonomy_page_header_author_info(){
    $currentPageId = get_queried_object_id();
  if (0 === $currentPageId ) {
    return;
  }
  $currentAuthorObj = get_term($currentPageId);
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="rswpthemes-book-showcase-page-title">
          <h1 class="rswpthemes-book-author-name"><?php echo esc_html($currentAuthorObj->name); ?></h1>
          <div class="author-details">
            <p><?php echo wp_kses_post($currentAuthorObj->description); ?></p>
          </div>
        </div>
      </div>
    </div>
  <?php
}
/**
 * Function rswpbs_archive_page_header For Showing Book Archive Page Header
 */
add_action('rswpbs_archive_before_book_loop', 'rswpbs_archive_page_header', 10);
function rswpbs_archive_page_header(){
  $showArchiveHeader = true;
  $archivePageTitle = '';
  $archivePageDesc = '';
  if (class_exists('Rswpbs_Pro')) :
    $showArchiveHeader = get_field('show_book_archive_page_header', 'option');
    $archivePageTitle = get_field('books_archive_page_title', 'option');
    $ArchivePageDesc = get_field('books_archive_page_description', 'option');
  endif;
  if (true == $showArchiveHeader) :
    ?>
    <div class="row">
      <div class="col-md-12">
        <div class="rswpthemes-book-showcase-page-title">
          <?php
          if (!empty($archivePageTitle)) {
            echo '<h1>'. esc_html($archivePageTitle) .'</h1>';
          }else{
            echo '<h1>'. post_type_archive_title() .'</h1>';
          }
          if (!empty($archivePageDesc)) {
            echo '<p>'. $archivePageDesc .'</p>';
          }else{
            echo get_the_post_type_description();
          }
          ?>
        </div>
      </div>
    </div>
    <?php
  endif;
}
/**
 * Function rswpbs_book_search_form for Book archive page
 */
add_action('rswpbs_archive_before_book_loop', 'rswpbs_book_search_form', 15);
function rswpbs_book_search_form(){
  $showSearchSection = true;
  if (class_exists('Rswpbs_Pro') && function_exists('get_field')) {
    $showSearchSection = get_field('show_search_section', 'option');
  }
  if (true == $showSearchSection) :
    ?>
    <div class="rswpthemes-books-showcase-search-section">
      <div class="row">
        <div class="col-md-12">
          <?php echo do_shortcode('[rswpbs_advanced_search]'); ?>
        </div>
      </div>
    </div>
    <?php
  endif;
}

/**
 * Function rswpbs_book_sorting_form for book archive page
 */
add_action('rswpbs_archive_before_book_loop', 'rswpbs_book_sorting_form', 20);
function rswpbs_book_sorting_form(){
    global $wp_query;

    $showSearchSection = true;
    $bookPerPage = 8;
    $show_sorting_section = true;
    if (class_exists('Rswpbs_Pro')) {
      $showSearchSection = get_field('show_search_section', 'option');
      $bookPerPage = get_field('books_per_page', 'option');
      $show_sorting_section = get_field('show_sorting_section', 'option');
    }
    $display_sorting_form_wrapper = true;
    if (true == $showSearchSection) {
      $display_sorting_form_wrapper = false;
    }
    if (true == $show_sorting_section) {
      rswpbs_shorting_form_global($wp_query, $bookPerPage, $display_sorting_form_wrapper);
    }
}

/**
 * Function rswpbs_book_loop_pagination for Pagination Below of the Book Archive Page
 */
add_action('rswpbs_archive_after_book_loop', 'rswpbs_book_loop_pagination', 10);
function rswpbs_book_loop_pagination(){
  ?>
    <div class="row">
      <div class="col-md-12">
        <?php rswpbs_navigation(); ?>
      </div>
    </div>
  <?php
}
/**
 * rswpbs_book_loop_image function display book cover image in the book pages
 */
add_action('rswpbs_book_loop_image', 'rswpbs_book_loop_image');
function rswpbs_book_loop_image(){
  if (has_post_thumbnail()) :
  ?>
  <div class="rswpthemes-book-loop-image">
    <a href="<?php the_permalink(); ?>"><?php echo rswpbs_get_book_image(); ?></a>
  </div>
  <?php
  endif;
}
/**
 * rswpbs_book_loop_content Function Display Book Content in book pages
 */
add_action('rswpbs_book_loop_content', 'rswpbs_book_loop_content');
function rswpbs_book_loop_content(){
  $showBookTItle = true;
  $showBookAuthor = true;
  $showBookPrice = true;
  $showBookDescription = true;
  $showBuyNowBtn = true;
  if (class_exists('Rswpbs_Pro')) :
    $showBookTItle = get_field('show_book_title', 'option');
    $showBookAuthor = get_field('show_author_name', 'option');
    $showBookPrice = get_field('show_price', 'option');
    $showBookDescription = get_field('show_description', 'option');
    $showBuyNowBtn = get_field('show_buy_now_button', 'option');
  endif;
  ?>
   <?php if (true == $showBookTItle && !empty(rswpbs_get_book_name())) :?>
    <h2 class="book-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html(rswpbs_get_book_name()); ?></a></h2>
    <?php endif;
    if (true == $showBookAuthor && !empty(rswpbs_get_book_author())):
    ?>
    <h4 class="book-author"><strong><?php echo rswpbs_static_text_by(); ?></strong>
      <?php echo wp_kses_post(rswpbs_get_book_author()); ?>
    </h4>
    <?php
    endif;
    if( true == $showBookPrice && !empty(rswpbs_get_book_price())) :
     ?>
    <div class="book-price d-flex justify-content-center">
      <?php echo wp_kses_post(rswpbs_get_book_price()); ?>
    </div>
    <?php endif;
    if( true == $showBookDescription && !empty(rswpbs_get_book_desc())) :
     ?>
    <div class="book-desc d-flex justify-content-center">
      <p><?php echo wp_kses_post(rswpbs_get_book_desc()); ?></p>
    </div>
    <?php endif;
    if( true == $showBuyNowBtn && !empty(rswpbs_get_book_buy_btn())) :
     ?>
    <div class="book-buy-btn d-flex justify-content-center">
      <?php echo wp_kses_post(rswpbs_get_book_buy_btn()); ?>
    </div>
    <?php endif; ?>
  <?php
}

function rswpbs_book_loop_column(){
    $bookColumnClases = 'col-lg-3';
    if (class_exists('Rswpbs_Pro')) :
      $bookColumn = get_field('books_per_row', 'option');
      if (1 == $bookColumn) {
        $bookColumnClases = 'col-lg-12';
      }elseif(2 == $bookColumn){
        $bookColumnClases = 'col-lg-6';
      }elseif(3 == $bookColumn){
        $bookColumnClases = 'col-lg-6 col-xl-4 col-md-6';
      }elseif(4 == $bookColumn){
        $bookColumnClases = 'col-lg-4 col-xl-3 col-md-6';
      }
    endif;
    return $bookColumnClases;
}