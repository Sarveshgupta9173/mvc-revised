<?php 

class Block_Core_Grid extends Block_Core_Template
{
	protected $columns = [];
	protected $actions = [];
	protected $buttons = [];
	protected $title = null;
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('Core/grid.phtml');
		$this->prepareColumns();
		$this->prepareActions();
		$this->prepareButtons();
	}

	public function setColumns(array $columns)
	{
		$this->columns = $columns;
		return $this;
	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function addColumn($key, $value)
	{
		$this->columns[$key] = $value;
		return $this;
	}

	public function removeColumn($key)
	{
		unset($this->columns[$key]);
		return $this;
	}

	public function getColumn($key)
	{
		if(array_key_exists($key, $this->columns)){
			return $this->columns[$key];
		}
		return false;
	}

	protected function prepareColumns()
	{
		return $this;
	}

	public function setActions(array $actions)
	{
		$this->actions = $actions;
		return $this;
	}

	public function getActions()
	{
		return $this->actions;
	}

	public function addAction($key, $value)
	{
		$this->actions[$key] = $value;
		return $this;
	}

	public function removeAction($key)
	{
		unset($this->actions[$key]);
		return $this;
	}

	public function getAction($key)
	{
		if(array_key_exists($key, $this->actions)){
			return $this->actions[$key];
		}
		return false;
	}

	protected function prepareActions()
	{
		return $this;
	}

	public function getEditUrl($row, $key)
	{
		return $this->getUrl($key,null,['id'=>$row->getId()]);
	}

	public function getDeleteUrl($row, $key)
	{
		return $this->getUrl($key,null,['id'=>$row->getId()]);
	}

	public function getMediaUrl($row, $key)
	{
		return $this->getUrl('grid','media',['id'=>$row->getId()]);
	}

	public function getPriceUrl($row, $key)
	{
		return $this->getUrl('grid','sprice',['id'=>$row->getId()]);
	}

	public function setButtons(array $buttons)
	{
		$this->buttons = $buttons;
		return $this;
	}

	public function getButtons()
	{
		return $this->buttons;
	}

	public function addButton($key, $value)
	{
		$this->buttons[$key] = $value;
		return $this;
	}

	public function removeButton($key)
	{
		unset($this->buttons[$key]);
		return $this;
	}

	public function getButton($key)
	{
		if(array_key_exists($key, $this->buttons)){
			return $this->buttons[$key];
		}
		return false;
	}

	protected function prepareButtons()
	{
		return $this;
	}

	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getColumnValue($row, $key)
	{
		if($key == 'status'){
			return $row->getStatusText();
		}
		return $row->$key;
	}
}