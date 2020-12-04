<?php
class Addon_Base_Setup
{

    function __construct()
    {
        add_action('elementor/init', array($this, 'initiate_elementor_addons'));

        add_action('elementor/widgets/widgets_registered', array($this, 'addons_widget_register'));

        add_action('elementor/frontend/after_register_scripts', array($this, 'enqueue_script'));

        add_action('elementor/frontend/after_register_styles', array($this, 'register_frontend_styles'), 10);

        add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_frontend_styles'), 10);
    }

    public function addons_widget_register()
    {
        require_once (EC_EXTENTIONS_PATH . 'widgets/hello.php');
		require_once (EC_EXTENTIONS_PATH . 'widgets/carousel-product.php');
		require_once (EC_EXTENTIONS_PATH . 'widgets/thumbs-gallery.php');
		require_once (EC_EXTENTIONS_PATH . 'widgets/description-product.php');
		require_once (EC_EXTENTIONS_PATH . 'widgets/hero-slider.php');
		require_once (EC_EXTENTIONS_PATH . 'widgets/form-search-advanced.php');
		require_once (EC_EXTENTIONS_PATH . 'widgets/show-by-taxonomy.php');
		require_once (EC_EXTENTIONS_PATH . 'widgets/form-search-advanced-sidebar.php');
		require_once (EC_EXTENTIONS_PATH . 'widgets/slider-thumbail-post.php');
		require_once (EC_EXTENTIONS_PATH . 'widgets/list-recruitment.php');
    }

    //Create new section on elementor
    public function initiate_elementor_addons()
    {
        Elementor\Plugin::instance()->elements_manager->add_category(
            'my-section',
            array(
                'title' => __('Addon Elementor Extentions', 'addon_elementor')
            ),
            1
        );
    }

    public function enqueue_script(){
        wp_register_script( 'general-script', EC_EXTENTIONS_URL . 'assets/js/script.js', [ 'jquery' ], EC_ELEMENTOR_VERSION, true );
		wp_register_script( 'ajax-script', EC_EXTENTIONS_URL . 'assets/js/jquery-3.4.1.min.js', [ 'jquery' ], EC_ELEMENTOR_VERSION, true );
    }

    public function register_frontend_styles(){
        wp_register_style('general-style', EC_EXTENTIONS_URL . 'assets/css/general.css', array(), EC_ELEMENTOR_VERSION);
		wp_register_style('general-style_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css', array(), EC_ELEMENTOR_VERSION);
    }

    public function enqueue_frontend_styles(){
        wp_enqueue_style('general-style');
		wp_enqueue_style('general-style_bootstrap');
		wp_enqueue_script('general-script');
		wp_enqueue_script('ajax-script');
    }
}

new Addon_Base_Setup();