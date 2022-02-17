 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
     <!-- sidebar: style can be found in sidebar.less -->
     <section class="sidebar">
         <!-- Sidebar user panel -->
         <div class="user-panel">
             <div class="pull-left image">
                 <img src="/assets/img/pjlp/<?= (session("image") == null ? 'no-photo.jpg' : '' . session("image")); ?>" class="img-circle" alt="User Image" />
             </div>
             <div class="pull-left info">
                 <p><?= session("name"); ?></p>
                 <a href="/pjlp/admin/userinfo/<?= session('userid'); ?>"><i class="fa fa-edit"></i> Profil</a>
             </div>
         </div>

         <!-- sidebar menu: : style can be found in sidebar.less -->
         <ul class="sidebar-menu">
             <li class="header">Menu </li>
             <li class="treeview">
                 <a href="/pjlp/admin/">
                     <i class="fa fa-dashboard"></i> <span>Beranda</span> <i class="fa fa-angle-left pull-right"></i>
                 </a>
             </li>
             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-files-o"></i>
                     <span>Data Data Anggota</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu">
                     <li><a href="/pjlp/admin/anggota/"><i class="fa fa-users"></i> Data Anggota PJLP </a></li>
                     <?php if (session('level') == 14) : ?>
                         <li><a href="/pjlp/admin/groupUsers/"><i class="fa fa-users"></i> Group Users </a></li>
                     <?php endif; ?>
                 </ul>
             </li>
             <?php if (session('level') == 14) : ?>
                 <li class="treeview">
                     <a href="#">
                         <i class="fa fa-files-o"></i>
                         <span>Input Data Data</span>
                         <i class="fa fa-angle-left pull-right"></i>
                     </a>
                     <ul class="treeview-menu">
                         <li><a href="/pjlp/admin/bidang/"><i class="fa fa-file-archive-o"></i> <span> Data Seksi Management </span> </a></li>
                         <li><a href="/pjlp/admin/shift/"><i class="fa fa-files-o"></i> <span> Data Shift PJLP </span> </a></li>
                         <li><a href="/pjlp/admin/role/"><i class="fa fa-users"></i> <span> Data Role Management </span> </a></li>
                         <li><a href="/pjlp/admin/seksi/"><i class="fa fa-files-o"></i> <span> Data Seksi Bagian </span> </a></li>
                         <li><a href="/pjlp/admin/usersmanagement/"><i class="fa fa-user"></i> <span> Data Users Management </span> </a></li>
                         <li><a href="/pjlp/admin/bulan/"><i class="fa fa-calendar"></i> <span> Data Bulan PJLP </span> </a></li>
                         <li><a href="/pjlp/admin/keterangan/"><i class="fa fa-files-o"></i> <span> Data Keterangan </span> </a></li>
                     </ul>
                 </li>
             <?php endif; ?>
             <?php if (session('level') == 14 || session('level') == 2) : ?>
                 <li>
                     <a href="/pjlp/admin/perbaikanAbsen/">
                         <i class="fa fa-calendar"></i> <span>Perbaikan Absen </span>
                         <i class="fa fa-angle-left pull-right"></i>
                     </a>
                 </li>
             <?php endif; ?>
             <li>
                 <a href="/pjlp/admin/suratperingatan/">
                     <i class="fa fa-user"></i> <span>Surat Peringatan </span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
             </li>
             <li>
                 <a href="#">
                     <i class="fa fa-book"></i> <span>Buku Panduan </span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
             </li>
         </ul>
     </section>
     <!-- /.sidebar -->
 </aside>