<?php $this->view("header", $data); ?>
<?php //show($orders);?>

<div style="min-height: 300px;max-width: 1000px; margin: auto;">

	<style type="text/css">
		
		#user_text{
			color: #6e93ce;
		}
		p{
			color: #6e93ce;
		}
		.details{
			background-color: #eee;
			box-shadow: 0px 0px 10px #aaa;
			width: 100%;
			position: absolute;
			min-height: 100px;
			left: 0px;
			padding: 10px;
			z-index: 2;
		}
		.hide{
			display: none;
		}
	</style>

	<!-- Profile data -->
<?php if(is_object($profile_data)): ?>
<div style="display: flex;">
	<div class="col-md-4 mb" style="flex: 1; background-color: #eee;text-align: center;box-shadow: 0px 0px 20px #aaa; border: solid thin #ddd;">
		<!-- WHITE PANEL - TOP USER -->
		<div class="white-panel pn">
			<div class="white-header" style="color:grey;">
				<h5>MY ACCOUNT</h5>
			</div>
			<p><img src="<?= ASSETS . THEME ?>admin/img/ui-zac.jpg" class="img-circle" width="80"></p>
			<p><b><?=$profile_data->name?></b></p>
			<div class="row">
				<div class="col-md-6">
					<p id="user_text" class="small mt">MEMBER SINCE</p>
					<p><?=date("jS M Y",strtotime($profile_data->date))?></p>
				</div>
				<div class="col-md-6">
					<p id="user_text" class="small mt">TOTAL SPEND</p>
					<p>$ 47,60</p>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-6">
					<p id="user_text" class="small mt" style="cursor:pointer; color: #039f06;"><i class="fa fa-edit"></i> EDIT</p>
				</div>
				<div class="col-md-6">
					<p id="user_text" class="small mt" style="cursor:pointer; color: #dd110a;">DELETE</p>
				</div>
			</div>
		</div>
	</div><!-- /col-md-4 -->
	
	<!-- End profile data -->
	<div style="flex: 3;" class="table-responsive cart_info"> 
		<?php if(is_array($orders)): ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Order no</th>
					<th>Order date</th>
					<th>Total</th>
					<th>Delivery Address</th>
					<th>City/State</th>
					<th>Mobile Phone</th>
					<th>...</th>
				</tr>
			</thead>
			<tbody onclick="show_detail(event)">
				<?php foreach ($orders as $order): ?>
					<tr style="position: relative;">
						<td><?=$order->id?></td>
						<td><?=date("jS M Y H:i a", strtotime($order->date))?></td>
						<td>$<?=$order->total?></td>
						<td><?=$order->delivery_address?></td>
						<td><?=$order->state?></td>
						<td><?=$order->mobile_phone?></td>
						<td>
							<i class="fa fa-arrow-down" style="cursor: pointer;"></i>
							<div class="js-order-details details hide">
								<a style="float: right;cursor: pointer;">Close</a>
									<h3>Order #<?=$order->id?></h3>
									<table class="table">
										<thead>
											<tr>
												<th>Qty</th>
												<th>Description</th>
												<th>Amount</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<?php if(isset($order->details) && is_array($order->details)): ?>
											<?php foreach ($order->details as $detail): ?>
												<tr>
													<td><?=$detail->qty?></td>
													<td><?=$detail->description?></td>
													<td>$<?=$detail->amount?></td>
													<td>$<?=$detail->total?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
											<?php else: ?>	
												<div>No order details were found</div>
											<?php endif; ?>		
									</table>
									<h3 class="pull-right">Grand Total: $<?=$order->grand_total?></h3>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php else: ?>		
			<h3 style="text-align: center;">This user has no orders yet</h3>
		<?php endif; ?>		
	</div>
</div>
<?php else: ?>
	<h1 style="text-align: center;">Sorry! that profile can not be found</h1>
<?php endif;?>
</div>

<script type="text/javascript">
	
	function show_detail(e){
		var row = e.target.parentNode;

		if (row.tagName != "TR")
			row = e.target.parentNode;

		var details = row.querySelector(".js-order-details");

		//get all rows
		var all = e.currentTarget.querySelectorAll(".js-order-details");
		for (var i = 0; i < all.length; i++) {
			if(all[i] != details){
				all[i].classList.add("hide");
			}
		}
		if(details.classList.contains("hide")){
			details.classList.remove("hide");
		}else{
			details.classList.add("hide");
		}
		
	}
</script>

<?php $this->view("footer", $data); ?>