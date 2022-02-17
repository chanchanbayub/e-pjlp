<?php

use phpDocumentor\Reflection\Types\Null_;

$this->extend('layout/templateAdmin') ?>
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
                    <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"> Jumlah Surat Peringatan </span>
                        <strong><?= $totalPeringatan;; ?></strong>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Surat Peringatan </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool add" data-toggle="modal" data-target="#tambahSurat"><i class="fa fa-plus"></i> </button>
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
                                            <th scope="col">Nama </th>
                                            <th scope="col">Tanggal </th>
                                            <th scope="col">Pelanggaran</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="target">
                                        <?php
                                        $number = 1;
                                        if (!empty($suratPeringatan)) :
                                            foreach ($suratPeringatan as $sp) :
                                        ?>
                                                <tr>
                                                    <td><?= $number++; ?> .</td>
                                                    <td><a href=""><?= $sp["name"]; ?></a></td>
                                                    <td><?= $sp["tanggal"]; ?></td>
                                                    <td><?= $sp["pelanggaran"]; ?></td>
                                                    <td><?= ($sp["nilai"] == null) ? '' : "SP " . $sp["nilai"]  ?></td>
                                                    <td align="center">
                                                        <button type="button" class="btn btn-warning edit" data="<?= $sp["id_peringatan"]; ?>"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger delete" data="<?= $sp["id_peringatan"]; ?>"><i class=" fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="10" align="center">Tidak Ada Data</td>
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
<div class="modal fade" id="tambahSurat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="titleModal">Kirim Surat Peringatan!</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_peringatan" id="id_peringatan">
                    <div class="form-group" id="nama">
                        <label for="userid">Nama :</label>
                        <select name="userid" id="userid" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($anggota as $anggota) : ?>
                                <option value="<?= $anggota["userid"]; ?>"><?= $anggota["name"]; ?></option>
                            <?php endforeach;  ?>
                        </select>
                        <span id="errorUserid" class="help-block"></span>
                    </div>
                    <div class="form-group" id="date">
                        <label for="tanggal">Tanggal :</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                        <span id="errorTanggal" class="help-block"></span>
                    </div>
                    <div class="form-group" id="message-pelanggaran">
                        <label for="pelanggaran" class="col-form-label">Pelanggaran :</label>
                        <textarea name="pelanggaran" id="pelanggaran" class="form-control" cols="5" rows="3"></textarea>
                        <span id="errorPelanggaran" class="help-block"></span>
                    </div>
                    <div class=" form-group">
                        <label for="nilai">Ketarangan :</label>
                        <select name="nilai" id="nilai" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <option value="1">SP 1</option>
                            <option value="2">SP 2</option>
                            <option value="3">SP 3</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Keluar</button>
                        <button type="submit" class="btn btn-primary kirim "> <i class="fa fa-arrow-right"></i> Kirim </button>
                        <button type="submit" class="btn btn-primary update "> <i class="fa fa-arrow-right"></i> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- delete -->
<div class="modal fade" id="deletePeringatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Hapus Surat Peringatan</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_peringatan" id="id_peringatan_delete">
                    <h4> Apakah anda yakin ?</h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-danger deleteData"> <i class="fa fa-send"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>

<script>
    $(".add").click(function(e) {
        // Inputan
        $("#userid").val("");
        $("#tanggal").val("");
        $("#pelanggaran").val("");
        $("#nilai").val("");
        // Button
        $(".update").css("display", "none");
        $(".update").attr("disabled", "disabled");
        $(".kirim").removeAttr('disabled', 'disabled');
        $(".kirim").css("display", "inline-block");
        $(".kirim").html('<i class="fa fa-arrow-right"> </i> Kirim');
        // Title
        $("#titleModal").html("Kirim Surat Peringatan!");
        // Validation
        $("#nama").removeClass("has-error");
        $("#errorUserid").html("");
        $("#date").removeClass("has-error");
        $("#errorTanggal").html("");
        $("#message-pelanggaran").removeClass("has-error");
        $("#errorPelanggaran").html("");

    })

    $(".kirim").click(function(e) {
        e.preventDefault();
        var userid = $("#userid").val();
        var tanggal = $("#tanggal").val();
        var pelanggaran = $("#pelanggaran").val();
        var nilai = $("#nilai").val();

        $.ajax({
            url: '/pjlp/admin/addSurat/',
            data: {
                userid: userid,
                tanggal: tanggal,
                pelanggaran: pelanggaran,
                nilai: nilai
            },
            dataType: 'JSON',
            type: 'POST',
            beforeSend: function() {
                $(".kirim").html("<i class ='fa fa-spinner fa-spin'> </i>");
                $(".kirim").css("cursor", "not-allowed");
            },
            success: function(response) {

                $(".kirim").html("<i class ='fa fa-send'> </i> Kirim");
                $(".kirim").css("cursor", "pointer");
                if (response.error) {
                    if (response.error.userid) {
                        $("#nama").addClass("has-error");
                        $("#errorUserid").html(response.error.userid);
                    } else {
                        $("#nama").removeClass("has-error");
                        $("#errorUserid").html("");
                    }
                    if (response.error.tanggal) {
                        $("#date").addClass("has-error");
                        $("#errorTanggal").html(response.error.tanggal);
                    } else {
                        $("#date").removeClass("has-error");
                        $("#errorTanggal").html("");
                    }
                    if (response.error.pelanggaran) {
                        $("#message-pelanggaran").addClass("has-error");
                        $("#errorPelanggaran").html(response.error.pelanggaran);
                    } else {
                        $("#message-pelanggaran").removeClass("has-error");
                        $("#errorPelanggaran").html("");
                    }

                } else {
                    $("#tambahSurat").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setInterval(function() {
                        document.location.reload();
                    }, 500)
                }
            }
        });
    });

    $(".edit").click(function(e) {
        e.preventDefault();
        $("#tambahSurat").modal("show");
        $("#titleModal").html("Edit Surat Peringatan!");
        // Button
        $(".kirim").css("display", "none");
        $(".kirim").attr("disabled", "disabled");
        $(".update").css("display", "inline-block");
        $(".update").html('<i class="fa fa-arrow-right"> </i> Update');
        $(".update").removeAttr('disabled', 'disabled');

        var id = $(this).attr("data");
        $.ajax({
            url: '/pjlp/admin/editSurat/',
            data: {
                id_peringatan: id
            },
            dataType: 'JSON',
            success: function(response) {
                $("#id_peringatan").val(response.id_peringatan);
                $("#userid").val(response.userid);
                $("#tanggal").val(response.tanggal);
                $("#pelanggaran").val(response.pelanggaran);
                $("#nilai").val(response.nilai);
            }
        });
    });

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id_peringatan").val();
        var userid = $("#userid").val();
        var tanggal = $("#tanggal").val();
        var pelanggaran = $("#pelanggaran").val();
        var nilai = $("#nilai").val();

        $.ajax({
            url: '/pjlp/admin/updateSurat/',
            type: 'POST',
            data: {
                id_peringatan: id,
                userid: userid,
                tanggal: tanggal,
                pelanggaran: pelanggaran,
                nilai: nilai
            },
            dataType: 'JSON',
            beforeSend: function() {
                $(".update").html("<i class ='fa fa-spinner fa-spin'> </i>");
                $(".update").css("cursor", "not-allowed");
            },
            success: function(response) {
                $("#tambahSurat").modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setInterval(function() {
                    document.location.reload()
                }, 500)
            }
        });
    });

    $(".delete").click(function(e) {
        $("#deletePeringatan").modal("show");
        var id = $(this).attr("data");
        $.ajax({
            url: '/pjlp/admin/editSurat/',
            data: {
                id_peringatan: id
            },
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                $("#id_peringatan_delete").val(response.id_peringatan);
            }
        });
    })

    $(".deleteData").click(function(e) {
        var id_peringatan = $("#id_peringatan_delete").val();
        e.preventDefault();
        $.ajax({
            url: '/pjlp/admin/delete/',
            type: 'post',
            dataType: 'json',
            data: {
                id_peringatan: id_peringatan
            },
            beforeSend: function() {
                $(".deleteData").html("<i class ='fa fa-spinner fa-spin'> </i>");
                $(".deleteData").css("cursor", "not-allowed");
            },
            success: function(response) {
                $(".deleteData").html("<i class ='fa fa-send'> </i> Delete");
                $(".deleteDat").css("cursor", "pointer");
                $("#deletePeringatan").modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setInterval(function() {
                    document.location.reload();
                }, 500);
            }
        });
    })
</script>
<?php $this->endSection() ?>