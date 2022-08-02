<?php


class Countries
{
	
	public function get_countries(){
		$db = Database::newInstance();
		$query = "select * from Countries order by country asc";
		$data = $db->read($query);

		return $data;
	}

	public function get_states($country){

		$arr['country'] = addslashes($country);

		$db = Database::newInstance();
		$query = "select * from countries where country = :country limit 1";
		$check = $db->read($query, $arr);
		$data = false;

		if(is_array($check)){
			$arr = false;
			$arr['id'] = $check[0]->id;
			$query = "select * from states where parent = :id order by id desc";
			$data = $db->read($query, $arr);
		}
		
		return $data;
	}

	public function get_country($id){

		$id = (int)$id;
		$db = Database::newInstance();
		$query = "select * from Countries where id = '$id'";
		$data = $db->read($query);

		return is_array($data) ? $data[0] : false;
	}

	public function get_state($id){
		
		$arr['id'] = (int)$id;

		$db = Database::newInstance();
		$query = "select * from states where id = :id";
		$data = $db->read($query, $arr);

		return is_array($data) ? $data[0] : false;
	}
	
	
}