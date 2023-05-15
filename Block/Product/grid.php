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
		$pager = $this->getPager();
		$query = "SELECT COUNT(product_id) FROM `product` ";
		$count = Ccc::getModel('Core_Adapter')->fetchOne($query);
		$pager->setTotalRecords($count)->calculate();
		$sql = "SELECT * FROM `product` LIMIT $pager->startLimit,$pager->recordPerPage";
		$products = Ccc::getModel('Product')->fetchAll($sql);
		$this->setData($products);
		return $products;
	}
}


?>