<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class UserController extends BaseController{
    protected $users;
    function __construct(){
        $this->users = new UserModel();
    }
    public function tampil(){
        $data['data'] = $this->users->findAll();
        return view('User', $data);
    }
    public function create(){
        $this->users->insert([
            'nama_user' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
            'level' => $this->request->getPost('level')
        ]);
        return redirect('user')->with('success', 'Data berhasil disimpan');
    }
    public function edit($id){
        $pass = $this->request->getPost('password');
        if(empty($pass)){
            $data = array('nama_user' => $this->request->getPost('nama'),
                 'username'=> $this->request->getPost('username'),
                 'level' => $this->request->getPost('level')       
                );
        }else{
            $data = array('nama_user' => $this->request->getPost('nama'),
                 'username'=> $this->request->getPost('username'),
                 'password'=> password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
                 'level' => $this->request->getPost('level')       
                );
        }
        $this->users->update($id,$data);
        return redirect('user')->with('success', 'Data berhasil di edit');
    }
    public function hapus($id){
        $this->users->delete($id);
        return redirect('user')->with('success','Data berhasil dihapus');
    }

}