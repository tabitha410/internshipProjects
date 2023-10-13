<?php

function rswpbs_paged(){
	$paged = 1;
	if ( get_query_var( 'paged' ) ) {
	    $paged = get_query_var( 'paged' );
	 } else if ( get_query_var( 'page' ) ) {
	    $paged = get_query_var( 'page' );
	 } else {
	     $paged = 1;
	 }
	return $paged;
}

function rswpbs_search_fields(){
	$search_fields = array(
		'name' => (isset($_GET['book_name']) ? sanitize_text_field($_GET['book_name']) : ''),
		'author' => (isset($_GET['author']) ? sanitize_text_field($_GET['author']) : ''),
		'category' => (isset($_GET['category']) ? sanitize_text_field($_GET['category']) : ''),
		'format' => (isset($_GET['format']) ? sanitize_text_field($_GET['format']) : ''),
		'publisher' => (isset($_GET['publisher']) ? sanitize_text_field($_GET['publisher']) : ''),
		'publish_year' => (isset($_GET['publish_year']) ? sanitize_text_field($_GET['publish_year']) : ''),
		'sortby' => (isset($_GET['sortby']) ? sanitize_text_field($_GET['sortby']) : ''),
	);
	return $search_fields;
}


function rswpbs_search_query_args(){
    $search_fields = rswpbs_search_fields();
    $paged = rswpbs_paged();
    $tax_query = array();
    $meta_query = array();
    $queryArgs = array();
    if ( $search_fields['category'] != 'all' ) {
        $tax_query[] = array(
            'taxonomy'	=>	'book-category',
            'field'	=>	'slug',
            'terms'	=>	$search_fields['category']
        );
    }
    if ($search_fields['author'] != 'all') {
        $tax_query[] = array(
            'taxonomy'	=>	'book-author',
            'field'	=>	'slug',
            'terms'	=>	$search_fields['author']
        );
    }
    if ($search_fields['name'] != 'all') {
        $meta_query[] = array(
            'key'     => '_rsbs_book_name',
            'value'   => $search_fields['name'],
            'compare' => 'LIKE',
        );
    }
    if ($search_fields['format'] != 'all') {
        $meta_query[] = array(
            'key'     => '_rsbs_book_format',
            'value'   => $search_fields['format'],
            'compare' => 'LIKE',
        );
    }
    if ($search_fields['publisher'] != 'all') {
        $meta_query[] = array(
            'key'     => '_rsbs_book_publisher_name',
            'value'   => $search_fields['publisher'],
            'compare' => 'LIKE',
        );
    }
    if ($search_fields['publish_year'] != 'all') {
        $meta_query[] = array(
            'key'     => '_rsbs_book_publish_year',
            'value'   => $search_fields['publish_year'],
            'compare' => 'LIKE',
        );
    }
    if (!empty($tax_query)) {
        $tax_query['relation'] = 'AND';
        $queryArgs['tax_query'] = $tax_query;
    }
    if (!empty($meta_query)) {
        $meta_query['relation'] = 'AND';
        $queryArgs['meta_query'] = $meta_query;
    }

    return $queryArgs;
}

function rswpbs_sorting_form_args(){
	$search_fields = rswpbs_search_fields();
	$queryArgs = array();
	if ('default' != $search_fields['sortby']) {
        switch ( $search_fields['sortby'] ) {
            case 'price_asc':
              $queryArgs['meta_key'] = '_rsbs_book_query_price';
              $queryArgs['orderby'] = 'meta_value_num';
              $queryArgs['order'] = 'ASC';
              break;
            case 'price_desc':
              $queryArgs['meta_key'] = '_rsbs_book_query_price';
              $queryArgs['orderby'] = 'meta_value_num';
              $queryArgs['order'] = 'DESC';
              break;
            case 'title_asc':
              $queryArgs['orderby'] = 'title';
              $queryArgs['order'] = 'ASC';
              break;
            case 'title_desc':
              $queryArgs['orderby'] = 'title';
              $queryArgs['order'] = 'DESC';
              break;
            case 'date_asc':
              $queryArgs['orderby'] = 'date';
              $queryArgs['order'] = 'ASC';
              break;
            case 'date_desc':
              $queryArgs['orderby'] = 'date';
              $queryArgs['order'] = 'DESC';
              break;
        }
    }else{
       $queryArgs['orderby'] = 'date';
       $queryArgs['order'] = 'DESC';
    }

    return $queryArgs;
}

function rswpbs_total_books_message($queryName, $bookPerPage){
	$total_books = $queryName->found_posts;
	$paged = rswpbs_paged();
	$current_page = $paged; // Replace with the current page number
	$start_index = ( $current_page - 1 ) * $bookPerPage + 1;
	$end_index = $start_index + $bookPerPage - 1;
	if ( $end_index > $total_books ) {
	  $end_index = $total_books;
	}
	$message = 'Showing ' . $start_index . '-' . $end_index . ' of ' . $total_books . ' books';
	return esc_html($message);
}