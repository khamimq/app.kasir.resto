<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TransaksiModel;
use App\Models\TransaksidetailModel;
use App\Models\MenuModel;
class TransaksiController extends Controller{
    protected $builder,$session,$transaksi,$detail;
    function __construct(){
        $db      = \Config\Database::connect();
        $this->builder = $db->table('menu');
        $this->session = session();
        $this->transaksi = new TransaksiModel();
        $this->detail = new TransaksidetailModel();
    }

    public function index()
    {
        # code...
        $this->builder->select('id_menu,nama_menu');
        $row = $this->builder->get();
        $data['data'] = $row->getResult();
        if(session('cart')!=null){
            $data['menu'] = array_values(session('cart'));
        }else{
            $data['menu'] =null;
        }
        return view('Transaksi',$data);
    }
    public function addCart(){
        $id = $this->request->getPost('idmenu');
        $jumlah = $this->request->getPost('jumlah');
           $menus = new MenuModel();
            $menu = $menus->find($id);
            $isi = array(
                'id_menu'=>$id,
                'nama_menu'=>$menu['nama_menu'],
                'harga'=>$menu['harga'],
                'jumlah'=>$jumlah
            );
            if($this->session->has('cart')){
                $index = $this->cek($id);
                $cart = array_values(session('cart'));
                if($index == -1){
                    array_push($cart,$isi);
                }else{
                    $cart[$index]['jumlah'] += $jumlah;
                }
                $this->session->set('cart', $cart);
            }else{
                $this->session->set('cart', array($isi));
            }

            return redirect('trans')->with('success', 'Data berhasil disimpan');
    }

    public function hapusCart($id){
        $index = $this->cek($id);
        $cart = array_values(session('cart'));
        unset($cart[$index]);
        $this->session->set('cart', $cart);
        return redirect('trans')->with('success', 'Data berhasil dihapus');
    }

    private function cek($id){
        $cart = array_values(session('cart'));
        for($i=0;$i<count($cart);$i++){
            if($cart[$i]['id_menu']==$id){
                return $i;
            }
        }
        return -1;
    }

    public function simpan(){
        if(session('cart') !=null){
            $datatrans = array(
                'tanggal'=>date('Y/m/d H:i:s'),
                'id_user'=>$this->session->get('id_user'),
                'no_meja'=>$this->request->getPost('nomeja'),
                'nama_pelanggan'=>$this->request->getPost('nama')
            );
            $id = $this->transaksi->insert($datatrans);
            $cart = array_values(session('cart'));
            foreach($cart as $val){
                $datadetail = array(
                    'id_transaksi'=>$id,
                    'id_menu'=>$val['id_menu'],
                    'jumlah'=>$val['jumlah'],
                    'harga'=>$val['harga']
                );
                $this->detail->insert($datadetail);               
            }
            $this->session->remove('cart');
            return redirect('trans')->with('success', 'Data berhasil disimpan');
        }
    }
    public function laporan(){
        $data['rekap'] = $this->transaksi->getLaporan()->getResult();
        return view('laporan',$data);
    }
}