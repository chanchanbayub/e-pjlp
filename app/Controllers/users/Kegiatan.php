<?php

namespace App\Controllers\users;

use App\Controllers\BaseController;
use App\Models\Admin\BulanModel;
use App\Models\users\KegiatanModel;
use DateTime;
use Mpdf\Mpdf;


class Kegiatan extends BaseController
{
  protected $kegiatanModel;
  protected $bulanModel;

  public function __construct()
  {
    $this->kegiatanModel = new KegiatanModel();
    $this->bulanModel = new BulanModel();
  }

  public function index($userid)
  {
    $date = new DateTime();
    $bulan = $date->format("m");
    $tahun = $date->format("Y");

    $currentPage = $this->request->getVar("page") ? $this->request->getVar('page') : 1;

    $data = [
      'validation' => \Config\Services::validation(),
      'kegiatan' =>  $this->kegiatanModel->getDataKegiatan($userid, $bulan, $tahun)->paginate(10, 'kegiatan'),
      'pager' => $this->kegiatanModel->pager,
      "title" => "PJLP | Kegiatan",
      'currentPage' => $currentPage,
      "bulan" => $this->bulanModel->findAll()
    ];

    return view('users/kegiatan', $data);
  }


  public function cetakPDFKegitan($userid)
  {
    setlocale(LC_TIME, 'id');
    $date = new DateTime();
    $bulan = $date->format("m");
    $tahun = $date->format("Y");

    $month = strftime('%B %Y', $date->getTimestamp());
    $filter = $this->request->getVar("filter");

    if ($filter) {
      $kegiatan = $this->kegiatanModel->getKinerjaPdf($userid, $filter, $tahun);
    } else {
      $kegiatan = $this->kegiatanModel->getKinerjaPdf($userid, $bulan, $tahun);
    }

    $data = [
      'kegiatan' => $kegiatan,
      'month' => $month
    ];

    $mpdf = new Mpdf(["mode" => 'utf-8', "format" => "A4-L"]);

    $html = view("users/cetakPdfKegiatan", $data);
    $mpdf->WriteHTML($html);
    $mpdf->Output('E-Kinerja - ' . session("name") . ".pdf", \Mpdf\Output\Destination::DOWNLOAD);
  }

  public function save()
  {
    if ($this->request->isAJAX()) {
      $validation = \Config\Services::validation();

      if (!$this->validate([
        'kegiatan' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Kegiatan Tidak Boleh Kosong'
          ]
        ],
        'tanggal' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Tanggal Kegiatan Tidak Boleh Kosong'
          ]
        ],
        'jam' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Jam Mulai Kegiatan Tidak Boleh Kosong'
          ]
        ],
        'selesai' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Jam Selesai Kegiatan Tidak Boleh Kosong'
          ]
        ],
      ])) {
        $messeage = [
          'error' => [
            'kegiatan' => $validation->getError('kegiatan'),
            'tanggal' => $validation->getError('tanggal'),
            'jam' => $validation->getError('jam'),
            'selesai' => $validation->getError('selesai'),
          ]
        ];
      } else {
        $useridKegiatan = $this->request->getVar('userid');
        $kegiatan = $this->request->getVar("kegiatan");
        $tanggal = $this->request->getVar("tanggal");
        $jam = $this->request->getVar("jam");
        $selesai = $this->request->getVar("selesai");

        $this->kegiatanModel->save([
          'userid' => $useridKegiatan,
          'kegiatan'  => $kegiatan,
          'tanggal'   => $tanggal,
          'jam'       => $jam,
          'selesai'   => $selesai
        ]);

        $messeage = [
          'success' => 'Data Kegiatan Berhasi ditambahkan!'
        ];
      }

      return json_encode($messeage);
    } else {
      echo "Tidak dapat di proses";
    }
  }
  public function getKinerja($userid)
  {
    if ($this->request->isAJAX()) {

      $filter = $this->request->getVar("filter");
      $date = new DateTime();
      $bulan = $date->format("m");
      $tahun = $date->format("Y");

      if ($filter) {
        $kegiatan = $this->kegiatanModel->getDataKegiatan($userid, $filter, $tahun)->paginate(10);
      } else {
        $kegiatan = $this->kegiatanModel->getDataKegiatan($userid, $bulan, $tahun)->paginate(10);
      }

      return json_encode($kegiatan);
    } else {
      echo "Tidak Bisa di proses";
    }
  }
}
