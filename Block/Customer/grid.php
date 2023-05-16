<?php 

class Block_Customer_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Customer');
	}

	public function prepareButtons()
	{
		$this->addButton('customer_id',['title'=>'ADD CUSTOMER','url'=>$this->getUrl('add')]);
		return parent::prepareButtons();
	}

	public function prepareColumns()
	{
		$this->addColumn('customer_id',['title'=>'Customer Id']);
		$this->addColumn('fname',['title'=>'First Name']);
		$this->addColumn('lname',['title'=>'Last Name']);
		$this->addColumn('email',['title'=>'Email']);
		$this->addColumn('gender',['title'=>'Gender']);
		$this->addColumn('created_at',['title'=>'Created At']);
		$this->addColumn('updated_at',['title'=>'Updated At']);
		return parent::prepareColumns();
	}	

	public function prepareActions()
	{
		$this->addAction('Edit',['title'=>'EDIT','method'=>'getEditUrl']);
		$this->addAction('Delete',['title'=>'DELETE','method'=>'getDeleteUrl']);
		return parent::prepareActions();

	}

	public function getCollection()
	{
		$query = "SELECT COUNT(customer_id) FROM `customer`";
		$count = Ccc::getModel('Core_Adapter')->fetchOne($query);
		$pager = $this->getPager()->setTotalRecords($count)->calculate();
		$sql = "SELECT * FROM `customer` LIMIT $pager->startLimit,$pager->recordPerPage";
		$customers = Ccc::getModel('Customer')->fetchAll($sql);
		$this->setData(['customers'=>$customers]);
		return $customers;
	}
}

?>