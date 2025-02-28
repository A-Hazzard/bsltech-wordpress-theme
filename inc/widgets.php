<?php
/**
 * Custom Widget for displaying specific post formats
 *
 * Displays posts from Aside, Quote, Video, Audio, Image, Gallery, and Link formats.
 *
 * @link http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package WordPress
 * @subpackage TemplateMela
 * @since TemplateMela 1.0
 */
class TemplateMela_Ephemera_Widget extends WP_Widget {
	/**
	 * The supported post formats.
	 *
	 * @access private
	 * @since TemplateMela 1.0
	 *
	 * @var array
	 */
	private $formats = array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery' );
	/**
	 * Pluralized post format strings.
	 *
	 * @access private
	 * @since TemplateMela 1.0
	 *
	 * @var array
	 */
	private $format_strings;
	/**
	 * Constructor.
	 *
	 * @since TemplateMela 1.0
	 *
	 * @return TemplateMela_Ephemera_Widget
	 */
	public function __construct() {
		parent::__construct( 'widget_templatemela_ephemera', esc_html__( 'TemplateMela Ephemera', 'expend' ), array(
			'classname'   => 'widget_templatemela_ephemera',
			'description' => esc_html__( 'Use this widget to list your recent Aside, Quote, Video, Audio, Image, Gallery, and Link posts', 'expend' ),
		) );
		/*
		 * @todo http://core.trac.wordpress.org/ticket/23257: Add plural versions of Post Format strings
		 */
		$this->format_strings = array(
			'aside'   => esc_html__( 'Asides',    'expend' ),
			'image'   => esc_html__( 'Images',    'expend' ),
			'video'   => esc_html__( 'Videos',    'expend' ),
			'audio'   => esc_html__( 'Audio',     'expend' ),
			'quote'   => esc_html__( 'Quotes',    'expend' ),
			'link'    => esc_html__( 'Links',     'expend' ),
			'gallery' => esc_html__( 'Galleries', 'expend' ),
		);
	}
	/**
	 * Output the HTML for this widget.
	 *
	 * @access public
	 * @since TemplateMela 1.0
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 * @return void Echoes its output.
	 */
	public function widget( $args, $instance ) {
		$format = $instance['format'];
		$number = empty( $instance['number'] ) ? 2 : absint( $instance['number'] );
		$title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? $this->format_strings[ $format ] : $instance['title'], $instance, $this->id_base );
		$ephemera = new WP_Query( array(
			'order'          => 'DESC',
			'posts_per_page' => $number,
			'no_found_rows'  => true,
			'post_status'    => 'publish',
			'post__not_in'   => get_option( 'sticky_posts' ),
			'tax_query'      => array(
				array(
					'taxonomy' => 'post_format',
					'terms'    => array( "post-format-$format" ),
					'field'    => 'slug',
					'operator' => 'IN',
				),
			),
		) );
		if ( $ephemera->have_posts() ) :
			$tmp_content_width = $GLOBALS['content_width'];
			$GLOBALS['content_width'] = 306;
                        echo wp_kses_post($args['before_widget']);
			?>
			<h3 class="widget-title <?php echo esc_attr( $format ); ?>">
				<a class="entry-format" href="<?php echo esc_url( get_post_format_link( $format ) ); ?>"><?php echo esc_attr($title); ?></a>
			</h3>
			<ol>
				<?php while ( $ephemera->have_posts() ) : $ephemera->the_post(); ?>
				<li>
				<article <?php post_class(); ?>>
					<div class="entry-content">
						<?php
							if ( has_post_format( 'gallery' ) ) :
								if ( post_password_required() ) :
									the_content(wp_kses( __( 'Read More <span class="meta-nav">&rarr;</span>', 'expend' ),tmpmela_allowed_html()) );
								else :
									$images = array();
									$galleries = get_post_galleries( get_the_ID(), false );
									if ( isset( $galleries[0]['ids'] ) )
										$images = explode( ',', $galleries[0]['ids'] );
									if ( ! $images ) :
										$images = get_posts( array(
											'fields'         => 'ids',
											'numberposts'    => -1,
											'order'          => 'ASC',
											'orderby'        => 'menu_order',
											'post_mime_type' => 'image',
											'post_parent'    => get_the_ID(),
											'post_type'      => 'attachment',
										) );
									endif;
									$total_images = count( $images );
									if ( has_post_thumbnail() ) :
										$post_thumbnail = get_the_post_thumbnail();
									elseif ( $total_images > 0 ) :
										$image          = array_shift( $images );
										$post_thumbnail = wp_get_attachment_image( $image, 'post-thumbnail' );
									endif;
									if ( ! empty ( $post_thumbnail ) ) :
						?>
						<a href="<?php esc_url(esc_url(the_permalink())); ?>"><?php echo esc_attr($post_thumbnail); ?></a>
						<?php endif; ?>
						<p class="wp-caption-text">
							<?php
								printf( _n( 'This gallery contains <a href="%1$s" rel="bookmark">%2$s photo</a>.', 'This gallery contains <a href="%1$s" rel="bookmark">%2$s photos</a>.', $total_images, 'expend' ),
									esc_url( get_permalink() ),
									number_format_i18n( $total_images )
								);
							?>
						</p>
						<?php
								endif;
							else :
								the_content(wp_kses( __( 'Read More <span class="meta-nav">&rarr;</span>', 'expend' ),tmpmela_allowed_html()) );
							endif;
						?>
					</div><!-- .entry-content -->
					<header class="entry-header">
						<div class="entry-meta">
							<?php
								if ( ! has_post_format( 'link' ) ) :
									the_title_attribute( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
								endif;
								printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
									esc_url( get_permalink() ),
									esc_attr( get_the_date( 'c' ) ),
									esc_html( get_the_date() ),
									esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
									get_the_author()
								);
								if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
							?>
							<span class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'expend' ), esc_html__( '1 Comment', 'expend' ), esc_html__( '% Comments', 'expend' ) ); ?></span>
							<?php endif; ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->
				</article><!-- #post-## -->
				</li>
				<?php endwhile; ?>
			</ol>
			<a class="post-format-archive-link" href="<?php echo esc_url( get_post_format_link( $format ) ); ?>"><?php printf(wp_kses( __( 'More %s <span class="meta-nav">&rarr;</span>', 'expend' ),tmpmela_allowed_html()), $this->format_strings[ $format ] ); ?></a>
			<?php
			 echo wp_kses_post($args['after_widget']);
			// Reset the post globals as this query will have stomped on it.
			wp_reset_postdata();
			$GLOBALS['content_width'] = $tmp_content_width;
		endif; // End check for ephemeral posts.
	}
	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 * @since TemplateMela 1.0
	 *
	 * @param array $new_instance New widget instance.
	 * @param array $instance     Original widget instance.
	 * @return array Updated widget instance.
	 */
	function update( $new_instance, $instance ) {
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number'] = empty( $new_instance['number'] ) ? 2 : absint( $new_instance['number'] );
		if ( in_array( $new_instance['format'], $this->formats ) ) {
			$instance['format'] = $new_instance['format'];
		}
		return $instance;
	}
	/**
	 * Display the form for this widget on the Widgets page of the Admin area.
	 *
	 * @since TemplateMela 1.0
	 *
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		$title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$number = empty( $instance['number'] ) ? 2 : absint( $instance['number'] );
		$format = isset( $instance['format'] ) && in_array( $instance['format'], $this->formats ) ? $instance['format'] : 'aside';
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'expend' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'expend' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3"></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'format' ) ); ?>"><?php esc_html_e( 'Post format to show:', 'expend' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'format' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'format' ) ); ?>">
				<?php foreach ( $this->formats as $slug ) : ?>
				<option value="<?php echo esc_attr( $slug ); ?>"<?php selected( $format, $slug ); ?>><?php echo esc_attr(get_post_format_string( $slug )); ?></option>
				<?php endforeach; ?>
			</select>
		<?php
	}
}