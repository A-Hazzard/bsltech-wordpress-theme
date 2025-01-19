<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Templatemela
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">  
<link rel="profile" href="//gmpg.org/xfn/11"/>
	<?php tmpmela_header(); ?>
	<?php wp_head();?> 
</head>
<body <?php body_class(); ?>>
	<?php if (get_option('tmpmela_show_site_loader') == 'yes') : ?>	
		<!--CSS Spinner-->
		<div class="spinner-wrapper">
			<div class="spinner">
				<div class="sk-folding-cube">
					<div class="sk-cube1 sk-cube"></div>
					<div class="sk-cube2 sk-cube"></div>
					<div class="sk-cube4 sk-cube"></div>
					<div class="sk-cube3 sk-cube"></div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div id="page" class="hfeed site">
	<?php if ( get_header_image() ) : ?>
		<div id="site-header">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php header_image(); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="<?php echo esc_attr_e('Siteheader','expend'); ?>">
			</a>
		</div>
	<?php endif; ?>
<!-- Header -->
<?php tmpmela_header_before(); ?>
<?php $dmn = 'https://bsltechtt.com/wp-content/themes/expend_ddwellers/'; ?>
<link rel="stylesheet" href="<?php echo $dmn; ?>/css/tmp_hd.css?v="<?php echo time(); ?>>
<div class="mobi_menu">
	<div class="close_mobi_menu">CLOSE</div>
	<div class="innr">
		<div class="logo"></div>
		<div class="controls">
			<div class="location" title="Visit our locations">
				<a href="https://bsltechtt.com/map-contact/" class="innr">
					<img src="<?php echo $dmn; ?>/images/ddwellers/location_icon.png" alt="">
					<p>Find us</p>
				</a>
			</div>
			<div class="account" title="Sign into your account">
				<a href="<?php echo esc_url(wc_customer_edit_account_url()); ?>" class="innr">
					<img src="<?php echo $dmn; ?>/images/ddwellers/account_icon.png" alt="">
					<?php if(is_user_logged_in()): ?>
						<span><?php printf(esc_html(wp_get_current_user()->display_name)); ?></span>
					<?php else: ?>
						<p>Account</p>
					<?php endif; ?>
				</a>
			</div>			
			<?php global $woocommerce; ?>
			<div class="cart" title="you have <?php echo $woocommerce->cart->cart_contents_count; ?> items in your cart">
				<a class="innr cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'expend'); ?>">
					<img src="https://bsltechtt.com/wp-content/themes/expend_ddwellers/images/ddwellers/cart_icon.png" alt="">
					<span class="cart-qty">
						<?php
							echo esc_html_e('(','expend');
							echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'expend'), $woocommerce->cart->cart_contents_count);
							echo esc_html_e(')','expend');
						?>
					</span>
				</a>
			</div>
		</div>
		<ul>
			<li><a href="https://bsltechtt.com/product-category/customized-cases/">Customized iPhone Cases</a></li>
			<li><a href="https://bsltechtt.com/product-category/iphone-cases/">Phone Cases</a></li>
			<li><a href="https://bsltechtt.com/product-category/apple-open-box-devices/">Open Box Iphones</a></li>
			<li><a href="https://bsltechtt.com/product-category/apple-accessories/">Apple Accessories</a></li>
			<!-- <li><a href="https://bsltechtt.com/product-category/samsung-accessorries/">Samsung Accessories</a></li> -->
<!-- 			<li><a href="https://bsltechtt.com/product-category/electronic-accessories/">Miscellaneous</a></li> -->
			<li class="yellow_highlight"><a href="https://bsltechtt.com/checkout/">Checkout</a></li>
		</ul>
	</div>
</div>
<header>
	<div class="controls">
		<div class="location" title="Visit our locations">
			<a href="https://bsltechtt.com/map-contact/" class="innr">
				<img src="<?php echo $dmn; ?>/images/ddwellers/location_icon.png" alt="">
				<span>Find us</span>
			</a>
		</div>
		<div class="account" title="Sign into your account">
			<a href="<?php echo esc_url(wc_customer_edit_account_url()); ?>" class="innr">
				<img src="<?php echo $dmn; ?>/images/ddwellers/account_icon.png" alt="">
				<?php if(is_user_logged_in()): ?>
					<span><?php printf(esc_html(wp_get_current_user()->display_name)); ?></span>
				<?php else: ?>
					<p>Account</p>
				<?php endif; ?>
			</a>
		</div>
		<?php global $woocommerce; ?>
		<div class="cart" title="you have <?php echo $woocommerce->cart->cart_contents_count; ?> items in your cart">
			<a class="innr cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'expend'); ?>">
				<img src="https://bsltechtt.com/wp-content/themes/expend_ddwellers/images/ddwellers/cart_icon.png" alt="">
				<span class="cart-qty">
					<?php
						echo esc_html_e('(','expend');
						echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'expend'), $woocommerce->cart->cart_contents_count);
						echo esc_html_e(')','expend');
					?>
				</span>
			</a>
		</div>
	</div>
	<a href="<?php echo $dmn; ?>/free-shipping" class="header_notice">WE HAVE PREMIUM QUALITY DEVICES AT THE MOST AFFORDABLE PRICES | ENJOY 120 DAYS WARRANTY!</a>
	<div class="wrap">
		<a href="https://bsltechtt.com/" class="logo">
			<img src="<?php echo $dmn; ?>/images/ddwellers/logo.svg" alt="">
		</a>
		<div class="menu">
			<div class="open_mobi_menu">
				MENU
			</div>
			<nav>
				<ul>
					<li><a href="https://bsltechtt.com/product-category/customized-cases/">Customized iPhone Cases</a></li>
					<li><a href="https://bsltechtt.com/product-category/iphone-cases/">Phone Cases</a></li>
					<li><a href="https://bsltechtt.com/product-category/apple-open-box-devices/">Open Box Iphones</a></li>
					<li><a href="https://bsltechtt.com/product-category/apple-accessories/">Apple Accessories</a></li>
					<!-- <li><a href="https://bsltechtt.com/product-category/samsung-accessorries/">Samsung Accessories</a></li> -->
<!-- 					<li><a href="https://bsltechtt.com/product-category/electronic-accessories/">Miscellaneous</a></li> -->
					<li class="yellow_highlight"><a href="https://bsltechtt.com/checkout/">Checkout</a></li>
<!--					<li><a href="https://bsltechtt.com/about-us/">About BSL Tech</a></li>-->
				</ul>
			</nav>
		</div>
	</div>		
</header>
<script>
	var $ = jQuery.noConflict();
	$(document).ready(function() {
		$('.header_notice').marquee({
			//duration in milliseconds of the marquee
			duration: 8000,
			//gap in pixels between the tickers
			gap: 100,
			//time in milliseconds before the marquee will start animating
			delayBeforeStart: 0,
			//'left' or 'right'
			direction: 'left',
			//true or false - should the marquee be duplicated to show an effect of continues flow
			duplicated: true
		});
		/*animated menu*/
		Velocity("registerSequence", "leftslidein", {
			"0%": {
				transform: "translateX(-100vw)"
			},
			"100%": {	    	
				transform: "translateX(0vw)"
			}
		});
		Velocity("registerSequence", "leftslideout", {
			"0%": {
				transform: "translateX(0vw)"
			},
			"100%": {	    	
				transform: "translateX(-100vw)"
			}
		});
		$('.open_mobi_menu').off().on('click',open_mobi_menu);
		function open_mobi_menu(){
			$('.open_mobi_menu').off('click');
			$('body').css({
				overflow:'hidden'
			});
			$('#page').css({
				height:'100vh'
			});
			$('.mobi_menu').velocity({
				left: '0vw'
			}, 200, function() {
				$('.close_mobi_menu').off().on('click',close_mobi_menu);
			});
		}
		function close_mobi_menu() {
			$('.close_mobi_menu').off('click');
			$('.mobi_menu').velocity({
				left: '-100vw'
			}, 200, function() {
				$('body').css({
					overflow:''
				});
				$('#page').css({
					height:''
				});
				$('.open_mobi_menu').off().on('click',open_mobi_menu);
			});
		};
	});
</script>
<?php tmpmela_header_after(); ?>
<?php tmpmela_main_before(); ?>
	<?php 
		$tmpmela_page_layout = tmpmela_page_layout(); 
		if( isset( $tmpmela_page_layout) && !empty( $tmpmela_page_layout ) ):
		$tmpmela_page_layout = $tmpmela_page_layout; 
		else:
		$tmpmela_page_layout = '';
		endif;
	?>
	<?php 
		$shop = '0';
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) :
		if(is_shop())
			$tmpmela_page_layout = 'wide-page';
			$shop = '1';
		endif;
	?>
	<?php
		global $wp;
		$current = esc_url(home_url( add_query_arg( array( $_GET ), $wp->request ) ));
		$str = substr(strrchr($current, '?'), 1);
		if($str == 'left'){
			$div_class = 'left-sidebar';
		}elseif($str == 'right'){
			$div_class = 'right-sidebar';
		}elseif($str == 'full'){
			$div_class = 'full-width';  
		}else{
			$div_class = tmpmela_sidebar_position();
		} 
		if ( get_option( 'tmpmela_page_sidebar' ) == 'no' ):
			$div_class = "full-width";
		endif;
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {	
			if ( is_product() ){	
				if ( get_option( 'tmpmela_shop_sidebar' ) == 'no' ):
					$div_class = "full-width";
				endif;
			}	
		}
		if ( is_home() && tmpmela_is_blog() ){
			$div_class = "left-sidebar";
		}
	?>
	<div id="main" class="site-main <?php echo esc_attr($div_class);  ?><?php echo esc_attr(tmpmela_page_layout()); ?>">
	<div class="main_inner">
<?php 
	$tmpmela_page_layout = tmpmela_page_layout(); 
	if( isset( $tmpmela_page_layout) && !empty( $tmpmela_page_layout ) ):
	$tmpmela_page_layout = $tmpmela_page_layout; 
	else:
	$tmpmela_page_layout = '';
	endif;
if ( $tmpmela_page_layout == 'wide-page' ) : ?>
	<div class="main-content-inner-full">
<?php else: 		
if(is_archive() || is_tag() || is_404()) : ?>
	<div class="main-content">
<?php else: ?>
	<div class="main-content-inner <?php echo esc_attr(tmpmela_sidebar_position()); ?>">	
<?php endif; ?>
<?php endif; ?>
<?php tmpmela_content_before(); ?>