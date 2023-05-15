<?php 

class Block_Core_Template extends Model_Core_View
{
	protected $children = [];
	protected $layout = null;
	protected $pager = null;

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

	public function setPager(Model_Core_Pager $pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager()
	{
		if($this->pager){
			return $this->pager;
		}
		$pager = new Model_Core_Pager();
		$this->setpager($pager);
		return $pager;
	}


	public function __construct()
	{
		parent::__construct();
	}

	public function setChildren(array $children)
	{
		$this->children = $children;
		return $this;
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function addChild($key,$value)
	{
		$this->children[$key] = $value;
		return $this;
	}

	public function removeChild($key)
	{
		if(!array_key_exists($key,$this->children)){
			return null;
		}
		unset($this->children[$key]);
		return $this;
	}

	public function getChild($key)
	{
		if(array_key_exists($key,$this->children)){
			return $this->children[$key];
		}
		return null;
	}
}

?>