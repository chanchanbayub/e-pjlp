<?php $this->extend('layout/templateAdmin') ?>
<?php $this->section("content"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?= $title; ?> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?= $title; ?></a></li>
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
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-navy"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"> Jumlah Users Management </span>
                        <strong><?= $totalUsers; ?></strong>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Users Management </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" id="addUser" data-toggle="modal" data-target="#tambahUsers"><i class="fa fa-plus"></i> </button>
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
                                            <th scope="col">NIP / ID PJLP </th>
                                            <th scope="col">Bidang </th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="target">
                                        <?php
                                        $number = 1;
                                        if (count($usersmanagement) > 0) :
                                            foreach ($usersmanagement as $user) : ?>
                                                <tr>
                                                    <td><?= $number++ ?>.</td>
                                                    <td><?= $user["badgenumber"] ?></td>
                                                    <td><?= $user["defaultdeptid"]; ?></td>
                                                    <td><?= $user["name"]; ?></td>
                                                    <td><?= $user["Privilege"]; ?></td>
                                                    <td align="center">
                                                        <button class="btn btn-warning item_edit" data="<?= $user["userid"]; ?>"> <i class="fa fa-edit"></i> </button>
                                                        <button class="btn btn-danger item_delete" data="<?= $user["userid"]; ?>"> <i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="10"> Tidak Ada Data</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Modal Add New Users -->
<div class="modal fade" id="tambahUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titleModal">Form Tambah Users</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" id="userid" name="userid" placeholder="Masukan Nama " required>
                    <div class="form-group" id="nip">
                        <label for="badgenumber" class="control-label">NIP / ID PJLP :</label>
                        <input type="text" class="form-control" id="badgenumber" name="badgenumber" placeholder="Masukan Nip atau ID PJLP" maxlength="9" required>
                        <span id="errorBadgenumber" class="help-block"></span>
                    </div>
                    <div class="form-group" id="departement">
                        <label for="defaultdepid" class="control-label">Bidang :</label>
                        <select name="defaultdepid" id="defaultdepid" class="form-control">
                            <option value="1">Dalopss</option>
                        </select>
                        <span id="errorDepartement" class="help-block"></span>
                    </div>
                    <div class="form-group" id="nama">
                        <label for="name" class="control-label">Name :</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama " required>
                        <span id="errorName" class="help-block"></span>
                    </div>
                    <div class="form-group" id="passwordError">
                        <label for="password" class="control-label">Password :</label>
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Masukan password" required>
                        <span id="errorPassword" class="help-block"></span>
                    </div>
                    <div class="form-group" id="privilege_id">
                        <label for="privilege" class="control-label">Role_Id :</label>
                        <select name="Privilege" id="Privilege" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($role as $role) : ?>
                                <option value="<?= $role["id_role"]; ?>"> <?= $role["role_name"]; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <span id="errorPrivilege" class="help-block"></span>
                    </div>
                    <div class="form-group" id="gender">
                        <label for="jk" class="control-label">Jenis Kelamin:</label>
                        <select name="Gender" id="jk" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <option value="L">Laki Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birthday" class="control-label">Tanggal Lahir :</label>
                        <input type="date" class="form-control" id="birthday" name="Birthday" placeholder="Masukan Tanggal Lahir">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary" id="add"> <i class="fa fa-send"></i> Kirim</button>
                        <button type="submit" class="btn btn-primary" id="update"> <i class="fa fa-send"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- delete -->
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Hapus User</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="text" name="userid" id="userid_delete">
                    <h4> Apakah anda yakin ?</h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-danger" id="delete"> <i class="fa fa-send"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    $("#add").click(function(e) {
        e.preventDefault();
        var badgeNumber = $("#badgenumber").val();
        var bidang = $("#defaultdepid").val();
        var name = $("#name").val();
        var password = $("#Password").val();
        var id_role = $("#Privilege").val();
        var gender = $("#jk").val();
        var ttl = $("#birthday").val();
        // console.log(this);
        $.ajax({
            url: '/pjlp/admin/users/',
            type: 'POST',
            dataType: 'JSON',
            data: {
                badgenumber: badgeNumber,
                defaultdeptid: bidang,
                name: name,
                Password: password,
                Privilege: id_role,
                Gender: gender,
                Birthday: ttl
            },
            beforeSend: function(e) {
                $("#add").html("<i class='fa fa-spinner fa-spin '></i>");
                $("#add").css("cursor", "not-allowed");
            },
            success: function(response) {
                $("#add").html('<i class="fa fa-send"></i> Kirim');
                $("#add").css('cursor', 'pointer');
                if (response.error) {
                    if (response.error.badgenumber) {
                        $("#nip").addClass('has-error');
                        $("#errorBadgenumber").html(response.error.badgenumber);
                    } else {
                        $("#nip").removeClass('has-error');
                        $("#errorBadgenumber").html("");
                    }
                    if (response.error.defaultdeptid) {
                        $("#departement").addClass('has-error');
                        $("#errorDepartement").html(response.error.defaultdeptid);
                    } else {
                        $("#departement").removeClass('has-error');
                        $("#errorDepartement").html("");
                    }
                    if (response.error.name) {
                        $("#nama").addClass('has-error');
                        $("#erroName").html(response.error.name);
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
                    if (response.error.Privilege) {
                        $("#privilege_id").addClass('has-error');
                        $("#errorPrivilege").html(response.error.Privilege);
                    } else {
                        $("#privilege_id").removeClass('has-error');
                        $("#errorPrivilege").html("");
                    }
                } else {
                    $('#tambahUsers').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setInterval(function() {
                        document.location.reload()
                    }, 500);
                }
            }
        });

    });

    $("#addUser").click(function(e) {
        $("#titleModal").html('Form Tambah Users');
        $("#add").removeAttr('disabled', 'disabled');
        $("#add").css('display', 'inline-block');
        $("#update").attr('disabled', 'disabled');
        $("#update").css('display', 'none');
        $("#userid").val('');
        $("#badgenumber").val('');
        $("#defaultdeptid").val('');
        $("#name").val('');
        $("#Password").val('');
        $("#Privilege").val('');
        $("#jk").val('');
        $("#birthday").val('');
    })

    // edit
    $(".target").on("click", ".item_edit", function(e) {
        var id_user = $(this).attr("data");
        $("#titleModal").html('Form Edit Users');
        $("#update").css('display', 'inline-block');
        $("#update").removeAttr('disabled', 'disabled');
        $("#add").css('display', 'none');
        $("#add").attr('disabled', 'disabled');
        // Validation

        $("#nip").removeClass('has-error');
        $("#errorBadgenumber").html("");

        $("#departement").removeClass('has-error');
        $("#errorDepartement").html("");

        $("#nama").removeClass('has-error');
        $("#errorName").html("");

        $("#passwordError").removeClass('has-error');
        $("#errorPassword").html("");

        $("#privilege_id").removeClass('has-error');
        $("#errorPrivilege").html("");

        $.ajax({
            url: '/pjlp/admin/getUsers/',
            data: {
                userid: id_user,
            },
            dataType: 'JSON',
            type: 'GET',
            success: function(response) {
                $("#tambahUsers").modal("show");
                $("#userid").val(response.userid);
                $("#badgenumber").val(response.badgenumber);
                $("#defaultdeptid").val(response.defaultdeptid);
                $("#name").val(response.name);
                $("#Password").val(response.Password);
                $("#Privilege").val(response.Privilege);
                $("#jk").val(response.Gender);
                $("#birthday").val(response.Birthday);
            }
        });
    });

    // button Update
    $("#update").click(function(e) {
        e.preventDefault();
        var userid = $("#userid").val();
        var badgeNumber = $("#badgenumber").val();
        var bidang = $("#defaultdepid").val();
        var name = $("#name").val();
        var password = $("#Password").val();
        var id_role = $("#Privilege").val();
        var gender = $("#jk").val();
        var ttl = $("#birthday").val();
        $.ajax({
            url: '/pjlp/admin/updateUsers/',
            data: {
                userid: userid,
                badgenumber: badgeNumber,
                defaultdeptid: bidang,
                name: name,
                Password: password,
                Privilege: id_role,
                Gender: gender,
                Birthday: ttl
            },
            beforeSend: function() {
                $("#update").html('<i class="fa fa-spinner fa-spin"></i>');
                $("#update").css('cursor', 'not-allowed');
            },
            dataType: 'json',
            type: 'post',
            success: function(response) {
                $("#update").html('<i class="fa fa-send"></i> Update');
                $("#update").css('cursor', 'pointer');
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setInterval(function() {
                    document.location.reload();
                }, 500);
            }
        });

    });

    // delete modal
    $(".target").on("click", '.item_delete', function(e) {
        e.preventDefault();
        var id = $(this).attr('data');
        $("#deleteUser").modal("show");
        $.ajax({
            url: '/pjlp/admin/getUsers/',
            data: {
                userid: id
            },
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                $("#userid_delete").val(response.userid);
            }
        });

    });

    $("#delete").click(function(e) {
        e.preventDefault();
        var id_user = $("#userid_delete").val();
        $.ajax({
            url: '/pjlp/admin/deleteUser/',
            data: {
                userid: id_user
            },
            dataType: 'json',
            type: 'POST',
            beforeSend: function(e) {
                $("#delete").html('<i class="fa fa-spinner fa-spin"></i>');
                $("#delete").css('cursor', 'not-allowed');
            },
            success: function(response) {
                $("#delete").html('<i class="fa fa-send"></i> Kirim');
                $("#delete").css('cursor', 'pointer');
                $("#deleteUser").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setInterval(function(e) {
                    document.location.reload()
                }, 500);

            }
        });
    });

    // $(document).ready(function() {
    //     getUsersManagement();
    // });
</script>
<?php $this->endSection() ?>