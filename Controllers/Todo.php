<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\TodosModel;
  
class Todo extends Controller
{
    public function index(){
        helper(['form']);
        echo view('create');
    } 
  
    public function create(){
        $todoModel = new TodosModel();
        $data = [
            'title' => $this->request->getVar('title'),
            'description'  => $this->request->getVar('description'),
            'todo_status'  => $this->request->getVar('todo_status'),
        ];
        $todoModel->save($data);
        return $this->response->redirect('http://localhost:8080/todo/list');
    }

    public function filter(){
        $date1 = $this->request->getVar('startdate');
        $date2 = $this->request->getVar('enddate');
        
        $todoModel = new TodosModel();
        $todoModel->where('created_at >=', $date1);
        $todoModel->where('created_at <=', $date2);
        $data['datas'] = $todoModel->findAll();
        // echo "<pre>";
        // print_r($data);
        // die;
        return view('list', $data);
    }

    public function list(){
        $todoModel = new TodosModel();
        $data['datas'] = $todoModel->orderBy('id', 'DESC')->findAll();
        return view('list', $data);
    } 

    public function edit($id = null){
        $todoModel = new TodosModel();
        $data['data'] = $todoModel->where('id', $id)->first();
        return view('edit', $data);
    }

    public function update()
    {
        $todoModel = new TodosModel();
        $id = $this->request->getVar('id');
        $data = [
            'title' => $this->request->getVar('title'),
            'description'  => $this->request->getVar('description'),
            'todo_status'  => $this->request->getVar('todo_status'),
        ];
        $todoModel->update($id, $data);
        return $this->response->redirect('http://localhost:8080/todo/list');
    }

    public function delete($id = null){
        $todoModel = new TodosModel();
        $data['todo'] = $todoModel->where('id', $id)->delete($id);
        return $this->response->redirect('http://localhost:8080/todo/list');
    }
  
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('http://localhost:8080/login');
    }
} 