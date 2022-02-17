<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <style>
        th {
            padding: 5px 0;
        }

        td {
            padding: 5px 0;
        }

        h3 {
            text-transform: uppercase;
        }
    </style>

</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3 class="text-center ">REKAPITULASI KINERJA PETUGAS PENUNJANG KEGIATAN KANTOR/ LAPANGAN (PPKK/L)
                    DINAS PERHUBUNGAN PROVINSI DKI JAKARTA <br> SEKSI MANAJEMEN BIDANG <?= session('seksi_bagian'); ?> <br> <?= $month; ?>
                </h3>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No.</th>
                                <th class="text-center" scope="col">Tanggal</th>
                                <th class="text-center" scope="col">Jam Mulai</th>
                                <th class="text-center" scope="col">Jam Selesai</th>
                                <th class="text-center" scope="col">Uraian Kegiatan</th>
                                <th class="text-center" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 1; ?>

                            <?php if (count($kegiatan) > 0) :
                                foreach ($kegiatan as $kegiatan) : ?>
                                    <tr>
                                        <td class="text-center"><?= $number++; ?>.</td>
                                        <td class="text-center"><?= $kegiatan["tanggal"]; ?> </td>
                                        <td class="text-center"><?= $kegiatan["jam"]; ?> </td>
                                        <td class="text-center"><?= $kegiatan["selesai"]; ?> </td>
                                        <td class="text-center"><?= $kegiatan["kegiatan"]; ?> </td>
                                        <?php if ($kegiatan["status"] == null) : ?>
                                            <td class="text-center">sedang dievaluasi</td>
                                        <?php else : ?>
                                            <td class="text-center"><?= $kegiatan["status"]; ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <td class="text-center"> Tidak Ada Data</td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>

</html>