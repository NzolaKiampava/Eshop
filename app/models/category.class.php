<?php 

Class Category
{

	public function create($DATA)
	{
		$DB = Database::newInstance();
		
		$arr['category'] = ucwords($DATA->category);
		$arr['parent'] = ucwords($DATA->parent);

		if(!preg_match("/^[a-zA-Z ]+$/", trim($arr['category'])))
		{
			$_SESSION['error'] = "Please enter a valid category name";
		}else{
			$_SESSION['error'] = "";
		}

		if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
			$query = "INSERT INTO categories (category,parent) VALUES (:category,:parent)";
			$check = $DB->write($query, $arr);

			if($check)
			{
				return true;
			}	
		}

		return false;
	}

	public function edit($data)
	{		
		$DB = Database::newInstance();
		$arr['id'] = $data->id;
		$arr['category'] = $data->category;
		$arr['parent'] = $data->parent;
		$query = "update categories set category = :category, parent = :parent where id = :id limit 1";
		$DB->write($query,$arr);
	}

	public function delete($id)
	{
		$DB = Database::newInstance();
		$id = (int)$id;
		$query = "delete from categories where id = '$id' limit 1";
		$DB->write($query);
	}

	public function get_all()
	{
		$DB = Database::newInstance();
		return $DB->read("select * from categories order by views desc");
	}

	public function get_one($id)
	{
		$id = (int)$id;

		$DB = Database::newInstance();
		$data = $DB->read("select * from categories where id = '$id' limit 1");
		return $data[0];
	}

	public function get_one_by_name($name)
	{
		$name = addslashes($name);

		$DB = Database::newInstance();
		$data = $DB->read("select * from categories where category like :name limit 1", ["name"=>$name]);
		if (is_array($data)) {
			// code...
			$DB->read("update categories set views = views + 1 where id = :id limit 1", ["id"=>$data[0]->id]);  //insert views by counting

			return $data[0];
		}

	}
	


	public function make_table($cats)
	{
		$result = "";
		if (is_array($cats)) {
			// code...
			foreach ($cats as $cat_row) {
				// code...

				$color = $cat_row->disabled ? "label label-warning label-mini" : "label label-info label-mini";
				$cat_row->disabled = $cat_row->disabled ? "Disabled" : "Enable";
				$args = $cat_row->id.",'".$cat_row->disabled."'";
				$edit_args = $cat_row->id.",'".addslashes($cat_row->category)."',".$cat_row->parent;
				$parent = "";

				foreach ($cats as $cat_row2) {
					if ($cat_row->parent == $cat_row2->id){
						$parent = $cat_row2->category;
					}
				}


				$result .= "<tr>";
					$result .= '
						<td><a>'.$cat_row->category.'</a></td>
	                    	<td><a>'.$parent.'</a></td>
	                    	<td><span onclick="disable_row('.$args.')" class="'.$color.'" style="cursor:pointer;">'.$cat_row->disabled.'</span></td>
	                      	<td>
	                          	<button onclick="show_edit_category('.$edit_args.',event)" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
	                          	<button onclick="delete_row('.$cat_row->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
	                      	</td>
					';
				$result .= "</tr>";
			}
		}

		return $result;
	}

}
