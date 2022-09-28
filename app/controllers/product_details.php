<?php

Class Product_details extends Controller
{

	public function index($slag)
	{
		$slag = esc($slag);

		$User = $this->load_model('User');
		$user_data = $User->check_login();
		if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

		$DB = Database::newInstance();
		$ROW = $DB->read("SELECT products.*, brands.brand as brand_name FROM products left join brands on brands.id = products.brand where slag = :slag",['slag'=>$slag]);

		if(is_array($ROW))
		{
			$catid = $ROW[0]->category;
			$cat = $DB->read("select * from categories where id = :catid", ['catid'=>$catid]);
			$data['cat'] = $cat[0];
		}

		//get all categories
		$category = $this->load_model('category');
		$data['categories'] = $category->get_all();

		$image_class = $this->load_model('Image');

		//get products for lower segment
		$data['segment_data'] = $this->get_segment_data($DB,$data['categories'],$image_class); 

		$data['page_title'] = "Product Details";
		
		$data['ROW'] = is_array($ROW) ? $ROW[0] : false;
		$this->view("product_details", $data);
	}

	//get segment data
	private function get_segment_data($DB,$categories,$image_class)
	{
		$mycats = array();
		$results = array();
		$num = 0;

		foreach ($categories as $cat) {
			// code...
			$mycats[] = $cat;
		
			$arr['id'] = $cat->id;
			$ROWS = $DB->read("select * from products where category = :id order by rand() limit 4", $arr);

			if (is_array($ROWS)) {

				$cat->category = str_replace(" ", "_", $cat->category);
				$cat->category = preg_replace("/\W+/", "", $cat->category);  //replace anything that isn't a word from category name to ""   (\w => anything that isnt a word, + => more than one item)

				//crop images
				foreach ($ROWS as $key => $row) {
					// code...
					$ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
				}
				
				$results[$cat->category] = $ROWS; //ROWS return array of object, we'll add on result $cat->category, many ROWS ($results[$cat->name])

				$num++;
				if($num > 5)
				{
					break;   //stop the foreach loop
				}
			}	
		}
		return $results;
	}
	
}
