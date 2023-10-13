<?php
/**
 * Book Author Taxonomy Page
 */
get_header();
$archive_page_settings = get_option('book_layouts_settings');
?>
<div class="rswpthemes-book-author-archive-page-wrapper">
	<div class="container">
		<?php do_action( 'rswpbs_author_taxonomy_page_header' ); ?>
		<div class="books-container-row">
			<?php if (have_posts()) : ?>
			<h2 class="book-container-section-title"><?php esc_html_e('Books', RSWPBS_TEXT_DOMAIN); ?></h2>
				<div class="row">
				<?php
				while ( have_posts() ) :
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
