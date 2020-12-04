<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Form_Search_Advanced_Sidebar extends Widget_Base {

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
        return 'Form-Search-Advanced-Sidebar';
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
        return __( 'Form Search Advanced Sidebar', 'addon_elementor' );
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
				'label' => __( 'Form', 'webmediavietnam' ),
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
	<div class="advanced-search">
		<div class="container">
			<form class="form-advanced-search" action="<?php echo site_url(); ?>" method="GET">
				<div class="row">
					<div class="col-12 col-md-6 form-group demand-radios">
						<label class="demand-radio">
							<span class="name">Tìm kiếm việc làm</span>
						</label>
					</div>
					
					<div class="col-12 col-sm-8 col-lg-8 form-group">
						<input class="form-control" type="text" name="s" placeholder="Từ khóa">
					</div>
					<div class="col-6 col-sm-4 col-lg-2 form-group">
						<select class="form-control custom-select" name="nganhnghe">
							<option value="0">Ngành nghề</option>
							<?php $terms = get_terms(array('taxonomy'   => 'nganhnghe','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
								<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-sm-4 col-lg-2 form-group">
						<button class="btn btn-primary btn-block" type="submit" data-toggle="modal" data-target="#myModal">Tìm kiếm!</button>
					</div>

					<div class="col-6 col-sm-4 col-lg-2 form-group">
						<select class="form-control custom-select" name="kinhnghiem" id="tinh_thanh">
							<option value="0">Kinh nghiệm</option>
							<?php 
								$terms_tinhthanh = get_terms(
									array(
										'taxonomy'   => 'kinhnghiem',
										'hide_empty' => false,
										'parent' => 0
									)
								); 
								
								foreach ( $terms_tinhthanh as $term ) { ?>
								<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-6 col-sm-4 col-lg-2 form-group">
						<select class="form-control custom-select" name="tinhthanh">
							<option value="0">Tỉnh / Thành</option>
							<?php $terms = get_terms(array('taxonomy'   => 'tinhthanh','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
								<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-6 col-sm-4 col-lg-2 form-group">
						<select class="form-control custom-select" name="trinhdo">
							<option value="0">Trình độ</option>
							<?php $terms = get_terms(array('taxonomy'   => 'trinhdo','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
								<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-6 col-sm-4 col-lg-2 form-group">
						<select class="form-control custom-select" name="hinhthuc">
							<option value="0">Hình thức làm việc</option>
							<?php $terms = get_terms(array('taxonomy'   => 'hinhthuc','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
								<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-6 col-sm-4 col-lg-2 form-group">
						<select class="form-control custom-select" name="mucluong">
							<option value="0">Mức lương</option>
							<?php $terms = get_terms(array('taxonomy'   => 'mucluong','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
								<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-6 col-sm-4 col-lg-2 form-group">
						<select class="form-control custom-select" name="capbac">
							<option value="0">Cấp bậc</option>
							<?php $terms = get_terms(array('taxonomy'   => 'capbac','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
								<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</form>
		</div>
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

Plugin::instance()->widgets_manager->register_widget_type( new Form_Search_Advanced_Sidebar() );