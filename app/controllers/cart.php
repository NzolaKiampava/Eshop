<?php

Class Cart extends Controller
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

		$data['page_title'] = "Cart";
		$data['sub_total'] = 0;

		if ($ROWS) {
			foreach ($ROWS as $key => $row) {
				// code...
				$ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
				$mytotal = $row->price * $row->cart_qty;

				$data['sub_total'] += $mytotal;
			}
		}
		//rsort($ROWS);  //sorting the data
		$data['ROWS'] = $ROWS;
		$this->view("cart", $data);
	}


}