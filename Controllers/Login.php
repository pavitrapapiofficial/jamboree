<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\JbModel;
  
class Login extends Controller
{
    public function index(){
        helper(['form']);
        echo view('login');
    } 
  
    public function auth(){
        $session = session();
        $model = new JbModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('user_email', $email)->first();
        if($data){
            $pwd = $data['user_password'];
            $cnfpass = password_verify($password, $pwd);
            if($cnfpass){
                $setsession = [
                    'user_id'       => $data['user_id'],
                    'user_name'     => $data['user_name'],
                    'user_email'    => $data['user_email'],
                    'logged_in'     => TRUE
                ];
                $session->set($setsession);
                return $this->response->redirect('http://localhost:8080/dashboard');
            }else{
                $session->setFlashdata('msg', 'Password did not matched');
                return redirect()->to('http://localhost:8080/login');
            }
        }else{
            $session->setFlashdata('msg', 'Email is not registered with us.');
            return redirect()->to('http://localhost:8080/login');
        }
    }
  
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('http://localhost:8080/login');
    }
} 