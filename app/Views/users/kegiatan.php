<?= $this->extend("layout/template"); ?>
<?= $this->section("content"); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kinerja
            <small>Version 0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-edit"></i> <?= $title; ?> </a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-4">
                <form>
                    <select name="filter" id="filter" class="form-control">
                        <option value="">
                            Filter Berdasarkan Bulan
                        </option>
                        <?php foreach ($bulan as $bulan) : ?>
                            <option value="<?= $bulan["number_date"]; ?>"> <?= $bulan["name_bulan"]; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </form>
                <br>
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
        </div><!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="btn-wrapper ">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addKegiatan" data-whatever="@getbootstrap"> <i class="fa fa-plus"></i> Tambah Kinerja</button>
                        <?php if (!empty($kegiatan)) : ?>
                            <a href="/pjlp/kegiatanKinerja/cetakPDF/<?= session("userid"); ?>" class="btn btn-primary pdf"> <i class="fa fa-files-o"></i> Cetak PDF</a>
                        <?php endif; ?>
                    </div>
                    <div class="box-body table-scrool">
                        <div class="row">
                            <div class="col-md-12 view-Kegiatan ">
                                <table class="table table-bordered" id="tableData">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Kegiatan</th>
                                            <th scope="col">Jadwal Kegiatan</th>
                                            <th scope="col">Jam Pelaksanaan</th>
                                            <th scope="col">Jam Selesai</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>

                                    <tbody id="target">
                                        <?php $number = 1 + (10 * ($currentPage - 1)); ?>
                                        <?php if (!empty($kegiatan)) :
                                            foreach ($kegiatan as $kegiatan) : ?>
                                                <tr>
                                                    <td><?= $number++; ?>.</td>
                                                    <td><?= $kegiatan["kegiatan"]; ?></td>
                                                    <td><?= $kegiatan["tanggal"]; ?></td>
                                                    <td><?= $kegiatan["jam"]; ?></td>
                                                    <td><?= $kegiatan["selesai"]; ?></td>
                                                    <?php if ($kegiatan["status"] == null) : ?>
                                                        <td>sedang dievaluasi</td>
                                                    <?php else : ?>
                                                        <td><?= $kegiatan["status"]; ?></td>
                                                    <?php endif; ?>
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
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- ./box-body -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- modal -->
<div class="modal fade" id="addKegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Tambah Kegiatan Kinerja</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" class="form-control" id="userid" name="userid" value="<?= session('userid'); ?>">
                    <div class="form-group" id="kegiatan-data">
                        <label for="kegiatan" class="col-form-label">Kegiatan :</label>
                        <textarea class="form-control" id="kegiatan" name="kegiatan" required></textarea>
                        <span id="errorKegiatan" class="help-block"></span>
                    </div>
                    <div class="form-group" id="tanggal-data">
                        <label for="tanggal">Tanggal Kegiatan:</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        <span id="errorTanggal" class="help-block"></span>
                    </div>
                    <div class="form-group" id="jam-data">
                        <label for="jam" class="col-form-label">Jam Kegiatan :</label>
                        <input type="time" class="form-control" id="jam" name="jam" required>
                        <span id="errorJam" class="help-block"></span>
                    </div>
                    <div class="form-group" id="selesai-data">
                        <label for="selesai" class="col-form-label">Jam Selesai :</label>
                        <input type="time" class="form-control" id="selesai" name="selesai" required>
                        <span id="errorSelesai" class="help-block"></span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary add"> <i class="fa fa-arrow-right"></i> Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    // Filter Bulan
    $("#filter").change(function(e) {
        var filter = $("#filter").val();
        $.ajax({
            url: '/pjlp/kegiatanData/getKinerja/<?= session("userid"); ?>',
            dataType: 'json',
            type: 'GET',
            cache: false,
            data: {
                filter: filter
            },
            success: function(response) {
                var table = '';
                var number = 1;
                if (response.length > 0) {
                    response.forEach(element => {
                        table += `<tr> 
                            <td> ${number++}.  </td> 
                            <td> ${element.kegiatan}  </td> 
                            <td> ${element.tanggal}  </td> 
                            <td> ${element.jam} </td> 
                            <td> ${element.selesai}  </td>  
                            <td> ${(element.status== null ? 'sedang di evaluasi' : '') }   </td>  
                            </tr> `;
                    });
                    $("#target").html(table);
                } else {
                    table += `<tr> 
                           <td colspan="10" align="center"> Tidak Ada Data  </td>
                        </tr>`;
                    $("#target").html(table);
                }

            }
        });
    });


    $(".add").click(function(e) {
        e.preventDefault();
        var useridKegiatan = $("#userid").val();
        var kegiatan = $("#kegiatan").val();
        var tanggal = $("#tanggal").val();
        var jam = $("#jam").val();
        var selesai = $("#selesai").val();

        $.ajax({
            url: '/pjlp/kegiatan/save/',
            type: 'POST',
            dataType: 'json',
            data: {
                userid: useridKegiatan,
                kegiatan: kegiatan,
                tanggal: tanggal,
                jam: jam,
                selesai: selesai
            },
            beforeSend: function() {
                $(".add").html("<i class ='fa fa-spinner fa-spin'> </i>");
                $(".add").css("cursor", "not-allowed");
            },
            success: function(response) {
                $(".add").html("<i class ='fa fa-send'> </i> Kirim");
                $(".add").css("cursor", "pointer");
                if (response.error) {
                    if (response.error.kegiatan) {
                        $("#kegiatan-data").addClass('has-error');
                        $("#errorKegiatan").html(response.error.kegiatan);
                    } else {
                        $("#tanggal-data").removeClass('has-error');
                        $("#errorKegiatan").html('');
                    }
                    if (response.error.tanggal) {
                        $("#tanggal-data").addClass('has-error');
                        $("#errorTanggal").html(response.error.tanggal);
                    } else {
                        $("#kegiatan-data").removeClass('has-error');
                        $("#errorTanggal").html('');
                    }
                    if (response.error.jam) {
                        $("#jam-data").addClass('has-error');
                        $("#errorJam").html(response.error.jam);
                    } else {
                        $("#jam-data").removeClass('has-error');
                        $("#errorJam").html('');
                    }
                    if (response.error.kegiatan) {
                        $("#selesai-data").addClass('has-error');
                        $("#errorSelesai").html(response.error.selesai);
                    } else {
                        $("#selesai-data").removeClass('has-error');
                        $("#errorSelesai").html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                    });
                    setInterval(function() {
                        document.location.reload();
                    }, 500);
                }
            }
        });
    });
</script>

<?= $this->endSection(); ?>