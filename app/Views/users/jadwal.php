<?= $this->extend("layout/template"); ?>
<?= $this->section("content"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Jadwal Kerja
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
            <div class="col-md-12 ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"> Jumlah Jadwal Kerja Perbulan </span>
                                <strong id="total"><?= $totalJadwalPerbulan; ?></strong>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
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
                </div>
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
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
                                            <th scope="col">Shift Masuk</th>
                                            <th scope="col">Shift Pulang</th>
                                        </tr>
                                    </thead>
                                    <tbody id="target">
                                        <?php $number = 1 + (10 * ($currentPage - 1)); ?>
                                        <?php if (!empty($jadwal)) :
                                            foreach ($jadwal as $jadwal) : ?>
                                                <tr>
                                                    <td><?= $number++; ?>.</td>
                                                    <td><?= $jadwal["tanggal_masuk"]; ?></td>
                                                    <td><?= $jadwal["tanggal_pulang"]; ?></td>
                                                    <td><?= $jadwal["shift_name"]; ?></td>
                                                    <td><?= $jadwal["shift_masuk"]; ?></td>
                                                    <td><?= $jadwal["shift_pulang"]; ?></td>
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
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>

<script>
    $("#filter").change(function(e) {
        var search = $("#filter").val();
        $.ajax({
            url: '/pjlp/getJadwalById/<?= session('userid'); ?>',
            dataType: 'json',
            cache: false,
            data: 'filter=' + search,
            success: function(response) {
                $("#total").html(response.total);
                var table = '';
                var number = 1;
                if (response.jadwal.length > 0) {
                    response.jadwal.forEach(element => {
                        table += `<tr>
                        <td> ${number++}.  </td>
                        <td> ${element.tanggal_masuk} </td>
                        <td> ${element.tanggal_pulang} </td>
                        <td> ${element.shift_name} </td>
                        <td> ${element.shift_masuk} </td>
                        <td> ${element.shift_pulang} </td>
                        </tr>`;
                    });
                    $("#target").html(table);

                } else {
                    table += `<tr> 
                        <td colspan = "10" align="center"> Tidak Ada Data </td>
                        </tr>`;

                }
                $("#target").html(table);
            }
        });
    })
</script>

<?= $this->endSection(); ?>