<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Carousel_Product extends Widget_Base {

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
        return 'carousel-product';
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
        return __( 'Carousel Product', 'addon_elementor' );
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
        $this->start_controls_section(
			'section_items',
			[
				'label' => __( 'Items', 'webmediavietnam' ),
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'plugin-name' ),
			]
		);
		$this->add_control(
			'number',
			[
				'label' => __( 'Posts Per Page', 'elementor-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
			]
		);

		$this->end_controls_section();
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

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'container' => [
				'class' => 'webmediavietnam-product-carousel-container',
				'dir' => 'ltr',
			],
			'wrapper' => [
				'class' => 'webmediavietnam-product-carousel-wrapper swiper-wrapper',
			],
		] );
		$args = array(
			'post_type'=>'product',
			'post_status'=>'publish',
			'orderby' => 'ID',
			'order' => 'DESC',
		);	
		$products = new \WP_Query($args);
		
		if ( $products->have_posts() ) :
?>
		<div <?php echo $this->get_render_attribute_string( 'container' ); ?>>
			<div class="product-carousel swiper-container">
				<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<div class="product-item-slide swiper-slide">
						<a href="<?php the_permalink(); ?>" class="product-thumb">
							<?php echo get_the_post_thumbnail();?>
						</a>
						<div class="product-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div>
					</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<?php //if ( 1 < $settings['number'] ) : ?>
			<!--div class="webmediavietnam-product-carousel-navigation">
				<div class="webmediavietnam-thumbail-ctegory-product-carousel-prev"><i class="eicon-chevron-left"></i></div>
				<div class="webmediavietnam-thumbail-ctegory-product-carousel-next"><i class="eicon-chevron-right"></i></div>
			</div-->
			<?php //endif; ?>
		</div>
		<?php endif; ?>
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

Plugin::instance()->widgets_manager->register_widget_type( new Carousel_Product() );