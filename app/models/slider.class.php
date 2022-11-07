<?php 

Class Slider
{
	private $error = "";

	public function create($DATA,$FILES,$image_class = null)
	{
		$_SESSION['error'] = "";

		$DB = Database::newInstance();
		$arr['header1_text'] 	= ucwords($DATA['header1_text']);
		$arr['header2_text']    = ucwords($DATA['header2_text']);
		$arr['text']    		= $DATA['text'];
		$arr['link']    		= $DATA['link'];

		if(empty($arr['header1_text']) || !preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['header1_text'])))
		{
			$_SESSION['error'] .= "Please enter a valid header1_text <br/>";
		}	

		if(empty($arr['header2_text']))
		{
			$_SESSION['error'] .= "Please enter a valid header2_text <br/>";
		}

	    if(empty($arr['text']))
		{
			$_SESSION['error'] .= "Please enter a valid main message <br/>";
		}
		if(empty($arr['link']))
		{
			$_SESSION['error'] .= "Please enter a valid link <br/>";
		}

		if($_SESSION['error'] == ""){

			$arr['image'] = "";
			//$allowed = array();
			//$allowed = ["image/jpeg", "image/png"];
			$allowed[] = "image/jpeg";
			$size = 10;
			$size = ($size * 1024 * 1024)/2;   //size 6MB
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
						/* testing to allow png and jpeg image

						if($img_row['type'] == "image/jpeg"){
							$destination = $folder . $image_class->generate_filename(60) . ".jpg";
						}elseif($img_row['type'] == "image/png"){
							$destination = $folder . $image_class->generate_filename(60) . ".png";
						}
						*/

						$destination = $folder . $image_class->generate_filename(60) . ".jpg";
						move_uploaded_file($img_row['tmp_name'], $destination);
						$arr[$key] = $destination;
						$image_class->resize_image($destination,$destination,1500,1500);
						//$image_class->resize_image($destination,$FILES,$destination,1500,1500);
					}else
					{
						$_SESSION['error'] .= $key . " Is bigger than require size<br>";
					}
				}else{
					$_SESSION['error'] .= " This type of image is not allowed, try for jpeg or png. Or convert the image to jpeg typing the following link in your browser: <a href='https://cloudconvert.com/'>https://cloudconvert.com</a> <br/>";
				}
			}

			$query = "INSERT INTO slider_images (header1_text , header2_text, text, link, image) VALUES (:header1_text, :header2_text, :text, :link, :image)";
			$check = $DB->write($query, $arr);

			if($check)
			{
				return true;
			}	
		}

		return false;
	}

	public function get_all()
	{
		$DB = Database::newInstance();

		$query = "select * from slider_images where disabled = 0 order by id desc";
		$result = $DB->read($query);

		return $result;
	}

	public function get_one($id)
	{
		$arr['id'] = $id;

		$DB = Database::newInstance();
		$data = $DB->read("select * from slider_images where id = :id limit 1", $arr);
		return $data[0];
	}

	public function edit($DATA,$FILES,$image_class = null)
	{
		$_SESSION['error'] = "";
		$DB = Database::newInstance();
		$arr['header1_text'] 	= ucwords($DATA['header1_text']);
		$arr['header2_text']    = ucwords($DATA['header2_text']);
		$arr['text']    		= $DATA['text'];
		$arr['link']    		= $DATA['link'];
		$arr['id']    		    = $DATA['id'];

		if(empty($arr['header1_text']) || !preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['header1_text'])))
		{
			$_SESSION['error'] .= "Please enter a valid header1_text <br/>";
		}	

		if(empty($arr['header2_text']))
		{
			$_SESSION['error'] .= "Please enter a valid header2_text <br/>";
		}

	    if(empty($arr['text']))
		{
			$_SESSION['error'] .= "Please enter a valid main message <br/>";
		}
		if(empty($arr['link']))
		{
			$_SESSION['error'] .= "Please enter a valid link <br/>";
		}

		if($_SESSION['error'] == ""){

			$arr2['image'] = "";
			//$allowed = array();
			//$allowed = ["image/jpeg", "image/png"];
			$allowed[] = "image/jpeg";
			$size = 10;
			$size = ($size * 1024 * 1024)/2;   //size 6MB
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
						/* testing to allow png and jpeg image

						if($img_row['type'] == "image/jpeg"){
							$destination = $folder . $image_class->generate_filename(60) . ".jpg";
						}elseif($img_row['type'] == "image/png"){
							$destination = $folder . $image_class->generate_filename(60) . ".png";
						}
						*/

						$destination = $folder . $image_class->generate_filename(60) . ".jpg";
						move_uploaded_file($img_row['tmp_name'], $destination);
						$arr2[$key] = $destination;
						$image_class->resize_image($destination,$destination,1500,1500);
						//$image_class->resize_image($destination,$FILES,$destination,1500,1500);
					}else
					{
						$_SESSION['error'] .= $key . " Is bigger than require size<br>";
					}
				}
				if($img_row['error'] == 0 && !in_array($img_row['type'], $allowed)){
					$_SESSION['error'] .= " This type of image is not allowed, try for jpeg or png. Or convert the image to jpeg typing the following link in your browser: <a href='https://cloudconvert.com/'>https://cloudconvert.com</a> <br/>";
				}
			}

			if($arr2['image'] != "")
			{
				$arr['image'] = $arr2['image'];
				$query = "UPDATE slider_images SET header1_text = :header1_text, header2_text = :header2_text, text = :text, link = :link, image = :image WHERE id = :id";
				$check = $DB->read($query, $arr);
			}else {
				$query = "UPDATE slider_images SET header1_text = :header1_text, header2_text = :header2_text, text = :text, link = :link WHERE id = :id";
				$check = $DB->read($query, $arr);
			}
			

			if($check)
			{
				return true;
			}	
		}

		return false;
	}

	public function delete($id)
	{
		$DB = Database::newInstance();
		$arr['id'] = $id;

		$query = "delete from slider_images where id = :id limit 1";
		$DB->write($query, $arr);
	}

}
