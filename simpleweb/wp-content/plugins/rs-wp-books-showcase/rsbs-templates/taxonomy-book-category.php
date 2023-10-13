<?php
/**
 * Book Author Taxonomy Page
 */

get_header();
$currentPageId = get_queried_object_id();
if (0 === $currentPageId) {
	return;
}
$currentCatObj = get_term($currentPageId);
?>
<div class="rswpthemes-book-author-archive-page-wrapper">
	<div class="container">
		<?php
		$showBookArchivePageHeader = true;
		if (class_exists('Rswpbs_Pro') && function_exists('get_field')) {
			$showBookArchivePageHeader = get_field('show_book_archive_page_header', 'option');
		}
		if (true == $showBookArchivePageHeader) :
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="rswpthemes-book-showcase-page-title">
					<h1 class="rswpthemes-book-category-name"><?php echo esc_html($currentCatObj->name); ?></h1>
					<div class="cateogry-details">
						<p><?php echo wp_kses_post($currentCatObj->description); ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php
		endif;
		?>
		<div class="books-container-row">
			<?php if (have_posts()) : ?>
				<div class="row">
				<?php while ( have_posts() ) :
					the_post();
					?>
					<div class="<?php echo esc_attr(rswpbs_book_loop_column());?> book-content-column">
						<?php
						rswpbs_book_loop_content_container();
						?>
					</div>
				<?php
				endwhile; // End of the loop.
				?>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php rswpbs_navigation(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
get_footer();
?>