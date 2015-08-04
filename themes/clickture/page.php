<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
		query_posts('cat=193');
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
			<a href="<?php  the_permalink(); ?>" title="<?php  echo the_title_attribute(); ?>">
			<?php  if ( has_post_thumbnail() ) : ?>
				<?php  the_post_thumbnail( ); ?>
			<?php 
	endif;
	/*This line posts the thumbnail of the featured image.  Placing this line of code in this exact position allows the image for all posts to exist immediately above their titles.  Also, the inclusion of the_permalink changes the image into a clickable link to the post its associated to */
	?>
</a>
<?php  /* There was previously code here: <?php
get_template_part( 'template-parts/content', get_post_format() );
?>
 which fetched the titles and excerpts of the posts; I have removed it so that only the featured (and clickable) thumbnails remain to form a grid
*/ ?>
			<?php 
	endwhile;
	$wp_query = $tmp;
	?>
			<?php  cd_posts_navigation(); ?>
		<?php  else : ?>
			<?php  get_template_part( 'template-parts/content', 'none' ); ?>
		<?php  endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php  get_sidebar(); ?>
<?php  get_footer(); ?>