<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

<style type="text/css">
	.details{
		background-color: #eee;
		box-shadow: 0px 0px 10px #aaa;
		width: 100%;
		position: absolute;
		min-height: 100px;
		left: 0px;
		padding: 10px;
		z-index: 10;
	}	
</style>

<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel table-responsive" style="padding: 10px;">
			<table class="table table-striped table-advance table-hover">

				<?php if($mode == "read"):?>
				<thead>
					<tr>
						<th>Order id</th>
						<th>Customer</th>
						<th>Order date</th>
						<th>Total</th>
						<th>Delivery Address</th>
						<th>City/State</th>
						<th>Mobile Phone</th>
						<th>...</th>
					</tr>
				</thead>

				<tbody onclick="show_detail(event)">
				<?php if (isset($orders) && is_array($orders)): ?>
					<?php foreach ($orders as $order): ?>
						<form method="POST">
						<tr style="position: relative;">
							<td><input autofocus="true" type="checkbox" name="<?=$order->id?>" value="<?=$order->id?>">&nbsp;&nbsp;&nbsp;<?=$order->id?></td>
							<td><a href="<?=ROOT?>profile/<?=$order->user->url_address?>"> <img class="img-circle" src="<?= ($order->user->image != "") ? ROOT.$order->user->image : ROOT.'uploads/user.png'?>" width="25px" height="25px" align=""> <?=$order->user->name?></a></td>
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
									<h3>Customer: <?=$order->user->name?></h3>

									<!-- Order datails-->
									<table class="table table-striped table-advance table-hover">
										<thead>
											<tr>
												<th>Country</th>
												<th>State</th>
												<th>Delivery Address</th>
												<th>Home Phone</th>
												<th>Mobile Phone</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?=$order->country?></td>
												<td><?=$order->state?></td>
												<td><?=$order->delivery_address?></td>
												<td><?=$order->home_phone?></td>
												<td><?=$order->mobile_phone?></td>
												<td><?=$order->date?></td>
											</tr>
										</tbody>
									</table>
									<br>
									<h3>Order Summary</h3>
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
							<td><a href="<?=ROOT?>admin/orders?delete=<?=$order->id?>"><button class="btn btn-danger" title="delete"><i class="fa fa-trash-o"></button></i></a></td>
						</tr>

						
					<?php endforeach; ?>
				<?php endif; ?>
				<tr><td colspan="8"><?php Page::show_links()?></td></tr>
				<tr><td><button class="btn btn-danger" title="delete all orders selected"><i class="fa fa-trash-o"></button></i></a></td></tr>
				</form>
				</tbody>
				<?php elseif($mode == "delete_confirmed"): ?>
					delete confirmed
				<?php elseif($mode == "delete" && is_array($orders)): ?>
					<tr>
						<th>Order no</th>
						<th>Customer</th>
						<th>Order date</th>
						<th>Total</th>
						<th>Delivery Address</th>
						<th>City/State</th>
						<th>Mobile Phone</th>
						<th>...</th>
					</tr>

					<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Are you sure you want to delete this order?</strong></div>
					
					<tbody>
						<tr>
							<td><?=$orders[0]->id?></td>
							<td><a href="<?=ROOT?>profile/<?=$order->user->url_address?>"><?=$orders[0]->user->name?></a></td>
							<td><?=date("jS M Y H:i a", strtotime($orders[0]->date))?></td>
							<td>$<?=$orders[0]->total?></td>
							<td><?=$orders[0]->delivery_address?></td>
							<td><?=$orders[0]->state?></td>
							<td><?=$orders[0]->mobile_phone?></td>
							<td><a href="<?=ROOT?>admin/orders?delete_confirmed=<?=$orders[0]->id?>"><button class="btn btn-danger" title="delete"><i class="fa fa-trash-o"></button></i></a></td>
						</tr>
					</tbody>
				<?php endif;?>
			</table>
		</div>
	</div>
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

<?php $this->view("admin/footer", $data); ?>
