<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/assets/img/pjlp/<?= (session("image") == null ? 'no-photo.jpg' : '' . session("image")); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= session('name'); ?></p>
                <a href="/pjlp/profil/userinfo/<?= session('userid'); ?>"><i class="fa fa-edit"></i> Profil</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Menu </li>
            <li class="treeview">
                <a href="/pjlp/beranda/">
                    <i class="fa fa-dashboard"></i> <span>Beranda</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Absensi</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/pjlp/absensi/hari/<?= session("userid"); ?>"><i class="fa fa-calendar"></i> Absen Terbaru</a></li>
                    <li><a href="/pjlp/absensi/rekap_absen/<?= session("userid"); ?>"><i class="fa fa-files-o"></i> Rekap Absen </a></li>
                    <li><a href="/pjlp/absensi/perbaikanAbsen/<?= session("userid"); ?>"><i class="fa fa-calendar"></i> Form Perbaikan Absen </a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="/pjlp/kegiatan/<?= session('userid'); ?>">
                    <i class="fa fa-edit"></i>
                    <span>Data Kinerja</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="/pjlp/jadwal/<?= session('userid'); ?>">
                    <i class="fa fa-calendar"></i>
                    <span>Jadwal Kerja</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="/pjlp/suratPeringatan/<?= session('userid'); ?>">
                    <i class="fa fa-exclamation-triangle"></i>
                    <span>Surat Peringatan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="/pjlp/capaiankinerja/<?= session('userid'); ?>">
                    <i class="fa fa-trophy"></i> <span>Cek Capaian Kinerja</span>
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