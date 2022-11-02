<?php $this->view("header", $data); ?>
<div style="text-align: center;">
	
	<center><img width="200" src="<?=ASSETS . THEME?>nearby-business.png"></center>
	
	<h1>Thank you for Shopping with us!</h1>
	<h4 style="color: green;">Your order was sucessful</h4>
	<br><br>

	<div>What would you like to do next?</div><br>
	<a href="<?=ROOT?>shop">
		<input type="button" class="btn btn-warning" value="Continue Shopping">
	</a>

	<a href="<?=ROOT?>profile">
	<input type="button" class="btn btn-warning" value="View your orders">
	</a><br><br>
</div>
<?php $this->view("footer", $data); ?>
