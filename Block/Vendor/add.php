<?php 

class Block_Vendor_Add extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Vendor/add.phtml');
	}
}

?>