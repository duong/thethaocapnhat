<?php
namespace App\Controller\Admin;

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
		$this->paginate = ['contain' => ['Categories']];
		$news = $this->paginate($this->News);
		//echo '<pre>'; print_r($this->News);die;

		$this->set(compact('news'));
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

		$this->set(compact('new', 'categories'));
		$this->set('_serialize',['new']);

	}
	public function edit($id = null){
		$new = $this->News->get($id, ['contain']);
		if ($this->request->is(['patch', 'post', 'put'])){
			$new = $this->News->patchEntity($new, $this->request->data);
			if($this->News->save($new)){
				$this->Flash->success(__('The new has been saved.'));
				return $this->redirect(['action' => 'index']);
			}else {
				$this->Flash->errror(__('The new could not be saved. Please, try again.'));
			}
		}
		$category = $this->News->Categories->find('list', ['limit' => 200]);
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
}