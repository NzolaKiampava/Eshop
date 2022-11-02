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

			<?php if(is_array($ROWS)):?>
			
			<div class="register-req">
				<p>Fields with * are required</p>
			</div><!--/register-req-->

			<?php 

				$address1 = "";
				$address2 = "";
				$postal_code = "";
				$country = "";
				$state = "";
				$home_phone = "";
				$mobile_phone = "";
				$message = "";

				if(isset($POST_DATA)){
					extract($POST_DATA); //get all individual items inside of $POST_DATA, and create variable with it
				}
			?>
			<div class="shopper-informations">
				<form method="POST">
					<div class="row">
						<div class="col-sm-8 clearfix">
							<div class="bill-to">
								<p>Bill To</p>
								<div class="form-one">
									
									<input class="form-control" name="address1" value="<?=$address1?>" type="text" placeholder="Address 1 *" autofocus required><br>
									<input class="form-control" name="address2" value="<?=$address2?>" type="text" placeholder="Address 2"><br>
									<input class="form-control" name="postal_code" value="<?=$postal_code?>" type="text" placeholder="Zip / Postal Code *" required><br>
									
								</div>
								<div class="form-two">
									
									<select name="country" class="js-country" oninput="get_states(this.value)" required>
										<?php if($country == ""){
											echo "<option>-- Country --</option>";
										}else{
											echo "<option>$country</option>";
										}?>
										
										<?php if(isset($countries) && $countries):?>
											<?php foreach ($countries as $row):?>
												<option value="<?=$row->country?>"><?=$row->country?></option>
											<?php endforeach;?>
										<?php endif;?>
									</select><br><br>
									<select name="state" value="<?=$state?>" class="js-state" required>
										<?php if($state == ""){
											echo "<option>-- State / Province / Region --</option>";
										}else{
											echo "<option>$state</option>";
										}?>
										
									</select><br><br>
									<input class="form-control" name="home_phone" value="<?=$home_phone?>" type="number" min="100000000" max="999999999" placeholder="Home Phone" ><br>
									<input class="form-control" name="mobile_phone" value="<?=$mobile_phone?>" type="number" min="100000000" max="999999999" placeholder="Mobile Phone *" required>
									
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="order-message">
								<p>Shipping Order</p>
								<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"><?=$message?></textarea>
							</div>	
						</div>					
					</div>
					<input type="submit" class="btn btn-warning pull-right" value="Submit >" name="">
					<a href="<?=ROOT?>checkout">
						<input type="button" class="btn btn-warning pull-left" value="< Back to Checkout" name="">
					</a>
				</form>
			</div>
			<br><br>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							
						</tr>
					</thead>
					<tbody>
						<?php if($ROWS):?>
						<?php foreach($ROWS as $row):?>
						<tr>
							<td class="cart_product">
								<img src="<?=ROOT?><?=$row->image?>" style="width: 110px;height: 110px;" alt="">
							</td>
							<td class="cart_description">
								<h4><a href=""><?=$row->description?></a></h4>
								<p>Prod ID: <?=$row->id?></p>
							</td>
							<td class="cart_price">
								<p>$<?=$row->price?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="text" name="quantity" value="<?=$row->cart_qty?>" autocomplete="off" size="2" readonly>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$<?=$row->price * $row->cart_qty?></p>
							</td>
							
						</tr>
						
						<?php endforeach;?>
						<?php endif;?>
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>$<?=number_format($sub_total,2)?></td>
									</tr>
									
									<tr>
										<td>Total</td>
										<td><span>$<?=number_format($sub_total,2)?></span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
			</div>

			<?php else:?>

				<div style="margin-top: -30rem;">
					<center><img width="500" src="<?=ASSETS . THEME?>select-message.png"></center>
					<h3 style="text-align: center; margin-top:-10rem;"><div class="alert alert-warning alert-dismissable">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						  <strong>Warning!</strong> Please add some items in the cart first!
						</div></h3>
				</div>
				<a href="<?=ROOT?>cart">
						<input type="button" class="btn btn-warning pull-left" value="< Back to cart" name="">
				</a><br><br><br>
			<?php endif;?>
		</div>
	</section> <!--/#cart_items-->

<script type="text/javascript">
	
	function get_states(country){

		send_data({
			id:country.trim()
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

		var info = {};
		info.data_type = data_type;
		info.data = data;
		ajax.open("POST","<?=ROOT?>ajax_checkout");
		ajax.send(JSON.stringify(info),true);
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
