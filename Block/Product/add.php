<?php 

class Block_Product_Add extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Product/add.phtml');
	}
}

?>