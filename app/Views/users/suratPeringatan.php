<?= $this->extend("layout/template"); ?>
<?= $this->section("content"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Surat Peringatan
            <small>Version 0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-exclamation-triangle"></i> <?= $title; ?></a></li>
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
                            <span class="info-box-icon bg-red"><i class="fa fa-exclamation-triangle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"> Jumlah Surat Peringatan </span>
                                <strong><?= $totalSP; ?></strong>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
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
                                                    <th scope="col">Tanggal </th>
                                                    <th scope="col">Pelanggaran</th>
                                                    <th scope="col">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody id="target">
                                                <?php $number = 1 + (1 * ($currentPage - 1)); ?>
                                                <?php if (!empty($suratPeringatan)) :
                                                    foreach ($suratPeringatan as $sp) : ?>
                                                        <tr>
                                                            <td><?= $number++; ?>.</td>
                                                            <td><?= $sp["tanggal"]; ?></td>
                                                            <td><?= $sp["pelanggaran"]; ?></td>
                                                            <?php if ($sp["nilai"] != null) : ?>
                                                                <td> SP <?= $sp["nilai"]; ?></td>
                                                            <?php else : ?>
                                                                <td></td>
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
                var table = '';
                var number = 1;
                if (response.length > 0) {
                    for (var i = 0; i < response.length; i++) {
                        table += `<tr>
                        <td> ${number++}.  </td>
                        <td> ${response[i].tanggal_masuk} </td>
                        <td> ${response[i].tanggal_pulang} </td>
                        <td> ${response[i].shift_name} </td>
                        <td> ${response[i].shift_masuk} </td>
                        <td> ${response[i].shift_pulang} </td>
                        </tr>`;
                    }
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