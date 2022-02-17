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
        <!-- Info boxes -->
        <div class="row">
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
                        <h3 class="box-title">Data Gaji Anggota </h3>
                        <div class="box-tools pull-right">
                            <?php if (session('level') == 14) : ?>
                                <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#inputGaji"><i class="fa fa-plus"></i> Input Gaji </button>
                            <?php endif; ?>
                            <a href="/pjlp/admin/anggota/detail/<?= $anggota["userid"]; ?>" class="btn btn-box-tool"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-scrool">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="tableData">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. </th>
                                            <th scope="col">Gaji</th>
                                            <th scope="col">Tunjangan</th>
                                            <th scope="col">Periode Awal</th>
                                            <th scope="col">Periode Akhir</th>
                                            <th scope="col">Potongan</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="target">
                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Modal Input Gaji -->
<div class="modal fade" id="inputGaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title">Form Input Gaji</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="userid" id="userid" value="<?= $anggota["userid"]  ?>">
                    <input type="hidden" name="id_gaji" id="id_gaji">
                    <div class=" form-group" id="gaji_awal">
                        <label for="gaji" class="control-label">Gaji :</label>
                        <input type="number" class="form-control" id="gaji" name="gaji">
                        <span id="errorGaji" class="help-block"></span>
                    </div>
                    <div class="form-group" id="tunjangan_awal">
                        <label for="tunjangan" class="control-label">Tunjangan :</label>
                        <input type="number" class="form-control" id="tunjangan" name="tunjangan">
                        <span id="errorTunjangan" class="help-block"></span>
                    </div>
                    <div class="form-group" id="in">
                        <label for="periode_awal" class="control-label">Periode Awal :</label>
                        <input type="date" class="form-control" id="periode_awal" name="periode_awal">
                        <span id="errorIn" class="help-block"></span>
                    </div>
                    <div class="form-group" id="out">
                        <label for="periode_akhir" class="control-label">Periode Akhir :</label>
                        <input type="date" class="form-control" id="periode_akhir" name="periode_akhir">
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
<!-- Modal edit Gaji -->
<div class="modal fade" id="editGaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title">Form Input Gaji</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="userid" id="userid_edit" value="<?= $anggota["userid"]  ?>">
                    <input type="hidden" name="id_gaji" id="id_gaji_edit">
                    <div class=" form-group" id="gaji_awal_edit">
                        <label for="gaji_edit" class="control-label">Gaji :</label>
                        <input type="number" class="form-control" id="gaji_edit" name="gaji">
                        <span id="errorGaji_edit" class="help-block"></span>
                    </div>
                    <div class="form-group" id="tunjangan_awal_edit">
                        <label for="tunjangan_edit" class="control-label">Tunjangan :</label>
                        <input type="number" class="form-control" id="tunjangan_edit" name="tunjangan">
                        <span id="errorTunjangan_edit" class="help-block"></span>
                    </div>
                    <div class="form-group" id="in_edit">
                        <label for="periode_awal_edit" class="control-label">Periode Awal :</label>
                        <input type="date" class="form-control" id="periode_awal_edit" name="periode_awal">
                        <span id="errorIn" class="help-block"></span>
                    </div>
                    <div class="form-group" id="out_edit">
                        <label for="periode_akhir" class="control-label">Periode Akhir :</label>
                        <input type="date" class="form-control" id="periode_akhir_edit" name="periode_akhir">
                        <span id="errorOut_edit" class="help-block"></span>
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


<!-- modal hapus Jadwal -->
<div class="modal fade" id="hapusGaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Hapus Jadwal Kerja</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_gaji" id="id_gaji">
                    <h4> Apakah anda yakin ?</h4>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary delete"> <i class="fa fa-send"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        getGaji();
    });

    function getGaji() {
        $.ajax({
            url: '/pjlp/admin/getGaji/<?= $anggota["userid"]; ?>',
            dataType: 'json',
            type: 'get',
            success: function(response) {
                var table = '';
                var number = 1;
                if (response.length != 0) {
                    response.forEach(element => {
                        table += `<tr> +
                        <td> ${number++}. </td>
                        <td> ${element.gaji} </td>
                        <td> ${element.tunjangan} </td>
                        <td> ${element.periode_awal} </td>
                        <td> ${element.periode_akhir} </td>
                        <td> ${(element.potongan == null) ? '0' : `${element.potongan}` } </td>
                        <td> ${parseInt(element.gaji) + parseInt(element.tunjangan)} </td>
                        <td align="center">
                        <a href="javascript:;" class="btn btn-warning item_edit" data-id="${element.id_gaji}"> <i class="fa fa-pencil"> </i> </a>
                        <a href="javascript:;" class="btn btn-danger item_hapus" data-id="${element.id_gaji}"> <i class="fa fa-trash"> </i> </a>
                        </td>
                        </tr>`;
                    });
                } else {
                    table += `<tr> <td colspan="10" align="center"> Tidak Ada Data </td> </tr>`;
                }
                $("#target").html(table);
            }
        });
    }

    $(".add").click(function(e) {
        e.preventDefault();
        var userid = $("#userid").val();
        var gaji = $("#gaji").val();
        var tunjangan = $("#tunjangan").val();
        var periode_awal = $("#periode_awal").val();
        var periode_akhir = $("#periode_akhir").val();
        $.ajax({
            url: '/pjlp/admin/addGaji/',
            dataType: 'json',
            type: 'post',
            data: {
                userid: userid,
                gaji: gaji,
                tunjangan: tunjangan,
                periode_awal: periode_awal,
                periode_akhir: periode_akhir
            },
            beforeSend: function(e) {
                $(this).html("<i class = 'fa fa-spinner fa-spin'></i>");
                $(this).css('cursor', 'pointer');
                $(this).attr("disabled", "disabled");

            },
            cache: false,
            success: function(response) {
                if (response.error) {
                    $(".add").html("<i class='fa fa-send '></i> Kirim");
                    $(".add").css("cursor", "pointer");
                    if (response.error.gaji) {
                        $("#gaji_awal").addClass("has-error");
                        $("#errorGaji").html(response.error.gaji);
                    } else {
                        $("#gaji_awal").removeClass("has-error");
                        $("#errorGaji").html("");
                    }
                    if (response.error.tunjangan) {
                        $("#tunjangan_awal").addClass("has-error");
                        $("#errorTunjangan").html(response.error.tunjangan);
                    } else {
                        $("#tunjangan_awal").removeClass("has-error");
                        $("#errorTunjangan").html("");
                    }
                    if (response.error.periode_awal) {
                        $("#in").addClass("has-error");
                        $("#errorIn").html(response.error.periode_awal);
                    } else {
                        $("#in").removeClass("has-error");
                        $("#errorIn").html('');
                    }
                    if (response.error.periode_akhir) {
                        $("#out").addClass("has-error");
                        $("#errorOut").html(response.error.periode_akhir);
                    } else {
                        $("#out").removeClass("has-error");
                        $("#errorOut").html('');
                    }
                } else {
                    $("#inputGaji").modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                        text: 'Gaji Anggota Telah ditambahkan!'
                    });
                    setInterval(function(e) {
                        window.location.reload();
                    }, 700)
                }

            }
        });
    });

    $("#target").on('click', '.item_edit', function(e) {
        var id = $(this).attr('data-id');
        $("#editGaji").modal('show');

        $.ajax({
            url: '/pjlp/admin/editGaji/',
            dataType: 'json',
            type: 'get',
            data: {
                id_gaji: id,
            },
            success: function(response) {
                $("#id_gaji_edit").val(response.id_gaji);
                $("#userid_edit").val(response.userid);
                $("#gaji_edit").val(response.gaji);
                $("#tunjangan_edit").val(response.tunjangan);
                $("#periode_awal_edit").val(response.periode_awal);
                $("#periode_akhir_edit").val(response.periode_akhir);
            }
        });
    });

    $(".update").click(function(e) {
        e.preventDefault();
        var id_gaji = $("#id_gaji_edit").val();
        var userid = $("#userid_edit").val();
        var gaji = $("#gaji_edit").val();
        var tunjangan = $("#tunjangan_edit").val();
        var periode_awal = $("#periode_awal_edit").val();
        var periode_akhir = $("#periode_akhir_edit").val();
        $.ajax({
            url: '/pjlp/admin/updateGaji/',
            dataType: 'json',
            type: 'post',
            data: {
                id_gaji: id_gaji,
                userid: userid,
                gaji: gaji,
                tunjangan: tunjangan,
                periode_awal: periode_awal,
                periode_akhir: periode_akhir
            },
            beforeSend: function(e) {
                $(this).html("<i class = 'fa fa-spinner fa-spin'></i>");
                $(this).css('cursor', 'pointer');
                $(this).attr("disabled", "disabled");
            },
            cache: false,
            success: function(response) {
                if (response.error) {
                    $(".update").html("<i class='fa fa-send '></i> Kirim");
                    $(".update").css("cursor", "pointer");
                    if (response.error.gaji) {
                        $("#gaji_awal_edit").addClass("has-error");
                        $("#errorGaji_edit").html(response.error.gaji);
                    } else {
                        $("#gaji_awal_edit").removeClass("has-error");
                        $("#errorGaji_edit").html("");
                    }
                    if (response.error.tunjangan) {
                        $("#tunjangan_awal_edit").addClass("has-error");
                        $("#errorTunjangan_edit").html(response.error.tunjangan);
                    } else {
                        $("#tunjangan_awal_edit").removeClass("has-error");
                        $("#errorTunjangan_edit").html("");
                    }
                    if (response.error.periode_awal) {
                        $("#in_edit").addClass("has-error");
                        $("#errorIn_edit").html(response.error.periode_awal);
                    } else {
                        $("#in_edit").removeClass("has-error");
                        $("#errorIn_edit").html('');
                    }
                    if (response.error.periode_akhir) {
                        $("#out_edit").addClass("has-error");
                        $("#errorOut_edit").html(response.error.periode_akhir);
                    } else {
                        $("#out_edot").removeClass("has-error");
                        $("#errorOut_edit").html('');
                    }
                } else {
                    $("#editGaji").modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                        text: 'Gaji Anggota Telah diubah!'
                    });
                    setInterval(function(e) {
                        window.location.reload();
                    }, 700)
                }

            }
        });
    });

    $("#target").on("click", ".item_hapus", function() {
        var id = $(this).attr("data-id");
        $("#id_gaji").val(id);
        $("#hapusGaji").modal("show");
    });

    $(".delete").click(function(e) {
        e.preventDefault();
        var id = $("#id_gaji").val();
        $.ajax({
            url: '/pjlp/admin/hapusGaji/',
            data: {
                id_gaji: id
            },
            dataType: 'JSON',
            type: 'post',
            beforeSend: function(e) {
                $(".delete").html('<i class="fa fa-spinner fa-spin"></i>');
                $(".delete").css('cursor', 'not-allowed');
                $(this).attr("disabled", "disabled");
                $("#hapusGaji").modal('hide');
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`,
                    text: 'Data Jadwal Berhasil di Hapus'
                });
                setInterval(function(e) {
                    document.location.reload()
                }, 500)

            }
        });
    });

    $('#filter').change(function(e) {
        var filter = $("#filter").val();
        $.ajax({
            url: '/pjlp/admin/getGaji/<?= $anggota["userid"]; ?>',
            data: {
                filter: filter
            },
            dataType: 'json',
            type: 'GET',
            cache: false,
            success: function(response) {
                var table = '';
                var number = 1;
                if (response.length != 0) {
                    response.forEach(element => {
                        table += `<tr> +
                        <td> ${number++}. </td>
                        <td> ${element.gaji} </td>
                        <td> ${element.tunjangan} </td>
                        <td> ${element.periode_awal} </td>
                        <td> ${element.periode_akhir} </td>
                        <td> ${(element.potongan == null) ? '0' : `${element.potongan}` } </td>
                        <td> ${parseInt(element.gaji) + parseInt(element.tunjangan)} </td>
                        <td align="center">
                        <a href="javascript:;" class="btn btn-warning item_edit" data-id="${element.id_gaji}"> <i class="fa fa-pencil"></i></a>
                        <a href="javascript:;" class="btn btn-danger item_hapus" data-id="${element.id_gaji}"> <i class="fa fa-trash"> </i> </a>
                        </td>
                        </tr>`;
                    });
                } else {
                    table += `<tr> <td colspan="10" align="center"> Tidak Ada Data </td> </tr>`;
                }
                $("#target").html(table);
            }
        });
    })
</script>
<?php $this->endSection() ?>