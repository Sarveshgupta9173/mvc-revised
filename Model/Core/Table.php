<?php 

class Model_Core_Table 
{
	protected $data = [];
	protected $resourceClass = 'Model_Core_Table_Resource';
	protected $collectionClass = 'Model_Core_Table_Collection';
	protected $resource = null;
	protected $collection = null;

	public function __construct()
	{

	}

	public function setId($id)
	{
		$this->data[$this->getResource()->getPrimaryKey()] = (int) $id;
		return $this;
	}

	public function getId()
	{
		$primaryKey = $this->getResource()->getPrimaryKey();
		return $this->$primaryKey;
	}

	public function setResource($resource)
	{
		$this->resource = $resource;
		return $this;
	}

	public function getResource()
	{
		if($this->resource){
			return $this->resource;
		}
		$resource = new $this->resourceClass;
		$this->setResource($resource);
		return $resource;
	}

		public function setCollection($collection)
	{
		$this->collection = $collection;
		return $this;
	}

	public function getCollection()
	{
		if($this->collection){
			return $this->collection;
		}
		$collection = new $this->collectionClass;
		$this->setCollection($collection);
		return $collection;
	}

	public function setResourceClass($resourceClass)
	{
		$this->resourceClass = $resourceClass;
		return $this;
	}

	    public function getResourceClass()
    {
        $resourceClassName = $this->resourceClass;
        if (!$this->resourceClass) {
            return $this->resourceClass;
        }
        $resourceClass = new $resourceClassName();
        $this->setResourceClass($resourceClass);
        return $resourceClass;
    }

	public function setCollectionClass($collectionClass)
	{
		$this->collectionClass = $collectionClass;
		return $this;
	}
	
	public function __set($key,$value){
		$this->data = $value;
	}

	public function __get($key){
		if(!array_key_exists($key,$this->data)){
			return null;
		}
		return $this->data[$key];
	}

	public function __unset($key){
		$this->data[$key];
		return $this;
	}

	public function setData($data){
		$this->data = $data;
		return $this;
	}

	public function getData($key=null){
		if($key == null){
			return $this->data;
		}
		if(!array_key_exists($key,$this->data)){
			return null;
		}
			return $this->data[$key];
	}

	public function addData($key,$value){
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData(){
		$this->data = [];
		return $this;
	}

	public function save(){
		$request = Ccc::getModel('Core_Request');
		if($request->getParams('id') != null){			       // update
			$id = $request->getParams('id');
			$newData = $this->data;
			$oldData = $this->load($id)->data;
			$this->data = array_merge($oldData,$newData);
			$this->getResourceClass()->update($this->data, $id);
		return $this;
		}
		else{
			$insertId = $this->getResourceClass()->insert($this->data);		// insert
			return $insertId;
		}
	}

	public function fetchAll($query){

		$resourceClass = $this->getResourceClass();
		$result = $resourceClass->fetchAll($query);
		 if (!$result) {
            return false;
        }
		 foreach ($result as &$row) {
            $row = (new $this)->setData($row)
                ->setResourceClass($this->resourceClass)
                ->setResource($this->getResource())
                ->setCollection($this->getCollection());
        }
        $collection = $this->getCollection()->setData($result);
        return $collection;
	}

	public function fetchRow($query){
		
		$result = $this->getResourceClass()->fetchRow($query);
		$this->data = $result;
		return $this;
	}

	public function load($id,$column=null){
		if(!$column){
			$column = $this->primaryKey;
		}
		$sql = "SELECT * FROM `{$this->getResourceClass()->getTableName()}` WHERE `{$this->getResourceClass()->getPrimaryKey()}` = '{$id}'";
        $result = $this->getResourceClass()->fetchRow($sql);
		if($result){
			$this->data = $result;
		}
		return $this;

	}

	public function delete(){
		$id = $this->data[$this->getResourceClass()->getPrimaryKey()];
		$this->getResourceClass()->delete($id);
		return $this;
	}
}

?>