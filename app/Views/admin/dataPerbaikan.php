<?php $this->extend('layout/templateAdmin') ?>
<?php $this->section("content"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $title; ?></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?= $title; ?></a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"> Jumlah Perbaikan Absen Yang Belum disetujui </span>
                        <strong><?= $totalPerbaikanAbsen; ?></strong>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>


            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Permohonan Perbaikan Absen </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-scrool">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="tableData">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. </th>
                                            <th scope="col">Nama </th>
                                            <th scope="col">Tanggal </th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Pengajuan Perbaikan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">File</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="target">
                                        <?php

                                        if (!empty($perbaikanAbsen)) :

                                            $no = 1;
                                            foreach ($perbaikanAbsen as $perbaikan) : ?>
                                                <tr>
                                                    <td><?= $no++ ?> .</td>
                                                    <td><?= $perbaikan["name"]; ?></td>
                                                    <td><?= $perbaikan["tanggal_masuk"]; ?></td>
                                                    <td><?= $perbaikan["keterangan"]; ?></td>
                                                    <td><?= $perbaikan["pengajuanPerbaikan"]; ?></td>
                                                    <td><?= $perbaikan["status"]; ?></td>
                                                    <td><a href="/pjlp/admin/getDataImage/<?= $perbaikan["id_perbaikan"]; ?>" target="_blank">Lihat Gambar</a></td>
                                                    <?php if ($perbaikan["status"] == null) : ?>
                                                        <td><button class="btn btn-warning edit" data-id="<?= $perbaikan["id_perbaikan"]; ?> "> <i class="fa fa-edit"></i> </button></td>
                                                    <?php else :  ?>
                                                        <td><button class="btn btn-warning edit" data-id="<?= $perbaikan["id_perbaikan"]; ?>"> <i class="fa fa-edit"></i> </button></td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <tr>
                                                <td align="center" colspan="10"> Tidak Ada Data </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->
                </div>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- modal -->
<div class="modal fade" id="editPerbaikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Permohonan Perbaikan Absen</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="form">
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" id="id_perbaikan" name="id_perbaikan">
                    <input type="hidden" class="form-control" id="userid" name="userid">
                    <div class="form-group">
                        <label for="tanggal">Tanggal :</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="col-form-label">Keterangan :</label>
                        <select name="keterangan_id" id="keterangan_id" class="form-control" <?= (session('level') == 14) ? '' : 'disabled'  ?>>
                            <?php foreach ($keterangan as $keterangan) : ?>
                                <option value="<?= $keterangan["id_keterangan"]; ?>"><?= $keterangan["keterangan"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group" id="message-pengajuan">
                        <label for="pengajuanPerbaikan" class="col-form-label">Pengajuan Perbaikan Absen :</label>
                        <textarea name="pengajuanPerbaikan" id="pengajuanPerbaikan" class="form-control" cols="5" rows="3" disabled></textarea>
                        <span id="errorPengajuan" class="help-block"></span>
                    </div>
                    <div class="form-group" id="status_error">
                        <label for="status" class="col-form-label">Status :</label>
                        <select name="status" id="status" class="form-control" <?= (session('level') == 2) ? '' : 'disabled'  ?>>
                            <option value="">Silahkan Pilih</option>
                            <option value="0">menunggu persetujuan</option>
                            <option value="1">disetujui</option>
                            <option value="2">ditolak</option>
                        </select>
                        <span id="errorStatus" class="help-block"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Keluar</button>
                        <button type="submit" class="btn btn-primary update"> <i class="fa fa-arrow-right"></i> Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>

<script>
    $(".edit").click(function(e) {
        var id_perbaikan = $(this).attr('data-id');
        $.ajax({
            url: '/pjlp/admin/getPerbaikanAbsen/',
            data: {
                id_perbaikan: id_perbaikan
            },
            dataType: 'JSON',
            type: 'GET',
            success: function(response) {
                $("#id_perbaikan").val(response.id_perbaikan);
                $("#tanggal").val(response.tanggal_masuk);
                $("#userid").val(response.userid);
                $("#keterangan_id").val(response.keterangan_id);
                $("#pengajuanPerbaikan").val(response.pengajuanPerbaikan);
                $("#status").val(response.status);
                $("#editPerbaikan").modal("show");
            }
        });
    });

    $(".update").click(function(e) {
        var id_perbaikan = $("#id_perbaikan").val();
        var status = $("#status").val();
        var keterangan = $("#keterangan_id").val();
        e.preventDefault();
        $.ajax({
            url: '/pjlp/admin/updatePerbaikan/',
            data: {
                id_perbaikan: id_perbaikan,
                keterangan_id: keterangan,
                status: status
            },
            dataType: 'JSON',
            type: 'post',
            beforeSend: function() {
                $(".update").html("<i class ='fa fa-spinner fa-spin'> </i>");
                $(".update").css("cursor", "not-allowed");
            },
            success: function(response) {
                console.log(response);
                $(".update").html("<i class ='fa fa-arrow-right'> </i> Ubah Data");
                $(".update").css("cursor", "pointer");
                if (response.error) {
                    if (response.error.status) {
                        $('#status_error').addClass('has-error');
                        $('#errorStatus').html(response.error.status)
                    } else {
                        $('#status_error').removeClass('has-error');
                        $('#errorStatus').html('')
                    }
                } else {
                    Swal.fire({
                        title: `${response.success}`,
                        icon: 'success'
                    });
                    setInterval(function() {
                        $("#editPerbaikan").modal('hide');
                        document.location.reload();
                    }, 500);
                }
            }

        })
    });
</script>
<?php $this->endSection() ?>