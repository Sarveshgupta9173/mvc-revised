<?php 

class Block_Salesman_Grid extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Salesman/grid.phtml');
		$this->getCollection();
	}

	public function getCollection()
	{
		$salesman = Ccc::getRegistry('salesman');
		$this->setData(['salesman'=>$salesman]);
		return $this;
	}
}

?>