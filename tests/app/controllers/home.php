<?php
require_once(getcwd().'/../Controller.php');

class Home extends Controller
{
	function __construct(){
		parent::__construct();
		$this->layoutView->template = getcwd()."/app/views/viewlayout.php";
	}

	public function index()
	{
		$this->render(getcwd()."/app/views/viewhome.php");
	}
	
	public function action()
	{
		$this->render(getcwd()."/app/views/viewaction.php");
	}
}
?>