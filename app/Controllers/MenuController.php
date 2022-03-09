<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class MenuController extends Controller{

    public function tampil(){
        return view('dashboard');
    }

}