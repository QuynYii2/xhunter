<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Hero_Slider extends Widget_Base {

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
        return 'hero-slides';
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
        return __( 'Hero Slider', 'addon_elementor' );
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
			'section_slides',
			[
				'label' => __( 'Slides', 'webmediavietnam' ),
			]
		);

		$repeater = new Repeater();

		$library = get_posts( array(
			'post_type'      => 'elementor_library',
			'fields'         => 'ids',
			'posts_per_page' => -1
		));

		$templates = array();

		if ( $library ) {
			foreach ( $library as $id ) {
				$templates[ $id ] = get_the_title( $id );
			}
		}

		$repeater->add_control(
			'slide',
			[
				'label'       => __( 'Choose Template', 'webmediavietnam' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'options'     => $templates,
				'label_block' => true,
			]
		);

		$this->add_control(
			'slides',
			[
				'label' => __( 'Slides', 'webmediavietnam' ),
				'type' => Controls_Manager::REPEATER,
				'show_label' => true,
				'fields' => $repeater->get_controls(),
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
	?>
	<!-- Swiper -->
	<div class="swiper-container hero-slides">
		<div class="swiper-wrapper">
			<?php foreach ( $settings['slides'] as $slide ) { ?>
				<div class="swiper-slide">
					<?php echo do_shortcode( '[elementor-template id="'. $slide['slide'] .'"]' ); ?>
				</div>
			<?php } ?>
		</div>
		<!-- Add Pagination -->
		<div class="swiper-pagination swiper-pagination-white"></div>
		<!-- Add Arrows -->
		<!--div class="swiper-button-next swiper-button-white"></div>
		<div class="swiper-button-prev swiper-button-white"></div-->
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

Plugin::instance()->widgets_manager->register_widget_type( new Hero_Slider() );