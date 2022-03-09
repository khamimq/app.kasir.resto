<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    protected $table      = 'user';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['nama_user','username','password','level'];
}