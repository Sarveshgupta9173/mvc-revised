<?php 

class Block_Core_Layout extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Core/Layout/3columns.phtml');
		$this->prepareChildren();
	}

	public function prepareChildren()
	{
		$header = $this->createBlock('Html_Header');
		$this->addChild('header',$header);

		$content = $this->createBlock('Html_Content');
		$this->addChild('content',$content);
		
		$footer = $this->createBlock('Html_Footer');
		$this->addChild('footer',$footer);
	}

	public function createBlock($block)
	{
		$blockClassName = 'Block_'.$block;
		$block = new $blockClassName();
		$block->setLayout($this);
		return $block;
	}
}

?>