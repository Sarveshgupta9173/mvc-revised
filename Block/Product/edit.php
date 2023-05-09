<?php 

class Block_Product_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Product/edit.phtml');
	}

	public function getCollection()
	{
		$products = Ccc::getRegistry('products');
		$this->setData($products);
		return $this;
	}
}

?>