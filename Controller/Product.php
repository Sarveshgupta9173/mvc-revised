<?php 

class Controller_Product extends Controller_Core_Action
{

	public function addAction(){
		$layout = $this->getLayout();
		$add = $layout->createBlock('Product_Add');
		$layout->getChild('content')->addChild('add',$add);
		$layout->render();
	}

	public function editAction(){

		$id = (int) $this->getRequest()->getParams("id");
		$products = Ccc::getModel('Product')->load($id);
		Ccc::register('products',$products);

		$layout = $this->getLayout();
		$edit = $layout->createBlock('Product_Edit');
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function gridAction(){
		
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Product_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	
	}

	public function saveAction()
	{
		try {
			$request = $this->getRequest();
			$data = $request->getPost("product");
			$product = Ccc::getModel('Product');                         			
			
			if($request->getParams("id")){  		   //update
			$product->data = $data;
			$product->save();

			}

			else{    
				$product->data = $data;					//insert
				$product->save();
			}

		} catch (Exception $e) {
			
		}
		$this->redirect('grid','product',null,true);
	}


	public function deleteAction(){
		try {

			$request = $this->getRequest();
			$id = $request->getParams("id");
			$product = Ccc::getModel('Product');
			$product->load($id);
			$product->delete();

		} catch (Exception $e) {
			
		}
		$this->redirect('grid','product',null,true);
	}
}

?>