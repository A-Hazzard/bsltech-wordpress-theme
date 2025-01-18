<link rel="stylesheet" href="https://bsltechtt.com/wp-content/themes/expend_ddwellers_2/custom-cases/custom-cases.css?v=<?php echo time(); ?>">
<?php $image_folder = 'https://bsltechtt.com/wp-content/themes/expend_ddwellers_2/custom-cases/'; ?>
<section class="slides">
	<div class="wrap">
		<img src="<?php echo $image_folder; ?>/images/custom-case-slides_bg.jpg?v=<?php echo time(); ?>" alt="" class="desk">
		<img src="<?php echo $image_folder; ?>/images/custom-case_slides_bg_mobile.jpg?v=<?php echo time(); ?>" alt="" class="mobi">
	</div>
</section>
<section class="about">
	<div class="wrap">
		<div class="item">
			<div class="innr">
				<img src="<?php echo $image_folder; ?>/images/custom-case-about-bg_1.png" alt="">
				<h1>Water Proof</h1>
				<h2>Our designs don't smear or smudge with water, you can be confident that your print will stay looking great.</h2>
			</div>
		</div>
		<div class="item">
			<div class="innr">
				<img src="<?php echo $image_folder; ?>/images/custom-case-about-bg_3.png" alt="">
				<h1>Long Lasting</h1>
				<h2>Our silicon cases are durable and made of the highest fitting quality for your phone.</h2>
			</div>
		</div>
		<div class="item">
			<div class="innr">
				<img src="<?php echo $image_folder; ?>/images/custom-case-about-bg_2.png" alt="">
				<h1>Fast Delivery</h1>
				<h2>We process your order, develop your custom case and send it out to delivery within 72 hours.</h2>
			</div>
		</div>
	</div>
</section>
<section class="bestsellers">
	<div class="wrap">
		<h1 class="title">Best selling designs</h1>
		<?php
			$cases = array(
				"nba-themed-bsl-silicone-case-get-it-with-any-iphone-case",
				"trinidad-themed-bsl-silicone-case-get-it-with-any-iphone-case",
				"trinidad-flag-themed-bsl-silicone-case-get-it-with-any-iphone-case",
				"uefa-themed-bsl-silicone-case-get-it-with-any-iphone-case",
				"iron-man-themed-bsl-silicone-case-get-it-with-any-iphone-case",
				"panther-themed-bsl-silicone-case-get-it-with-any-iphone-case",
				"mk-themed-bsl-silicone-case-get-it-with-any-iphone-case",
				"natasha-themed-bsl-silicone-case-get-it-with-any-iphone-case"
			);
		?>
		<?php foreach($cases as $key=>$value): ?>
		<?php $key = $key + 1; ?>
		<div class="item">
			<a href="/product/<?php echo $value; ?>" class="innr open_custom_modal">
				<div class="image" style="background-image: url(<?php echo $image_folder; ?>/images/dynamic_case_image/featured_case_<?php echo $key; ?>.png);"></div>
				<div class="name"><?php echo ucwords(str_replace('-', ' ', $value)); ?></div>
				<div class="price">$200TTD/$30USD</div>
			</a>
		</div>
		<?php endforeach; ?>
	</div>
</section>
<section class="hype">
	<div class="wrap">
		<h1>Perfect for different occastions!</h1>
		<div class="lf">
			<div class="top" style="background-image: url(<?php echo $image_folder; ?>/images/custom-case-hype_bg_1.jpg);">
				<div class="text">
					<h1>Send A Great Gift!</h1>
					<h2>Surprise your loved ones with a great custom case for their phone. Be it a birthday, valentine or anniversary it would make a great gift.</h2>
				</div>
			</div>
			<div class="btm" style="background-image: url(<?php echo $image_folder; ?>/images/custom-case-hype_bg_2.jpg);">
				<div class="text">
					<h1>Be Unique</h1>
					<h2>Represent yourself well with your custom print, from selfies, movie posters, couple photos, you can get really creative!</h2>
				</div>
			</div>
		</div>
		<div class="rt">
			<div class="top" style="background-image: url(<?php echo $image_folder; ?>/images/custom-case-hype_bg_4.jpg);">
				<div class="text">
					<h1>Sports Support</h1>
					<h2>Show how strong you represent your sports team, use player images or team logos to ensure everyone knows who you support!</h2>
				</div>
			</div>
			<div class="btm" style="background-image: url(<?php echo $image_folder; ?>/images/custom-case-hype_bg_3.jpg);">
				<div class="text">
					<h1>Promote Your Brand</h1>
					<h2>Advertise your business brand in a stylish way, send us your logo or business banner and we can have your case customized with it!</h2>
				</div>
			</div>
		</div>
	</div>
</section>
<a href="https://bsltechtt.com/product/custom-iphone-case/">
	<img src="<?php echo $image_folder; ?>/images/dynamic_case_image/custom-case-outro_slide.png" alt="" class="begin_here open_custom_modal">
</a>
<a href="https://bsltechtt.com/product/custom-iphone-case/">
	<img src="<?php echo $image_folder; ?>/images/dynamic_case_image/custom-case-outro_slide_mobile.png" alt="" class="begin_here_mobile open_custom_modal">
</a>
<script>
	$(document).ready(function() {
		function open_modal() {
			$('section.ordering').fadeIn("fast", function() {
				$('body').css({
					overflow: 'hidden'
				});
				$('section.ordering .close').off().one('click', function() {
					$('body').css({
						overflow: ''
					});
					$('section.ordering').fadeOut('fast', function() {
						$('img.open_custom_modal').off().one('click', open_modal);
					})
				})
			})
		};
		$('.open_custom_modal').off().one('click', open_modal);
	});

</script>
