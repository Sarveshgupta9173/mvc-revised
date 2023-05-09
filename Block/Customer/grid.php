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

		$customers = Ccc::getRegistry('customers');
		$this->setData(['customers'=>$customers]);
		return $this;
	}
}

?>