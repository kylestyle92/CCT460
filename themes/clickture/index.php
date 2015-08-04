<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clickture
 */

 

	get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php  if ( have_posts() ) : ?>
			<?php  /* Start the Loop */ ?>
			<?php
	
	if ( is_home() ) {
		query_posts('cat=');
		/*This limits which category is displayed on the home page.  In this instance, I selected category 193, the value appointed to 'Ravenclaw' by WordPress */
	}

	?>
<?php
	$tmp = $wp_query;
	$wp_query = null;
	$wp_query = new WP_Query('showposts=6');
	/* These lines of code determine that only 6 posts will be shown on a page, namely the home page in this instance */
	?>
			<?php 
	while ( have_posts() ) :
	the_post();
	?>
<?php 
	the_post_thumbnail();
	/*This line posts the thumbnail of the featured image.  Placing this line of code in this exact position allows the image for all posts to exist immediately above their titles */
	?>
				<?php
 get_template_part( 'template-parts/content', get_post_format() ); ?>
			<?php 
	endwhile;
	$wp_query = $tmp;
	?>
			<?php  cd_posts_navigation(); /*This line is breaking the footer.  Removing stops the breaking, but leave the footer looking strange */ ?>
		<?php  else : ?>
			<?php  get_template_part( 'template-parts/content', 'none' ); ?>
		<?php  endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php  get_sidebar(); ?>
<?php  get_footer(); ?>
 

