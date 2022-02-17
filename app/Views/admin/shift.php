<?php $this->extend('layout/templateAdmin') ?>
<?php $this->section("content"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?>
        </h1>
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
                        <h3 class="box-title">Data Shift Kerja </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahShift"><i class="fa fa-plus"></i> Tambah Shift</button>
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
                                            <th scope="col">Nama Shift</th>
                                            <th scope="col">Shift Masuk</th>
                                            <th scope="col">Shift Pulang </th>
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
<!-- MODAl Tambah -->
<div class="modal fade" id="tambahShift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Tambah Shift</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" id="id_shift" name="id_shift">
                    <div class="form-group" id="name">
                        <label for="shift_name" class="control-label">Shift Name :</label>
                        <input type="text" class="form-control" id="shift_name" name="shift_name" placeholder="Masukan Shift Kerja Baru" required>
                        <span id="errorName" class="help-block"></span>
                    </div>
                    <div class="form-group" id="in">
                        <label for="shift_masuk" class="control-label">Shift Masuk :</label>
                        <input type="time" class="form-control" id="shift_masuk" name="shift_masuk" required>
                        <span id="errorIn" class="help-block"></span>
                    </div>
                    <div class="form-group" id="out">
                        <label for="shift_pulang" class="control-label">Shift Pulang :</label>
                        <input type="time" class="form-control" id="shift_pulang" name="shift_pulang" required>
                        <span id="errorOut" class="help-block"></span>
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
<!-- modal Update -->
<div class="modal fade" id="editShift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Edit Data Shift</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" id="id_shift_edit" name="id_shift">
                    <div class="form-group" id="name_edit">
                        <label for="shift_name" class="control-label">Shift Name :</label>
                        <input type="text" class="form-control" id="shift_name_edit" name="shift_name" placeholder="Masukan Shift Kerja Baru" required>
                        <span id="errorNameEdit" class="help-block"></span>
                    </div>
                    <div class="form-group" id="in_edit">
                        <label for="shift_masuk" class="control-label">Shift Masuk :</label>
                        <input type="time" class="form-control" id="shift_masuk_edit" name="shift_masuk" required>
                        <span id="errorInEdit" class="help-block"></span>
                    </div>
                    <div class="form-group" id="out_edit">
                        <label for="shift_pulang" class="control-label">Shift Pulang :</label>
                        <input type="time" class="form-control" id="shift_pulang_edit" name="shift_pulang" required>
                        <span id="errorOutEdit" class="help-block"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary update"> <i class="fa fa-send"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal Hapus -->
<div class="modal fade" id="hapusShift" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Hapus Data Shift</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" id="id_shift_delete" name="id_shift">
                    <h4 style="color: red;"> Apakah anda yakin ? </h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary delete"> <i class="fa fa-send"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    function getShiftName() {
        $.ajax({
            url: '/pjlp/admin/getShift/',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let row = '';
                let number = 1;
                if (response.length > 0) {
                    response.forEach(element => {
                        row += ` <tr> 
                            <th> ${number++}  </th>  
                            <td> ${element.shift_name}  </td>  
                            <td> ${element.shift_masuk}  </td>  
                            <td> ${element.shift_pulang}  </td>  
                            <td align="center">
                                <button type="button" class="btn btn-warning item_edit" data-id="${element.id_shift}"> <i class="fa fa-pencil"></i> </button> 
                                <button type="button" class="btn btn-danger item_hapus" data-id="${element.id_shift}"> <i class="fa fa-trash"></i> </button> 
                            </td>
                            </tr>`;
                    });
                } else {
                    row += `<tr> 
                        <td colspan = "10" align="center"> Tidak ada data </td> 
                        </tr>`;
                }
                $(".target").html(row);
            }
        });
    }
    $(".add").click(function(e) {
        e.preventDefault();
        var shift = $("#shift_name").val();
        var masuk = $("#shift_masuk").val();
        var pulang = $("#shift_pulang").val();
        $.ajax({
            url: '/pjlp/admin/addShift/',
            type: 'POST',
            dataType: 'json',
            data: {
                shift_name: shift,
                shift_masuk: masuk,
                shift_pulang: pulang
            },
            beforeSend: function(e) {
                $(".add").html("<i class ='fa fa-spinner fa-spin'> </i>");
                $(".add").css("cursor", "not-allowed");
            },
            success: function(response) {
                if (response.error) {
                    $(".add").html("<i class ='fa fa-send'> Kirim </i>");
                    $(".add").css("cursor", "pointer");
                    if (response.error.shift_name) {
                        $("#name").addClass('has-error');
                        $("#errorName").html(response.error.shift_name);
                    } else {
                        $("#name").removeClass('has-error');
                        $("#errorName").html('');
                    }
                    if (response.error.shift_masuk) {
                        $("#in").addClass('has-error');
                        $("#errorIn").html(response.error.shift_masuk);
                    } else {
                        $("#in").removeClass('has-error');
                        $("#errorIn").html('');
                    }
                    if (response.error.shift_pulang) {
                        $("#out").addClass('has-error');
                        $("#errorOut").html(response.error.shift_pulang);
                    } else {
                        $("#out").removeClass('has-error');
                        $("#errorOut").html('');
                    }
                } else {
                    $("#tambahShift").modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                    });
                    setInterval(function() {
                        window.location.reload();
                    }, 1000);
                }
            }
        });
    });

    $(".target").on('click', '.item_edit', function() {
        var id_shift = $(this).attr("data-id");
        $.ajax({
            url: '/pjlp/admin/getDataShift/',
            type: 'GET',
            data: {
                id_shift: id_shift
            },
            dataType: 'JSON',
            success: function(data) {
                $("#editShift").modal('show');
                $('#id_shift_edit').val("" + data.id_shift);
                $('#shift_name_edit').val("" + data.shift_name);
                $('#shift_masuk_edit').val("" + data.shift_masuk);
                $('#shift_pulang_edit').val("" + data.shift_pulang);
            }
        });

        return false;
    });

    $('.update').click(function(e) {
        e.preventDefault();
        var id_shift = $("#id_shift_edit").val();
        var shift_name = $("#shift_name_edit").val();
        var shift_masuk = $("#shift_masuk_edit").val();
        var shift_pulang = $("#shift_pulang_edit").val();
        $.ajax({
            url: '/pjlp/admin/updateShift/',
            dataType: 'json',
            type: 'POST',
            data: {
                id_shift: id_shift,
                shift_name: shift_name,
                shift_masuk: shift_masuk,
                shift_pulang: shift_pulang
            },
            beforeSend: function(e) {
                $(".update").html('<i class = "fa fa-spinner fa-spin"></i>');
                $(".update").css('cursor', 'not-allowed');
            },
            success: function(response) {
                if (response.error) {
                    $(".update").html("<i class ='fa fa-send'> Kirim </i>");
                    $(".update").css("cursor", "pointer");
                    if (response.error.shift_name) {
                        $("#name_edit").addClass('has-error');
                        $("#errorNameEdit").html(response.error.shift_name);
                    } else {
                        $("#name_edit").removeClass('has-error');
                        $("#errorNameEdit").html('');
                    }
                    if (response.error.shift_masuk) {
                        $("#in_edit").addClass('has-error');
                        $("#errorInEdit").html(response.error.shift_masuk);
                    } else {
                        $("#in_edit").removeClass('has-error');
                        $("#errorInEdit").html('');
                    }
                    if (response.error.shift_pulang) {
                        $("#out_edit").addClass('has-error');
                        $("#errorOutEdit").html(response.error.shift_pulang);
                    } else {
                        $("#out_edit").removeClass('has-error');
                        $("#errorOutEdit").html('');
                    }
                } else {
                    $("#editShift").modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                    });
                    setInterval(function() {
                        window.location.reload();
                    }, 1000);
                }
            }
        });
    });

    $(".target").on('click', '.item_hapus', function(e) {
        e.preventDefault();
        var id_shift = $(this).attr("data-id");
        $("#hapusShift").modal('show');
        $('#id_shift_delete').val(id_shift);
    });

    $(".delete").click(function(e) {
        e.preventDefault();
        var id_shift = $("#id_shift_delete").val();
        $.ajax({
            url: '/pjlp/admin/deleteShift/',
            data: 'id_shift=' + id_shift,
            dataType: 'json',
            type: 'POST',
            beforeSend: function(e) {
                $(".delete").html('<i class = "fa fa-spinner fa-spin"></i>');
                $(".delete").css('cursor', 'not-allowed');
            },
            success: function(response) {
                $('#hapusShift').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Dihapus!'
                });
                setInterval(function(e) {
                    window.location.reload();
                }, 1000);
            }
        });

    });

    $(document).ready(function() {
        getShiftName();
    });
</script>
<?php $this->endSection() ?>