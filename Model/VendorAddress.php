<?php 

class Model_VendorAddress extends Model_Core_Table
{
     public function __construct()
    {
        parent::__construct();
        $this->setResourceClass('Model_Vendor_Address_Resource');
    }
}

?>