<?php 

class Controller_Vendor extends Controller_Core_Action
{

	public function addAction(){
		$vendor = Ccc::getModel('Vendor');
		Ccc::register('vendor',$vendor);
		$layout = $this->getLayout();
		$edit = $layout->createBlock('Vendor_Edit');
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function editAction(){

		$request = $this->getRequest();
		$id = $request->getParams("id");

		$sql = "SELECT * FROM `vendor` INNER JOIN  `vendor_address` ON `vendor`.`vendor_id` = `vendor_address`.`vendor_id` WHERE `vendor`.`vendor_id` = '{$id}' ";
		$data = Ccc::getModel('Vendor')->fetchRow($sql);
		Ccc::register('vendor',$data);

		$layout = $this->getLayout();
		$edit = $layout->createBlock('Vendor_Edit');
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function gridAction(){
		
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Vendor_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function saveAction()
	{
		try {
			$request = $this->getRequest();
			$data = $request->getPost("vendor");
			$vendor = Ccc::getModel('Vendor');

			if($request->getParams("id")){  		   //update
				$vendor->data = $data;
				$id = $vendor->save();
				$address = Ccc::getModel('VendorAddress');
				$addressData = $request->getPost("address");
				$address->data = $addressData;
				$address->save();

			}

			else{                             			//insert
				$vendor->data = $data;
				$id = $vendor->save();
				$address = Ccc::getModel('VendorAddress');
				$addressData = $request->getPost("address");
				$address->data = $addressData;
				$address->addData('vendor_id',$id);
				$address->save();
			}

		} catch (Exception $e) {
			
		}
		$this->redirect('grid','vendor',null,true);
	}

	public function deleteAction(){

		try {
			$message = Ccc::getModel('Core_Message');
			$request = $this->getRequest();
			
			$id = $request->getParams("id");
			Ccc::getModel('Vendor')->load($id)
			->delete();

		} catch (Exception $e) {

		}		
		$this->redirect('grid','vendor',null,true);

	}

}


?>