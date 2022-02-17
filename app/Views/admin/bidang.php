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
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Bidang </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahBidang"><i class="fa fa-plus"></i> Tambah Bidang</button>
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
                                            <th scope="col">Nama Bidang</th>
                                            <th scope="col">Kepala Bidang</th>
                                            <th scope="col">Nip</th>
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
<div class="modal fade" id="tambahBidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Tambah Bidang</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="bidang_name" class="control-label">Bidang Name :</label>
                        <input type="text" class="form-control" id="bidang_name" name="bidang_name" placeholder="Masukan Nama Bidang Baru" required>
                    </div>
                    <div class="form-group">
                        <label for="bidang_name" class="control-label">Kepala Bidang :</label>
                        <input type="text" class="form-control" id="kepala_bidang" name="kepala_bidang" placeholder="Masukan Nama Kepala Bidang " required>
                    </div>
                    <div class="form-group">
                        <label for="bidang_name" class="control-label">Nip :</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukan Nip Kepala Bidang" required>
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
<div class="modal fade" id="editBidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Edit Bidang</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" name="id_bidang" id="id_bidang">
                        <div class="form-group">
                            <label for="bidang_name" class="control-label">Bidang Name :</label>
                            <input type="text" class="form-control" id="bidang_name_edit" name="bidang_name" placeholder="Masukan Nama Bidang Baru" required>
                        </div>
                        <div class="form-group">
                            <label for="bidang_name" class="control-label">Kepala Bidang :</label>
                            <input type="text" class="form-control" id="kepala_bidang_edit" name="kepala_bidang" placeholder="Masukan Nama Kepala Bidang " required>
                        </div>
                        <div class="form-group">
                            <label for="bidang_name" class="control-label">Nip :</label>
                            <input type="text" class="form-control" id="nip_edit" name="nip" placeholder="Masukan Nip Kepala Bidang" required>
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
<div class="modal fade" id="deleteBidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Hapus Bidang</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_bidang_delete" id="id_bidang_delete">
                    <h4 style="color: red;"> Apakah anda yakin ?</h4>
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
    function getBidangName() {
        $.ajax({
            url: '/pjlp/admin/getBidang/',
            type: 'get',
            async: true,
            dataType: 'json',
            success: function(response) {
                let row = '';
                let number = 1;
                if (response.length != 0) {
                    for (let i = 0; i < response.length; i++) {
                        row += '<tr>' +
                            '<th>' + number++ + '</th>' +
                            '<td align="center">' +
                            response[i].bidang_name + '</td>' +
                            '<td align="center">' +
                            response[i].kepala_bidang + '</td>' +
                            '<td align="center">' +
                            response[i].nip + '</td>' +
                            '<td align="center">' +
                            '<a href="javascript:; " class="btn btn-warning edit" data="' + response[i].id_bidang + '"> <i class="fa fa-pencil"> </i></a>' +
                            '<a href="javascript:;" class="btn btn-danger delete" data="' + response[i].id_bidang + '"> <i class="fa fa-trash"> </i> </a>' +
                            '</td>' +
                            '</tr>';
                    }
                } else {
                    row += '<tr>' +
                        '<td colspan="10" align="center"> Tidak Ada Data </td>' +
                        '</tr>';
                }
                $(".target").html(row);
            }
        });
    }
    $(".add").click(function(e) {
        var bidang = $('#bidang_name').val();
        var kepala_bidang = $('#kepala_bidang').val();
        var nip = $('#nip').val();
        e.preventDefault();
        $(".add").html("<i class='fa fa-spinner fa-spin '></i>");
        $(".add").css("cursor", "not-allowed");
        $.ajax({
            url: '/pjlp/admin/addBidang/',
            type: 'POST',
            dataType: 'JSON',
            data: 'bidang_name=' + bidang + '&kepala_bidang=' + kepala_bidang + '&nip=' + nip,
            success: function(response) {
                $(".add").css("cursor", "pointer");
                $(".add").html("<i class='fa fa-send'></i>Kirim");
                $('[name="bidang_name"]').val("");
                $('[name="kepala_bidang"]').val("");
                $('[name="nip"]').val("");
                $("#tambahBidang").modal('hide');
                getBidangName();
            }
        });
        return false;
    });

    // edit
    $(".target").on("click", ".edit", function(e) {
        var id_bidang = $(this).attr("data");
        $.ajax({
            url: '/pjlp/admin/getDataBidang/',
            type: 'get',
            data: 'id_bidang=' + id_bidang,
            dataType: 'json',
            success: function(response) {
                $("#editBidang").modal('show');
                $("#id_bidang").val(response.id_bidang);
                $("#bidang_name_edit").val(response.bidang_name);
                $("#kepala_bidang_edit").val(response.kepala_bidang);
                $("#nip_edit").val(response.nip);
            }
        });
        return false;
    });

    $(".update").click(function(e) {
        e.preventDefault();
        var id_bidang = $("#id_bidang").val();
        var bidang_name = $("#bidang_name_edit").val();
        var kepala_bidang = $("#kepala_bidang_edit").val();
        var nip = $("#nip_edit").val();
        $(".update").html('<i class = "fa fa-spinner fa-spin"></i>');
        $(".update").css('cursor', 'not-allowed');
        $.ajax({
            url: '/pjlp/admin/updateBidang/',
            data: 'id_bidang=' + id_bidang + '&bidang_name=' + bidang_name + '&kepala_bidang=' + kepala_bidang + '&nip=' + nip,
            dataType: 'json',
            type: 'post',
            success: function(response) {
                $(".update").html('<i class = "fa fa-send"></i> Kirim');
                $(".update").css('cursor', 'pointer');
                $("#editBidang").modal('hide');
                $("#id_bidang").val("");
                $("#bidang_name_edit").val("");
                $("#kepala_bidang_edit").val("");
                $("#nip_edit").val("");
                getBidangName();

            }
        });
        return false;
    });
    // delete modal
    $(".target").on("click", '.delete', function() {
        var id_bidang = $(this).attr("data");
        $("#deleteBidang").modal("show");
        $("#id_bidang_delete").val(id_bidang);
    });

    $(".delete").click(function(e) {
        e.preventDefault();
        var id_bidang = $("#id_bidang_delete").val();
        $(".delete").html('<i class = "fa fa-spinner fa-spin"></i>');
        $(".delete").css('cursor', 'not-allowed');
        $.ajax({
            url: '/pjlp/admin/deleteBidang/',
            data: 'id_bidang=' + id_bidang,
            dataType: 'json',
            type: 'POST',
            success: function(response) {
                $(".delete").html('<i class = "fa fa-send"></i>Delete');
                $(".delete").css('cursor', 'pointer');
                $("#deleteBidang").modal('hide');
                getBidangName();
                $("#id_bidang_delete").val("");
            }
        });
        return false;
    });
    $(document).ready(function() {
        getBidangName();

    });
</script>
<?php $this->endSection() ?>