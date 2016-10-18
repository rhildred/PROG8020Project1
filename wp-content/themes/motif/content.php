<?php
/**
 * @package Motif
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php motif_entry_meta(); ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'motif' ), __( '1 Comment', 'motif' ), __( '% Comments', 'motif' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'motif' ), '<span class="edit-link">', '</span>' ); ?>

		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( '' != get_the_post_thumbnail() && ! post_password_required() ) : ?>
	<div class="entry-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .entry-thumbnail -->
	<?php endif; ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'motif' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'motif' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php if ( is_single() && 'post' == get_post_type() ) : ?>
	<footer class="entry-meta">
		<?php
			$categories_list = get_the_category_list( __( ', ', 'motif' ) );
			if ( $categories_list && motif_categorized_blog() ) {
				echo '<span class="categories-links">' . $categories_list . '</span>';
			}

			// Translators: used between list items, there is a space after the comma.
			$tag_list = get_the_tag_list( '', __( ', ', 'motif' ) );
			if ( $tag_list ) {
				echo '<span class="tags-links">' . $tag_list . '</span>';
			}

			edit_post_link( __( 'Edit', 'motif' ), '<span class="edit-link">', '</span>' );
		?>
	</footer><!-- .entry-meta -->
	<?php endif; ?>

</article><!-- #post-## -->
