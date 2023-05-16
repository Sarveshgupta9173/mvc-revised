<?php 


class Block_Product_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		// $this->setTemplate('Product/grid.phtml');
		$this->setTitle('Manage Product');
	}

	public function prepareButtons()
	{
		$this->addButton('product_id',['title'=>'ADD PRODUCT','url'=>$this->getUrl('add')]);
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
		$this->addColumn('product_id',['title'=>'Product Id']);
		$this->addColumn('name',['title'=>'Name']);
		$this->addColumn('cost',['title'=>'Cost']);
		$this->addColumn('price',['title'=>'Price']);
		$this->addColumn('sku',['title'=>'SKU']);
		$this->addColumn('quantity',['title'=>'Quantity']);
		$this->addColumn('created_at',['title'=>'Created At']);
		$this->addColumn('updated_at',['title'=>'Updated At']);	
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