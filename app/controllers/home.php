<?php

Class Home extends Controller
{
		
	public function index()
	{
		$search = false;
		//check if is a search
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

		//read for main post
		if($search){
			$arr['description'] = "%". $find . "%";
			$ROWS = $DB->read("select * from products where description like :description", $arr);
		}else{
			$ROWS = $DB->read("select * from products");
		}
		if ($ROWS) {
			foreach ($ROWS as $key => $row) {
				// code...
				$ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
			}
		}
		$data['ROWS'] = $ROWS;

	
		//corousel post page 
		$carousel_page_count = 3;
		for ($i=0; $i < $carousel_page_count; $i++) { 
			
			$Slider_ROWS[$i] = $DB->read("select * from products where rand() limit 3");
			if ($Slider_ROWS[$i]) {
				foreach ($Slider_ROWS[$i] as $key => $row) {
					// code...
					$Slider_ROWS[$i][$key]->image = $image_class->get_thumb_post($Slider_ROWS[$i][$key]->image);
				}
			}
			$data['Slider_ROWS'][] = $Slider_ROWS[$i];

		}

		//get all categories
		$category = $this->load_model('category');
		$data['categories'] = $category->get_all();

		//get products for lower segment
		$data['segment_data'] = $this->get_segment_data($DB,$data['categories']); 

		//get all slider  content
		$Slider = $this->load_model('Slider');
		$data['slider'] = $Slider->get_all();

		if ($data['slider']) {
			foreach ($data['slider'] as $key => $row) {
				// code...
				$data['slider'][$key]->image = $image_class->get_thumb_post($data['slider'][$key]->image,484,441);
			}
		}
		
		$data['page_title'] = "Home";
		$data['show_search'] = true;
		$this->view("index", $data);
	}

	//get segment data
	private function get_segment_data($DB,$categories)
	{
		$mycats = array();
		$results = array();
		$num = 0;

		foreach ($categories as $cat) {
			// code...
			$mycats[] = $cat;
		
			$arr['id'] = $cat->id;
			$ROWS = $DB->read("select * from products where category = :id order by rand() limit 5", $arr);

			if (is_array($ROWS)) {

				$cat->category = str_replace(" ", "_", $cat->category);
				$cat->category = preg_replace("/\W+/", "", $cat->category);  //replace anything that isn't a word from category name to ""   (\w => anything that isnt a word, + => more than one item)

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
