<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage TemplateMela
 * @since TemplateMela 1.0
 */
?>
<?php tmpmela_content_after(); ?>
</div>
<!-- .main-content-inner -->
</div>
<!-- .main_inner -->
</div>
<!-- #main -->
<?php tmpmela_footer_before(); ?>
<?php if ( is_active_sidebar( 'footer-newsletter-widget-area' ) ) : ?>
<div class="footer-newsletter">
	<div class="theme-container">
		<?php dynamic_sidebar( 'footer-newsletter-widget-area' ); ?>
	</div>
</div>
<?php endif; ?>



<?php $dmn = 'https://bsltechtt.com/wp-content/themes/expend_ddwellers/'; ?>
<link rel="stylesheet" href="<?php echo $dmn; ?>/css/tmp_ft.css?v="<?php echo time(); ?>>
<footer>
	<img src="<?php echo $dmn; ?>/images/ddwellers/footer_top_bg.png" alt="" class="logo">
	<div class="wrap">
		<ul class="links">
			<li class="title">Shopping</li>
<!-- 			<li><a href="https://bsltechtt.com/shop-2/">Newest Additions</a></li> -->
			<li><a href="https://bsltechtt.com/product-category/apple-accessories/">Accessories</a></li>
			<li><a href="https://bsltechtt.com/product-category/samsung-accessorries/">Samsung Accessories</a></li>
<!-- 			<li><a href="https://bsltechtt.com/product-category/electronic-accessories/">Miscellaneous</a></li> -->
			<li><a href="https://bsltechtt.com/custom-cases/">Custom iPhone Cases</a></li>
<!--
			<li><a href="">Promotions</a></li>
			<li><a href="">Buying Guides</a></li>
-->
		</ul>
		<ul class="links">
			<li class="title">Purchases</li>
<!--			<li><a href="">Order Tracking</a></li>-->
			<li><a href="https://bsltechtt.com/my-account-2/">Your Account</a></li>
			<li><a href="https://bsltechtt.com/checkout/">Checkout</a></li>
			<li><a href="https://bsltechtt.com/cart/">Cart</a></li>
			<li><a href="https://bsltechtt.com/contact-us/">Contact Us</a></li>
		</ul>
		<ul class="links">
			<li class="title">Resources</li>
<!--
			<li><a href="">Returns &amp; Shipping</a></li>
			<li><a href="">Terms &amp; Conditions</a></li>
			<li><a href="">Privacy Policy</a></li>
-->
<!-- 			<li><a href="https://bsltechtt.com/sell-device/">Sell Device</a></li> -->
			<li><a href="https://www.facebook.com/bsltech/">Facebook</a></li>
			<li><a href="https://www.instagram.com/bsltechtt/">Instagram</a></li>
			<li><a href="https://bsltechtt.com/?faq_categories=general-questions>">FAQ</a></li>
			<li><a href="https://bsltechtt.com/about-us/">About BSLTechTT</a></li>
		</ul>
		<div class="fcy_dvd"></div>
		<ul class="social_links">
			<li class="title">Get connected to BSL Tech socials</li>
			<li class="social">
				<a href="https://www.facebook.com/bsltech/" target="_blank">
					<img src="<?php echo $dmn; ?>/images/ddwellers/facebook.png" alt="">
				</a>
			</li>
			<li class="social">
				<a href="https://www.instagram.com/bsltechtt/" target="_blank">
					<img src="<?php echo $dmn; ?>/images/ddwellers/instagram.png" alt="">
				</a>
			</li>
		</ul>
	</div>
</footer>



<!-- #colophon -->
<?php tmpmela_footer_after(); ?>
</div>
<!-- #page -->
<?php tmpmela_go_top(); ?>
<?php tmpmela_get_widget('before-end-body-widget'); ?>
<?php wp_footer(); ?>
</body>

</html>
