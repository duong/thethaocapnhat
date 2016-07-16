<?php
namespace App\Controller;

use App\Controller\AppController;

class TypesController extends AppController
{
	public function index()
	{
		$categories = $this->Types->Categories->find('list')->toArray();
		$types = $this->paginate($this->Types);
		$this->set(compact('types', 'categories'));
		$this->set('__serialize', ['types']);
		//debug($categories);
	}
	public function view()
	{

	}
	public function add()
	{
		$types = $this->Types->newEntity();
        if ($this->request->is('post')) {
            $types = $this->Types->patchEntity($types, $this->request->data);
            if ($this->Types->save($types)) {
                $this->Flash->success(__('The types has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The types could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Types->Categories->find('list' , ['limit' => 200]);
        $this->set(compact('types', 'categories'));
        $this->set('_serialize', ['types']);

	}
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$type = $this->Types->get($id);
		if ($this->Types->delete($type)) {
			$this->Flash->success(__('The type has been deleted.'));
        } else {
            $this->Flash->error(__('The type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
	}
}