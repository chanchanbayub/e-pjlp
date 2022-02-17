<?php $this->extend('layout/template') ?>
<?php $this->section("content"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?>
            <small>Version 0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?= $title; ?></a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12 ">
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"> Jumlah Perbaikan Absen </span>
                                <strong><?= $totalPerbaikan; ?></strong>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div>
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"> Jumlah Pengajuan Perbaikan </span>
                                <strong><?= $totalPengajuan; ?></strong>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div>
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"> Jumlah Perbaikan Sukses</span>
                                <strong><?= $totalSukses; ?></strong>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div>
                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-md-4 ">
                        <form>
                            <select name="filter" id="filter" class="form-control">
                                <option value="">
                                    Filter Berdasarkan Bulan
                                </option>
                                <?php foreach ($bulan as $month) : ?>
                                    <option value="<?= $month["number_date"]; ?>"><?= $month["name_bulan"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                        <br>
                    </div>
                    <div class="col-md-12">
                        <div class="box">

                            <div class="box-header with-border">
                                <h3 class="box-title">Permohonan Perbaikan Absen </h3>
                                <div class="box-tools pull-right">
                                    <a href="/pjlp/absensi/cetakPDFPerbaikan/<?= session('userid'); ?>" target="_blank" class="btn btn-box-tool"> <i class="fa fa-files-o"></i> Cetak Bukti Perbaikan</a>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-scrool">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id="tableData">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No. </th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="target">

                                                <?php $number = 1 + (10 * ($currentPage - 1)); ?>
                                                <?php if (!empty($perbaikanAbsen)) :
                                                    foreach ($perbaikanAbsen as $perbaikan) :  ?>
                                                        <tr>
                                                            <td><?= $number++; ?>.</td>
                                                            <td><?= $perbaikan["tanggal_masuk"]; ?></td>
                                                            <td><?= $perbaikan["keterangan"]; ?></td>
                                                            <td><button class="btn btn-primary sendData" data-id="<?= $perbaikan["id_perbaikan"]; ?>" <?= ($perbaikan["pengajuanPerbaikan"] == null ? ' ' : 'disabled'); ?>> <i class="fa fa-check"></i> </button> </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <td colspan="10" align="center"> Tidak Ada Data</td>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <?= $pager->simpleLinks(); ?>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- ./box-body -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- modal -->
<div class="modal fade" id="addPerbaikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" class="form-control " id="keterangan_id" name="keterangan_id" required disabled>
                    </div>
                    <div class="form-group" id="message-pengajuan">
                        <label for="pengajuanPerbaikan" class="col-form-label">Pengajuan Perbaikan Absen :</label>
                        <textarea name="pengajuanPerbaikan" id="pengajuanPerbaikan" class="form-control" cols="5" rows="3"></textarea>
                        <span id="errorPengajuan" class="help-block"></span>
                    </div>
                    <div class="form-group" id="message-file">
                        <label for="file" class="col-form-label">Upload Bukti :</label>
                        <input type="file" class="form-control" id="file" name="file">
                        <span id="errorFile" class="help-block"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Keluar</button>
                        <button type="submit" class="btn btn-primary update"> <i class="fa fa-arrow-right"></i> Ajukan Permohonan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    $("#filter").change(function(e) {
        e.preventDefault();
        var filter = $("#filter").val();
        $.ajax({
            url: '/pjlp/absensi/getPerbaikanAbsen/<?= session("userid"); ?>',
            dataType: 'json',
            type: 'get',
            cache: false,
            data: {
                filter: filter
            },
            success: function(response) {
                var table = '';
                var no = 1;
                if (response.perbaikanAbsen.length > 0) {
                    response.perbaikanAbsen.forEach(element => {
                        table += `<tr>
                         <td> ${no++}. </td>
                         <td> ${element.tanggal_masuk} </td>
                         <td> ${element.keterangan} </td>
                         <td> <button class="btn btn-primary sendData" data-id="${element.id_perbaikan}" ${element.pengajuanPerbaikan==null ? '' : 'disabled' }> <i class="fa fa-check"></i> </button> </td>
                        </tr>`;
                    });
                    $("#target").html(table);
                } else {
                    table += `<tr>
                        <td align="center" colspan="10"> Tidak Ada Data </td>
                        </tr>`;
                    $("#target").html(table);
                }
            }

        });
    });

    $("#target").on("click", ".sendData", function() {
        var id = $(this).attr("data-id");
        $.ajax({
            cache: false,
            url: '/pjlp/absensi/getId/',
            dataType: 'json',
            data: {
                id_perbaikan: id
            },
            type: 'get',
            success: function(response) {
                $("#id_perbaikan").val(response.id_perbaikan);
                $("#userid").val(response.userid);
                $("#tanggal").val(response.tanggal_masuk);
                $("#keterangan_id").val(response.keterangan);
                $("#addPerbaikan").modal("show");
            }
        });
    });

    $("#form").submit(function(e) {
        e.preventDefault();
        var id = $("#id_perbaikan").val();
        var userid = $("#userid").val();
        var pengajuanPerbaikan = $("#pengajuanPerbaikan").val();
        var file = $("#file").val();

        var data = new FormData(this);
        data.append('id_perbaikan', id);
        data.append('userid', userid);
        data.append('pengajuanPerbaikan', pengajuanPerbaikan);
        data.append('file', file);
        $.ajax({
            url: '/pjlp/absensi/savePerbaikan/',
            dataType: 'json',
            enctype: 'multipart/form-data',
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response.file);
                if (response.error) {
                    if (response.error.pengajuanPerbaikan) {
                        $('#message-pengajuan').addClass('has-error');
                        $('#errorPengajuan').html(response.error.pengajuanPerbaikan);
                    } else {
                        $('#message-pengajuan').removeClass('has-error');
                        $('#errorPengajuan').html("");
                    }
                    if (response.error.file) {
                        $('#message-file').addClass('has-error');
                        $('#errorFile').html(response.error.file);
                    } else {
                        $('#message-file').removeClass('has-error');
                        $('#errorFile').html("");
                    }

                } else if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setInterval(function() {
                        window.location.reload();
                    }, 700)

                    // getPerbaikan();
                }
            }

        });
    })

    // $(document).ready(function() {
    // getPerbaikan();
    // $.ajaxSetup({
    // cache: true
    // });
    // // window.location.reload();
    // });
</script>
<?php $this->endSection() ?>