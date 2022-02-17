<?php $this->extend('layout/templateAdmin') ?>
<?php $this->section("content"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?>
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
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"> Jumlah Role Management </span>
                        <strong><?= $role; ?></strong>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Role Management </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#tambahRole"><i class="fa fa-plus"></i> Tambah Role</button>
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
                                            <th scope="col">Nama Role</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="target">

                                    </tbody>
                                </table>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Modal Add New Role -->
<div class="modal fade" id="tambahRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Tambah Role</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <div class="form-group" id="id">
                        <label for="id_role" class="control-label">ID Role :</label>
                        <input type="number" class="form-control" id="id_role" name="id_role" placeholder="Masukan ID Role Baru">
                        <span id="errorId" class="help-block"></span>
                    </div>
                    <div class="form-group" id="name">
                        <label for="role_name" class="control-label">Role Name :</label>
                        <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Masukan Role Baru">
                        <span id="errorRole" class="help-block"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary add"> <i class="fa fa-send"></i> Kirim</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal Edit Role -->
<div class="modal fade" id="editRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Edit Role</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="id_edit">
                    <div class="form-group" id="updateIdRole">
                        <label for="id_role_edit" class="control-label">ID Role :</label>
                        <input type="number" class="form-control" id="id_role_edit" name="id_role" placeholder="Masukan ID Role">
                        <span id="errorRoleEdit" class="help-block"></span>
                    </div>
                    <div class="form-group" id="updateName">
                        <label for="role_name_edit" class="control-label">Role Name :</label>
                        <input type="text" class="form-control" id="role_name_edit" name="role_name" placeholder="Masukan Role Baru">
                        <span id="errorRoleEdit" class="help-block"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary update"> <i class="fa fa-send"></i> Kirim</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal Hapus Role -->
<div class="modal fade" id="deleteRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Delete Role</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="id_delete">
                    <h4>Apakah Anda yakin ?</h4>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-danger delete"> <i class="fa fa-send"></i> Delete</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    function getRoleName() {
        $.ajax({
            url: '/pjlp/admin/getRole/',
            type: 'get',
            dataType: 'json',
            success: function(response) {
                let row = '';
                let number = 1;
                if (response.length > 0) {
                    response.forEach(element => {
                        row += `<tr> 
                            <th> ${number++}.</th>  
                            <td>${element.role_name}</td>  
                            <td align = "center">
                            <a href ="javascript:; "class ="btn btn-warning item_edit" data = "${element.id}"><i class= "fa fa-pencil"> </i></a> 
                            <a href = "javascript:;" class = "btn btn-danger item_delete" data = "${element.id}"> <i class = "fa fa-trash" > </i> </a> 
                            </td>  
                        </tr> `;
                    });
                } else {
                    row += `<tr> 
                        <td colspan="10" align="center"> Tidak ada Data </td> 
                        </tr>`;
                }
                $(".target").html(row);
            }
        });
    }

    $(".add").click(function(e) {
        e.preventDefault();
        var role_id = $('#id_role').val();
        var role_name = $('#role_name').val();
        $.ajax({
            type: 'POST',
            url: '/pjlp/admin/addRole/',
            dataType: 'json',
            data: {
                id_role: role_id,
                role_name: role_name
            },
            beforeSend: function(e) {
                $(".add").html("<i class ='fa fa-spinner fa-spin'> </i>");
                $(".add").css("cursor", "not-allowed");
            },
            success: function(response) {
                $(".add").css("cursor", "pointer");
                $(".add").html("<i class='fa fa-send'></i>Kirim");
                if (response.error) {
                    if (response.error.id_role) {
                        $("#id").addClass("has-error");
                        $("#errorId").html(response.error.id_role)
                    } else {
                        $("#id").removeClass("has-error");
                        $("#errorId").html('')
                    }
                    if (response.error.role_name) {
                        $("#name").addClass("has-error");
                        $("#errorRole").html(response.error.role_name)
                    } else {
                        $("#name").removeClass("has-error");
                        $("#errorRole").html('')
                    }
                } else {
                    $("#tambahRole").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setInterval(function(e) {
                        document.location.reload();
                    }, 700);
                }
            }
        });
    });

    $(".target").on("click", ".item_edit", function(e) {
        var id = $(this).attr("data");
        $.ajax({
            url: '/pjlp/admin/getDataRole/',
            data: {
                id: id
            },
            dataType: 'json',
            type: 'get',
            success: function(response) {
                // console.log(response);
                $("#editRole").modal('show');
                $("#id_edit").val(response.id);
                $("#id_role_edit").val(response.id_role);
                $("#role_name_edit").val(response.role_name);
            }
        });
    });
    $(".update").click(function(e) {
        e.preventDefault();
        var id_data = $("#id_edit").val();
        var id_role = $("#id_role_edit").val();
        var role_name = $("#role_name_edit").val();

        $.ajax({
            url: '/pjlp/admin/updateRole/',
            type: 'post',
            data: {
                id: id_data,
                id_role: id_role,
                role_name: role_name
            },
            dataType: 'json',
            beforeSend: function(e) {
                $(".update").html('<i class="fa fa-spinner fa-spin"></i>');
                $(".update").css("cursor", "not-allowed");
            },
            success: function(response) {
                $(".update").css("cursor", "pointer");
                $(".update").html('<i class="fa fa-send"></i> Kirim');
                if (response.error) {
                    if (response.error.role_name) {
                        $("#updateName").addClass("has-error");
                        $("#errorRoleEdit").html(response.error.role_name)
                    } else {
                        $("#updateName").removeClass("has-error");
                        $("#errorRoleEdit").html('')
                    }
                } else {
                    $("#editRole").modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setInterval(function(e) {
                        document.location.reload();
                    }, 500);
                }
            }
        });
    });

    $(".target").on("click", ".item_delete", function(e) {
        var id = $(this).attr("data");
        $("#deleteRole").modal("show");
        $("#id_delete").val(id);
    });

    $(".delete").click(function(e) {
        e.preventDefault();
        var id_data = $("#id_delete").val();
        $.ajax({
            url: '/pjlp/admin/deleteRole/',
            data: {
                id: id_data
            },
            type: 'POST',
            dataType: 'JSON',
            beforeSend: function(e) {
                $(".delete").html('<i class = "fa fa-spinner fa-spin"></i>');
                $(".delete").css('cursor', 'not-allowed');
            },
            success: function(response) {
                $("#deleteRole").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setInterval(function(e) {
                    document.location.reload();
                }, 500);
            }
        });

    });
    $(document).ready(function() {
        getRoleName();
    });
</script>
<?php $this->endSection() ?>