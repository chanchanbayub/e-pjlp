<?= $this->extend("layout/template"); ?>
<?= $this->section("content"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Capaian Kinerja
            <small>Version 0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-calendar"></i> <?= $title; ?></a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
        </div><!-- /.row -->
        <!-- Laporan Gaji -->
        <div class="row">
            <div class="col-md-4 ">
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

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Laporan Gaji Yang Akan di Bayarkan</h3>
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
                                            <th scope="col">Gaji</th>
                                            <th scope="col">Tunjangan</th>
                                            <th scope="col">Periode Awal</th>
                                            <th scope="col">Periode Akhir</th>
                                            <th scope="col">Potongan</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="gaji">

                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->
                </div>

                <!-- Laporan Absensi Masuk  -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Laporan Capaian Absensi </h3>
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
                                                    <th scope="col">Total Perbulan </th>
                                                    <th scope="col">Total Pertahun </th>
                                                </tr>
                                            </thead>
                                            <tbody id="target">

                                            </tbody>
                                        </table>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- ./box-body -->
                        </div>

                        <!-- Laporan Ketidak Hadiran  -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Laporan Ketidak Hadiran </h3>
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
                                                    <tbody id="targetKetidakHadiran">

                                                    </tbody>
                                                </table>
                                            </div><!-- /.col -->
                                        </div><!-- /.row -->
                                    </div><!-- ./box-body -->
                                </div>

                                <!-- Laporan Bobot Absensi -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Laporan Bobot Absensi</h3>
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
                                                                    <th scope="col">Jumlah Hari Kerja</th>
                                                                    <th scope="col">Jumlah Alfa</th>
                                                                    <th scope="col">Jumlah Sakit</th>
                                                                    <th scope="col">Jumlah Izin</th>
                                                                    <th scope="col">Jumlah Cuti</th>
                                                                    <th scope="col">Jumlah WFH</th>
                                                                    <th scope="col"> Nilai Bobot Absensi </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tableBobot">

                                                            </tbody>
                                                        </table>
                                                    </div><!-- /.col -->
                                                </div><!-- /.row -->
                                            </div><!-- ./box-body -->
                                        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>

<script>
    function showData() {
        $.ajax({
            url: "/pjlp/capaian/getAbsensiDataJadwal/<?= session("userid") ?> ",
            cache: false,
            dataType: "JSON",
            type: "get",
            success: function(response) {
                // Tabel Capaian Absensi
                var table = '';
                var number = 1;
                table += `<tr> 
                            <td> ${number++}. </td>
                            <td> ${(response.totalPerbulan.totalPerbulan) == null ? '0' : response.totalPertahun.totalPertahun} </th> 
                            <td> ${(response.totalPertahun.totalPertahun) == null ? '0' : response.totalPertahun.totalPertahun} Detik  </td>
                     </tr>`;

                $("#target").html(table);

                // Table Perbaikan
                var tablePerbaikan = '';
                var angka = 1;
                if (response.perbaikanAbsen.length > 0) {
                    response.perbaikanAbsen.forEach(element => {
                        tablePerbaikan += `<tr> 
                                <td> ${angka++}  </td> 
                                <td> ${element.tanggal_masuk}  </td> 
                                <td> ${element.keterangan}  </td> 
                                </tr>`;
                    });
                    $("#targetKetidakHadiran").html(tablePerbaikan);
                } else {
                    tablePerbaikan += `<tr> 
                                <td align="center" colspan="10"> Tidak Ada Data </td> 
                                </tr>`;
                    $("#targetKetidakHadiran").html(tablePerbaikan);
                }
                // end Table Perbaikan

                // Table Gaji
                if (response.gaji != null) {
                    var table = '';
                    var numb = 1;
                    table += `<tr>
                    <td>  ${numb++}  </td> 
                    <td> ${parseInt(response.gaji.gaji)} </td>
                    <td> ${parseInt(response.gaji.tunjangan)} </td>
                    <td> ${response.gaji.periode_awal} </td>
                    <td> ${response.gaji.periode_akhir} </td>
                    <td> ${parseInt(response.gaji.potongan) } </td>
                    <td> ${parseInt(response.gaji.gaji) + parseInt(response.gaji.tunjangan) - parseInt(response.gaji.potongan)} </td> 
                    </tr>`;
                    $("#gaji").html(table);
                } else {
                    var table = '';
                    table += `<tr>
                    <td colspan="10" align="center"> Tidak Ada Data </td>
                </tr>`;
                    $("#gaji").html(table);
                }
                // end Table Gaji

                // table Bobot Absensi
                var tableBobot = '';
                var no = 1;
                tableBobot += `<tr> 
                <td> ${no++} </td>
                <td> ${response.jumlahJadwal} </td>
                <td> ${response.totalAlfa} </td>
                <td> ${response.totalSakit} </td>
                <td> ${response.totalIzin} </td>
                <td> ${response.totalCuti} </td>
                <td> ${response.totalWFH} </td>
                <td> ${response.nilaiBobot} % </td>
            </tr>`;

                $("#tableBobot").html(tableBobot);
            }
            // endBobot Absensi
        });
    }

    $("#filter").change(function() {
        var filter = $("#filter").val();
        $.ajax({
            url: "/pjlp/capaian/getAbsensiDataJadwal/<?= session("userid") ?>",
            data: "filter=" + filter,
            dataType: "JSON",
            cache: false,
            type: "get",
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {

                // Tabel Capaian Absensi
                var table = '';
                var number = 1;
                var table = '';
                var number = 1;
                table += `<tr> 
                            <td> ${number++}. </td>
                            <td> ${(response.totalPerbulan.totalPerbulan) == null ? '0' : response.totalPertahun.totalPertahun} </th> 
                            <td> ${(response.totalPertahun.totalPertahun) == null ? '0' : response.totalPertahun.totalPertahun} Detik  </td>
                     </tr>`;

                $("#target").html(table);

                // end Capaian Absensi

                // Table Perbaikan
                var tablePerbaikan = '';
                var angka = 1;
                if (response.perbaikanAbsen.length > 0) {
                    response.perbaikanAbsen.forEach(element => {
                        tablePerbaikan += `<tr> 
                                <td> ${angka++}  </td> 
                                <td> ${element.tanggal_masuk}  </td> 
                                <td> ${element.keterangan}  </td> 
                                </tr>`;
                    });
                    $("#targetKetidakHadiran").html(tablePerbaikan);
                } else {
                    tablePerbaikan += `<tr> 
                                <td align="center" colspan="10"> Tidak Ada Data </td> 
                                </tr>`;
                    $("#targetKetidakHadiran").html(tablePerbaikan);
                }
                // end Table Perbaikan

                // Table Gaji
                if (response.gaji != null) {
                    var table = '';
                    var numb = 1;
                    table += `<tr>
                    <td>  ${numb++}  </td> 
                    <td> ${parseInt(response.gaji.gaji)} </td>
                    <td> ${parseInt(response.gaji.tunjangan)} </td>
                    <td> ${response.gaji.periode_awal} </td>
                    <td> ${response.gaji.periode_akhir} </td>
                    <td> ${parseInt(response.gaji.potongan) } </td>
                    <td> ${parseInt(response.gaji.gaji) + parseInt(response.gaji.tunjangan) - parseInt(response.gaji.potongan)} </td> 
                    </tr>`;
                    $("#gaji").html(table);
                } else {
                    var table = '';
                    table += `<tr>
                    <td colspan="10" align="center"> Tidak Ada Data </td>
                </tr>`;
                    $("#gaji").html(table);
                }
                // end Table Gaji

                // table Bobot Absensi
                var tableBobot = '';
                var no = 1;
                tableBobot += `<tr> 
                <td> ${no++} </td>
                <td> ${response.jumlahJadwal} </td>
                <td> ${response.totalAlfa} </td>
                <td> ${response.totalSakit} </td>
                <td> ${response.totalIzin} </td>
                <td> ${response.totalCuti} </td>
                <td> ${response.totalWFH} </td>
                <td> ${response.nilaiBobot} % </td>
            </tr>`;

                $("#tableBobot").html(tableBobot);
            }
            // endBobot Absensi
        });
    });

    $(document).ready(function() {
        $.ajaxSetup({
            cache: false
        });
        showData();

    });
</script>
<?= $this->endSection(); ?>