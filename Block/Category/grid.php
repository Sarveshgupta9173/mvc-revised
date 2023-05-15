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
		$query = "SELECT COUNT(category_id) FROM `category`";
		$count = Ccc::getModel('Core_Adapter')->fetchOne($query);
		$pager = $this->getPager()->setTotalRecords($count)->calculate();
		$sql = "SELECT * FROM `category` LIMIT $pager->startLimit,$pager->recordPerPage";
		$category = Ccc::getModel('Category')->fetchAll($sql);
		$this->setData(['categories'=>$category]);
		return $category;
	}
}

?>