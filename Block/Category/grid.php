<?php 

class Block_Category_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		// $this->setTemplate('Category/grid.phtml');
		// $this->getCollection();
		$this->setTitle('Manage Category');
	}

	public function prepareButtons()
	{
		$this->addButton('category_id',['title'=>'ADD CATEGORY','url'=>$this->getUrl('add')]);
		return parent::prepareButtons();
	}

	public function prepareColumns()
	{
		$this->addColumn('category_id',['title'=>'Category Id']);
		$this->addColumn('name',['title'=>'Name']);
		$this->addColumn('description',['title'=>'Description ']);
		$this->addColumn('status',['title'=>'Status']);
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