<?php 

class Block_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Customer/grid.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{
		$query = "SELECT COUNT(customer_id) FROM `customer`";
		$count = Ccc::getModel('Core_Adapter')->fetchOne($query);
		$pager = $this->getPager()->setTotalRecords($count)->calculate();
		$sql = "SELECT * FROM `customer` LIMIT $pager->startLimit,$pager->recordPerPage";
		$customers = Ccc::getModel('Customer')->fetchAll($sql);
		$this->setData(['customers'=>$customers]);
		return $this;
	}
}

?>