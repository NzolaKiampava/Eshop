<?php 

/**
 * search for stuff
 */
class Search
{
	
	public function __construct()
	{
		// code...
	}

	public static function get_categories($name='')
	{
		$DB = Database::newInstance();

		$query = "select id, category from categories where disabled = 0 order by views desc";
		$data = $DB->read($query);

		if(is_array($data))
		{
			foreach ($data as $row) {
				// code...
				echo "<option value='$row->id' ".self::get_sticky('select',$name,$row->id).">$row->category</option>";
			}
		}
	}

	public static function get_brands()
	{
		$DB = Database::newInstance();

		$query = "select id, brand from brands where disabled = 0 order by views desc";
		$data = $DB->read($query);

		if(is_array($data))
		{
			$num = 0;
			foreach ($data as $row) {
				// code...
				echo "<input ".self::get_sticky('checkbox','brand-'.$num,$row->id)." id=\"$row->id\" value=\"$row->id\" type=\"checkbox\" name=\"brand-$num\">
                      <label for=\"$row->id\">$row->brand</label> . &nbsp;";

                $num++;
			}
		}
	}
	
	public static function get_years($name)
	{
		$DB = Database::newInstance();

		$query = "select id, date from products group by YEAR(date)";
		$data = $DB->read($query);

		if(is_array($data))
		{
			foreach ($data as $row) {
				// code...
				$year = date("Y",strtotime($row->date));
				echo "<option ".self::get_sticky('select',$name,$year).">".$year."</option>";
			}
		}
	}

	public static function get_sticky($type,$name,$value='')
	{
		switch ($type) {
			case 'textbox':
				// code...
			    echo isset($_GET[$name]) ? $_GET[$name] : "";
				break;

			case 'number':
				// code...
			    echo isset($_GET[$name]) ? $_GET[$name] : "0";
				break;
				
			case 'select':
				// code...
			    return isset($_GET[$name]) && $value == $_GET[$name] ? "selected='true'" : "";
				break;

			case 'checkbox':
				// code...
			    return isset($_GET[$name]) && $value == $_GET[$name] ? "checked='true'" : "";
				break;
			
			default:
				// code...
				break;
		}
	}
	
}