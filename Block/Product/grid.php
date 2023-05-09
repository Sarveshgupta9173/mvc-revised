<?php 


class Block_Product_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Product/grid.phtml');
	}

	public function getCollection()
	{
		$sql = "SELECT * FROM `product`";
		$products = Ccc::getModel('Product')->fetchAll($sql);
		$this->setData($products);
		return $products;
	}
}


?>