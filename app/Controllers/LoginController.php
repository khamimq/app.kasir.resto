<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class LoginController extends Controller{

    public function index(){
        return view('login');
    }

    public function auth(){
        $session = session();
        $user = new UserModel();
        $username = $this->request->getPost('username');
        $pass = $this->request->getPost("password");
        $data = $user->where('username',$username)->first();
        if($data){
            $password = $data['password'];
            $verif = password_verify($pass,$password);
            if($verif){
                $sesdata=[
                    'id_user' => $data['id_user'],
                    'username' => $data['username'],
                    'logged_in' =>TRUE
                ];
                $session->set($sesdata);
                return redirect('/');
            }
        }else{
            return redirect('login')->with('alert','Username atau Password Salah!');
        }
    }
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect('/');
    }
}