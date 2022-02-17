<?= $this->extend("layout/template"); ?>
<?= $this->section("content"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rekap Absensi
            <small>Version 0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-files-o"></i> <?= $title; ?></a></li>
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
            <div class="col-md-4">
                <div class="form-group">
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
                </div>
            </div>
            <br>
            <!-- Laporan Absensi Masuk  -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Rekap Absen Perbulan </h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-scrool">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No. </th>
                                                    <th scope="col">Tanggal </th>
                                                    <th scope="col">Jam </th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Terlambat</th>
                                                </tr>
                                            </thead>
                                            <tbody class="target">
                                                <?php $number = 1 + (10 * ($currentPage - 1)); ?>
                                                <?php if (!empty($latetime)) :
                                                    foreach ($lateTime as $latetime) : ?>
                                                        <?php $date = $latetime["checktype"]; ?>
                                                        <?php $date = explode(' ', $date); ?>
                                                        <?php $tanggal = $date[0];
                                                        $jam = $date[1];
                                                        ?>
                                                        <tr>
                                                            <td><?= $tanggal; ?></td>
                                                            <td><?= $jam; ?></td>
                                                            <td><?= $latetime["checktype"]; ?></td>
                                                            <td><?= $latetime["interval"]; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <td colspan="10" align="center">Tidak Ada Data</td>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <?= $pager->simpleLinks(); ?>
                                        <span style="color: red; font-size: 10px;"> <strong> * Catatan : Jika Terjadi Kesalahan Dalam Perhitungan, Silahkan Refresh. </strong></span>

                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- ./box-body -->
                        </div>
                    </div>
                </div>

                <!-- Laporan Ketidak Hadiran  -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Rekap Ketidak Hadiran Perbulan </h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-scrool">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No. </th>
                                                    <th scope="col">Tanggal </th>
                                                    <th scope="col">Keterangan </th>
                                                </tr>
                                            </thead>
                                            <tbody class="targetKetidakHadiran">
                                                <?php $number = 1 + (10 * ($currentPage - 1)); ?>
                                                <?php if (!empty($perbaikanAbsen)) :
                                                    foreach ($perbaikanAbsen as $perbaikanAbsen) : ?>
                                                        <tr>
                                                            <td><?= $number++; ?>.</td>
                                                            <td><?= $perbaikanAbsen["tanggal_masuk"]; ?></td>
                                                            <td><?= $perbaikanAbsen["keterangan"]; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <td colspan="10" align="center">Tidak Ada Data</td>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <?= $pager->simpleLinks(); ?>
                                        <span style="color: red; font-size: 10px;"> <strong> * Catatan : Jika Terjadi Kesalahan Dalam Perhitungan, Silahkan Refresh dihalaman capaian kinerja. </strong></span>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- ./box-body -->
                        </div>
                    </div>
                </div>
            </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
    function viewData() {
        $.ajax({
            url: "/pjlp/absensi/getResultAbsensi/<?= session('userid'); ?>",
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(response) {
                var table = '';
                var no = 1;
                if (response.lateTime.length > 0) {
                    response.lateTime.forEach(element => {
                        var time = element.checktime;
                        var waktu = time.split(' ');
                        table += `<tr> 
                                <td> ${no++}.</td>
                                <td>${element.tanggal} </td>
                                <td> ${waktu[1]}  </td>
                                <td> ${(element.checktype == 0) ? "Masuk" : "Pulang"} </td>
                                <td> ${element.interval} </td>
                            </tr>`;
                    });
                } else {
                    table += `
                        <tr> 
                            <td colspan="5" align="center"> Tidak Ada Data </td>
                        </tr>
                    `;
                }
                $(".target").html(table);

                var tablePerbaikanAbsen = '';
                var number = 1;
                if (response.perbaikanAbsen.length > 0) {
                    response.perbaikanAbsen.forEach(element => {
                        tablePerbaikanAbsen += `<tr> 
                        <td> ${number ++} </td>
                        <td> ${element.tanggal} </td>
                        <td> ${element.keterangan} </td>
                    </tr>`;
                    });
                } else {
                    tablePerbaikanAbsen += `
                        <tr> 
                            <td colspan="10" align="center"> Tidak Ada Data </td>
                        </tr>
                    `;
                }
                $(".targetKetidakHadiran").html(tablePerbaikanAbsen);
            }
        });
    }


    $('#filter').change(function(e) {
        var search = $("#filter").val();
        $.ajax({
            url: "/pjlp/absensi/getResultAbsensi/<?= session('userid'); ?>",
            dataType: 'json',
            data: 'filter=' + search,
            cache: false,
            success: function(response) {
                var table = '';
                var no = 1;
                if (response.lateTime.length > 0 || response.perbaikanAbsen.length > 0) {
                    for (let i = 0; i < response.lateTime.length; i++) {
                        var time = response.lateTime[i].checktime;
                        var result = time.split(" ");
                        table += `<tr> 
                                <td> ${no++}.</td>
                                <td> ${result[0]} </td>
                                <td> ${result[1]} </td>
                                <td> ${(response.lateTime[i].checktype == 0) ? "Masuk" : "Pulang"} </td>
                                <td> ${response.lateTime[i].interval} </td>
                            </tr>`;
                        $(".target").html(table);
                    }

                    var tablePerbaikanAbsen = '';
                    var number = 1;
                    response.perbaikanAbsen.forEach(element => {
                        tablePerbaikanAbsen += `<tr> 
                        <td> ${number ++}. </td>
                        <td> ${element.tanggal} </td>
                        <td> ${element.keterangan} </td>
                    </tr>`;
                    });
                    $(".targetKetidakHadiran").html(tablePerbaikanAbsen);
                } else {
                    var table = '';
                    table += `
                        <tr> 
                            <td colspan="5" align="center"> Tidak Ada Data </td>
                        </tr>
                    `;
                    $(".targetKetidakHadiran").html(table);
                    $(".target").html(table);
                }
            }
        });
    })

    // $(document).ready(function() {
    //     viewData();
    //     // $.ajaxSetup({
    //     //     cache: false
    //     // });
    // });
</script>

<?= $this->endSection(); ?>