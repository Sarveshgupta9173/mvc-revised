<?php 

class Block_Category_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Category/grid.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{
		$categories = Ccc::getRegistry('category');
		$this->setData(['categories'=>$categories]);
		return $this;
	}
}

?>