<?= $this->extend("layout/template"); ?>
<?= $this->section("content"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Absen Terbaru
            <small>Version 0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-calendar"></i> <?= $title; ?></a></li>
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
                        <h3 class="box-title">Laporan Terbaru Absensi </h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body table-scrool">
                        <div class="row">
                            <div class="col-md-12 viewdata_absen">
                                <table class="table table-bordered" id="tableData">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. </th>
                                            <th scope="col"> Tanggal </th>
                                            <th scope="col"> Jam </th>
                                            <th scope="col"> Status </th>
                                            <th scope="col"> Shift </th>
                                            <th scope="col"> Shift Masuk </th>
                                            <th scope="col"> Shift Pulang </th>
                                            <th scope="col"> Terlambat</th>
                                        </tr>
                                    </thead>
                                    <tbody id="target">

                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    function getAbsen() {
        $.ajax({
            url: "/pjlp/absensi/getRowAbsensi/<?= session('userid'); ?>",
            type: 'GET',
            dataType: 'json',
            cache: 'false',
            success: function(response) {

                var dateTime = response.lateTime.checktime;

                var result = dateTime.split(" ");
                var jam = dateTime[1];
                var number = 1;
                var table = `<tr>
                            <td> ${number++}. </td>
                            <td> ${response.lateTime.tanggal} </td>
                            <td> ${result[1]} </td>
                            <td> ${(response.lateTime.checktype == 0) ? "Masuk" : " Pulang " } </td>
                            <td> ${response.jadwal.shift_name} </td>
                            <td> ${response.jadwal.shift_masuk} </td>
                            <td> ${response.jadwal.shift_pulang} </td>
                            <td> ${response.lateTime.interval} </td>
                        </tr>
                `;
                $("#target").html(table);
                // } else {
                //     var table = `<tr> 
                //         <td colspan="10" align="center"> Tidak Ada Data </td>
                //     </tr>`;
                //     $("#target").html(table)
                // }
            }

        });
    }

    $(document).ready(function() {
        getAbsen();
    });
</script>

<?= $this->endSection(); ?>