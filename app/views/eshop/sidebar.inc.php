<div class="left-sidebar">
	<h2>Category</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->

		<!-- category with children -->
		<?php if(isset($categories) && is_array($categories)): ?>
			<?php foreach($categories as $cats): 

					if($cats->parent > 0){
						continue;   //skip if is big than 0
					}

					$parents = array_column($categories, "parent");  //take parent of each category

				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a <?=in_array($cats->id, $parents) ? 'data-toggle="collapse"' : '';?>  data-parent="#accordian" href="<?=in_array($cats->id, $parents) ? '#'.$cats->category : ROOT . 'shop/category/' . $cats->category?>">
								<?=$cats->category?>
								<?php if(in_array($cats->id, $parents)): ?>
									<span class="badge pull-right"><i class="fa fa-plus"></i></span>
								<?php endif;?>
							</a>
						</h4>
					</div>
					<?php if(in_array($cats->id, $parents)): ?>
						<div id="<?=$cats->category?>" class="panel-collapse collapse">
							<div class="panel-body">
								<ul>
									<li><a href="<?=ROOT . 'shop/category/' . $cats->category;?>">ALL</a></li>
									<?php foreach($categories as $sub_cat): ?>
										<?php if($sub_cat->parent == $cats->id): ?>
											<li><a href="<?=ROOT . 'shop/category/' . $sub_cat->category?>"><?=$sub_cat->category?></a></li>
										<?php endif;?>
									<?php endforeach;?>
								</ul>
							</div>
						</div>
					<?php endif;?>
				</div>
			<?php endforeach;?>
		<?php endif;?>
	</div><!--/category-products-->

	
	<div class="shipping text-center"><!--shipping-->
		<img src="<?= ASSETS . THEME ?>/images/home/shipping.jpg" alt="" />
	</div><!--/shipping--><br><br><br>

</div>