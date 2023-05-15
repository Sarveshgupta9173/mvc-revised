<?php 

class Block_Salesman_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Salesman/grid.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{
		$pager = $this->getPager();
		$query = "SELECT COUNT(sales_id) FROM `salesman` ";
		$count = Ccc::getModel('Core_Adapter')->fetchOne($query);
		$pager->setTotalRecords($count)->calculate();
		$sql = "SELECT * FROM `salesman` LIMIT $pager->startLimit,$pager->recordPerPage";
		$salesman = Ccc::getModel('Salesman')->fetchAll($sql);
		$this->setData(['salesman'=>$salesman]);
		return $salesman;
	}
}

?>