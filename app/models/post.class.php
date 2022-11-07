<?php 

Class Post
{

	public function create($DATA,$FILES,$image_class = null)
	{

		$_SESSION['error'] = "";

		$DB = Database::newInstance();
		$arr['title']       = ucwords($DATA['title']);
		$arr['post']        = ($DATA['post']);
		$arr['date']        = date("Y-m-d H:i:s");
		$arr['user_url']    = $_SESSION['user_url'];
		$arr['url_address'] = str_to_url($DATA['title']);

		if(!preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['title'])))
		{
			$_SESSION['error'] .= "Please enter a valid title for this post<br/>";
		}	

		if(empty($arr['post']))
		{
			$_SESSION['error'] .= "Please enter some valid post text content<br/>";
		}

		//make sure url_address is unique
		$url_address_arr['url_address'] = $arr['url_address'];
		$query = "select url_address from blogs where url_address = :url_address limit 1";
			$check = $DB->read($query,$url_address_arr);

		if($check)
		{
			$arr['url_address'] .= "-" . rand(0,99999);
		}	

		$arr['image'] = "";

		//$allowed = array();
		//$allowed = ["image/jpeg", "image/png"];
		$allowed[] = "image/jpeg";
		$size = 10;
		$size = ($size * 1024 * 1024)/2;  //the max size is 10MB
		$folder = "uploads/";

		if (!file_exists($folder)) 
		{
			mkdir($folder,0777,true);
		}
		//Check for files
		foreach ($FILES as $key => $img_row) {
			// code...
			if ($img_row['error'] == 0 && in_array($img_row['type'], $allowed)) 
			{
				if ($img_row['size'] < $size) 
				{
					$destination = $folder . $image_class->generate_filename(60) . ".jpg";
					move_uploaded_file($img_row['tmp_name'], $destination);
					$arr[$key] = $destination;
					$image_class->resize_image($destination,$destination,1500,1500);
				}else
				{
					$_SESSION['error'] .= $key . " Is bigger than require size<br>";
				}
				
			}elseif ($img_row['error'] == 0 && !in_array($img_row['type'], $allowed)) {
				
				$_SESSION['error'] .= " This type of image is not allowed, try for jpeg or png. Or convert the image to jpeg clicking in this link: <a href='https://cloudconvert.com/' target='_blank'>https://cloudconvert.com/</a><br/>";
			}
		}

		if($arr['image'] == "")
		{
			$_SESSION['error'] .= "An image is required<br/>";
		}

		if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
			$query = "INSERT INTO blogs (title, post, date, user_url, url_address, image) VALUES (:title, :post, :date, :user_url, :url_address, :image)";
			$check = $DB->write($query, $arr);

			if($check)
			{
				return true;
			}	
		}

		return false;
	}

	public function edit($DATA,$FILES,$image_class = null)
	{
		$_SESSION['error'] = "";
		
		$DB = Database::newInstance();
		$arr['title']       = ucwords($DATA['title']);
		$arr['post']        = ($DATA['post']);
		$arr['url_address'] = ($DATA['url_address']);

		if(!preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['title'])))
		{
			$_SESSION['error'] .= "Please enter a valid title for this post<br/>";
		}	

		if(empty($arr['post']))
		{
			$_SESSION['error'] .= "Please enter some valid post text content<br/>";
		}

		$arr2['image'] = "";
		$allowed[] = "image/jpeg";
		$size = 10;
		$size = ($size * 1024 * 1024)/2;
		$folder = "uploads/";

		if (!file_exists($folder)) 
		{
			mkdir($folder,0777,true);
		}
		//Check for files
		
		foreach ($FILES as $key => $img_row) {
			// code...
			if ($img_row['error'] == 0 && in_array($img_row['type'], $allowed)) 
			{
				if ($img_row['size'] < $size) 
				{
					$destination = $folder . $image_class->generate_filename(60) . ".jpg";
					move_uploaded_file($img_row['tmp_name'], $destination);
					$arr2[$key] = $destination;
					$image_class->resize_image($destination,$destination,1500,1500);
				}else
				{
					$_SESSION['error'] .= $key . " Is bigger than require size<br>";
				}
			}elseif ($img_row['error'] == 0 && !in_array($img_row['type'], $allowed)) {
				
				$_SESSION['error'] .= " This type of image is not allowed, try for jpeg or png<br/>";
			}
		}
		
		if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
			$DB = Database::newInstance();

			if($arr2['image'] == "")
			{
				$query = "update blogs set title = :title, post = :post where url_address = :url_address limit 1";
			}else {
				$arr['image'] = $arr2['image'];
				$query = "update blogs set title = :title, post = :post, image = :image where url_address = :url_address limit 1";
			}

			$check = $DB->write($query,$arr);

			if($check){
				return true;
			}
		}

		return false;
	}

	public function delete($url_address)
	{
		$DB = Database::newInstance();
		$arr['url_address'] = $url_address;

		$query = "delete from blogs where url_address = :url_address limit 1";
		$DB->write($query, $arr);
	}

	public function get_one($url_address)
	{
		$arr['url_address'] = $url_address;

		$DB = Database::newInstance();
		$data = $DB->read("select * from blogs where url_address = :url_address limit 1", $arr);
		return $data[0];
	}

	public function get_all()
	{
		//paginatin formula
		$limit = 10;
		$offset = Page::get_offset($limit);

		$DB = Database::newInstance();
		return $DB->read("select * from blogs order by id desc limit $limit offset $offset");
	}

	public function make_table($cats, $model = null)
	{
		$result = "";
		if (is_array($cats)) {
			// code...
			foreach ($cats as $cat_row) {
				// code...

				$edit_args = $cat_row->id.",'".$cat_row->description."'";

				$info = array();
				$info['id'] = $cat_row->id;
				$info['description'] = $cat_row->description;
				$info['quantity'] = $cat_row->quantity;
				$info['price'] = $cat_row->price;
				$info['category'] = $cat_row->category;
				$info['image'] = $cat_row->image;
				$info['image2'] = $cat_row->image2;
				$info['image3'] = $cat_row->image3;
				$info['image4'] = $cat_row->image4;

				$info = str_replace('"', "'", json_encode($info));

				$one_cat = $model->get_one($cat_row->category);

				$result .= "<tr>";
					$result .= '
						<td><a href="#">'.$cat_row->id.'</a></td>
						<td><a href="#">'.$cat_row->description.'</a></td>
						<td><a href="#">'.$cat_row->quantity.'</a></td>
						<td><a href="#">'.$one_cat->category.'</a></td>
						<td><a href="#">'.$cat_row->price.'</a></td>
						<td><a href="#">'.date("jS M, Y H:i:s", strtotime($cat_row->date)).'</a></td>
						<td><a href="#"><img src="'.ROOT.$cat_row->image.'" style="width:70px;height:70px;"></a></td>
	                    	
	                      	<td>
	                          	<button info="'.$info.'" onclick="show_edit_product('.$edit_args.',event)" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
	                          	<button onclick="delete_row('.$cat_row->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
	                      	</td>
					';
				$result .= "</tr>";
			}
		}

		return $result;
	}

	public function str_to_url($url) {
		$url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
		$url = trim($url, "-");
		$url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
		$url = strtolower($url);
		$url = preg_replace('~[^-a-z0-9_]+~', '', $url);
		return $url;
	}

}