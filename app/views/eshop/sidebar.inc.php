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

	<h2>Advanced Search</h2>
            <!-- Searchbox -->
            <style>
              .my-table {
                background-color: #F0F0E9;
              }

              .my-table th{
              	background-color: #ddd;
              }
            </style>
            <form method="get">
              <table class="my-table table table-condensed">
                  <tr>
                    <td><input value="<?=Search::get_sticky('textbox','description')?>" autofocus="true" type="text" name="description" class="form-control" placeholder="Type Product name"></td>

                  </tr> 

                  <tr>
                    <td>
                      <select class="form-control" name="category">
                        <option>--Select Category--</option>
                        <?=Search::get_categories('category')?>
                      </select>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>
	                	<div>Brands</div>
	                  	<?=Search::get_brands()?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td>
                  		<div>Price Range:</div>
                  		<div class="well text-center price-range" style="margin-top: 0px; margin-bottom: 0px;">
												<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000" data-slider-step="5" data-slider-value="[0,800]" id="sl2" ><br />
												<b class="pull-left">$ 0</b> <b class="pull-right">$ 1000</b>
                      	
                        <input value="<?=Search::get_sticky('number','min-price')?>" class="form-control min-value" type="hidden" size="12" min="0" step="0.01" name="min-price">
                        <input value="<?=Search::get_sticky('number','max-price')?>" class="form-control max-value" type="hidden" size="12" min="0" step="0.01" name="max-price">

											</div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                    	<div>Quantity</div>
                      	<div class="form-inline">
	                       	<div class="well text-center quantity-range" style="margin-top: 0px; margin-bottom: 0px;">
														<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000" data-slider-step="5" data-slider-value="[0,800]" id="sl3" ><br />
														<b class="pull-left">0</b> <b class="pull-right">1000</b>
														<input class="form-control min-value" type="hidden" value="<?=Search::get_sticky('number','min-qty')?>" size="12" min="0" step="1" name="min-qty">
	                        	<input class="form-control max-value" type="hidden" value="<?=Search::get_sticky('number','max-qty')?>" size="12" min="0" step="1" name="max-qty">
													</div>
	                        
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <select class="form-control" name="year">
                        <option>--Select Year--</option>
                        <?=Search::get_years('year')?>
                      </select>
                    </td>
                  </tr>
                  <tr><td><input type="submit" value="Search" class="btn btn-success pull-right" name="search"></td></tr>
              </table>
            </form>
            <!-- endSearchbox -->
	
	<div class="shipping text-center"><!--shipping-->
		<img src="<?= ASSETS . THEME ?>/images/home/shipping.jpg" alt="" />
	</div><!--/shipping--><br><br><br>

</div>

<script>
	
	var price_range = document.querySelector(".price-range");
	var qty_range = document.querySelector(".quantity-range");
	
	price_range.addEventListener('mousemove', change_value_range);
	qty_range.addEventListener('mousemove', change_value_range);


	function change_value_range(e)
	{
		var tooltip = e.currentTarget.querySelector(".tooltip-inner");
		var min_value = e.currentTarget.querySelector(".min-value");
		var max_value = e.currentTarget.querySelector(".max-value");

		var values = tooltip.innerHTML;
		var parts = values.split(":"); //divide in 2 parts or separate the values between

		min_value.value = parts[0].trim();
		max_value.value = parts[1].trim();
	}


</script>
