<?php 

class Controller_Customer extends Controller_Core_Action
{
	public function addAction(){

		$customer = Ccc::getModel('Customer');

		Ccc::register('customer',$customer);
		$layout = $this->getLayout();
		$edit = $layout->createBlock('Customer_Edit');
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function editAction(){
		$request = $this->getRequest();
		$id = $request->getParams("id");

		$sql = "SELECT * FROM `customer` INNER JOIN  `customer_address` ON `customer`.`customer_id` = `customer_address`.`customer_id` WHERE `customer`.`customer_id` = '{$id}' ";
		$customers = Ccc::getModel('Customer')->fetchRow($sql);

		Ccc::register('customer',$customers);

		$layout = $this->getLayout();
		$edit = $layout->createBlock('Customer_Edit');
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function gridAction(){
		$sql = "SELECT * FROM `customer`";
		$customers = Ccc::getModel('Customer')->fetchAll($sql);
		Ccc::register('customers',$customers);

		$layout = $this->getLayout();
		$grid = $layout->createBlock('Customer_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function saveAction()
	{
		try {
			$request = $this->getRequest();
			$data = $request->getPost("customer");
			$customer = Ccc::getModel('Customer');

			if($request->getParams("id")){  		   //update
				$customer->data = $data;
				$id = $customer->save();
				$address = Ccc::getModel('CustomerAddress');
				$addressData = $request->getPost("address");
				$address->data = $addressData;
				$address->save();

			}

			else{                             			//insert
				$customer->data = $data;
				$id = $customer->save();
				$address = Ccc::getModel('CustomerAddress');
				$addressData = $request->getPost("address");
				$address->data = $addressData;
				$address->addData('customer_id',$id);
				$address->save();
			}

		} catch (Exception $e) {
			
		}
		$this->redirect('grid','customer',null,true);
	}

	public function deleteAction(){

		try {
			
			$request = $this->getRequest();
			$id = $request->getParams("id");
			$customer = Ccc::getModel('Customer');
			$customer->load($id);
			$customer->delete();
			$address = Ccc::getModel('CustomerAddress');
			$address->load($id);
			$address->delete();


		} catch (Exception $e) {
			
		}
	
		$this->redirect('grid','customer',null,true);
		
	}

}


?>