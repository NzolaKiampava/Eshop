<?php

Class Checkout extends Controller
{

	public function index()
	{
		$User = $this->load_model('User');
		$image_class = $this->load_model('Image');
		$user_data = $User->check_login();
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$DB = Database::newInstance();

		$ROWS = false;
		$prod_ids = array();
		if (isset($_SESSION['CART'])) {
			$prod_ids = array_column($_SESSION['CART'], 'id'); //getting the all id of each array
			$id_str = "'" . implode("','", $prod_ids) . "'";  //converting the array to string, ex.:'8','9','10'
			$ROWS = $DB->read("select * from products where id in ($id_str) order by id desc");
		}

		//show($ROWS);
		//show($prod_ids);
		//show($_SESSION['CART']);

		if (is_array($ROWS)) {
			
			foreach ($ROWS as $key => $row) {
				
				foreach ($_SESSION['CART'] as $item) {
					// code...
					if($row->id == $item['id']){
						$ROWS[$key]->cart_qty = $item['qty'];  //creating cart_qty key to get qty
						break;  //moveout this loop to up loop, and do always the same process
					}
				}
			}
		}
		//show($ROWS);
		//show($_SESSION['CART']);

		$data['page_title'] = "Checkout";
		$data['sub_total'] = 0;

		if ($ROWS) {
			foreach ($ROWS as $key => $row) {
				// code...
				$ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
				$mytotal = $row->price * $row->cart_qty;

				$data['sub_total'] += $mytotal;
			}
		}
		
		/* sorting the data
		if(is_array($ROWS)){
			rsort($ROWS);  
		}
		*/

		$data['ROWS'] = $ROWS;

		//get countries
		$countries = $this->load_model('Countries');
		$data['countries'] = $countries->get_countries();

		//Check if old post data exists
		if (isset($_SESSION['POST_DATA'])) {
			$data['POST_DATA'] = $_SESSION['POST_DATA'];
		}

		if(count($_POST) > 0){

			$order = $this->load_model('Order');
			$order->validate($_POST);
			$data['errors'] = $order->errors;

			$_SESSION['POST_DATA'] = $_POST;
			$data['POST_DATA'] = $_POST;

			if(count($order->errors) == 0){
				header("Location:".ROOT."checkout/summary");
				die;
			}
		}

		$this->view("Checkout", $data);
	}

	public function summary(){

		$User = $this->load_model('User');
		$image_class = $this->load_model('Image');
		$user_data = $User->check_login();
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}


		//get data
		$DB = Database::newInstance();

		$ROWS = false;
		$prod_ids = array();
		if (isset($_SESSION['CART'])) {
			$prod_ids = array_column($_SESSION['CART'], 'id'); //getting the all id of each array
			$id_str = "'" . implode("','", $prod_ids) . "'";  //converting the array to string, ex.:'8','9','10'
			$ROWS = $DB->read("select * from products where id in ($id_str) order by id desc");
		}

		if (is_array($ROWS)) {
			
			foreach ($ROWS as $key => $row) {
				
				foreach ($_SESSION['CART'] as $item) {
					// code...
					if($row->id == $item['id']){
						$ROWS[$key]->cart_qty = $item['qty'];  //creating cart_qty key to get qty
						break;  //moveout this loop to up loop, and do always the same process
					}
				}
			}
		}

		$data['sub_total'] = 0;
		if ($ROWS) {
			foreach ($ROWS as $key => $row) {
				// code...
				$mytotal = $row->price * $row->cart_qty;

				$data['sub_total'] += $mytotal;
			}
		}
		
		/* sorting the data
		if(is_array($ROWS)){
			rsort($ROWS);  
		}
		*/

		$data['order_details'] = $ROWS;
		$data['orders'][] = $_SESSION['POST_DATA'];
		
		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['POST_DATA'])){

			$sessionid = session_id();
			$user_url = "";
			if(isset($_SESSION['user_url'])){
				$user_url = $_SESSION['user_url'];
			}
			$order = $this->load_model('Order');
			$order->save_order($_SESSION['POST_DATA'],$ROWS,$user_url,$sessionid);
			$data['errors'] = $order->errors;

			unset($_SESSION['POST_DATA']);
			unset($_SESSION['CART']);

			header("Location:".ROOT."checkout/thank_you");
			die;
		}

		$data['page_title'] = "Checkout summary";

		$this->view("checkout.summary", $data);
	}

	public function thank_you()
	{
		$data['page_title'] = "Thank you";
		$this->view("checkout.thank_you", $data);

	}


}