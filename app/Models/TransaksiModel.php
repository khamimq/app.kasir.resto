<?php 
namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model{
    protected $table      = 'transaksi';
    
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $primaryKey = 'id_transaksi';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['tanggal','id_user','status','no_meja','nama_pelanggan'];
 public function getLaporan(){
     $query = $this->db->table('transaksi a')
            ->select('tanggal,no_meja,nama_pelanggan')
            ->join('detail_transaksi b', 'a.id_transaksi = b.id_transaksi')
            ->get();
    return $query;
 }
}