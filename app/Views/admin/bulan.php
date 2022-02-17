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
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Bulan PJLP </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahBulan"><i class="fa fa-plus"></i> Tambah Bulan</button>
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
                                            <th scope="col">ID Bulan</th>
                                            <th scope="col">Nama Bulan</th>
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
<div class="modal fade" id="tambahBulan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Tambah Bulan</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" id="id_shift" name="id_shift">
                    <div class="form-group" id="number">
                        <label for="number_date" class="control-label">Number Bulan :</label>
                        <input type="number" class="form-control" id="number_date" name="number_date" placeholder="cth: 01" required>
                        <span id="errorNumber" class="help-block"></span>
                    </div>
                    <div class="form-group" id="name">
                        <label for="name_bulan" class="control-label">Nama Bulan :</label>
                        <input type="text" class="form-control" id="name_bulan" name="name_bulan" placeholder="cth:january" required>
                        <span id="errorName" class="help-block"></span>
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

<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        getBulanName();
    });

    function getBulanName() {
        $.ajax({
            url: '/pjlp/admin/getBulan/',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let row = '';
                let number = 1;
                if (response.length > 0) {
                    response.forEach(element => {
                        row += `<tr>
                            <td> ${number++} </td>
                            <td> ${element.number_date} </td>
                            <td> ${element.name_bulan} </td>
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

        var number = $("#number_date").val();
        var bulan = $("#name_bulan").val();
        $.ajax({
            url: '/pjlp/admin/addBulan/',
            type: 'POST',
            dataType: 'json',
            data: {
                number_date: number,
                name_bulan: bulan
            },
            beforeSend: function(e) {
                $(".add").html("<i class ='fa fa-spinner fa-spin'> </i>");
                $(".add").css("cursor", "not-allowed");
            },
            success: function(response) {
                $(".add").html("<i class ='fa fa-send '> </i> Kirim");
                $(".add").css("cursor", "pointer");
                if (response.error) {
                    if (response.error.number_date) {
                        $("#number").addClass('has-error');
                        $("#errorNumber").html(response.error.number_date);
                    } else {
                        $("#number").removeClass('has-error');
                        $("#errorNumber").html('');
                    }
                    if (response.error.name_bulan) {
                        $("#name").addClass('has-error');
                        $("#errorName").html(response.error.name_bulan);
                    } else {
                        $("#name").removeClass('has-error');
                        $("#errorName").html('');
                    }
                } else {
                    $("#tambahBulan").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setInterval(function(e) {
                        window.location.reload();
                    }, 1000)
                }
            }
        });
    });
</script>
<?php $this->endSection() ?>