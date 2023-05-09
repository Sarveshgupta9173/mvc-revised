<?php 

class Model_Vendor extends Model_Core_Table
{
     public function __construct()
    {
        parent::__construct();
        $this->setResourceClass('Model_Vendor_Resource');
    }
}

?>