<?php 

class Block_Customer_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Customer/edit.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{
		$customers = Ccc::getRegistry('customer');
		$this->setData($customers);
		return $this;
	}
}

?>