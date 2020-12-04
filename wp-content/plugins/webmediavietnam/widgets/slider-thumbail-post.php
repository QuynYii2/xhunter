<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Slider_Thumbail_Post extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'Slider thumbail post';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Slider Thumbail Post', 'addon_elementor' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-push';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'my-section' ];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls() {
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
		global $post;
		$args = array(  
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => 'title', 
			'order' => 'ASC',
			'cat' => 1,
		);

		$loop = new \WP_Query( $args ); 
	?>
		<div class="swiper-container slide-post-thumbail duan tintuc_slide">
			<div class="swiper-wrapper">
	<?php
		while ( $loop->have_posts() ) : $loop->the_post(); 
			$img_attribs = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()));
	?>
				<div class="swiper-slide">
					<a href="<?php the_permalink(); ?>">
						<img class="swiper-slide-image" src="<?php print_r($img_attribs[0]); ?>">
					</a>
					<div class="product_content">
						<h2><?php the_title(); ?></h2>
						<?php the_excerpt(); ?>
					</div>
				</div>
	<?php
		endwhile;
		wp_reset_postdata(); 
	?>
			</div>
			<!-- Add Arrows -->
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
	<?php
	}

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _content_template() {
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Slider_Thumbail_Post() );