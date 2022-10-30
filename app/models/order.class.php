<?php


class Order extends Controller
{
	public $errors = array();

	public function validate($POST)
	{
		$this->errors = array();

		foreach ($POST as $key => $value) {
			// code...
			if($key == "country"){
				if ($value == "" || $value == "-- Country --") {
					// code...
					$this->errors[] = "Please enter a valid Country";
				}
			}

			if($key == "state"){
				if ($value == "" || $value == "-- State / Province / Region --") {
					// code...
					$this->errors[] = "Please enter a valid State";
				}
			}

			if($key == "address1"){
				if (empty($value)) {
					// code...
					$this->errors[] = "Please enter a valid Address 1";
				}
			}
			if($key == "postal_code"){
				if (empty($value)) {
					// code...
					$this->errors[] = "Please enter a valid Postal Code";
				}
			}
			if($key == "mobile_phone"){
				if (empty($value)) {
					// code...
					$this->errors[] = "Please enter a valid Mobile number";
				}
			}
			
		}

	}

	public function save_order($POST,$ROWS,$user_url,$sessionid)
	{
		//show($ROWS);die;

		$total = 0;
		foreach ($ROWS as $key => $row) {
			$total += $row->cart_qty * $row->price;
		}

		$db = Database::newInstance();

		if(is_array($ROWS) && count($this->errors) == 0){
			$countries = $this->load_model('Countries');

			$data = array();
			$data['user_url'] = $user_url;
			$data['sessionid'] = $sessionid;
			$data['delivery_address'] = $POST['address1'] . " / " . $POST['address2'];
			$data['total'] = $total;
			//$country_obj = $countries->get_country($POST['country']);
			$data['country'] = $POST['country'];
			//$state_obj = $countries->get_state($POST['state']);
			$data['state'] = $POST['state'];
			$data['zip'] = $POST['postal_code'];
			$data['tax'] = 0;
			$data['shipping'] = 0;
			$data['date'] = date("Y-m-d H:i:s");
			$data['home_phone'] = $POST['home_phone'];
			$data['mobile_phone'] = $POST['mobile_phone'];


			$query = "insert into orders (user_url,delivery_address,total,country,state,zip,tax,shipping,date,sessionid,home_phone,mobile_phone) values(:user_url,:delivery_address,:total,:country,:state,:zip,:tax,:shipping,:date,:sessionid,:home_phone,:mobile_phone)";

			$result = $db->write($query,$data);

			//save order details
			$orderid = 0;
			$query = "select * from orders order by id desc limit 1";
			$result = $db->read($query);

			if(is_array($result)){
				$orderid = $result[0]->id;
			}

			foreach ($ROWS as $row) {
				// code...
				$data = array();
				$data['orderid'] = $orderid;
				$data['productid'] = $row->id;
				$data['qty'] = $row->cart_qty;
				$data['description'] = $row->description;
				$data['amount'] = $row->price;
				$data['total'] = $row->price * $row->cart_qty;

				$query = "insert into order_details (orderid,productid,qty,description,amount,total) values (:orderid,:productid,:qty,:description,:amount,:total)";
				$result = $db->write($query,$data);
			}
		}
	}

	public function get_oders_by_user($user_url)
	{
		$orders = false;
		$db = Database::newInstance();
		$data['user_url'] = $user_url;

		$query = "select * from orders where user_url = :user_url order by id desc limit 100";
		$orders = $db->read($query,$data);

		return $orders;
	}
	public function get_orders_count($user_url)
	{
		$db = Database::newInstance();
		$data['user_url'] = $user_url;

		$query = "select * from orders where user_url = :user_url";
		$result = $db->read($query,$data);

		$orders = is_array($result) ? count($result) : 0;
		return $orders;
	}


	public function get_all_oders()
	{
		//paginatin formula
		$limit = 10;
		$offset = Page::get_offset($limit);

		$orders = false;
		$db = Database::newInstance();

		$query = "select * from orders order by id desc limit $limit offset $offset";
		$orders = $db->read($query);

		return $orders;
	}


	public function get_order_details($id)
	{
		$details = false;
		$data['id'] = esc($id);
		$db = Database::newInstance();

		$query = "select * from order_details where orderid = :id order by id desc";
		$details = $db->read($query,$data);

		return $details;
	}

	public function get_one($id)
	{
		$id = (int)$id;

		$DB = Database::newInstance();
		$orders = $DB->read("select * from orders where id = '$id' limit 1");
		return $orders;
	}
	
	public function delete($id)
	{
		$DB = Database::newInstance();
		$id = (int)$id;
		$query = "delete from orders where id = '$id' limit 1";
		$DB->write($query);
	}

	public function delete_order_details($orderid)
	{
		$DB = Database::newInstance();
		$id = (int)$id;
		$query = "delete from order_details where orderid = '$orderid' limit 1";
		$DB->write($query);
	}	

	public function delete_array($ids)
	{
		$DB = Database::newInstance();
		$query = "DELETE from orders where id in ('". $ids ."')";
		$DB->write($query);
	}
}
