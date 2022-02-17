<?php $this->extend('layout/templateAdmin') ?>
<?php $this->section("content"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Rekap Absensi</h1>
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
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Laporan Data Absensi Perbulan</h3>
                        <div class="box-tools pull-right">
                            <a href="/pjlp/admin/cetakPdf/<?= $anggota["userid"]; ?>" target="_blank" class="btn btn-box-tool cetak"><i class="fa fa-file-pdf-o"></i> Cetak PDF</a>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <a href="/pjlp/admin/anggota/" class="btn btn-box-tool"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-scrool">
                        <div class="row ">
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

                            <div class="col-md-12 viewdata">
                                <div class="row">
                                    <div class="col-md-8 ">
                                        <table class="table table-bordered" id="tableData">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No. </th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Jam</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Terlambat</th>
                                                </tr>
                                            </thead>
                                            <tbody class="target">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th scope="col">No.</th>
                                                <th scope="col">Tanggal </th>
                                                <th scope="col">Keterangan</th>
                                            </thead>
                                            <tbody class="ketidakHadiran">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- ./box-body -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    function getData() {
        $.ajax({
            url: "/pjlp/admin/rekapAbsen/<?= $anggota["userid"] ?>",
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            dataType: "JSON",
            cache: false,
            type: "get",
            success: function(response) {
                console.log(response.perbaikanAbsen);
                var table = '';
                var number = 1;
                if (response.lateTime.length > 0) {
                    for (var i = 0; i < response.lateTime.length; i++) {

                        var time = response.lateTime[i]["checktime"];
                        var waktu = time.split(" ");
                        var jam = waktu[1];
                        var tanggal = waktu[0];
                        table += `<tr> 
                        <td> ${number++} </td>
                        <td> ${tanggal} </td>
                        <td> ${jam} </td>
                        <td> ${(response.lateTime[i]["checktype"] == 0 ? "Masuk" : "Pulang")} </td>
                        <td> ${response.lateTime[i]["interval"]} </td>
                     </tr>`;
                    }

                    // for (var i = 0; i < response.totalTerlambat.length; i++) {
                    table += `<tr>
                        <th colspan="4" > Jumlah Keterlambatan Perbulan </th>
                        <td> ${response.totalPerbulan.totalPerbulan}</td>
                    </tr>`;
                    // }
                    // for (var i = 0; i < response.totalKeseluruhan.length; i++) {
                    table += `<tr> 
                            <th colspan ="4"> Jumlah Total Keterlambatan Pertahun </th> 
                            <th> ${response.totalPertahun.totalPertahun} </th> 
                        </tr>`;
                    // }

                    $(".target").html(table);
                }

                var tableKetidakHadiran = '';
                var number = 1;

                response.perbaikanAbsen.forEach(element => {
                    tableKetidakHadiran += `<tr> 
                        <td> ${number ++}</td>
                        <td> ${element.tanggal} </td>
                        <td> ${element.keterangan} </td>
                    </tr>`;
                });
                $(".ketidakHadiran").html(tableKetidakHadiran);
            }
        });
    }

    $(document).ready(function() {
        getData();
    });
</script>

<?php $this->endSection() ?>