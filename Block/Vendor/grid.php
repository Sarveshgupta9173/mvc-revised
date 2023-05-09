<?php 

class Block_Vendor_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Vendor/grid.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{

		$vendors = Ccc::getRegistry('vendors');
		$this->setData(['vendors'=>$vendors]);
		return $this;
	}
}

?>