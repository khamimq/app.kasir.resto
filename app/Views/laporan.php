<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
    </div>
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
    <!-- Content Row -->
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser" data-user="">
                    <i class="fa fa-plus"></i> Tambah User
                </button> -->
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped tabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=0;
                            foreach($rekap as $val){
                                $no++;
                                // $row = $val['id_user'].",".$val['nama_user'].",".$val['username'].",".$val['level'].",".base_url('user/edit/'.$val['id_user']);
                                ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$val['tanggal']?></td>
                            <td><?=$val['nama_pelanggan']?></td>
                            <td><?=$val['no_meja']?></td>
                            <td><a href="#" class="btn btn-warning" ><i class="fa fa-edit"></i> Edit</a>
                                <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i>
                                    Hapus</a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
</div>


<?= $this->endSection() ?>
<?php $this->section('scripts')?>


<?php $this->endSection()?>