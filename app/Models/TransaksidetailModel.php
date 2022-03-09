<?php 
namespace App\Models;

use CodeIgniter\Model;

class TransaksidetailModel extends Model{
    protected $table      = 'detail_transaksi';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_detail_transaksi';
    protected $allowedFields = ['id_transaksi','id_menu','jumlah','harga'];
}