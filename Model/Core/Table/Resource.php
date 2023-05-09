<?php 

class Model_Core_Table_Resource
{
	protected $adapter = null;
	protected $tableName = null;
    protected $primaryKey = null;

	public function __construct()
    {
        
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

	public function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if($this->adapter){
			return $this->adapter;
		}

		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

	//Queries

	public function fetchAll($query){
		$rows = $this->getAdapter()->fetchAll($query);
		return $rows;
	}

	public function fetchRow($query){
		$result = $this->getAdapter()->fetchRow($query);
		if(!$result){
			return false;
		}
		return $result;
	}

	public function insert($data){
		// print_r($data);die;
		date_default_timezone_set("Asia/Kolkata");
		$createdAt = date("Y-m-d h:i:s");
		
		$keys = array_keys($data);
        $values = array_values($data);

        $keyString = implode('`,`', $keys);
        $valueString = implode("','", $values);

        $sql = "INSERT INTO `{$this->getTableName()}` (`{$keyString}`,`created_at`) VALUES ('{$valueString}','{$createdAt}')";
        // echo $sql;die;
		 $insertId = $this->getAdapter()->insert($sql);
		 return $insertId;
		 	
	}

	public function update($data,$condition)
	{
		date_default_timezone_set("Asia/Kolkata");
		$updated_at = date("Y-m-d h:i:s");

        $sql = "UPDATE `{$this->getTableName()}` SET ";
        foreach ($data as $key => $value) {
            $sql = $sql."`{$key}`='{$value}', ";
         }
        $sql = $sql."`updated_at`='{$updated_at}' WHERE `{$this->getPrimaryKey()}`='{$condition}'";
        print_r($sql);
		$adapter = $this->getAdapter()->update($sql);
		return true;

	}

	public function delete($id)
	{
		$sql = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = '{$id}' ";
		$adapter = $this->getAdapter()->delete($sql);
		return $adapter;
	}

	public function load($value, $column=null)
    {
        $column = (!$column) ? $this->primaryKey : $column;
        $sql = "SELECT * FROM `{$this->getTableName}` WHERE `{$column}`={$value}";
        $row = $this->getAdapter()->fetchRow($sql);
        return $row;
    }

}

?>