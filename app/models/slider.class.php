<?php 

Class Slider
{
	private $error = "";

	public function create($DATA,$FILES,$image_class = null)
	{
		$this->error = "";

		$DB = Database::newInstance();
		$arr['header1_text'] = ucwords($DATA->header1_text);
		$arr['header2_text']    = ucwords($DATA->header2_text);
		$arr['text']    = ucwords($DATA->text);
		$arr['link']       = ucwords($DATA->link);

		if(empty($arr['header1_text']) || !preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['header1_text'])))
		{
			$this->error['error'] .= "Please enter a valid header1_text";
		}	

		if(empty($arr['header2_text']))
		{
			$this->error['error'] .= "Please enter a valid header2_text";
		}

	    if(empty($arr['text']))
		{
			$this->error['error'] .= "Please enter a valid main message";
		}
		if(empty($arr['link']))
		{
			$this->error['error'] .= "Please enter a valid link";
		}

		if($this->error == ""){
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
						$arr[$key] = $destination;
						$image_class->resize_image($destination,$destination,1500,1500);
					}else
					{
						$this->error['error'] .= $key . " Is bigger than require size<br>";
					}
				}else{
					$this->error['error'] .= " This type of image is not allowed, try for jpeg";
				}
			}

			$query = "INSERT INTO slider_image (header1_text , header2_text, text, link, image) VALUES (:header1_text, :header2_text, :text, :link, :date, :imag)";
			$check = $DB->write($query, $arr);

			if($check)
			{
				return true;
			}	
		}

		return $this->error;
	}
}