<?php
/**
 * Template : Danh mục
 */
?>

<?php get_header(); ?>
	<div class="container pad-top">
	  	<div class="row">
			<div class="col-sm-8 product-list">
				<?php 
				global $wpdb;
				$limit = 10;
				$offset = 0;
				$table = $wpdb->prefix . 'posts';
				$sql = "SELECT * FROM {$table} WHERE 'post_type' = 'vieclam' LIMIT %d OFFSET %d";
				$data = $wpdb->get_results( $wpdb->prepare($sql, $limit, $offset), ARRAY_A);
				$title=$_GET['s'];
				$tinhthanh=$_GET['tinhthanh'];
				$nganhnghe=$_GET['nganhnghe'];
				$kinhnghiem=$_GET['kinhnghiem'];
				$trinhdo=$_GET['trinhdo'];
				$hinhthuc=$_GET['hinhthuc'];
				$mucluong=$_GET['mucluong']; 
				$capbac=$_GET['capbac']; 
				$args = array(
					'post_type' => 'vieclam',
					'posts_per_page' => 15,
					'orderby' => 'title',
					'order'   => 'ASC',
					's' => $title,
					'tax_query' => array(
					'relation' => 'AND',
						array(
							'taxonomy' => 'tinhthanh',
							'field'    => 'term_taxonomy_id',
							'terms'    => array($tinhthanh),
							'operator' => 'AND'
						),
						array(
							'taxonomy' => 'nganhnghe',
							'field'    => 'term_taxonomy_id',
							'terms'    => array($nganhnghe),
							'operator' => 'AND'
						),
						array(
							'taxonomy' => 'kinhnghiem',
							'field'    => 'term_taxonomy_id',
							'terms'    => array($kinhnghiem),
							'operator' => 'AND'
						),
						array(
							'taxonomy' => 'trinhdo',
							'field'    => 'term_taxonomy_id',
							'terms'    => array($trinhdo),
							'operator' => 'AND'
						),
						array(
							'taxonomy' => 'hinhthuc',
							'field'    => 'term_taxonomy_id',
							'terms'    => array($hinhthuc),
							'operator' => 'AND'
						),
						array(
							'taxonomy' => 'mucluong',
							'field'    => 'term_taxonomy_id',
							'terms'    => array($mucluong),
							'operator' => 'AND'
						),
						array(
							'taxonomy' => 'capbac',
							'field'    => 'term_taxonomy_id',
							'terms'    => array($capbac),
							'operator' => 'AND'
						),
					),
				);
				
				$the_query = new WP_Query( $args );
				//print_r($the_query->get_posts());
				//echo $the_query->request;
				?>
				<div class="Repeat">
					<h2>Kết quả tìm kiếm</h2>
					<?php
						if($title == "" and $tinhthanh == 0 and $nganhnghe == 0 and $kinhnghiem == 0 and $trinhdo == 0 and $hinhthuc == 0 and $mucluong == 0 and $capbac == 0) {
							echo '<span class="colorblue"><strong><a href="">Không tìm thấy kết quả phù hợp 1</a></strong></span>.';
						}
						elseif ($the_query->have_posts() == 0){
							echo '<span class="colorblue"><strong><a href="">Không tìm thấy kết quả phù hợp</a></strong></span>.';
						}
					?>
				</div>
				<?php 
					if($title != "" or $nganhnghe != 0 or $tinhthanh != 0 or $kinhnghiem != 0 or $trinhdo != 0 or $hinhthuc != 0 or $mucluong != 0 or $capbac != 0) {
				?>
						<div class="row-mb-block box-search-candidate search-job-quick">
							<div>
								<div class="box-cnt-white mt-1 mt-md-3">
									<div class="box-list-job">
										<ul>
										<?php 
											if ( $the_query->have_posts() ) :
												while ( $the_query->have_posts() ) : $the_query->the_post();
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
												endif;
												wp_reset_postdata();
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
				<?php
					//endif;
				//wp_reset_postdata();
					}
				?>
			</div>
			
	  		<div class="col-sm-4 form_search_sidebar">
				<div class="container">
					<form class="form-advanced-search" action="<?php echo site_url(); ?>" method="GET">
						<div class="row">
							<div class="col-12 col-md-12 form-group demand-radios">
								<label class="demand-radio">
									<span class="name">Tìm kiếm xe ô tô</span>
								</label>
							</div>
							<div class="col-12 col-md-12 form-group">
								<input class="form-control" type="text" name="s" placeholder="Từ khóa">
							</div>
							<div class="col-12 col-md-12 form-group">
								<select class="form-control custom-select" name="loainhadat">
									<option value="0">Chọn loại nhà đất</option>
									<?php $terms = get_terms(array('taxonomy'   => 'category','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
										<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-md-12 form-group">
								<select class="form-control custom-select" name="tinhthanh" id="tinh_thanh">
									<option value="0">Tỉnh/Thành</option>
									<?php 
										$terms_tinhthanh = get_terms(
											array(
												'taxonomy'   => 'tinh-thanh',
												'hide_empty' => false,
												'parent' => 0
											)
										); 
										
										foreach ( $terms_tinhthanh as $term ) { ?>
										<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-md-12 form-group">
								<select class="form-control custom-select" name="quanhuyen" id="quan_huyen">
									<option value="0">Quận/Huyện</option>
								</select>
							</div>
							<div class="col-12 col-md-12 form-group">
								<select class="form-control custom-select" name="giaban">
									<option value="0">Giá bán</option>
									<?php $terms = get_terms(array('taxonomy'   => 'gia-ban','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
										<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-md-12 form-group">
								<select class="form-control custom-select" name="huongnha">
									<option value="0">Hướng nhà</option>
									<?php $terms = get_terms(array('taxonomy'   => 'huong-nha','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
										<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-md-12 form-group">
								<select class="form-control custom-select" name="dientich">
									<option value="0">Diện tích</option>
									<?php $terms = get_terms(array('taxonomy'   => 'dien-tich','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
										<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-md-12 form-group">
								<select class="form-control custom-select" name="phongngu">
									<option value="0">Phòng ngủ</option>
									<?php $terms = get_terms(array('taxonomy'   => 'phong-ngu','hide_empty' => false,)); foreach ( $terms as $term ) { ?>
										<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-md-12 form-group">
								<button class="btn btn-primary btn-block" type="submit" data-toggle="modal" data-target="#myModal">Tìm kiếm!</button>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	
<?php get_footer(); ?>