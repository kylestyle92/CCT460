<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Clickture
 */

?>

	</div><!-- #content -->

	
		<div class="container">
		
		<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="bottomMenu">
              <?php
//this section of code creates the menu at the bottom of the page, inside the footer
wp_nav_menu(array(
    'theme_location' => 'secondary'
));
?>  
    </div>
	        <div id="footer-widgets">
	            <?php
if (is_active_sidebar('footer')):
?>
	                <aside id="widget-foot" class="widget-foot">
	                    <?php
    dynamic_sidebar('footer');
?>
	                </aside>
	            <?php
endif;
?>
	        </div><!-- end #footer-widgets -->

			<div class="site-info">
				<p class="copyright">&copy; <?php
echo date('Y');
?> <a href="<?php
echo home_url();
?>"><?php
bloginfo('name');
?></a>. All Rights Reserved.</p> 
                <p class="credits"><?php
printf(__('Theme: %1$s by %2$s.', 'codediva'), 'By Kyle Johnson, Alex Naccarato, and Saad Rabbani', '<a href="http://codediva.com" rel="designer">originally designed by Code Diva</a>');
?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php
wp_footer();
?>

</body>
</html>
