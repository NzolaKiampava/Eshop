<?php

Class Shop extends Controller
{

	public function index()
	{

		//paginatin formula
		$limit = 4;
		$page_number = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
		$page_number = $page_number < 1 ? 1 : $page_number;
		$offset = ($page_number - 1) * $limit;

		//check if is a search
		$search = false;
		if(isset($_GET['find']))
		{
			$find = addslashes($_GET['find']);
			$search = true;
		}

		$User = $this->load_model('User');
		$image_class = $this->load_model('Image');
		$user_data = $User->check_login();
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$DB = Database::newInstance();
		
		if($search){
			$arr['description'] = "%". $find . "%";
			$ROWS = $DB->read("select * from products where description like :description limit $limit offset $offset", $arr);
		}else{
			$ROWS = $DB->read("select * from products limit $limit offset $offset");
		}

		$data['page_title'] = "Shop";

		if ($ROWS) {
			foreach ($ROWS as $key => $row) {
				// code...
				$ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
			}
		}
		
		//get all categories
		$category = $this->load_model('category');
		$data['categories'] = $category->get_all();

		$data['page_links'] = $this->get_pagination();
		$data['ROWS'] = $ROWS;
		$data['show_search'] = true;
		$this->view("shop", $data);
	}

	public function category($cat_find = '')
	{
		//paginatin formula
		$limit = 4;
		$page_number = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
		$page_number = $page_number < 1 ? 1 : $page_number;
		$offset = ($page_number - 1) * $limit;

		$User = $this->load_model('User');
		$category = $this->load_model('Category');
		$image_class = $this->load_model('Image');
		$user_data = $User->check_login();
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$DB = Database::newInstance();
		$cat_id = null;

		$check = $category->get_one_by_name($cat_find);

		if (is_object($check)) {
			$cat_id = $check->id;
		}
		
		$ROWS = $DB->read("select * from products where category = :cat_id limit $limit offset $offset", ["cat_id"=>$cat_id]);


		$data['page_title'] = "Shop";

		if ($ROWS) {
			foreach ($ROWS as $key => $row) {
				// code...
				$ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
			}
		}
		
		//get all categories
		$data['categories'] = $category->get_all();

		$data['ROWS'] = $ROWS;
		$data['show_search'] = true;
		$this->view("shop", $data);
	}

	private function get_pagination()
	{
		$links = (object)[];                 //converting links to object
		$links->prev = "";                   //previous link
		$links->next = "";					 //next link
		$query_string = str_replace("url=", "", $_SERVER['QUERY_STRING']);

		$page_number = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
		$page_number = $page_number < 1 ? 1 : $page_number;

		$next_page = $page_number + 1;
		$prev_page = ($page_number > 1) ? ($page_number - 1) : 1;

		$current_link = ROOT . $query_string;
		if(!strstr($query_string, "pg=")){    //if pg not contain on $query string
			$current_link .= "&pg=1";
		}

		$links->prev = preg_replace("/pg=[^&?=]+/", "pg=" . $prev_page, $current_link);
		$links->next = preg_replace("/pg=[^&?=]+/", "pg=" . $next_page, $current_link);
		$links->current = $page_number;

		return $links;
	}

}
