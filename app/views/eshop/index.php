<?php $this->view("header", $data); ?>

	<?php $this->view("slider", $data); ?>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<?php $this->view("sidebar.inc", $data); ?>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>

						<?php if(isset($ROWS) && is_array($ROWS)): ?>
						<?php foreach($ROWS as $row): ?>

							<?php $this->view("product.inc", $row); ?>
						
						<?php endforeach;?>
						<?php endif;?>
						
						
					</div><!--features_items-->
					<?php //show($segment_data);?>

					<?php if(isset($segment_data) && is_array($segment_data)): $num = 0; ?>
						<div class="category-tab"><!--category-tab-->
							<div class="col-sm-12">
								<ul class="nav nav-tabs">
									<?php foreach($segment_data as $key => $seg): $num++ ?>
										<li <?= ($num == 1) ? 'class="active"' : '';?>><a href="#<?=$key?>" data-toggle="tab"><?=$key?></a></li>
									<?php endforeach;?>
								</ul>
							</div>
							<div class="tab-content">
								<?php $num = 0;?>
								<?php foreach($segment_data as $key => $seg): $num++; ?>
									<div class="tab-pane fade <?= ($num == 1) ? 'active in' : '';?>" id="<?=$key?>" >
										<?php if(is_array($seg)): ?>
											<?php foreach($seg as $row): ?>

											<div class="col-sm-3">
												<div class="product-image-wrapper">
													<div class="single-products">
														<div class="productinfo text-center">
															<img src="<?= ROOT .$row->image ?>" alt="" />
															<h2>$<?= $row->price ?></h2>
															<p><?= $row->description ?></p>
															<a href="<?=ROOT?>add_to_cart/<?=$row->id?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
														</div>
														
													</div>
												</div>
											</div>
											<?php endforeach;?>
										<?php endif;?>
									</div>
								<?php endforeach;?>
							</div>
						</div><!--/category-tab-->
					<?php endif;?>
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">

								<?php if(isset($Slider_ROWS) && is_array($Slider_ROWS)): $num=0?>

									<?php foreach($Slider_ROWS as $Slider_ROW): $num++?>
										<div class="item <?=($num==1) ? 'active' : '';?>">
											<?php if(is_array($Slider_ROW)): ?>
												<?php foreach($Slider_ROW as $row): ?>
													<?php $this->view("product.inc", $row); ?>
												<?php endforeach;?>
											<?php endif;?>
										</div>
									<?php endforeach;?>

								<?php endif;?>

							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>

	
<?php $this->view("footer", $data); ?>

