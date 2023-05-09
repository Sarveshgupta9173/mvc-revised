<?php 

class Model_Core_View
{
	protected $data = [];
	protected $template = null;

	public function setData($data){
		$this->data = $data;
		return $this;
	} 

	public function __construct()
	{
		
	}

	public function getData(){
		if($this->data){
			return $this->data;
		}
		return false;
	}

	public function setTemplate($templatePath){
		$this->template = $templatePath;
		return $this;
	}

	public function getTemplate(){
		if($this->template){
			return $this->template;
		}
		return null;
	}

	public function render()
	{
		$url = new Model_Core_url();
		require "View".DS.$this->getTemplate();
	}

	public function getUrl($a = Null, $c = Null, $params = [], $resetParams = false)
	{
		$url = Ccc::getModel('Core_Url');
		return $url->getUrl($a,$c,$params,$resetParams);
	}

	public function __set($key,$value)
	{
		$this->data = $value;
	}

	public function __get($key)
	{
		return $this->data[$key];
	}

	public function __unset($key)
	{
		unset($this->data[$key]);
	}
}

?>