<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

use App\Controller\AppController;
/**
* 
*/
class NewsController extends AppController
{
	
	public function initialize()
	{
	    parent::initialize();
	    
	    //Set the layout
	    //$this->viewBuilder()->layout('home');
	}
	public function index()
	{

		//debug($this->News->find('list')->last());
		$categories = $this->News->Categories->find('list')->toArray();
		$key = !empty($this->request->query['key']) ? $this->request->query['key'] : '';
		//debug($this->request);
		//debug($this->request);
		$this->paginate = ['contain' => ['Categories']];
		$news = $this->paginate($this->News);
		//echo '<pre>'; print_r($this->News);die;

		//debug($categories);

		$con=[];
		if(!empty($key)) {
			$con['News.category_Id LIKE'] = '%' . $key . '%';

		}
		

		$this->paginate = [
            // 'sortWhitelist' => ['ContractorDetails.company_name', 'ProjectTypes.name', 'Users.name', 'Users.id', 'Users.phone', 'Users.deleted', 'Users.probationary'],
            //'contain' => ['ContractorDetails.ProjectTypes'],
            'conditions' => $con,
            //'order' => ['Users.id' => 'desc'],
            'limit' => 10,
        ];
        $news = $this->paginate($this->News);



		$this->set(compact('news', 'categories'));
		$this->set('_serialize',['news']);
	}

	public function view($id = null){
		$new = $this->News->get($id, [ 'contain' => ['Categories'] ]);

		$this->set('new', $new);
		$this->set('_serialize', ['new']);

	}
	
	public function add(){
		$new = $this->News->newEntity();
		if($this->request->is('post')) {

			$new = $this->News->patchEntity($new, $this->request->data);
			if($this->News->save($new)) {
				$this->Flash->success(__('The new has been saved.'));
				return $this->redirect(['action' => 'index']);
			}else{
				$this->Flash->error(__('The new could not be saved. Please, try again.'));
			}
		}
		//echo '<pre>'; print_r($new);die;
		$categories = $this->News->Categories->find('list' , ['limit' => 200]);

		// debug($categories);

		$this->set(compact('new', 'categories'));
		$this->set('_serialize',['new']);

	}
	public function edit($id = null){
		$new = $this->News->get($id, ['contain']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $new = $this->News->patchEntity($new, $this->request->data);
            if ($this->News->save($new)) {
                $this->Flash->success(__('The news has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The news could not be saved. Please, try again.'));
            }
        }
        $categories = $this->News->Categories->find('list', ['limit' => 200]);
        $this->set(compact('new', 'categories'));
        $this->set('_serialize', ['new']);
	}
	public function delete( $id = null){
		$this->request->allowMethod(['post', 'delete']);
		$new = $this->News->get($id);
		if ($this->News->delete($new)) {
			$this->Flash->success(__('The new has been deleted.'));
        } else {
            $this->Flash->error(__('The new could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
	}

	public function ajax() {
		$types = TableRegistry::get('Types');
		$category_id = $this->request->data ['category_id'];
		
		$type = $types->find('list')
				->where(['category_id' =>$category_id])
				->toArray();
		$this->set('type', $type);

		// $options = '
		// 	<option value="0">test ' . $category_id . '</option>
		// 	<option value="0">test 1</option>
		// 	<option value="0">test 1</option>
		// 	<option value="0">test 1</option>
		// ';
		// /die($options);
	}
}