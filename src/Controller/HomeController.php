<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
* 
*/
class HomeController extends AppController
{
	public function index()
	{
		$this->viewBuilder()->layout('home');
		
		$news = TableRegistry::get('News');

		// Start a new query.
		$hotNews = $news->find('all')
			->select(['id', 'title', 'description', 'image', 'created'])
			->order(['created' => 'DESC'])
			->limit(16)->toArray();
		$latestNews = array_shift($hotNews);
		$chunkData = array_chunk($hotNews, 10);
		//debug($chunkData[0]);
		$this->set('latestNews', $latestNews);
		$this->set('chunkData', $chunkData);

		$menu = TableRegistry::get('categories');

		// Start a new query.
		$list = $menu->find('all')
			->select(['name'])
			->order(['id' => 'ASC'])
			->limit(16)->toArray();
			$this->set('list', $list);
			//debug($list);
		
	}
	public function view($id = null)
	{
		$this->viewBuilder()->layout('view');
		$new = $this->News = TableRegistry::get($id);
		$this->set('new', $new);
		debug($new);
	}
}