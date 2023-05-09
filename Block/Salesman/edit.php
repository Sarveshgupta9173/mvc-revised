<?php 

class Block_Salesman_Edit extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Salesman/edit.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{
		$salesman = Ccc::getRegistry('salesman');	
		$this->setData($salesman);
		return $this;
	}
}

?>