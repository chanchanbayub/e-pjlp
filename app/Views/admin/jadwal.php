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
                        <h3 class="box-title">Jadwal Kerja <?= $anggota["name"]; ?> </h3>
                        <div class="box-tools pull-right">
                            <?php if (session('level') == 14) : ?>
                                <button type="button" class="btn btn-box-tool inputJadwal" data-toggle="modal" data-target="#inputJadwal"><i class="fa fa-plus"></i> Input Jadwal </button>
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
                                            <th scope="col">Tanggal Masuk</th>
                                            <th scope="col">Tanggal Pulang</th>
                                            <th scope="col">Shift</th>
                                            <?php if (session('level') == 14) : ?>
                                                <th scope="col">Aksi</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody id="target">
                                        <?php $no = 1 + (10 * ($currentPage - 1));
                                        if (!empty($jadwal)) :
                                            foreach ($jadwal as $jadwal) : ?>
                                                <tr>
                                                    <td><?= $no++ ?>.</td>
                                                    <td><?= $jadwal["tanggal_masuk"] ?></td>
                                                    <td><?= $jadwal["tanggal_pulang"] ?></td>
                                                    <td><?= $jadwal["shift_name"] ?></td>
                                                    <td align="center">
                                                        <button class="btn btn-warning item_edit" data-id="<?= $jadwal["id_jadwal"]; ?>"> <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger item_hapus" data-id="<?= $jadwal["id_jadwal"]; ?>"> <i class="fa fa-trash"></i>
                                                        </button>
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
                                <?= $pager->simpleLinks(); ?>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Modal Jadwal Kerja -->
<div class="modal fade" id="inputJadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titleModal">Form Input Jadwal Kerja</h4>
            </div>
            <div class="modal-body">
                <form id="form_jadwal">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_jadwal" id="id_jadwal">
                    <input type="hidden" name="userid" id="userid" value="<?= $anggota["userid"]  ?>">
                    <div class="form-group" id="in">
                        <label for="tanggal_masuk" class="control-label">Tanggal Masuk :</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk ">
                        <span id="errorIn" class="help-block"></span>
                    </div>
                    <div class="form-group" id="out">
                        <label for="tanggal_pulang" class="control-label">Tanggal Pulang :</label>
                        <input type="date" class="form-control" id="tanggal_pulang" name="tanggal_pulang">
                        <span id="errorOut" class="help-block"></span>
                    </div>
                    <div class="form-group" id="shift">
                        <label for="shift_id">Shift :</label>
                        <select class="form-control" id="shift_id" name="shift_id">
                            <option value=""> &laquo; Silahkan Pilih &raquo; </option>
                            <!-- get Shift -->
                            <?php foreach ($shift as $shift) : ?>
                                <option value="<?= $shift["id_shift"]; ?>"> <?= $shift["shift_name"]; ?> </option>
                            <?php endforeach ?>
                        </select>
                        <span id="errorShift" class="help-block"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary add"> <i class="fa fa-send"></i> Kirim</button>
                        <button type="submit" class="btn btn-primary update"> <i class="fa fa-send"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- modal hapus Jadwal -->
<div class="modal fade" id="hapusJadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titleModal">Form Hapus Jadwal Kerja</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_jadwal" id="id_jadwal_edit">
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
        getJadwal();
    });

    // function getJadwal() {
    //     $.ajax({
    //         url: '/pjlp/admin/getJadwal/<?= $anggota["userid"]; ?>',
    //         dataType: 'json',
    //         type: 'get',
    //         success: function(response) {
    //             var table = '';
    //             var number = 1;
    //             if (response.length != 0) {
    //                 response.forEach(element => {
    //                     table += `<tr> +
    //                         <td>  ${number++}.  </td> 
    //                         <td>  ${element.tanggal_masuk} </td> 
    //                         <td>  ${element.tanggal_pulang} </td> 
    //                         <td>  ${element.shift_name}  </td> 
    //                         <?php if (session('Privilege') == 14) : ?>
    //                         <td align="center">     
    //                         <a href="javascript:;" class="btn btn-warning item_edit" data-id="${element.id_jadwal}"> <i class="fa fa-pencil"> </i> </a> 
    //                         <a href="javascript:;" class="btn btn-danger item_hapus" data-id="${element.id_jadwal}"> <i class="fa fa-trash"> </i> </a> 
    //                         </td>
    //                         <?php endif; ?> 
    //                         </tr>`;
    //                 });
    //             } else {
    //                 table += '<tr>' + '<td colspan="10" align="center"> Tidak Ada Data </td>' + '</tr>';
    //             }
    //             $("#target").html(table);
    //         }
    //     });
    // }

    $('.add').click(function(e) {
        e.preventDefault();
        var userid = $("#userid").val();
        var tanggal_masuk = $("#tanggal_masuk").val();
        var tanggal_pulang = $("#tanggal_pulang").val();
        var shift_id = $("#shift_id").val();

        $.ajax({
            url: '/pjlp/admin/addJadwal/',
            data: {
                userid: userid,
                tanggal_masuk: tanggal_masuk,
                tanggal_pulang: tanggal_pulang,
                shift_id: shift_id
            },
            dataType: 'JSON',
            type: 'POST',
            beforeSend: function(e) {
                $(".add").html("<i class='fa fa-spinner fa-spin '></i>");
                $(".add").css("cursor", "not-allowed");
            },
            success: function(response) {
                $(".add").html("<i class='fa fa-send '></i> Kirim");
                $(".add").css("cursor", "pointer");
                if (response.error) {
                    if (response.error.tanggal_masuk) {
                        $("#in").addClass("has-error");
                        $("#errorIn").html(response.error.tanggal_masuk);
                    } else {
                        $("#in").removeClass("has-error");
                        $("#errorIn").html("");
                    }
                    if (response.error.tanggal_pulang) {
                        $("#out").addClass("has-error");
                        $("#errorOut").html(response.error.tanggal_pulang);
                    } else {
                        $("#out").removeClass("has-error");
                        $("#errorOut").html("");
                    }
                    if (response.error.shift_id) {
                        $("#shift").addClass("has-error");
                        $("#errorShift").html(response.error.shift_id);
                    } else {
                        $("#shift").removeClass("has-error");
                        $("#errorShift").html(response.error.shift_id);
                    }
                } else {
                    $("#inputJadwal").modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                        text: 'Jadwal Telah ditambahkan!'
                    });
                    setInterval(function(e) {
                        window.location.reload();
                    }, 700)
                }

            }
        });
    });

    $(".inputJadwal").click(function(e) {
        $(".add").removeAttr('disabled', 'disabled');
        $(".add").css('display', 'inline-block');
        $(".update").attr('disabled', 'disabled');
        $(".update").css('display', 'none');
        $("#titleModal").html('Input Jadwal Kerja');
        $("#id_jadwal").val("");
        $("#tanggal_masuk").val("");
        $("#tanggal_pulang").val("");
        $("#shift_id").val("");
    });

    $("#target").on('click', '.item_edit', function() {
        var id_jadwal = $(this).attr('data-id');
        $("#titleModal").html('Edit Jadwal Kerja');
        $(".add").attr('disabled', 'disabled');
        $(".add").css('display', 'none');
        $(".update").removeAttr('disabled', 'disabled');
        $(".update").css('display', 'inline-block');
        $.ajax({
            url: '/pjlp/admin/editJadwal/',
            data: {
                id_jadwal: id_jadwal
            },
            dataType: 'JSON',
            success: function(response) {
                $("#inputJadwal").modal('show');
                $("#id_jadwal").val(response.id_jadwal);
                $("#userid").val(response.userid);
                $("#tanggal_masuk").val(response.tanggal_masuk);
                $("#tanggal_pulang").val(response.tanggal_pulang);
                $("#shift_id").val(response.shift_id);
            }
        });
    });

    $(".update").click(function(e) {
        e.preventDefault();
        var id_jadwal = $("#id_jadwal").val();
        var userid = $("#userid").val();
        var tanggal_masuk = $("#tanggal_masuk").val();
        var tanggal_pulang = $("#tanggal_pulang").val();
        var shift_id = $("#shift_id").val();

        $.ajax({
            url: '/pjlp/admin/updateJadwal/',
            data: {
                id_jadwal: id_jadwal,
                userid: userid,
                tanggal_masuk: tanggal_masuk,
                tanggal_pulang: tanggal_pulang,
                shift_id: shift_id
            },
            dataType: 'JSON',
            type: 'POST',
            beforeSend: function() {
                $(".update").html("<i class='fa fa-spinner fa-spin '></i>");
                $(".update").css("cursor", "not-allowed");
            },
            success: function(response) {
                $(".update").html("<i class='fa fa-send '></i> Kirim");
                $(".update").css("cursor", "pointer");
                $("#inputJadwal").modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`,
                });
                setInterval(function(e) {
                    window.location.reload();
                }, 700);
            }
        })
    })

    $("#target").on("click", ".item_hapus", function() {
        var id = $(this).attr("data-id");
        $("#id_jadwal_edit").val(id);
        $("#hapusJadwal").modal("show");

    });

    $(".delete").click(function(e) {
        e.preventDefault();
        var id = $("#id_jadwal_edit").val();
        $.ajax({
            url: '/pjlp/admin/hapusJadwal/',
            data: {
                id_jadwal: id
            },
            dataType: 'JSON',
            type: 'post',
            beforeSend: function(e) {
                $(".delete").html('<i class="fa fa-spinner fa-spin"></i>');
                $(".delete").css('cursor', 'not-allowed');
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
            url: '/pjlp/admin/getJadwal/<?= $anggota["userid"]; ?>',
            data: 'filter=' + filter,
            dataType: 'json',
            type: 'GET',
            cache: false,
            success: function(response) {
                var table = '';
                var number = 1;
                if (response.length != 0) {
                    response.forEach(element => {
                        table += `<tr> +
                            <td>  ${number++}.  </td> 
                            <td>  ${element.tanggal_masuk} </td> 
                            <td>  ${element.tanggal_pulang} </td> 
                            <td>  ${element.shift_name}  </td> 
                            <td align="center"> 
                            <a href="javascript:;" class="btn btn-danger item_hapus" data-id="${element.id_jadwal}"> <i class="fa fa-trash"> </i> </a> 
                            </td> 
                            </tr>`;
                    });
                } else {
                    table += `<tr> 
                            <td colspan="10" align="center"> Tidak Ada Data </td>
                        </tr>`;
                }
                $("#target").html(table);
            }
        });
    })
</script>
<?php $this->endSection() ?>