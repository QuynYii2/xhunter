<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Show_By_Taxonomy extends Widget_Base {

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
        return 'Show-By-Taxonomy';
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
        return __( 'Show By Taxonomy', 'addon_elementor' );
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
			'widget_title',
			[
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => [],
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);
		
		$taxonomies = get_terms(array(
            'post_type' => 'post',
            'hide_empty' => false,
		));
		$options = [];
		if ( $taxonomies ) {
			$options = wp_list_pluck( $taxonomies, 'name', 'term_id' );
		}
		$this->add_control(
			'taxonomy',
			[
				'label' => __( 'Choose Taxonomy', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $options,
				'default' => [],
			]
		);
		
		$this->add_control(
			'number_show',
			[
				'label' => __( 'Post Per Page ', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '8', 'plugin-domain' ),
				'placeholder' => __( 'Type your title here', 'plugin-domain' ),
			]
		);
		$this->end_controls_section();
    }
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$term = get_term($settings['taxonomy']);
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $settings['number_show'],
			'tax_query' => array(
				array(
					'taxonomy' => $term->taxonomy,
					'terms' => $settings['taxonomy'],
				)
			),
		);
		$query = new \WP_Query( $args ); 
		?>
		<div class="home-center bg-grey">
			<div class="home-product product-4-you">
				<h2 class="fl">
					<?php 
						if($settings['widget_title']){ 
							print_r($settings['widget_title']); 
						}
						else{
							echo 'Dự án '.$term->name;
						}
							
					?>
				</h2>
				<div class="clear"></div>
				<ul id="tin-rao-danh-cho-ban">
		<?php 
		if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post();
		?>
			<li>
				<div class="vip1" rel="26513865" uid="739820">
					<div class="product-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php $images = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); ?>
							<img src="<?php print_r($images[0]); ?>" alt="" noloaderror="true" imgerr="3">
						</a>
					</div>
					<div class="home-product-bound">
						<div class="p-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_title(); ?>
							</a>
						</div>
						<div class="product-price"><?php echo get_field('gia'); ?></div>
						<div class="product-info">
							<img src="https://file4.batdongsan.com.vn/images/newhome/3x/selection.png" width="16"><?php echo get_field('diện_tich'); ?> m²
						</div>
						<div class="product-info">
							<img src="https://file4.batdongsan.com.vn/images/newhome/3x/location.png" width="18">
							<a><?php echo get_field('dịa_chỉ'); ?></a>
						</div>
					</div>
				</div>
			</li>
		<?php 
		endwhile; endif; wp_reset_postdata() ;
		?>
				</div>
			</div>
		<?php 
	}
	
}

Plugin::instance()->widgets_manager->register_widget_type( new Show_By_Taxonomy() );