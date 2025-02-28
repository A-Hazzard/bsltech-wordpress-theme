<?php
/**
 * Handles taxonomies in admin
 *
 * @class    brand_taxonomies
 * @version  2.3.10
 * @package  WooCommerce/Admin
 * @brand Class
 * @author   WooThemes
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * brand_taxonomies class.
 */
class brand_taxonomies {
	/**
	 * Constructor.
	 */
	public function __construct() {
		// Category/term ordering
		add_action( 'create_term', array( $this, 'create_term' ), 5, 3 );
		add_action( 'delete_term', array( $this, 'delete_term' ), 5 );
		// Add form
		add_action( 'product_brand_add_form_fields', array( $this, 'add_brand_fields' ) );
		add_action( 'product_brand_edit_form_fields', array( $this, 'edit_brand_fields' ), 10 );
		add_action( 'created_term', array( $this, 'save_brand_fields' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'save_brand_fields' ), 10, 3 );
		// Add columns
		add_filter( 'manage_edit-product_brand_columns', array( $this, 'product_brand_columns' ) );
		add_filter( 'manage_product_brand_custom_column', array( $this, 'product_brand_column' ), 10, 3 );
		// Taxonomy page descriptions
		add_action( 'product_brand_pre_add_form', array( $this, 'product_brand_description' ) );
		$attribute_taxonomies = wc_get_attribute_taxonomies();
		if ( ! empty( $attribute_taxonomies ) ) {
			foreach ( $attribute_taxonomies as $attribute ) {
				add_action( 'pa_' . $attribute->attribute_name . '_pre_add_form', array( $this, 'product_attribute_description' ) );
			}
		}
		// Maintain hierarchy of terms
		add_filter( 'wp_terms_checklist_args', array( $this, 'disable_checked_ontop' ) );
	}
	/**
	 * Order term when created (put in position 0).
	 *
	 * @param mixed $term_id
	 * @param mixed $tt_id
	 * @param string $taxonomy
	 */
	public function create_term( $term_id, $tt_id = '', $taxonomy = '' ) {
		if ( 'product_brand' != $taxonomy && ! taxonomy_is_product_attribute( $taxonomy ) ) {
			return;
		}
		$meta_name = taxonomy_is_product_attribute( $taxonomy ) ? 'order_' . esc_attr( $taxonomy ) : 'order';
		update_woocommerce_term_meta( $term_id, $meta_name, 0 );
	}
	/**
	 * When a term is deleted, delete its meta.
	 *
	 * @param mixed $term_id
	 */
	public function delete_term( $term_id ) {
		global $wpdb;
		$term_id = absint( $term_id );
		if ( $term_id && get_option( 'db_version' ) < 34370 ) {
			$wpdb->delete( $wpdb->woocommerce_termmeta, array( 'woocommerce_term_id' => $term_id ), array( '%d' ) );
		}
	}
	/**
	 * Category thumbnail fields.
	 */
	public function add_brand_fields() {
		?>
		<div class="form-field term-thumbnail-wrap">
			<label><?php _e( 'Thumbnail', 'expend' ); ?></label>
			<div id="product_brand_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="product_brand_thumbnail_id" name="product_brand_thumbnail_id" />
				<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'expend' ); ?></button>
				<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'expend' ); ?></button>
			</div>
			<script type="text/javascript">
				// Only show the "remove image" button when needed
				if ( ! jQuery( '#product_brand_thumbnail_id' ).val() ) {
					jQuery( '.remove_image_button' ).hide();
				}
				// Uploading files
				var file_frame;
				jQuery( document ).on( 'click', '.upload_image_button', function( event ) {
					event.preventDefault();
					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}
					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( "Choose an image", "expend" ); ?>',
						button: {
							text: '<?php _e( "Use image", "expend" ); ?>'
						},
						multiple: false
					});
					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						var attachment = file_frame.state().get( 'selection' ).first().toJSON();
						var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;
						jQuery( '#product_brand_thumbnail_id' ).val( attachment.id );
						jQuery( '#product_brand_thumbnail' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
						jQuery( '.remove_image_button' ).show();
					});
					// Finally, open the modal.
					file_frame.open();
				});
				jQuery( document ).on( 'click', '.remove_image_button', function() {
					jQuery( '#product_brand_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
					jQuery( '#product_brand_thumbnail_id' ).val( '' );
					jQuery( '.remove_image_button' ).hide();
					return false;
				});
				jQuery( document ).ajaxComplete( function( event, request, options ) {
					if ( request && 4 === request.readyState && 200 === request.status
						&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {
						var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
						if ( ! res || res.errors ) {
							return;
						}
						// Clear Thumbnail fields on submit
						jQuery( '#product_brand_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#product_brand_thumbnail_id' ).val( '' );
						jQuery( '.remove_image_button' ).hide();
					return;
					}
				} );
			</script>
			<div class="clear"></div>
		</div>
		<?php
	}
	/**
	 * Edit brand thumbnail field.
	 *
	 * @param mixed $term Term (brand) being edited
	 */
	public function edit_brand_fields( $term ) {
		$display_type = get_term_meta( $term->term_id, 'display_type', true );
		$thumbnail_id = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) );
		if ( $thumbnail_id ) {
			$image = wp_get_attachment_thumb_url( $thumbnail_id );
		} else {
			$image = wc_placeholder_img_src();
		}
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php _e( 'Thumbnail', 'expend' ); ?></label></th>
			<td>
				<div id="product_brand_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_brand_thumbnail_id" name="product_brand_thumbnail_id" value="<?php echo esc_attr($thumbnail_id); ?>" />
					<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'expend' ); ?></button>
					<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'expend' ); ?></button>
				</div>
				<script type="text/javascript">
					// Only show the "remove image" button when needed
					if ( '0' === jQuery( '#product_brand_thumbnail_id' ).val() ) {
						jQuery( '.remove_image_button' ).hide();
					}
					// Uploading files
					var file_frame;
					jQuery( document ).on( 'click', '.upload_image_button', function( event ) {
					event.preventDefault();
					// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}
						// Create the media frame.
						file_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php _e( "Choose an image", "expend" ); ?>',
							button: {
								text: '<?php _e( "Use image", "expend" ); ?>'
							},
							multiple: false
						});
						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
						var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;
							jQuery( '#product_brand_thumbnail_id' ).val( attachment.id );
							jQuery( '#product_brand_thumbnail' ).find( 'img' ).attr( 'src', attachment_thumbnail.url);
							jQuery( '.remove_image_button' ).show();
						});
						// Finally, open the modal.
						file_frame.open();
					});
					jQuery( document ).on( 'click', '.remove_image_button', function() {
						jQuery( '#product_brand_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#product_brand_thumbnail_id' ).val( '' );
						jQuery( '.remove_image_button' ).hide();
						return false;
					});
				</script>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
}
	/**
	
	 * save_brand_fields function.
	 *
	 * @param mixed $term_id Term ID being saved
	 * @param mixed $tt_id
	 * @param string $taxonomy
	 */
	public function save_brand_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
		if ( isset( $_POST['display_type'] ) && 'product_brand' === $taxonomy ) {
			update_woocommerce_term_meta( $term_id, 'display_type', esc_attr( $_POST['display_type'] ) );
		}
		if ( isset( $_POST['product_brand_thumbnail_id'] ) && 'product_brand' === $taxonomy ) {
			update_woocommerce_term_meta( $term_id, 'thumbnail_id', absint( $_POST['product_brand_thumbnail_id'] ) );
		}
	}
	/**
	 * Description for product_brand page to aid users.
	 */
	public function product_brand_description() {
		echo wpautop( __( 'Product categories for your store can be managed here. To change the order of categories on the front-end you can drag and drop to sort them. To see more categories listed click the "screen options" link at the top of the page.', 'expend' ) );
	}
	/**
	 * Description for shipping class page to aid users.
	 */
	public function product_attribute_description() {
		echo wpautop( __( 'Attribute terms can be assigned to products and variations.<br/><br/><b>Note</b>: Deleting a term will remove it from all products and variations to which it has been assigned. Recreating a term will not automatically assign it back to products.', 'expend' ) );
	}
/**
	 * Thumbnail column added to brand admin.
	 *
	 * @param mixed $columns
	 * @return array
	 */
	public function product_brand_columns( $columns ) {
		$new_columns = array();
		if ( isset( $columns['cb'] ) ) {
			$new_columns['cb'] = $columns['cb'];
			unset( $columns['cb'] );
		}
		$new_columns['thumb'] = __( 'Image', 'expend' );
		return array_merge( $new_columns, $columns );
	}
	/**
	 * Thumbnail column value added to brand admin.
	 *
	 * @param string $columns
	 * @param string $column
	 * @param int $id
	 * @return array
	 */
	public function product_brand_column( $columns, $column, $id ) {
		if ( 'thumb' == $column ) {
			$thumbnail_id = get_term_meta( $id, 'thumbnail_id', true );
			if ( $thumbnail_id ) {
				$image = wp_get_attachment_thumb_url( $thumbnail_id );
			} else {
				$image = wc_placeholder_img_src();
			}
			// Prevent esc_url from breaking spaces in urls for image embeds
			// Ref: https://core.trac.wordpress.org/ticket/23605
			$image = str_replace( ' ', '%20', $image );
			$columns .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr__( 'Thumbnail', 'expend' ) . '" class="wp-post-image" height="48" width="48" />';
		}
		return $columns;
	}
	/**
	 * Maintain term hierarchy when editing a product.
	 *
	 * @param  array $args
	 * @return array
	 */
	public function disable_checked_ontop( $args ) {
		if ( ! empty( $args['taxonomy'] ) && 'product_brand' === $args['taxonomy'] ) {
			$args['checked_ontop'] = false;
		}
		return $args;
	}
}
new brand_taxonomies();
?>