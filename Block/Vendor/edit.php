<?php 

class Block_Vendor_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Vendor/edit.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{
		$result = Ccc::getRegistry('vendor');
		$this->setData($result);
		return $this;
	}
}

?>