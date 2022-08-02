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
		z-index: 2;
	}	
</style>

<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel table-responsive">
			<table class="table table-striped table-advance table-hover">
				<thead>
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
				</thead>
				<tbody onclick="show_detail(event)">
				<?php if (is_array($orders)): ?>
					<?php foreach ($orders as $order): ?>
						<tr style="position: relative;">
							<td><?=$order->id?></td>
							<td><a href="<?=ROOT?>profile/<?=$order->user->url_address?>"><?=$order->user->name?></a></td>
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
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
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