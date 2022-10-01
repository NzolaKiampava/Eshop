<?php

Class Admin extends Controller
{

	public function index()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$data['page_title'] = "Admin";
		$data['current_page'] = "dashboard";
		$this->view("admin/index", $data);
	}

	public function categories()
	{
		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

	    $DB = Database::newInstance();
	    //paginatin formula
		$limit = 10;
		$offset = Page::get_offset($limit);

	    $categories_all = $DB->read("select * from categories order by id desc limit $limit offset $offset");
	    $categories = $DB->read("select * from categories where disabled = 0 order by id desc");
	    

	    $category = $this->load_model('Category');
	    $tbl_rows = $category->make_table($categories_all);
	    $data['tbl_rows'] = $tbl_rows;
	    $data['categories'] = $categories;

		$data['page_title'] = "Admin - Categories";
		$data['current_page'] = "categories";
		$this->view("admin/categories", $data);
	}

	public function products()
	{
		$search = false;

		if(isset($_GET['search']))
		{
			//show($_GET);
			$search = true;
		}

		$User = $this->load_model('User');
		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

	    $DB = Database::newInstance();
	    //paginatin formula
		$limit = 10;
		$offset = Page::get_offset($limit);

		if ($search) {

			//Generate a search query
			$query = Search::make_query($_GET,$limit,$offset);
			$products = $DB->read($query);

		} else {
			$products = $DB->read("SELECT prod.*, brands.brand as brand_name, cat.category as category_name FROM products as prod left join brands on brands.id = prod.brand join categories as cat on cat.id = prod.category order by prod.id desc limit $limit offset $offset");
		}

	    //$products = $DB->read("select * from products order by id desc limit $limit offset $offset");

	    $categories = $DB->read("select * from categories where disabled = 0 order by views desc");
	    $brands = $DB->read("select * from brands where disabled = 0 order by id desc");

	    //show($categories);
	    $product = $this->load_model('Product');
	    $category = $this->load_model('Category');

	    $tbl_rows = $product->make_table($products,$category);
	    $data['tbl_rows'] = $tbl_rows;
	    $data['categories'] = $categories;
	    $data['brands'] = $brands;

		$data['page_title'] = "Admin - Products";
		$data['current_page'] = "products";
		$this->view("admin/products", $data);
	}

	public function orders()
	{
		$User = $this->load_model('User');
		$Order = $this->load_model('Order');
		$user_data = $User->check_login(true, ["admin"]);

		$orders = $Order->get_all_oders();

		if (is_array($orders)) {
			foreach ($orders as $key => $row) {
				// code...
				$details = $Order->get_order_details($row->id);
				$orders[$key]->grand_total = 0;
				if(is_array($details))
				{
					$totals = array_column($details, "total"); //get all item with specific total value
					$grand_total = array_sum($totals);  //sum the totals
					$orders[$key]->grand_total = $grand_total;

				}
				
				$orders[$key]->details = $details;
				$orders[$key]->user = $User->get_user($row->user_url);
				$orders[$key]->grand_total = $grand_total;
			}
		}

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		$data['page_title'] = "Admin - Orders";
		$data['orders'] = $orders;
		$data['current_page'] = "orders";
		$this->view("admin/Orders", $data);
	}

	public function users($type = "customers")
	{
		$User = $this->load_model('User');
		$Order = $this->load_model('Order');

		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		if($type == "admins")
		{
			$users = $User->get_admins();
		}else{
			$users = $User->get_customers();
		}

		if(is_array($users)){
			foreach ($users as $key => $row) {
				// code...
				$orders_num = $Order->get_orders_count($row->url_address);
				$users[$key]->orders_count = $orders_num;
			}
		}

		$data['users'] = $users;
		$data['page_title'] = "Admin - $type";
		$data['current_page'] = "users";
		$this->view("admin/users", $data);

	}

	public function settings($type = '')
	{
		$User = $this->load_model('User');
		$Settings = new Settings();

		$user_data = $User->check_login(true, ["admin"]);
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		//select the right page
		if($type == 'socials'){

			if(count($_POST) > 0)
			{
				$error = $Settings->save_settings($_POST);
				header("Location: " . ROOT . "admin/settings/socials");
				die;
			}

		}else
		if($type == "slider_images"){

			$data['action'] = "show";				
			$Slider = $this->load_model('Slider');
			$mode = "";
			
			//read all slider image
			$data['rows'] = $Slider->get_all();

			if(isset($_GET['action']) && $_GET['action'] == "add"){
				$data['action'] = "add";

				//if new row was posted

				if(count($_POST) > 0)
				{
					//show($_POST);
					//show($_FILES);
					$Image = $this->load_model('Image');
					$data['errors'] = $Slider->create($_POST, $_FILES, $Image);
					//show($data['errors']);
					$data['POST'] = $_POST;
					header("Location: " . ROOT . "admin/settings/slider_images");
					die;
				}

			} 
				if(isset($_GET['edit'])){
					$mode = "edit";
			}else
				if(isset($_GET['delete'])){
					$mode = "delete";
			} else
				if(isset($_GET['delete_confirmed'])){
				$mode = "delete_confirmed";
				$id = $_GET['delete_confirmed'];
				$post_class->delete($id);
			} else
				if ($mode == "edit") {
				$id = $_GET['edit'];
				$slider = $Slider->get_one($id);
				$data['POST'] = (array)$slider;
				
			}
				/*if(isset($_GET['action']) && $_GET['action'] == "edit"){
					$data['action'] = "edit";
					$data['id'] = null;
					if(isset($_GET['id'])){
						$data['id'] = $_GET['id'];
					}

				}else
				if(isset($_GET['action']) && $_GET['action'] == "delete"){

				}
				else
				if(isset($_GET['action']) && $_GET['action'] == "delete_comfirmed"){

				}*/
			
		}

		$data['mode'] = $mode;
		$data['settings'] = $Settings->get_all_settings();
		$data['type'] = $type;
		$data['page_title'] = "Admin - $type";
		$data['current_page'] = "settings";
		$this->view("admin/settings", $data);
	}

	public function messages($type = '')
	{
		$type = "Messages";
		$mode = "read";

		$User = $this->load_model('User');
		$Message = $this->load_model('Message');

		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		
		if(isset($_GET['delete']))
		{
			$mode = "delete";
		} 

		if(isset($_GET['delete_confirmed']))
		{
			$mode = "delete_confirmed";
			$id = $_GET['delete_confirmed'];
			$Message->delete($id);
		}
		

		if ($mode == "delete") {
			$id = $_GET['delete'];
			$messages = $Message->get_one($id);
		}else{
			$messages = $Message->get_all();
		}
		
		$data['mode'] = $mode;
		$data['messages'] = $messages;
		$data['page_title'] = "Admin - $type";
		$data['current_page'] = "messages";
		$this->view("admin/messages", $data);

	}

	public function blogs($type = '')
	{
		$type = "Blog Posts";
		$mode = "read";

		$User = $this->load_model('User');
		$post_class = $this->load_model('post');
		$image_class = $this->load_model('Image');

		$user_data = $User->check_login(true, ["admin"]);

		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}
		
		if(isset($_GET['add_new']))
		{
			$mode = "add_new";

		} 

		if(isset($_GET['edit']))
		{
			$mode = "edit";
		} 

		if(isset($_GET['delete']))
		{
			$mode = "delete";
		} 
		
		if(isset($_GET['delete_confirmed']))
		{
			$mode = "delete_confirmed";
			$id = $_GET['delete_confirmed'];
			$post_class->delete($id);
		}
		
		if ($mode == "edit") {
			$id = $_GET['edit'];
			$blogs = $post_class->get_one($id);
			$data['POST'] = (array)$blogs;
			
		}
		else
			if ($mode == "delete") {
			$id = $_GET['delete'];
			$blogs = $post_class->get_one($id);
			$image_class = $this->load_model('Image');

			if(file_exists($blogs->image)){
					$blogs->image = $image_class->get_thumb_post($blogs->image);
				}
				// find the user by his user_url
				$blogs->user_data = $User->get_user($blogs->user_url);
				

			$data['POST'] = (array)$blogs;
		}else{
			$blogs = $post_class->get_all();
			
			if ($blogs) {
				foreach ($blogs as $key => $row) {
					// code...
					if(file_exists($blogs[$key]->image)){
						$blogs[$key]->image = $image_class->get_thumb_post($blogs[$key]->image);
					}
					// find the user by his user_url
					$blogs[$key]->user_data = $User->get_user($blogs[$key]->user_url);
				}
			}
		}

		//if something was posted
		if(count($_POST) > 0)
		{
			$post = $this->load_model('post');
			if ($mode == "edit"){
				$post_class->edit($_POST,$_FILES,$image_class);
			}
			else{
				$post_class->create($_POST,$_FILES,$image_class);
			}

			if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
				$data['errors'] = $_SESSION['error'];
				$data['POST'] = $_POST;
			}else{
				redirect("admin/blogs");
			}
		}		
		
		$data['mode'] = $mode;
		$data['blogs'] = $blogs;
		$data['page_title'] = "Admin - $type";
		$data['current_page'] = "blogs";
		$this->view("admin/blogs", $data);

	}

}
