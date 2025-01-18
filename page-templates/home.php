<?php /* Template Name: Home */ ?>
<?php
	$product_categories = array(
		'apple-open-box-devices'
	);
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => 15000,
		'tax_query' => array( 
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $product_categories,
				'operator' => 'IN',
			)
		)
	);
	$loop = new WP_Query($args);
	while($loop->have_posts()){
		$loop->the_post();
		global $product;
//		$test = get_post_meta($product->ID, 'full_image', true);
//		echo '<pre>'; print_r($product); echo '</pre>';
//		echo '<pre>'; print_r(get_the_ID()); echo '</pre>';
//		echo '<pre>'; print_r(get_post_meta(get_the_ID())); echo '</pre>';
//		$test = get_post_meta($product->ID, 'full_image', true);
//		$image = wp_get_attachment_image_url( $test[0] );
//		echo '<pre>'; print_r($test); echo '</pre>';
//		echo '<pre>'; print_r($image); echo '</pre>';
		
//		$image = wp_get_attachment_image_src( get_post_thumbnail_id($product->ID), 'single-post-thumbnail' );
//		$image = wp_get_attachment_image_src( get_post_thumbnail_id($product->ID) );
//		echo '<pre>'; print_r($image); echo '</pre>';
//		echo "<img src=".$image[0]." data-id=".$product->ID.">";
//		echo '<pre>'; print_r($product->get_attributes()); echo '</pre>';
//		echo '<pre>'; print_r($product->get_attributes()['Storage (GB)']['options'][$product->get_attributes()['storage']['options']]); echo '</pre>';
//		echo '<pre>'; print_r($product->get_attributes()['storage-gb']['options'][$product->get_attributes()['storage-gb']['position']]); echo '</pre>';
	};
	wp_reset_query();

	// Get Woocommerce product categories WP_Term objects
	$categories = get_terms( ['taxonomy' => 'product_cat'] );

	// Getting a visual raw output
//	echo '<pre>'; print_r( $categories ); echo '</pre>';

?>
<?php echo do_shortcode('[products limit="4" columns="4" orderby="popularity" class="quick-sale" on_sale="true" ]'); ?>
<?php $dmn = 'https://bsltechtt.com/wp-content/themes/expend_ddwellers/'; ?>
<?php get_header(); ?>
	<section class="slides">
		<div class="wrap">
			<img src="<?php echo $dmn; ?>/images/ddwellers/slides_bg.jpg?v=<?php echo time(); ?>" alt="" class="desk">
			<img src="<?php echo $dmn; ?>/images/ddwellers/slides_bg_mobile.jpg?v=<?php echo time(); ?>" alt="" class="mobi">
		</div>
	</section>
	<section class="phones">
		<h1>Shop our latest Iphone deals</h1>
		<div class="wrap">
			<div class="scrollbar">
				<div class="handle"></div>
			</div>
			<div class="frame">
				<div class="item_list">
					<?php
						$product_categories = array(
							'apple-open-box-devices'
						);
						$args = array(
							'post_type'      => 'product',
							'posts_per_page' => 15,
							'tax_query' => array( 
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'slug',
									'terms'    => $product_categories,
									'operator' => 'IN',
								)
							)
						);
						$loop = new WP_Query($args);
						while($loop->have_posts()):
							$loop->the_post();
							global $product;
							$product->get_attributes();
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($product->ID), 'single-post-thumbnail' );
							$storage = $product->get_attributes()['storage-gb']['options'][$product->get_attributes()['storage-gb']['position']];
					?>
							<div class="item">
								<a href="<?php echo get_permalink(); ?>" class="innr">							
									<div class="image" style="background-image: url(<?php echo $image[0]; ?>)"></div>
									<div class="info">
										<div class="brand"><?php echo $product->get_name(); ?></div>
										<div class="price"><?php echo $product->get_price_html(); ?></div>
									</div>
								</a>
							</div>
					<?php
						endwhile;
						wp_reset_query();
					?>
				</div>
			</div>
		</div>
	</section>
	<section class="accessories">
		<img src="https://bsltechtt.com/wp-content/uploads/section_accessories_bnr.jpg" alt="" class="section_bnr desk">
		<img src="https://bsltechtt.com/wp-content/uploads/section_accessories_bnr_mobile.jpg" alt="" class="section_bnr mobi">
		<div class="wrap">
			<div class="frame">
				<div class="item_list">
					<?php
						$product_categories = array(
							'apple-accessories'
						);
						$args = array(
							'post_type'      => 'product',
							'posts_per_page' => 1500,
							'tax_query' => array( 
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'slug',
									'terms'    => $product_categories,
									'operator' => 'IN',
								)
							)
						);
						$loop = new WP_Query($args);
						while($loop->have_posts()):
						$loop->the_post();
						global $product;
						$image = wp_get_attachment_image_src( get_post_thumbnail_id($product->ID), 'single-post-thumbnail' );
					?>
					<div class="item">
						<a href="<?php echo get_permalink(); ?>" class="innr">
							<div class="image" style="background-image: url(<?php echo $image[0]; ?>)"></div>
							<div class="info">
								<div class="brand"><?php echo $product->get_name(); ?></div>
								<div class="price"><?php echo $product->get_price_html(); ?></div>
							</div>
						</a>
					</div>
					<?php
						endwhile;
						wp_reset_query();
					?>
				</div>
			</div>
		</div>
	</section>
	<div class="section_box">
		<section class="other_accessories">
			<img src="https://bsltechtt.com/wp-content/themes/expend_ddwellers/images/ddwellers/section_samsung_bnr.jpg" alt="" class="section_bnr desk">
			<img src="https://bsltechtt.com/wp-content/themes/expend_ddwellers/images/ddwellers/section_samsung_bnr_mobile.jpg" alt="" class="section_bnr mobi">
			<div class="wrap">
				<div class="frame">
					<div class="item_list">
						<?php
							$product_categories = array(
								'samsung-accessorries'
							);
							$args = array(
								'post_type'      => 'product',
								'posts_per_page' => 1500,
								'tax_query' => array( 
									array(
										'taxonomy' => 'product_cat',
										'field'    => 'slug',
										'terms'    => $product_categories,
										'operator' => 'IN',
									)
								)
							);
							$loop = new WP_Query($args);
							while($loop->have_posts()):
							$loop->the_post();
							global $product;
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($product->ID), 'single-post-thumbnail' );
						?>
						<div class="item">
							<a href="<?php echo get_permalink(); ?>" class="innr">
								<div class="image" style="background-image: url(<?php echo $image[0]; ?>)"></div>
								<div class="info">
									<div class="brand"><?php echo $product->get_name(); ?></div>
									<div class="price"><?php echo $product->get_price_html(); ?></div>
								</div>
							</a>
						</div>
						<?php
							endwhile;
							wp_reset_query();
						?>
					</div>
				</div>
			</div>
		</section>
		<section class="other_accessories">
			<img src="https://bsltechtt.com/wp-content/themes/expend_ddwellers/images/ddwellers/section_general_bnr.jpg" alt="" class="section_bnr desk">
			<img src="https://bsltechtt.com/wp-content/themes/expend_ddwellers/images/ddwellers/section_general_bnr_mobile.jpg" alt="" class="section_bnr mobi">
			<div class="wrap">
				<div class="frame">
					<div class="item_list">
						<?php
							$product_categories = array(
								'electronic-accessories'
							);
							$args = array(
								'post_type'      => 'product',
								'posts_per_page' => 1500,
								'tax_query' => array( 
									array(
										'taxonomy' => 'product_cat',
										'field'    => 'slug',
										'terms'    => $product_categories,
										'operator' => 'IN',
									)
								)
							);
							$loop = new WP_Query($args);
							while($loop->have_posts()):
							$loop->the_post();
							global $product;
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($product->ID), 'single-post-thumbnail' );
						?>
						<div class="item">
							<a href="<?php echo get_permalink(); ?>" class="innr">
								<div class="image" style="background-image: url(<?php echo $image[0]; ?>)"></div>
								<div class="info">
									<div class="brand"><?php echo $product->get_name(); ?></div>
									<div class="price"><?php echo $product->get_price_html(); ?></div>
								</div>
							</a>
						</div>
						<?php
							endwhile;
							wp_reset_query();
						?>
					</div>
				</div>
			</div>
		</section>
	</div>
	<section class="services">
		<h1></h1>
		<div class="wrap">
			<div class="item">
				<div class="innr txt_1">
					<h1><sup>REVIVE YOUR IPHONE</sup>Best prices on iPhone repairs, also ask about our on the spot repair service.</h1>
					<a href="">REQUEST REPAIR SERVICE</a>
				</div>
			</div>
			<div class="item">
				<div class="innr blk_1"></div>
			</div>
			<div class="item">
				<div class="innr blk_2"></div>
			</div>
			<div class="item">
				<div class="innr txt_2">
					<h1><sup>MAKE IT PERSONAL</sup>Get great accessories for your iPhone and make it represent you. Shop all the latest iPhone accessories from BSL Tech.</h1>
					<a href="">SHOP ACCESSORIES</a>
				</div>
			</div>
		</div>
	</section>
	<section class="services_a">
		<div class="wrap">
			<div class="top">
				<div class="lf">
					<a href="" class="innr" style="background-image: url(https://bsltechtt.com/wp-content/uploads/mrkt_top_lf.jpg);"></a>
				</div>
				<div class="rt">
					<a href="" class="innr" style="background-image: url(https://bsltechtt.com/wp-content/uploads/mrkt_top_rt.jpg);"></a>
				</div>
			</div>
			<div class="btm">
				<div class="rt">
					<a href="" class="innr" style="background-image: url(https://bsltechtt.com/wp-content/uploads/mrkt_btm_lf.jpg);"></a>
				</div>
				<div class="lf">
					<a href="" class="innr" style="background-image: url(https://bsltechtt.com/wp-content/uploads/mrkt_btm_rt.jpg);"></a>
				</div>
			</div>
		</div>
	</section>
	<section class="outro">
		<div class="wrap">
			<h1>Order safely online and we'll bring it to you!</h1>
			<div class="item">
				<div class="innr">
					<h2>Fast delivery and tracking</h2>
					<p>Enjoy quick deliveries at affordable prices</p>
				</div>
			</div>
			<div class="item">
				<div class="innr">
					<h2>Packaged with care</h2>
					<p>Your iPhone is packaged safely to ensure that it arrives to you its original condition</p>
				</div>
			</div>
			<div class="item">
				<div class="innr">
					<h2>Many ways to pay</h2>
					<p>Pay for your iPhone in different and safe methods, if it is not listed you can always ask</p>
				</div>
			</div>
		</div>
	</section>
	<script>
		$(document).ready(function() {
			var $frame = $('section.phones .frame');
			var $wrap = $frame.parent();
			$frame.sly({
				horizontal: 1,
				itemNav: 'basic',
				smart: 1,
				activateOn: 'click',
				mouseDragging: 1,
				touchDragging: 1,
				releaseSwing: 1,
				startAt: 0,
				scrollBar: $wrap.find('.scrollbar'),
				scrollBy: 1,
				speed: 300,
				elasticBounds: 1,
				easing: 'easeOutExpo',
				dragHandle: 1,
				dynamicHandle: 1,
				clickBar: 1,

				// Cycling
				cycleBy: 'items',
				cycleInterval: 1000,
				pauseOnHover: 1
			});
		});
	</script>
<?php get_footer(); ?>
