<?php 

class Model_Core_Table_Collection 
{
	protected $data = [];

	public function setData($data)
	{
		$this->data = $data;
		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function count()
	{
		return count($this->data);
	}

	public function getFirst()
	{
		return $this->data[0];
	}

	public function getLast()
	{
		return $this->data[$this->count()-1];
	}
}

?>