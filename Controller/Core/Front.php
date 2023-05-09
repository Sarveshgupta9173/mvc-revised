<?php 

class Controller_Core_Front extends Controller_Core_Action
{
	public function init()
	{
		$request = new Model_Core_Request();
		$action = $request->getActionName()."Action";
		$controller = ucwords($request->getControllerName());

		$ca = 'Controller_'.$controller;
		$commonobject = new $ca;
		if(!method_exists($commonobject, $action)){
			echo "Given method Doesn't exists in the file/class";
		}
		else{
		$commonobject->$action(); 
		}
	}
}

?>