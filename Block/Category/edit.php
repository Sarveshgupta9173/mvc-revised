<?php 

class Block_Category_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Category/edit.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{
		$data = Ccc::getRegistry('category');
		$this->setData($data);
		return $this;
	}
}

?>