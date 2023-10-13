(function($) {
    $('.search-field select').selectize();
    $('#rswpbs-sort').change(function() {
        $('#rswpbs-sortby').val(this.value);
        $('#rswpthemes-books-search-form, #rswpthemes-book-sort-form').submit();
    });
    $('.reset-search-form').click(function(event) {
        event.preventDefault();
        history.pushState({}, "", window.location.pathname);
        location.reload();
    });
})(jQuery);
