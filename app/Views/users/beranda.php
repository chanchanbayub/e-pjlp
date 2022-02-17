       <?php $this->extend("layout/template") ?>
       <!-- Left side column. contains the logo and sidebar -->
       <?php $this->section("content") ?>
       <!-- Right side column. Contains the navbar and content of the page -->
       <div class="content-wrapper">
           <!-- Content Header (Page header) -->
           <section class="content-header">
               <?php if (session()->getFlashdata("pesan")) : ?>
                   <div class="row">
                       <div class="col-md-4">
                           <div class="alert alert-success alert-dismissable">
                               <strong> <i class="icon fa fa-check"></i> Pemberitahuan !</strong>
                               <strong><?= session()->getFlashdata("pesan"); ?></strong>
                           </div>
                       </div>
                   </div>
               <?php endif; ?>
               <h1>
                   Dashboard E-PJLP
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
                   <div class="col-md-12 ">
                       <div class="row">
                           <div class="col-md-4">
                               <div class="info-box">
                                   <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
                                   <div class="info-box-content">
                                       <span class="info-box-text"> Jumlah Jadwal </span>
                                       <strong><?= $totalJadwal; ?></strong>
                                   </div><!-- /.info-box-content -->
                               </div><!-- /.info-box -->
                           </div>
                           <div class="col-md-4">
                               <div class="info-box">
                                   <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>
                                   <div class="info-box-content">
                                       <span class="info-box-text"> Jumlah Kegiatan </span>
                                       <strong><?= $totalKegiatan; ?></strong>
                                   </div><!-- /.info-box-content -->
                               </div><!-- /.info-box -->
                           </div>
                           <div class="col-md-4">
                               <div class="info-box">
                                   <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
                                   <div class="info-box-content">
                                       <span class="info-box-text"> Jumlah Ketidak Hadiran </span>
                                   </div><!-- /.info-box-content -->
                               </div><!-- /.info-box -->
                           </div>
                           <div class="col-md-4">
                               <div class="info-box">
                                   <span class="info-box-icon bg-aqua"><i class="fa fa-exclamation-triangle"></i></span>
                                   <div class="info-box-content">
                                       <span class="info-box-text"> Jumlah Surat Peringatan </span>
                                       <strong><?= $totalSP; ?></strong>
                                   </div><!-- /.info-box-content -->
                               </div><!-- /.info-box -->
                           </div>
                       </div>
                   </div><!-- /.col -->
                   <!-- fix for small devices only -->
                   <div class="clearfix visible-sm-block"></div>
               </div><!-- /.row -->

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
                           <div class="box-body">
                               <div class="row">
                                   <div class="col-md-12">
                                       <p class="text-center">
                                           <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                       </p>
                                       <div class="chart-responsive">
                                           <!-- Sales Chart Canvas -->
                                           <canvas id="salesChart" height="180"></canvas>
                                       </div><!-- /.chart-responsive -->
                                   </div><!-- /.col -->
                               </div><!-- /.row -->
                           </div><!-- ./box-body -->
                       </div>
                   </div>
               </div>
           </section><!-- /.content -->
       </div><!-- /.content-wrapper -->
       <?php $this->endSection(); ?>