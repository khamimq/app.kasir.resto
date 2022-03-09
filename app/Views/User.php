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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser" data-user="">
                    <i class="fa fa-plus"></i> Tambah User
                </button>
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
                        $aksi = base_url('user');
                        $no=0;
                            foreach($data as $key=>$val){
                                $no++;
                                $row = $val['id_user'].",".$val['nama_user'].",".$val['username'].",".$val['level'].",".base_url('user/edit/'.$val['id_user']);
                                ?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?=$val['nama_user']?></td>
                            <td><?=$val['username']?></td>
                            <td><?=$val['level']?></td>
                            <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#addUser" data-user="<?=$row?>"><i class="fa fa-edit"></i> Edit</a>
                                <a href="<?=base_url('user/hapus/'.$val['id_user']);?>" class="btn btn-danger"
                                    onclick="return confirm('Yakin akan dihapus?');"><i class="fa fa-trash"></i>
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
<div class="modal fade" id="addUser" tabindex="-1" aria-hidden="true" aria-labelledby="useradd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="useradd">Add Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmuser" action="<?= base_url('user')?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="level">Hak Akses</label>
                        <select name="level" id="level" class="form-control">
                            <option value="">==pilih hak akses==</option>
                            <option value="manager">manager</option>
                            <option value="admin">admin</option>
                            <option value="kasir">kasir</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fa fa-arrow-left"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?php $this->section('scripts')?>
<script>
    $(document).ready(function () {
        $('#addUser').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var row = button.data('user');
            if (row == "") {
                $("#nama").val("");
                $("#username").val("");
                $("#password").val("");
                $("#level").val("");
                $("#frmuser").attr('action', '<?=$aksi;?>');
            } else {
                const rowarr = row.split(",");
                $("#nama").val(rowarr[1]);
                $("#username").val(rowarr[2]);
                $("#password").val("");
                $("#level").val(rowarr[3]);
                $("#frmuser").attr('action', rowarr[4]);
            }
        });
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 4000);
    })
</script>

<?php $this->endSection()?>