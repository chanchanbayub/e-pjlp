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
        <!-- Info boxes -->
        <div class="row">
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-4 ">
                <form>
                    <select name="filter" id="filter" class="form-control">
                        <option value="">
                            Filter Berdasarkan Seksi
                        </option>
                        <?php foreach ($seksi as $seksi) : ?>
                            <option value="<?= $seksi["id_seksi"]; ?>"><?= $seksi["seksi_bagian"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
                <br>
            </div>
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Group Users</h3>
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
                                            <th scope="col">Seksi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="target">
                                        <?php
                                        $number = 1;
                                        if (count($groupUser) > 0) :
                                            foreach ($groupUser as $group) : ?>
                                                <tr>
                                                    <td><?= $number++ ?>.</td>
                                                    <td><?= $group["badgenumber"] ?></td>
                                                    <td><?= $group["name"] ?></td>
                                                    <td><?= $group["seksi_bagian"]; ?></td>
                                                    <td align="center">
                                                        <button class="btn btn-danger item_delete" data="<?= $group["id_user_group"]; ?>"> <i class="fa fa-trash"></i> </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="10" align="center"> Tidak Ada Data</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <div class="col-md-12">
                                    <ol class=" pull-right">
                                        <?= $pager->links(); ?>
                                    </ol>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- ./box-body -->
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- modal hapus Jadwal -->
<div class="modal fade" id="hapusGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Form Hapus Jadwal Kerja</h4>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_user_group" id="id_user_group">
                    <h4> Apakah anda yakin ?</h4>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary delete"> <i class="fa fa-send"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script>
    $(".item_delete").click(function(e) {
        var id = $(this).attr('data');
        console.log(id);
        $("#hapusGroup").modal('show');
        $.ajax({
            url: '/pjlp/admin/getGroupUser/',
            type: 'GET',
            dataType: 'json',
            data: {
                id_user_group: id
            },
            success: function(response) {
                $("#id_user_group").val(response.id_user_group);
            }

        });

    });

    $(".delete").click(function(e) {
        e.preventDefault();
        var id = $("#id_user_group").val();
        $.ajax({
            url: '/pjlp/admin/deleteGroup/',
            data: {
                id_user_group: id
            },
            dataType: 'JSON',
            type: 'post',
            beforeSend: function(e) {
                $(".delete").html('<i class="fa fa-spinner fa-spin"></i>');
                $(".delete").css('cursor', 'not-allowed');
                $(this).attr("disabled", "disabled");
            },
            success: function(response) {
                $("#hapusGroup").modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`,
                });
                setInterval(function(e) {
                    document.location.reload()
                }, 500)

            }
        });
    });

    $("#filter").change(function(e) {
        var filter = $("#filter").val();
        $.ajax({
            url: '/pjlp/admin/filter/',
            data: {
                filter: filter
            },
            type: 'get',
            dataType: 'JSON',
            success: function(response) {
                var table = '';
                var nomor = 1;
                if (response.length > 0) {
                    response.forEach(element => {
                        table += `<tr>
                            <td> ${nomor++}. </td>
                            <td> ${element.badgenumber} </td>
                            <td> ${element.name} </td>
                            <td> ${element.seksi_bagian} </td>
                            <td align="center"> 
                                <button class="btn btn-danger item_delete" data="${element.id_user_group}"> <i class="fa fa-trash"></i> </button> 
                            </td>
                        </tr>`;
                    });
                } else {
                    table += `<tr>
                        <td colspan="10" align="center"> Tidak Ada Data </td>
                    </tr>`;
                }
                $(".target").html(table);
            }
        });
    });
</script>
<?php $this->endSection() ?>