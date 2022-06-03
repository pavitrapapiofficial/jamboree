<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\JbModel;
  
class Registration extends Controller
{
    public function index(){
        helper(['form']);
        $data = [];
        echo view('registration', $data);
    }
  
    public function saveuser(){
        helper(['form']);
        $creationrules = [
            'name'          => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];
          
        // if($this->validate($creationrules)){
            $model = new JbModel();
            $data = [
                'user_name'     => $this->request->getVar('name'),
                'user_email'    => $this->request->getVar('email'),
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('http://localhost:8080/login');
        // }else{
        //     $data['validation'] = $this->validator;
        //     // echo "<pre>";
        //     // print_r($data);
        //     echo view('registration', $data);
        // }
    }
  
}