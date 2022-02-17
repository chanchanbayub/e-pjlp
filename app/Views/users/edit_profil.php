<?= $this->extend("layout/template"); ?>
<?= $this->section("content"); ?>
<!-- Left side column. contains the logo and sidebar -->

<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profil Anggota
            <small>Version 0.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?= $title; ?></a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Perbaharui Profil</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class=" box-body">
                            <input type="hidden" class="form-control" id="userid" name=" userid">
                            <div class="form-group">
                                <label for="badgenumber">ID PJLP :</label>
                                <input type="text" class="form-control " id="badgenumber" name="badgenumber">
                            </div>
                            <div class="form-group" id="nama">
                                <label for="name">Nama :</label>
                                <input type="text" class="form-control " id="name" name="name">
                                <span id="errorName" class="help-block"></span>
                            </div>
                            <div class="form-group" id="passwordError">
                                <label for="Password">Password :</label>
                                <input type="password" class="form-control" id="Password" name="Password">
                                <span id="errorPassword" class="help-block"></span>
                            </div>
                            <div class="form-group" id="jk">
                                <label for="Gender">Jenis Kelamin :</label>
                                <select name="Gender" id="Gender" class="form-control" selected>
                                    <option value="">Silahkan Pilih</option>
                                    <option value="L">Laki Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <span id="errorJK" class="help-block"></span>
                            </div>
                            <div class="form-group" id="ttl">
                                <label for="Birthday">Tanggal Lahir :</label>
                                <input type="date" name="Birthday" id="Birthday" class="form-control">
                                <span id="errorTTL" class="help-block"></span>
                            </div>
                            <div class="form-group" id="seksi">
                                <label for="seksi_bagian">Seksi :</label>
                                <select name="seksi_bagian" id="seksi_bagian" class="form-control">
                                    <option value="">Silahkan Pilih</option>
                                    <?php foreach ($seksi as $seksi) : ?>
                                        <option value="<?= $seksi["id_seksi"]; ?>"><?= $seksi["seksi_bagian"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="errorSeksi" class="help-block"></span>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary update"> <i class="fa fa-arrow-right"></i> Perbaharui</button>
                            <a href="/pjlp/profil/userinfo/<?= session('userid'); ?>" class="btn btn-warning"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back </a>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        var userid = "<?= session("userid"); ?>"
        $.ajax({
            url: '/pjlp/getData/<?= session("userid"); ?>',
            type: 'GET',
            dataType: 'JSON',
            data: {
                userid: userid
            },
            success: function(response) {
                var birthday = response.Birthday;
                var ttl = birthday.split(" ");
                var tanggal = ttl[0];
                $("#userid").val(response.userid);
                $("#badgenumber").val(response.badgenumber);
                $("#name").val(response.name);
                $("#Password").val(response.Password);
                $("#Gender").val(response.Gender);
                $("#Birthday").val(tanggal);
                $("#seksi_bagian").val(response.id_seksi);
            }
        })
    });

    $(".update").click(function(e) {
        e.preventDefault();
        var userid = $("#userid").val();
        var badgeNumber = $("#badgenumber").val();
        var name = $("#name").val();
        var password = $("#Password").val();
        var gender = $("#Gender").val();
        var birthday = $("#Birthday").val();
        var seksi_bagian = $("#seksi_bagian").val();
        var userid_group = $("#userid").val();
        $.ajax({
            url: '/pjlp/profil/save/',
            type: 'post',
            data: {
                userid: userid,
                badgenumber: badgeNumber,
                name: name,
                Password: password,
                Gender: gender,
                Birthday: birthday,
                userid_group: userid_group,
                seksi_bagian: seksi_bagian
            },
            dataType: 'JSON',
            success: function(response) {
                if (response.error) {
                    if (response.error.name) {
                        $("#nama").addClass('has-error');
                        $("#errorName").html(response.error.name);
                    } else {
                        $("#nama").removeClass('has-error');
                        $("#errorName").html("");
                    }
                    if (response.error.Password) {
                        $("#passwordError").addClass('has-error');
                        $("#errorPassword").html(response.error.Password);
                    } else {
                        $("#passwordError").removeClass('has-error');
                        $("#errorPassword").html("");
                    }
                    if (response.error.Gender) {
                        $("#jk").addClass('has-error');
                        $("#errorJK").html(response.error.Gender);
                    } else {
                        $("#jk").removeClass('has-error');
                        $("#errorJK").html("");
                    }
                    if (response.error.Birthday) {
                        $("#ttl").addClass('has-error');
                        $("#errorTTL").html(response.error.Gender);
                    } else {
                        $("#ttl").removeClass('has-error');
                        $("#errorTTL").html("");
                    }
                    if (response.error.seksi_bagian) {
                        $("#seksi").addClass('has-error');
                        $("#errorSeksi").html(response.error.seksi_bagian);
                    } else {
                        $("#seksi").removeClass('has-error');
                        $("#errorSeksi").html("");
                    }
                } else {
                    Swal.fire({
                        title: `${response.pesan}`,
                        icon: 'success'
                    })
                    setInterval(function() {
                        document.location.href = '/pjlp/profil/userinfo/<?= session('userid'); ?>'
                    }, 500);
                }
            }
        })
    })
</script>
<?= $this->endSection(); ?>