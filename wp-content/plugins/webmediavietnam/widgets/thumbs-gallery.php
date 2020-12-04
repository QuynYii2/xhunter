<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Thumbs_Gallery extends Widget_Base {

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
        return 'thumbs-gallery';
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
        return __( 'Thumbs Gallery', 'addon_elementor' );
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
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'border_style',
			[
				'label' => __( 'Layout', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'Horizontal',
				'options' => [
					'Horizontal'  => __( 'Horizontal', 'plugin-domain' ),
					'Verical' => __( 'Verical', 'plugin-domain' ),
				],
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
		//echo '<div style="border-style: ' . $settings['border_style'] . '">'. $settings['border_style'].'</div>';
		$query_args = array( 
			'post_type'     => 'post', 
			'post_status'   => 'publish',
			'orderby'       => '',
			'order'         => 'asc',
			'nopaging'      => true
		);

		$myQuery = new \WP_Query($query_args);
		if($settings['border_style'] == 'Verical'){
?>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="swiper-container gallery-thumbs">
						<div class="swiper-wrapper">
							<?php
							foreach ($myQuery->posts as $key => $thingieBob) {
								$acf_field = get_field('gallery', $thingieBob->ID);       
								$title 	=	$thingieBob->post_title;
								$image  = wp_get_attachment_image_src( get_post_thumbnail_id($thingieBob->ID), 'medium');
								$image  = $image[0];
							?>
								
									<div class="swiper-slide" style="background-image:url(<?php print_r($image ); ?>)"></div>
								
							<?php } ?>
						</div>
					</div>
				</div>
				
				<div class="col-md-9">
					<div class="webmediavietnam-thumbs swiper-container gallery-top">
						<div class="swiper-wrapper">
							<?php
							foreach ($myQuery->posts as $key => $thingieBob) {
								$acf_field = get_field('gallery', $thingieBob->ID);       
								$title 	=	$thingieBob->post_title;
								$image  = wp_get_attachment_image_src( get_post_thumbnail_id($thingieBob->ID), 'medium');
								$image  = $image[0];
							?>
									<div class="swiper-slide" style="background-image:url(<?php print_r($image ); ?>)"></div>
							<?php } wp_reset_postdata();?>
						</div>
							<!-- Add Arrows -->
							<div class="swiper-button-next swiper-button-black"></div>
							<div class="swiper-button-prev swiper-button-black"></div>
					</div>
				</div>
			</div>
		</div>
<?php
		}
		else{
?>
<div class="webmediavietnam-thumbs swiper-container gallery-top">
						<div class="swiper-wrapper">
							<?php
							foreach ($myQuery->posts as $key => $thingieBob) {
								$acf_field = get_field('gallery', $thingieBob->ID);       
								$title 	=	$thingieBob->post_title;
								$image  = wp_get_attachment_image_src( get_post_thumbnail_id($thingieBob->ID), 'medium');
								$image  = $image[0];
							?>
									<div class="swiper-slide" style="background-image:url(<?php print_r($image ); ?>)"></div>
							<?php } wp_reset_postdata();?>
						</div>
							<!-- Add Arrows -->
							<div class="swiper-button-next swiper-button-black"></div>
							<div class="swiper-button-prev swiper-button-black"></div>
					</div>
					<div class="swiper-container gallery-thumbs">
						<div class="swiper-wrapper">
							<?php
							foreach ($myQuery->posts as $key => $thingieBob) {
								$acf_field = get_field('gallery', $thingieBob->ID);       
								$title 	=	$thingieBob->post_title;
								$image  = wp_get_attachment_image_src( get_post_thumbnail_id($thingieBob->ID), 'medium');
								$image  = $image[0];
							?>
								
									<div class="swiper-slide" style="background-image:url(<?php print_r($image ); ?>)"></div>
								
							<?php } ?>
						</div>
					</div>
<?php 
		}
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

Plugin::instance()->widgets_manager->register_widget_type( new Thumbs_Gallery() );