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
                        <h3 class="box-title">Data Anggota</h3>
                        <div class="box-tools pull-right">
                            <div class="dropdown">
                                <button class="btn btn-box-tool dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Menu
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="/pjlp/admin/gaji/<?= $anggota["userid"]; ?>"> <i class="fa fa-money"></i> Data Gaji Anggota</a></li>
                                    <li><a href="/pjlp/admin/jadwal/<?= $anggota["userid"]; ?>"> <i class=" glyphicon glyphicon-list-alt"></i> Data Jadwal Kerja Perbulan</a></li>
                                    <li><a href="#"> <i class="glyphicon glyphicon-book"></i> Cetak Data Kinerja </a>
                                    <li><a href="/pjlp/admin/absensi/<?= $anggota["userid"]; ?>"> <i class="glyphicon glyphicon-calendar"></i> Cetak Data Absensi perbulan</a></li>
                                </ul>
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <a href="/pjlp/admin/anggota/" class="btn btn-box-tool"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img src="/assets/img/pjlp/<?= ($anggota["Image_id"] == null ? "no-photo.jpg" : "" . $anggota["ImageId"]); ?>" alt="profil">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <label for="">Nama :</label>
                                            <?= $anggota["name"]; ?>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <label for=""> ID PJLP :</label>
                                            <?= $anggota["badgenumber"]; ?>
                                        </div>
                                    </div>
                                    <?php if (!empty($anggota["Gender"] && $anggota["Birthday"])) : ?>
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <label for=""> Jenis Kelamin :</label>
                                                <?= $anggota["Gender"]; ?>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <label for=""> Tanggal Lahir :</label>
                                                <?= $anggota["Birthday"]; ?>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <label for="">Seksi :</label>
                                                <?= $anggota["seksi_bagian"]; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($gaji)) : ?>
                                        <div class="page-header">
                                            <h5> <?= $gaji["gaji"]; ?> </h5>
                                        </div>
                                        <div class="page-header">
                                            <h5> <?= $gaji["tunjangan"]; ?></h5>
                                        </div>
                                        <div class="page-header">
                                            <h5> <?= $gaji["potongan"]; ?></h5>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->endSection() ?>