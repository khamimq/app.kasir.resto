<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
        <?php
        if(session()->getFlashData('success')){
        ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
        }
        ?>
    </div>
    
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-3 border-left-primary">
                <div class="card-body">
                    <form class="form" action="<?= base_url('trans');?>" method="post">
                        <div class="form-group">
                            <label for="idmenu">Menu</label>
                            <select name="idmenu" id="idmenu" class="form-control" required>
                                <option value="">==pilih menu==</option>
                                <?php
                            
                                foreach($data as $id => $val){
                                    ?>
                                <option value="<?= $val->id_menu?>"><?=$val->nama_menu?></option>
                                <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right" type="submit">Tambah</button>
                            <button type="reset" class="btn btn-secondary float-right mx-2">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-left-primary">
                <div class="card-body">
                    <form action="/trans/save" method="post">
                        <div class="form-group">
                            <label for="nama">Nama Pelanggan</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nomeja">Nomor Meja</label>
                            <input type="number" name="nomeja" id="nomeja" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success float-right" <?=$menu!=null?"":"disabled"?>>Simpan</button>
                            <button type="reset" class="btn btn-secondary float-right mx-2">Batalkan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow mb-3 border-left-primary">
        <div class="card-body">
            <table class="table table-bordered table-striped tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            if($menu != null){
                                $no=0;
                                foreach($menu as $val){
                                    $no++;
                                    $namamenu = $val['nama_menu'];
                            ?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$val['nama_menu']?></td>
                        <td><?=$val['jumlah']?></td>
                        <td><?=$val['harga']?></td>
                        <td><?=$val['harga']*$val['jumlah']?></td>
                        <td><a href="trans/hapus/<?=$val['id_menu']?>" class="btn btn-danger btn-circle btn-sm"
                                onclick="return confirm('yakin akan menghapus <?=$namamenu?> ?');"><i
                                    class="fa fa-trash"></i></a></td>
                    </tr>
                    <?php
                                }
                            }
                            ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?php $this->section('scripts')?>
<script>
    $(document).ready(function () {
        $('select').select2({
            'placeholder': 'please select'
        });
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 500);
    });
</script>

<?php $this->endSection()?>