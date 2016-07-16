<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
* 
*/
class MenuController extends AppController
{
	public function index()
	{
		$menu = TableRegistry::get('categories');

		// Start a new query.
		$list = $menu->find('all')
			->select(['id', 'name'])
			->order(['created' => 'DESC'])
			->limit(16);
			$this->set('list', $list);
			//debug($list);
	}
	
}