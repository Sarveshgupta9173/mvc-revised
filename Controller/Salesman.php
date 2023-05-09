<?php 

class Controller_Salesman extends Controller_Core_Action
{

	public function gridAction(){

		$sql = "SELECT * FROM `salesman`";
		$salesman = Ccc::getModel('Salesman')->fetchAll($sql);
		Ccc::register('salesman',$salesman);

		$layout = $this->getLayout();
		$grid = $layout->createBlock('Salesman_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction(){

		$layout = $this->getLayout();
		$add = $layout->createBlock('Salesman_Add');
		$layout->getChild('content')->addChild('add',$add);
		$layout->render();
	}

	public function editAction(){

		$request = $this->getRequest();
		$id = $request->getParams("id");

		$sql = "SELECT * FROM `salesman` where sales_id='{$id}';";
		$salesman = Ccc::getModel('Salesman')->load($id);
		Ccc::register('salesman',$salesman);
		
		$layout = $this->getLayout();
		$edit = $layout->createBlock('Salesman_Edit');
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();

	}

	public function saveAction()
	{
		try {
			$message = Ccc::getModel('Core_Message');
			$request = $this->getRequest();
			$data = $request->getPost("salesman");
			
			if($request->getParams("id")){  		   //update
			$product = Ccc::getModel('Salesman');                         			//insert
			$product->data = $data;
			$product->save();

			}

			else{    
				$product = Ccc::getModel('Salesman');                         			//insert
				$product->data = $data;
				$product->save();

			}

		} catch (Exception $e) {
			
		}
		$this->redirect('grid','salesman',null,true);
	}

	public function deleteAction(){

		try {
			
			$message = Ccc::getModel('Core_Message');
			$request = $this->getRequest();
			$id = $request->getParams("id");
			$salesman = Ccc::getModel('Salesman')->load($id)->delete();

		} catch (Exception $e) {
			
		}

		$this->redirect('grid','salesman',null,true);
	}
}

?>