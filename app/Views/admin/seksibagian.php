<?php $this->extend('layout/templateAdmin') ?>
<?php $this->section("content"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?= $title; ?> </h1>
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
                    <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"> Jumlah Data Seksi Bagian </span>
                        <strong><?= $total; ?></strong>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Seksi Bagian </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahSeksi"><i class="fa fa-plus"></i> Tambah Seksi</button>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-scrool">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="tableData">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. </th>
                                            <th scope="col">Seksi Bagian</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="target">

                                    </tbody>
                                </table>

                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Modal Add New Bidang -->
<div class="modal fade" id="tambahSeksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Tambah Seksi</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <div class="form-group" id="seksi">
                        <label for="seksi_bagian" class="control-label">Seksi Name :</label>
                        <input type="text" class="form-control" id="seksi_bagian" name="seksi_bagian" placeholder="Masukan Nama Seksi Baru" required>
                        <span id="errorSeksi" class="help-block"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary add"> <i class="fa fa-send"></i> Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Bidang -->
<div class="modal fade" id="editSeksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Edit Seksi</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" name="id_seksi" id="id_seksi">
                        <div class="form-group" id="seksi_edit">
                            <label for="seksi_bagian_edit" class="control-label">Seksi Name :</label>
                            <input type="text" class="form-control" id="seksi_bagian_edit" name="seksi_bagian_edit" placeholder="Masukan Nama Seksi Baru" required>
                            <span id="errorSeksi_edit" class="help-block"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary update"> <i class="fa fa-send"></i> Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- delete -->
<div class="modal fade" id="deleteSeksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Hapus Seksi</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_seksi" id="id_seksi_delete">
                    <h4> Apakah anda yakin ?</h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-danger delete"> <i class="fa fa-send"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        getDataSeksi();
    });

    function getDataSeksi() {
        $.ajax({
            url: '/pjlp/admin/getDataSeksi/',
            type: 'get',
            dataType: 'json',
            success: function(response) {
                let row = '';
                let number = 1;
                if (response.length > 0) {
                    response.forEach(element => {
                        row += `<tr> 
                            <th> ${number++} </th> 
                            <td>${element.seksi_bagian}</td> 
                            <td align="center"> 
                            <a href="javascript:; " class="btn btn-warning edit" data="${element.id_seksi}"> <i class="fa fa-pencil"> </i></a> 
                            <a href="javascript:;" class="btn btn-danger delete" data="${element.id_seksi}"> <i class="fa fa-trash"> </i> </a> 
                            </td> 
                            </tr>`;
                    });

                } else {
                    row += `<tr>
                        <td align="center" colspan="10"> Tidak Ada Data  </td> 
                    </tr>`;
                }
                $(".target").html(row);
            }
        });
    }

    $(".add").click(function(e) {
        var seksi_bagian = $('#seksi_bagian').val();
        e.preventDefault();
        $.ajax({
            url: '/pjlp/admin/addSeksi/',
            type: 'POST',
            dataType: 'JSON',
            data: {
                seksi_bagian: seksi_bagian
            },
            beforeSend: function() {
                $(".add").html("<i class='fa fa-spinner fa-spin '></i>");
                $(".add").css("cursor", "not-allowed");
            },
            success: function(response) {
                $(".add").html('<i class = "fa fa-send"></i> Kirim');
                $(".add").css('cursor', 'pointer');
                if (response.error) {
                    if (response.error.seksi_bagian) {
                        $("#seksi").addClass('has-error');
                        $("#errorSeksi").html(response.error.seksi_bagian)
                    } else {
                        $("#seksi").removeClass('has-error');
                        $("#errorSeksi").html('');
                    }
                } else {
                    $("#tambahSeksi").modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setInterval(function() {
                        document.location.reload();
                    }, 700);
                }
            }
        });
    });

    // // edit
    $(".target").on("click", ".edit", function(e) {
        var id_seksi = $(this).attr("data");
        $.ajax({
            url: '/pjlp/admin/getRowSeksi/',
            type: 'GET',
            data: {
                id_seksi: id_seksi
            },
            dataType: 'json',
            success: function(response) {
                $("#editSeksi").modal('show');
                $("#id_seksi").val(response.id_seksi);
                $("#seksi_bagian_edit").val(response.seksi_bagian);
            }
        });
    });

    $(".update").click(function(e) {
        e.preventDefault();
        var id_seksi = $("#id_seksi").val();
        var seksi_bagian = $("#seksi_bagian_edit").val();

        $.ajax({
            url: '/pjlp/admin/updateSeksi/',
            dataType: 'json',
            type: 'post',
            data: {
                id_seksi: id_seksi,
                seksi_bagian: seksi_bagian
            },
            beforeSend: function(e) {
                $(".update").html('<i class = "fa fa-spinner fa-spin"></i>');
                $(".update").css('cursor', 'not-allowed');
            },
            success: function(response) {
                $(".update").html('<i class = "fa fa-send"></i> Kirim');
                $(".update").css('cursor', 'pointer');
                if (response.error) {
                    if (response.error.seksi_bagian) {
                        $("#seksi_edit").addClass('has-error');
                        $("#errorSeksi_edit").html(response.error.seksi_bagian)
                    } else {
                        $("#seksi_edit").removeClass('has-error');
                        $("#errorSeksi_edit").html('');
                    }
                } else {
                    $("#editSeksi").modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setInterval(function() {
                        document.location.reload();
                    }, 700);
                }
            }
        });
    });

    // delete modal
    $(".target").on("click", '.delete', function() {
        var id_seksi = $(this).attr("data");
        $("#deleteSeksi").modal("show");
        $("#id_seksi_delete").val(id_seksi);
    });

    $(".delete").click(function(e) {
        e.preventDefault();
        var id_seksi = $("#id_seksi_delete").val();

        $.ajax({
            url: '/pjlp/admin/deleteSeksi/',
            dataType: 'json',
            type: 'POST',
            data: {
                id_seksi: id_seksi
            },
            beforeSend: function(e) {
                $(".delete").html('<i class = "fa fa-spinner fa-spin"></i>');
                $(".delete").css('cursor', 'not-allowed');
            },
            success: function(response) {
                $("#deleteSeksi").modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setInterval(function() {
                    document.location.reload();
                }, 700);
            }
        });
    });
</script>
<?php $this->endSection() ?>