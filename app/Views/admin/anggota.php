<?php $this->extend('layout/templateAdmin') ?>
<?php $this->section("content"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $title; ?></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?= $title; ?></a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Anggota PJLP</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-scrool">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="tableData">
                                    <thead>
                                        <tr>
                                            <th scope="col">No. </th>
                                            <th scope="col">No PJLP</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="target">
                                        <?php $no = 1 + (10 * ($currentPage - 1));
                                        if (!empty($anggota)) :
                                            foreach ($anggota as $anggota) : ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $anggota["badgenumber"] ?></td>
                                                    <td><?= $anggota["name"] ?></td>
                                                    <td><button class="btn btn-warning detail" data-no="<?= $anggota["userid"]; ?>"> <i class="fa fa-user"></i></button></td>
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
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    $(".detail").click(function(e) {
        e.preventDefault();
        var userid = $(this).data("no");
        $.ajax({
            url: '/pjlp/admin/viewAnggota/',
            data: 'userid=' + userid,
            dataType: 'JSON',
            type: 'GET',
            success: function(response) {
                document.location.href = "/pjlp/admin/anggota/detail/" + response.userid;
            }
        });

    });
</script>
<?php $this->endSection() ?>