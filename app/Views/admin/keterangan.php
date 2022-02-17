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
                    <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"> Jumlah Data Keterangan </span>
                        <strong><?= $totalKeterangan; ?></strong>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Keterangan </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool add" data-toggle="modal" data-target="#tambahKeterangan"><i class="fa fa-plus"></i> </button>
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
                                            <th scope="col">Keterangan </th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="target">
                                        <?php
                                        $number = 1;
                                        if (!empty($keterangan)) :
                                            foreach ($keterangan as $keterangan) :
                                        ?>
                                                <tr>
                                                    <td><?= $number++; ?> .</td>
                                                    <td><?= $keterangan["keterangan"]; ?></td>
                                                    <td align="center">
                                                        <button type="button" class="btn btn-warning edit" data="<?= $keterangan["id_keterangan"]; ?>"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger delete" data="<?= $keterangan["id_keterangan"]; ?>"><i class=" fa fa-trash"></i></button>
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

                                <?= $pager->links(); ?>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->
                </div>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- modal -->
<div class="modal fade" id="tambahKeterangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="titleModal">Form Tambah Keterangan</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_keterangan" id="id_keterangan">
                    <div class="form-group" id="data-keterangan">
                        <label for="keterangan">Keterangan :</label>
                        <input type="keterangan" name="keterangan" id="keterangan" class="form-control">
                        <span id="errorKeterangan" class="help-block"></span>
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
<div class="modal fade" id="deleteKeterangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Hapus Surat Peringatan</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_keterangan" id="id_keterangan_delete">
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
        $("#keterangan").val("");

        // Button
        $(".update").css("display", "none");
        $(".update").attr("disabled", "disabled");
        $(".kirim").removeAttr('disabled', 'disabled');
        $(".kirim").css("display", "inline-block");
        $(".kirim").html('<i class="fa fa-arrow-right"> </i> Kirim');
        // Title
        $("#titleModal").html("Form Tambah Keterangan!");
        // Validation
        $("#data-keterangan").removeClass("has-error");


    })

    $(".kirim").click(function(e) {
        e.preventDefault();
        var keterangan = $("#keterangan").val();

        $.ajax({
            url: '/pjlp/admin/aadKeterangan/',
            data: {
                keterangan: keterangan,
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
                    if (response.error.keterangan) {
                        $("#data-keterangan").addClass("has-error");
                        $("#errorKeterangan").html(response.error.keterangan);
                    } else {
                        $("#data-keterangan").removeClass("has-error");
                        $("#errorKeterangan").html("");
                    }

                } else {
                    $("#tambahKeterangan").modal("hide");
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
        $("#tambahKeterangan").modal("show");
        $("#titleModal").html("Edit Keterangan!");
        // Button
        $(".kirim").css("display", "none");
        $(".kirim").attr("disabled", "disabled");
        $(".update").css("display", "inline-block");
        $(".update").html('<i class="fa fa-arrow-right"> </i> Update');
        $(".update").removeAttr('disabled', 'disabled');

        var id = $(this).attr("data");
        $.ajax({
            url: '/pjlp/admin/editKeterangan/',
            data: {
                id_keterangan: id
            },
            dataType: 'JSON',
            success: function(response) {
                $("#id_keterangan").val(response.id_keterangan);
                $("#keterangan").val(response.keterangan);
            }
        });
    });

    $(".update").click(function(e) {
        e.preventDefault();
        var id = $("#id_keterangan").val();
        var keterangan = $("#keterangan").val();
        $.ajax({
            url: '/pjlp/admin/updateKeterangan/',
            type: 'POST',
            data: {
                id_keterangan: id,
                keterangan: keterangan,
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
        $("#deleteKeterangan").modal("show");
        var id = $(this).attr("data");
        $.ajax({
            url: '/pjlp/admin/editKeterangan/',
            data: {
                id_keterangan: id
            },
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                $("#id_keterangan_delete").val(response.id_keterangan);
            }
        });
    })

    $(".deleteData").click(function(e) {
        var id_keterangan = $("#id_keterangan_delete").val();
        e.preventDefault();
        $.ajax({
            url: '/pjlp/admin/deleteKeterangan/',
            type: 'post',
            dataType: 'json',
            data: {
                id_keterangan: id_keterangan
            },
            beforeSend: function() {
                $(".deleteData").html("<i class ='fa fa-spinner fa-spin'> </i>");
                $(".deleteData").css("cursor", "not-allowed");
            },
            success: function(response) {
                $(".deleteData").html("<i class ='fa fa-send'> </i> Delete");
                $(".deleteData").css("cursor", "pointer");
                $("#deleteKeterangan").modal('hide');
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