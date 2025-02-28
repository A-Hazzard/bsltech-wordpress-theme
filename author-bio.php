<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage Templatemela
 * @since Templatemela 1.0
 */
?>
<div class="author-info">
  <div class="author-avatar">
    <?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @since Templatemela 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'tmpmela_author_bio_avatar_size', 100 );
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
  </div>
  <!-- .author-avatar -->
  <div class="author-description">
    <h2 class="author-title"><?php printf( esc_html__( 'About %s', 'expend' ), get_the_author() ); ?></h2>
    <p class="author-bio">
      <?php the_author_meta( 'description' ); ?>
      <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"> <?php printf(wp_kses( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'expend' ),tmpmela_allowed_html()), get_the_author() ); ?> </a> </p>
  </div><!-- .author-description -->
</div><!-- .author-info -->