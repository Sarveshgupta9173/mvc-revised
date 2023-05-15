<?php 

class Block_Vendor_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Vendor/grid.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{
		$query = "SELECT COUNT(vendor_id) FROM `vendor`";
		$count = Ccc::getModel('Core_Adapter')->fetchOne($query);
		$pager = $this->getPager()->setTotalRecords($count)->calculate();
		$sql = "SELECT * FROM `vendor` LIMIT $pager->startLimit,$pager->recordPerPage";
		$vendors = Ccc::getModel('Vendor')->fetchAll($sql);
		$this->setData(['vendors'=>$vendors]);
		return $this;
	}
}

?>