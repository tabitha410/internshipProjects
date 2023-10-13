<?php
/**
 * Book Loop Modify And Advanced Search Query
 */
add_action( 'pre_get_posts', 'rswpbs_book_cpt_query_modify' );
function rswpbs_book_cpt_query_modify($query){
    if ( !is_admin() && $query->is_main_query() && $query->is_archive('book') ) {
      // Modify the query based on the selected sorting option

        $booksPerPage = 8;
        if (class_exists('Rswpbs_Pro')) {
            $booksPerPage = get_field('books_per_page', 'option');
        }

        $query->set( 'posts_per_page', $booksPerPage);
        $search_fields = rswpbs_search_fields();
        if (isset($_GET['search_type']) && 'book' === $_GET['search_type']) {
            if ($search_fields['category'] != 'all') {
                $cat_tax_args = array(
                    array(
                        'taxonomy'  =>  'book-category',
                        'field' =>  'slug',
                        'terms' =>  $search_fields['category']
                    )
                );
                $query->set('tax_query', $cat_tax_args);
            }
            if ($search_fields['author'] != 'all') {
                $author_tax_args = array(
                    array(
                        'taxonomy'  =>  'book-author',
                        'field' =>  'slug',
                        'terms' =>  $search_fields['author']
                    )
                );
                $query->set('tax_query', $author_tax_args);
            }
            if ($search_fields['name'] != 'all') {
                $book_name_meta = array(
                    array(
                        'key'     => '_rsbs_book_name',
                        'value'   => $search_fields['name'],
                        'compare' => 'LIKE',
                    )
                );
                $query->set('meta_query', $book_name_meta);
            }
            if ($search_fields['format'] != 'all') {
                $book_format_meta = array(
                    array(
                        'key'     => '_rsbs_book_format',
                        'value'   => $search_fields['format'],
                        'compare' => 'LIKE',
                    )
                );
                $query->set('meta_query', $book_format_meta);
            }
            if ($search_fields['publisher'] != 'all') {
                $book_publisher_meta = array(
                    array(
                        'key'     => '_rsbs_book_publisher_name',
                        'value'   => $search_fields['publisher'],
                        'compare' => 'LIKE',
                    )
                );
                $query->set('meta_query', $book_publisher_meta);
            }
            if ($search_fields['publish_year'] != 'all') {
                $book_publish_year_meta = array(
                    array(
                        'key'     => '_rsbs_book_publish_year',
                        'value'   => $search_fields['publish_year'],
                        'compare' => 'LIKE',
                    )
                );
                $query->set('meta_query', $book_publish_year_meta);
            }
            if ('default' != $search_fields['sortby']) {
                switch ( $search_fields['sortby'] ) {
                    case 'price_asc':
                      $query->set( 'meta_key', '_rsbs_book_query_price' );
                      $query->set( 'orderby', 'meta_value_num' );
                      $query->set( 'order', 'ASC' );
                      break;
                    case 'price_desc':
                      $query->set( 'meta_key', '_rsbs_book_query_price' );
                      $query->set( 'orderby', 'meta_value_num' );
                      $query->set( 'order', 'DESC' );
                      break;
                    case 'title_asc':
                      $query->set( 'orderby', 'title' );
                      $query->set( 'order', 'ASC' );
                      break;
                    case 'title_desc':
                      $query->set( 'orderby', 'title' );
                      $query->set( 'order', 'DESC' );
                      break;
                    case 'date_asc':
                      $query->set( 'orderby', 'date' );
                      $query->set( 'order', 'ASC' );
                      break;
                    case 'date_desc':
                      $query->set( 'orderby', 'date' );
                      $query->set( 'order', 'DESC' );
                      break;
                }
            }else{
                $query->set( 'order', 'DESC' );
                $query->set( 'orderby', 'date' );
            }
        }elseif(isset($_GET['sortby']) && 'default' != $_GET['sortby']){
            switch ( $search_fields['sortby'] ) {
                case 'price_asc':
                  $query->set( 'meta_key', '_rsbs_book_query_price' );
                  $query->set( 'orderby', 'meta_value_num' );
                  $query->set( 'order', 'ASC' );
                  break;
                case 'price_desc':
                  $query->set( 'meta_key', '_rsbs_book_query_price' );
                  $query->set( 'orderby', 'meta_value_num' );
                  $query->set( 'order', 'DESC' );
                  break;
                case 'title_asc':
                  $query->set( 'orderby', 'title' );
                  $query->set( 'order', 'ASC' );
                  break;
                case 'title_desc':
                  $query->set( 'orderby', 'title' );
                  $query->set( 'order', 'DESC' );
                  break;
                case 'date_asc':
                  $query->set( 'orderby', 'date' );
                  $query->set( 'order', 'ASC' );
                  break;
                case 'date_desc':
                  $query->set( 'orderby', 'date' );
                  $query->set( 'order', 'DESC' );
                  break;
            }
        }
    }
   wp_reset_query();
}
