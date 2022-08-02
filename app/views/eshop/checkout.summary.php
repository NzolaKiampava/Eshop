<?php $this->view("header", $data); ?>

<?php
	if (isset($errors) && count($errors) > 0) {
		echo "<div>";
		foreach($errors as $error){
			echo "<div class='alert alert-danger' style='padding:5px;max-width:500px; margin:auto;text-align:center;'>$error</div>";
		}
		echo "</div>";
	}
?>

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="<?=ROOT?>home">Home</a></li>
			  <li class="active">Check out</li>
			</ol>
		</div><!--/breadcrums-->
		
		<div class="register-req">
			<p>Please confirm the information below</p>
		</div><!--/register-req-->

			
		<div class="content-panel table-responsive">
			<?php if (is_array($orders)): ?>
				<?php foreach ($orders as $order): ?>
					<?php $order = (object)$order; 
							$order->id = 0;
					?>
							<div class="js-order-details details">
								<!-- Order datails-->
								<table class="table table-striped table-advance table-hover">
									<thead>
										<tr>
											<th>Country</th>
											<th>State</th>
											<th>Delivery Address 1</th>
											<th>Delivery Address 2</th>
											<th>Zip/Postal_Code</th>
											<th>Home Phone</th>
											<th>Mobile Phone</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?=$order->country?></td>
											<td><?=$order->state?></td>
											<td><?=$order->address1?></td>
											<td><?=$order->address2?></td>
											<td><?=$order->postal_code?></td>
											<td><?=$order->home_phone?></td>
											<td><?=$order->mobile_phone?></td>
											<td><?=date('Y-m-d')?></td>
										</tr>
									</tbody>
								</table>
								<table style="width: 100%;background-color: #eee;"><tr style="text-align: center; padding: 1em;"><td><?=$order->message?></tr></td></table>
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
										<?php if(isset($order_details) && is_array($order_details)): ?>
										<?php foreach ($order_details as $detail): ?>
											<tr>
												<td><?=$detail->cart_qty?></td>
												<td><?=$detail->description?></td>
												<td>$<?=$detail->price?></td>
												<td>$<?=($detail->cart_qty * $detail->price)?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								<?php else: ?>	
									<div style="text-align: center;">No order details were found</div>
								<?php endif; ?>		
							</table>
							<h3 class="pull-right">Grand Total: $<?=$sub_total?></h3>
							</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<hr style="clear: both;">
			
		<a href="<?=ROOT?>checkout">
				<input type="button" class="btn btn-warning pull-left" value="< Back to Checkout" name="">
		</a>
		<form method="POST">	
			<input type="submit" class="btn btn-warning pull-right" value="Pay >" name="">
		</form>
			
	</div>
</section> <!--/#cart_items-->

<script type="text/javascript">
	
	function get_states(id){

		send_data({
			id:id.trim()
		}, "get_states");

	}
	function send_data(data = {}, data_type)
	{
		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(){

			if(ajax.readyState == 4 && ajax.status == 200)
			{
			  handle_result(ajax.responseText);
			}
		});

		ajax.open("POST","<?=ROOT?>ajax_checkout/"+data_type+"/"+JSON.stringify(data),true);
		ajax.send();
	}
	function handle_result(result)
	{   
		console.log(result);
		//alert(result);
		if(result != "")
		{
			var obj = JSON.parse(result);                           //converting to object

			//verifying if message_type exists
			if(typeof obj.data_type != 'undefined')
			{
				if(obj.data_type == "get_states")
				{
					var select_input = document.querySelector(".js-state");
					select_input.innerHTML = "<option>-- State / Province / Region --</option>";
					for (var i = 0; i < obj.data.length; i++) {

						select_input.innerHTML += "<option value='"+obj.data[i].state+"'>"+obj.data[i].state+"</option>";
					}
				}
			}
		}
	}

</script>

<?php $this->view("footer", $data); ?>