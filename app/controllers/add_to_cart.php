<?php

Class Add_to_cart extends Controller
{
	private $redirect_to = "";

	public function index($id = '')
	{
		$this->set_redirect();

		$id = esc($id);  //calling the function esc to get value $id
	
		$DB = Database::newInstance();
		$ROWS = $DB->read("select * from products where id = :id limit 1",['id'=>$id]);

		if ($ROWS) {

			$ROW = $ROWS[0];
			if (isset($_SESSION['CART'])) {  //verifying if cart exist
				
				$ids = array_column($_SESSION['CART'], "id"); //taking the id column_key values in CART
				if(in_array($ROW->id, $ids)){  
					$key = array_search($ROW->id, $ids); // searching for the key 
					$_SESSION['CART'][$key]['qty']++;
				}else{
					$arr = array();
					$arr['id'] = $ROW->id;
					$arr['qty'] = 1;

					$_SESSION['CART'][] = $arr;              //$_SESSION['CART'][] is an array
				}
			}else{
				$arr = array();
				$arr['id'] = $ROW->id;
				$arr['qty'] = 1;

				$_SESSION['CART'][] = $arr; //seting an array
			}
		}
		//show($_SESSION);
		
		header("Location: ". ROOT . "cart");   //it's suppose to remove and uncomment $this->redirect()
		die;
		//$this->redirect();
	}
	public function add_quantity($id = '') 
	{
		$this->set_redirect();

		$id = esc($id);
		$DB = Database::newInstance();
		//$pro = $DB->read("select quantity from products where id = '$id'");
		//show($pro[0]->quantity);
		if (isset($_SESSION['CART'])) {
			foreach ($_SESSION['CART'] as $key => $item) {
				// code...
				if ($item['id'] == $id) {
					// code...
					$_SESSION['CART'][$key]['qty'] += 1;
					
					/*  Testing for simulation of decrease products
						$num = $_SESSION['CART'][$key]['qty'];
						$qty = $DB->read("select quantity from products where id = '$id'");
						$qty = $qty[0]->quantity - $num;
						if($qty < 0){
							$qty = 0;
						}
						//show($qty);
						$DB->read("update products set quantity = '$qty' where id = '$id'");
					*/

					break;
				}
			}
		}
		$this->redirect();
	}
	public function subtract_quantity($id = '')
	{
		$this->set_redirect();

		$id = esc($id);
		if (isset($_SESSION['CART'])) {
			foreach ($_SESSION['CART'] as $key => $item) {
				// code...
				if ($item['id'] == $id) {
					// code...
					if($_SESSION['CART'][$key]['qty'] > 1)
					{
						$_SESSION['CART'][$key]['qty'] -= 1;
						break;
					}
				}
			}
		}
		$this->redirect();
	}
	public function remove($id = '')
	{
		$this->set_redirect();

		$id = esc($id);
		if (isset($_SESSION['CART'])) {
			foreach ($_SESSION['CART'] as $key => $item) {
				// code...
				if ($item['id'] == $id) {
					// code...
					unset($_SESSION['CART'][$key]);
					$_SESSION['CART'] = array_values($_SESSION['CART']);
					//show($_SESSION['CART']);
					break;
				}
			}
		}
		$this->redirect();
	}
	private function redirect()
	{
		header("Location: ". $this->redirect_to);
		die;
	}
	private function set_redirect()
	{
		//[HTTP_REFERER] => http://localhost/eshop/public/cart
		if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ""){
			$this->redirect_to = $_SERVER['HTTP_REFERER'];
		}else{
			$this->redirect_to = ROOT . "shop";
		}
		//show($_SERVER);
	}


}
