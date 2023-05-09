<?php 

class Model_Salesman extends Model_Core_Table
{
     public function __construct()
    {
        parent::__construct();
        $this->setResourceClass('Model_Salesman_Resource');
    }
}

?>