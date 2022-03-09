<?php 
namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model{
    protected $table      = 'menu';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_menu';
    protected $allowedField = ['nama_menu','harga','stok'];
}