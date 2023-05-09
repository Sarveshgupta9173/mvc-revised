<?php 

class Model_Category extends Model_Core_Table
{
     public function __construct()
    {
        parent::__construct();
        $this->setResourceClass('Model_Category_Resource');
    }
}

?>