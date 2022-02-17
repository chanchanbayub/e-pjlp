<?= $this->extend("layout/template"); ?>
<?= $this->section("content"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1>
            Profil Pengguna
            <small>Version 0.0</small>
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
            <div class="col-md-6 col-sm-6 col-xs-12">

            </div><!-- /.col -->
            <div class="col-md-6 col-sm-6 col-xs-12">

            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
        </div><!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">

                        <h3 class="box-title">Data Anggota</h3>
                        <div class="box-tools pull-right">
                            <a href="/pjlp/profil/<?= $profil["userid"]; ?>"> <i class="fa fa-arrow-left"> Edit Data Users </i></a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (session()->getFlashdata("pesan")) : ?>
                                    <div class="alert alert-success " role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong><?= session()->getFlashdata("pesan"); ?></strong>
                                    </div>
                                <?php endif; ?>

                                <div class="row">
                                    <div class="col-md-4 ">
                                        <a href="#" class="thumbnail">
                                            <img src="/assets/img/pjlp/<?= ($profil["image"] == null) ? 'no-photo.jpg' : '' . $profil["image"]; ?>" alt="...">
                                        </a>
                                        <?php if ($profil["image"] == null) : ?>
                                            <form action="/pjlp/profil/saveImage/<?= session("userid"); ?>" method="post" enctype="multipart/form-data">
                                                <div class="input-group <?= ($validation->hasError('image')) ? 'has-error' : ''; ?>">
                                                    <input type="hidden" name="userid" id="userid" value="<?= session('userid'); ?>">
                                                    <label for="image"></label>
                                                    <input type="file" class="form-control" name="image" id="image">

                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="submit"> <i class="fa fa-send"></i> Upload Foto</button>
                                                    </span>
                                                    <br>
                                                </div><!-- /input-group -->
                                                <span id="errorName" class="help-block" style="color: red;"><?= $validation->getError('image'); ?></span>
                                            </form>
                                        <?php endif; ?>
                                        <br>
                                    </div>
                                    <div class="col-md-8 ">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <label for=""> Nama : </label>
                                                <?= $profil["name"]; ?>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <label for=""> ID PJLP :</label>
                                                <?= $profil["badgenumber"]; ?>
                                            </div>
                                        </div>
                                        <?php if ($profil["Gender"] != null) : ?>
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <label for="">Jenis Kelamin :</label>
                                                    <?= $profil["Gender"]; ?>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <label for=""> Seksi :</label>
                                                    <?= $profil["seksi_bagian"]; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>

                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- ./box-body -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?= $this->endSection(); ?>