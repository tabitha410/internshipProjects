<?php
/**
 * Archive Template For Book Post Type
 */
get_header();
?>
<div class="rswpthemes-book-author-archive-page-wrapper">
	<div class="container">
		<?php
		do_action('rswpbs_archive_before_book_loop');
		if (have_posts()) : ?>
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
		<?php
		endif;
		do_action('rswpbs_archive_after_book_loop');
		?>
	</div>
</div>
<?php
get_footer();
?>