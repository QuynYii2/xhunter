<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class List_Recruitment  extends Widget_Base {

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
        return 'List Recruitment';
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
        return __( 'List Recruitment', 'addon_elementor' );
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
			'post_type' => 'vieclam',
			'post_status' => 'publish',
			'orderby' => 'title', 
			'order' => 'ASC',
			//'posts_per_page' => 10
		);

		$loop = new \WP_Query( $args ); 
		echo '<pre>';
		//print_r($loop);
		echo '</pre>';
	?>
			<div class="row-mb-block box-search-candidate search-job-quick">
				<div>
					<div class="box-cnt-white mt-1 mt-md-3">
						<div class="box-list-job">
							<ul>
							<?php 
								while ( $loop->have_posts() ) : $loop->the_post();
								$taxonomy_luong = wp_get_object_terms( $post->ID, 'mucluong', array( 'fields' => 'names' ) );
								$taxonomy_tinhthanh = wp_get_object_terms( $post->ID, 'tinhthanh', array( 'fields' => 'names' ) );
							?>
								<li class="jsx-896248193 false">
									<div class="jsx-896248193 job-box">
										<button class="btn btn-favor fn-favor-job cursor-pointer" tooltip-title="Lưu việc làm">
											<i class="fa fa-star-o" aria-hidden="true"></i>
										</button>
										<div class="jsx-896248193 job-row">
											<div class="jsx-896248193 job-cnt">
												<div class="jsx-896248193 job-ttl truncate-ellipsis">
													<a title="<?php the_title(); ?>" class="jsx-896248193" href="<?php the_permalink(); ?>">
														<span class="jsx-896248193"></span>
														<span class="jsx-896248193 black-hover-active"><?php the_title(); ?></span>
													</a>
												</div>
												<div class="jsx-896248193 candi-name truncate-ellipsis">
													<a title="<?php the_field('ten_cong_ty'); ?>" class="jsx-896248193 effect-basic-job" href="">
														<?php if( get_field('ten_cong_ty') ): ?>
															<h2><?php the_field('ten_cong_ty'); ?></h2>
														<?php endif; ?>
													</a>
												</div>
											</div>
											<div class="jsx-896248193 job-actions ">
												<div class="jsx-896248193 job-action-col">
													<div title="Mức lương" class="jsx-896248193 job-desc truncate-ellipsis text-center">
													<i class="fa fa-usd" aria-hidden="true"></i>
													<span class="jsx-896248193 job-desc-txt w-100">
														<?php print_r($taxonomy_luong[0]); ?>
													</span>
													</div>
												</div>
												<div class="jsx-896248193 job-action-col">
													<div title="Địa điểm" class="jsx-896248193 job-desc truncate-ellipsis text-center">
													<i class="fa fa-map-marker" aria-hidden="true"></i>
													<span class="jsx-896248193 job-desc-txt w-100">
														<?php print_r($taxonomy_tinhthanh[0]); ?>
													</span>
													</div>
												</div>
												<div class="jsx-896248193 job-action-col">
													<div title="Hạn nộp hồ sơ" class="jsx-896248193 job-desc truncate-ellipsis text-center">
													<i class="fa fa-calendar-o" aria-hidden="true"></i>
													<span class="jsx-896248193 job-desc-txt w-100">
														<?php if( get_field('hạn_nộp_hồ_so') ): ?>
															<h2><?php the_field('hạn_nộp_hồ_so'); ?></h2>
														<?php endif; ?>
													</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
								<?php 
									endwhile;
									wp_reset_postdata();
								?>
							</ul>
						</div>
					</div>
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

Plugin::instance()->widgets_manager->register_widget_type( new List_Recruitment() );