<?php
require_once(getcwd().'/../Model.php');

class ModelTest extends Model
{
	public function getItems()
	{
		$items = array(
				array(1,"Item1"),
				array(2,"Item2"),
				array(3,"Item3")
			);
		return $items;
	}
}
?>
