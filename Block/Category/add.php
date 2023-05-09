<?php 

class Block_Category_Add extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Category/add.phtml');
	}
}

?>