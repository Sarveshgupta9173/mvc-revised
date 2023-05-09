<?php 

class Controller_Core_Action{
	
	protected $request = null;
	protected $adapter = null;
	protected $url = null;
	protected $layout = null;

	public function setLayout(Block_Core_Layout $layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if($this->layout){
			return $this->layout;
		}
		$layout = new Block_Core_Layout();
		$this->setLayout($layout);
		return $layout;
	}

	public function setRequest(Model_Core_Request $request)
	{
		$this->request = $request;
		return $this;
	}

	public function getRequest()
	{
		if($this->request){
			return $this->request;
		}
		$request = new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}

	protected function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if($this->adapter){
			return $this->adapter;
		}
		
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

	public function getTemplate($templatePath){
		$url = new Model_Core_url();
		
		require "View".DS.$templatePath;
	}

	public function setUrl(Model_Core_url $url){
		$this->url = $url;
		return $this;
	}

	public function getUrl(){
		if($this->url){
			return $this->url;
		}
		$url = new Model_Core_url();
		$this->setUrl($url);
		return $url;
	}

	public function redirect($a,$c){
		header("Location:Index.php?a={$a}&c={$c}");
		exit();	
	}
}

?>