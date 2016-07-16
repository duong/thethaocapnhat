<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BookmarksTags Controller
 *
 * @property \App\Model\Table\BookmarksTagsTable $BookmarksTags
 */
class BookmarksTagsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bookmarks', 'Tags']
        ];
        $bookmarksTags = $this->paginate($this->BookmarksTags);

        $this->set(compact('bookmarksTags'));
        $this->set('_serialize', ['bookmarksTags']);
    }

    /**
     * View method
     *
     * @param string|null $id Bookmarks Tag id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookmarksTag = $this->BookmarksTags->get($id, [
            'contain' => ['Bookmarks', 'Tags']
        ]);

        $this->set('bookmarksTag', $bookmarksTag);
        $this->set('_serialize', ['bookmarksTag']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bookmarksTag = $this->BookmarksTags->newEntity();
        if ($this->request->is('post')) {
            $bookmarksTag = $this->BookmarksTags->patchEntity($bookmarksTag, $this->request->data);
            if ($this->BookmarksTags->save($bookmarksTag)) {
                $this->Flash->success(__('The bookmarks tag has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The bookmarks tag could not be saved. Please, try again.'));
            }
        }
        $bookmarks = $this->BookmarksTags->Bookmarks->find('list', ['limit' => 200]);
        $tags = $this->BookmarksTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('bookmarksTag', 'bookmarks', 'tags'));
        $this->set('_serialize', ['bookmarksTag']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Bookmarks Tag id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookmarksTag = $this->BookmarksTags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookmarksTag = $this->BookmarksTags->patchEntity($bookmarksTag, $this->request->data);
            if ($this->BookmarksTags->save($bookmarksTag)) {
                $this->Flash->success(__('The bookmarks tag has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The bookmarks tag could not be saved. Please, try again.'));
            }
        }
        $bookmarks = $this->BookmarksTags->Bookmarks->find('list', ['limit' => 200]);
        $tags = $this->BookmarksTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('bookmarksTag', 'bookmarks', 'tags'));
        $this->set('_serialize', ['bookmarksTag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Bookmarks Tag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookmarksTag = $this->BookmarksTags->get($id);
        if ($this->BookmarksTags->delete($bookmarksTag)) {
            $this->Flash->success(__('The bookmarks tag has been deleted.'));
        } else {
            $this->Flash->error(__('The bookmarks tag could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
