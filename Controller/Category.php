<?php 

class Controller_Category extends Controller_Core_Action
{	
	public function addAction(){
		$layout = $this->getLayout();
		$add = $layout->createBlock('Category_Add');
		$layout->getChild('content')->addChild('add',$add);
		$layout->render();
	}

	public function editAction(){

		$request = Ccc::getModel('Core_Request');
		$id = $request->getParams("id");
		$sql = "SELECT * FROM `category` WHERE `category_id` = '{$id}'";
		$data = Ccc::getModel('Category')->fetchRow($sql);
		Ccc::register('category',$data);

		$layout = $this->getLayout();
		$edit = $layout->createBlock('Category_Edit');
		$layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
		
	}

	public function gridAction(){
		
		$sql = "SELECT * FROM `category`";
		$category = Ccc::getModel('Category')->fetchAll($sql);
		Ccc::register('category',$category);

		$layout = $this->getLayout();
		$grid = $layout->createBlock('Category_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();

	}

	
	public function saveAction()
	{
		try {
			$message = Ccc::getModel('Core_Message');
			$request = $this->getRequest();
			$request->isPost();
			$data = $request->getPost('category');
			$category = Ccc::getModel('Category');
			$category = Ccc::getModel('Category');

			$id = $request->getParams("id");


			if($request->getParams("id")){   				//update
				$category->data = $data;
				$category->save();

			}
			else{											// insert
				$category->data = $data;
				$category->save();
			}
			
		} catch (Exception $e) {
		}
		$this->redirect('grid','category',null,true);

	}

	public function deleteAction(){
		try {
			$message = Ccc::getModel('Core_Message');
			$request = $this->getRequest();
			$id = $request->getParams("id");
			$category = Ccc::getModel('Category');
			$category->load($id);
			$category->delete();

		} catch (Exception $e) {
			
		}
		$this->redirect('grid','category',null,true);
	}


}

?>