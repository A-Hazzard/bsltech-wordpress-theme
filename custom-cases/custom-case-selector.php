<?php
	$image_folder = 'https://bsltechtt.com/wp-content/themes/expend_ddwellers_2/custom-cases/';
//	$image_folder = 'http://localhost/dev/bsltechtt/wp-content/themes/expend_ddwellers_2/custom-cases/';
	$custom_stylesheet = '<link rel="stylesheet" href="https://bsltechtt.com/wp-content/themes/expend_ddwellers_2/custom-cases/custom-cases.css?v='.time().'">';
//	$custom_stylesheet = '<link rel="stylesheet" href="http://localhost/dev/bsltechtt/wp-content/themes/expend_ddwellers_2/custom-cases/custom-cases.css?v='.time().'">';
	echo $custom_stylesheet;
?>
<!--jquery region-->
<!--
<script src="http://localhost/dev/bsltechtt/jquery_libs/jquery-3.2.1.js"></script>
<script src="http://localhost/dev/bsltechtt/jquery_libs/plugins.js"></script>
-->




<section class="ordering">
	<div class="innr">
		<div class="close">CLOSE</div>
		<h1 class="title">Select your device, case and upload your image</h1>
		<?php if(isset($_GET['preset_image'])): ?>
			<h2>
				Please select your phone model first<br>
				Use the preset photo or upload a custom one of your choice<br>
				You can use your mouse or touch device to resize and reposition the custom image.
			</h2>
		<?php else: ?>
			<h2>
				Please select your phone model first<br>
				You can use your mouse or touch device to resize and reposition the custom image.
			</h2>
		<?php endif; ?>
		<div class="choose_phone">
			<?php
				$iphones = array("iPhone 14 Pro Max", "iPhone 14 Pro", "iPhone 14 Plus", "iPhone 14", "iPhone 13 Pro Max", "iPhone 13 Pro", "iPhone 13", "iPhone 13 Mini", "iPhone 12 Pro Max", "iPhone 12 Pro", "iPhone 12", "iPhone 12 Mini", "iPhone 11 Pro Max", "iPhone 11 Pro", "iPhone 11", "iPhone SE 2022", "iPhone SE 2020", "iPhone XS Max", "iPhone XR", "iPhone X/XS", "iPhone 8 Plus / 7 Plus", "iPhone 8/7", "iPhone 6/6S Plus", "iPhone 6/6S");
			?>
			<?php foreach($iphones as $key=>$value): ?>
			<?php $phone_name = str_replace(' ','_',strtolower($value)); ?>
			<div class="box">
				<input id="select_<?php echo $phone_name; ?>" type="radio" name="select_phone" value="<?php echo $value; ?>">
				<label for="select_<?php echo $phone_name; ?>"><?php echo $value; ?></label>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="choose_case">
			<?php
			$cases = array(
				"Transparent Silicone Case"
//					"Blue Silicone Case",
//					"Red Silicone Case",
//					"Black Silicone Case"
			);
		?>
			<?php foreach($cases as $key=>$value): ?>
			<?php $case_name = str_replace(' ','_',strtolower($value)); ?>
			<div class="item">
				<input id="case_<?php echo $case_name; ?>" type="radio" name="select_case" value="<?php echo $value; ?>">
				<label for="case_<?php echo $case_name; ?>">
					<div class="image" style="background-image: url(<?php echo $image_folder; ?>images/dynamic_case_image/sample_case_<?php echo $key ?>.png);"></div>
					<div class="name"><?php echo $value; ?></div>
				</label>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="mockup" id="capture_photo">
			<div class="innr">
				<?php if(isset($_GET['preset_image'])): ?>
					<img src="<?php echo $image_folder; ?>images/dynamic_case_image/<?php echo $_GET['preset_image'].'.png'; ?>" class="cust_image">
				<?php else: ?>
					<img src="<?php echo $image_folder; ?>images/Upload-Photo-BG.png" class="cust_image">
				<?php endif; ?>
				<img src="<?php echo $image_folder; ?>images/dynamic_case_image/test_image.png" alt="" class="phone_image">
			</div>
		</div>
		<div class="buttons">
			<div class="btn_1">
				<div class="innr" id="upload_photo">
					<?php
					// Dynamically include the Lumise button for WooCommerce product customization
					echo do_shortcode('[lumise_customize id="65"]');
					?>
				</div>
			</div>
			<div class="btn_1">
				<div class="innr" id="dd_addtocart">
					ADD TO CART
				</div>
			</div>
		</div>
		<form class="cart" method="post" enctype="multipart/form-data">
			<p class="form-row validate-required" id="image">
				<label for="file_field">
<!--					<input type="file" name="image" accept="image/*">-->
					<input type="hidden" name="phone_type" id="phone_type">
					<input type="hidden" name="dd_customer_image_upload" id="dd_customer_image_upload">
					<input type="hidden" name="dd_case_mockup_image" id="dd_case_mockup_image">
				</label>
			</p>
			<button type="submit" name="add-to-cart" value="12931" class="single_add_to_cart_button button alt">Add to cart</button>
		</form>
	</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>-->
<!--
<script>
	$('form.cart').submit(function(e){
		console.log($('form.cart').serialize());
	});
</script>
-->
<script>
	$(document).ready(function() {
		function takeshot() {
			let capture_photo = document.getElementById('capture_photo');
			html2canvas(
				capture_photo,{
					scrollY: -window.scrollY,
					scale: 1.5
				}).then(function(canvas) {
			//		document.getElementById('output').appendChild(canvas);
			//		var dataurl = canvas.toDataURL().replace(/.*,/, '');
					var selected_phone = $('input[name="select_phone"]:checked').val();
					console.log('selected_phone: '+selected_phone);
					$('#phone_type').val(selected_phone);
					var dataurl = canvas.toDataURL('image/png');
//					console.log(dataurl);
					$('#dd_case_mockup_image').val(dataurl);
					var uploaded_image = $('.cust_image').attr('src');
					$('#dd_customer_image_upload').val(uploaded_image);
					$('.single_add_to_cart_button').trigger('click');
			});
		}
		$('#dd_addtocart').click(function(){
			takeshot();
		});
		$('input[name="select_phone"]').click(function() {
			console.log($(this).val());
		});
	});
	function dragMoveListener (event) {
	  var target = event.target
	  // keep the dragged position in the data-x/data-y attributes
	  var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
	  var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy

	  // translate the element
	  target.style.transform = 'translate(' + x + 'px, ' + y + 'px)'

	  // update the posiion attributes
	  target.setAttribute('data-x', x)
	  target.setAttribute('data-y', y)
	}
interact('.cust_image')
    .resizable({
        // resize from all edges and corners
        edges: {
            left: true,
            right: true,
            bottom: true,
            top: true
        },

        listeners: {
            move(event) {
                var target = event.target
                var x = (parseFloat(target.getAttribute('data-x')) || 0)
                var y = (parseFloat(target.getAttribute('data-y')) || 0)

                // update the element's style
                target.style.width = event.rect.width + 'px'
                target.style.height = event.rect.height + 'px'

                // translate when resizing from top or left edges
                x += event.deltaRect.left
                y += event.deltaRect.top

                target.style.transform = 'translate(' + x + 'px,' + y + 'px)'

                target.setAttribute('data-x', x)
                target.setAttribute('data-y', y)
                target.textContent = Math.round(event.rect.width) + '\u00D7' + Math.round(event.rect.height)
            }
        },
        modifiers: [
            // keep the edges inside the parent
            interact.modifiers.restrictEdges({
                outer: 'body'
            }),
			interact.modifiers.aspectRatio({
				ratio: 'preserve',
				modifiers: [
					interact.modifiers.restrictSize({ max: { width: 10000, height: 10000 } }),
				],
			}),
            interact.modifiers.restrictSize({
                min: {
                    width: 100,
                    height: 50
                }
            })
        ],

        inertia: true
    })
    .draggable({
        listeners: {
            move: window.dragMoveListener
        },
        inertia: true,
        modifiers: [
            interact.modifiers.restrictRect({
                restriction: 'parent',
                endOnly: true
            })
        ]
    })
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

<script>
	$(document).ready(function() {
		var myDropzone = new Dropzone("#upload_photo", {
			uploadMultiple: false,
			url: "<?php echo $image_folder; ?>/custom_case_image_upload.php",
			paramName: "file",
			previewsContainer: false,
			autoProcessQueue: true,
			addRemoveLinks: true,
			method: "POST",
			acceptedFiles: "image/jpeg,image/png,image/gif",
			maxFiles: 1,
			renameFile: function(file){
				console.log(file);
				return file.name = 'test_upload.jpg';
			},
			success: function (file, response) {
	//            document.location.reload(true);
			},
			complete: function(){
				
			}
		});
		console.log("myDropzone: ");
		console.log(myDropzone);
		myDropzone.on("success", function(file) {
			console.log('Success: ');
			console.log(file);
			$('img.cust_image').attr('src',file.dataURL);
			myDropzone.removeAllFiles();
		});
		myDropzone.on("maxfilesexceeded",function(file){
			this.removeFile(file);
		});
		myDropzone.on("error", function(file, response){
			console.log("response: ");
			console.log(response);
		});
	//    myDropzone.on("addedfile", function(file) {console.log(file); });
		myDropzone.on("sending", function(file, xhr, data) {
			console.log('Sending Dropzone');
			data.append('cx_content_upload','introductory_programs');
			data.append('folder','/cx_pitch/media/sample.mp4');
		});
	});
</script>
