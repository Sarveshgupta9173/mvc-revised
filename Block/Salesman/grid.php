<?php 

class Block_Salesman_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		// $this->setTemplate('Salesman/grid.phtml');
		// $this->getCollection();
		$this->setTitle('Manage Salesman');
	}


	public function prepareButtons()
	{
		$this->addButton('sales_id',['title'=>'ADD SALESMAN','url'=>$this->getUrl('add')]);
		return parent::prepareButtons();
	}

	public function prepareActions()
	{
		$this->addAction('Edit',['title'=>'EDIT','method'=>'getEditUrl']);
		$this->addAction('Delete',['title'=>'DELETE','method'=>'getDeleteUrl']);
		return parent::prepareActions();
	}

	public function prepareColumns()
	{
		$this->addColumn('sales_id',['title'=>'Salesman Id']);
		$this->addColumn('fname',['title'=>'First Name']);
		$this->addColumn('lname',['title'=>'Last Name']);
		$this->addColumn('email',['title'=>'Email']);
		$this->addColumn('gender',['title'=>'Gender']);
		$this->addColumn('status',['title'=>'Status']);
		$this->addColumn('created_at',['title'=>'Created At']);
		$this->addColumn('updated_at',['title'=>'Updated At']);	
		return parent::prepareColumns();
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