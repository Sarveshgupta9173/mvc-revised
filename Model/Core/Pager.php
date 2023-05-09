<?php 

class Model_Core_Pager
{
	public $start = null;
	public $previous = null;
	public $currentPage = null;
	public $next = null;
	public $end = null;
	public $startLimit = null;
	public $totalRecords = null;
	public $numberOfPages = null;
	public $recordPerPage = null;

	public function setTotalRecords($totalRecords)
	{
		$this->totalRecords = $totalRecords;
		return $this;
	}

	public function getTotalRecords()
	{
		return $this->totalRecords;
	}

	public function getCurrentPage()
	{
		$request = Ccc::getModel('Core_Request');
		$currentPage = $request->getParams('p');
		return $currentPage;
	}

	public function calculate()
	{
		$this->start = 1;

		$this->recordPerPage = 10;

		$this->numberOfPages = ceil($this->getTotalRecords()/$this->recordPerPage);

		$this->end = $this->numberOfPages;

		$this->currentPage = $this->getCurrentPage();

		$this->next = $this->getCurrentPage() + 1;

		if($this->previous > 1){
		$this->previous = $this->getCurrentPage() - 1;
		}else{
			$this->previous = 1;
		}

		$this->startLimit = ($this->getCurrentPage()-1)*$this->recordPerPage;

		
		return $this;
	}


	
}

?>