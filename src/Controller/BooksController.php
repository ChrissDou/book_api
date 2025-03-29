<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\BadRequestException;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 */
class BooksController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()
            ->setClassName('Json')
            ->setOption('serialize', true);
        
        $this->response = $this->response->withType('application/json');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Books->find();
        $books = $this->paginate($query);
        
        $this->set([
            'success' => true,
            'data' => $books,
            '_serialize' => ['success', 'data']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $book = $this->Books->get($id, contain: []);
        
        $this->set([
            'success' => true,
            'data' => $book,
            '_serialize' => ['success', 'data']
        ]);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $book = $this->Books->newEmptyEntity();
        $book = $this->Books->patchEntity($book, $this->request->getData());
        
        if ($this->Books->save($book)) {
            $this->set([
                'success' => true,
                'data' => $book,
                '_serialize' => ['success', 'data']
            ]);
            return;
        }
        
        $this->response = $this->response->withStatus(400);
        $this->set([
            'success' => false,
            'data' => [
                'message' => 'The book could not be saved',
                'errors' => $book->getErrors()
            ],
            '_serialize' => ['success', 'data']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['put', 'patch']);
        $book = $this->Books->get($id, contain: []);
        $book = $this->Books->patchEntity($book, $this->request->getData());
        
        if ($this->Books->save($book)) {
            $this->set([
                'success' => true,
                'message' => 'Book updated successfully',
                'data' => $book,
                '_serialize' => ['success', 'message', 'data']
            ]);
            
            return;
        }

        $this->response = $this->response->withStatus(400);
        $this->set([
            'success' => false,
            'data' => [
                'message' => 'The book could not be saved',
                'errors' => $book->getErrors()
            ],
            '_serialize' => ['success', 'data']
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $book = $this->Books->get($id);
        
        if ($this->Books->delete($book)) {
            $this->set([
                'success' => true,
                'data' => null,
                '_serialize' => ['success', 'data']
            ]);
            return;
        }

        $this->response = $this->response->withStatus(400);
        $this->set([
            'success' => false,
            'data' => [
                'message' => 'The book could not be deleted'
            ],
            '_serialize' => ['success', 'data']
        ]);
    }
}
