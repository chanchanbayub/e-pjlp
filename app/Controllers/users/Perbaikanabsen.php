<?php

namespace App\Controllers\users;


use App\Controllers\BaseController;
use App\Models\Admin\BulanModel;
use App\Models\Admin\KeteranganModel;
use App\Models\users\PerbaikanabsenModel;
use DateTime;
use Mpdf\Mpdf;


class Perbaikanabsen extends BaseController
{
	protected $bulanModel;
	protected $perbaikanabsenModel;
	protected $keteranganModel;

	public function __construct()
	{
		$this->bulanModel = new BulanModel();
		$this->perbaikanabsenModel = new PerbaikanabsenModel();
		$this->keteranganModel = new KeteranganModel();
	}
	public function index($userid)
	{
		$dateTime = new DateTime();
		$tahun = $dateTime->format("Y");
		$bulan = $dateTime->format("m");

		$currentPage = $this->request->getVar("page") ? $this->request->getVar('page') : 1;
		$perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithMonth($userid, $bulan, $tahun);

		$data = [
			'title' => "PJLP | Perbaikan Absen",
			'bulan' => $this->bulanModel->findAll(),
			'keterangan' => $this->keteranganModel->findAll(),
			'perbaikanAbsen' => $perbaikanAbsen->paginate(10, 'perbaikanAbsen'),
			'totalPerbaikan' => $this->perbaikanabsenModel->totalPerbaikan($userid, $bulan, $tahun),
			'totalPengajuan' => $this->perbaikanabsenModel->totalPengajuan($userid, $bulan, $tahun),
			'totalSukses' => $this->perbaikanabsenModel->totalSukses($userid, $bulan, $tahun),
			'currentPage' => $currentPage,
			'pager' => $this->perbaikanabsenModel->pager
		];
		return view("users/perbaikanAbsen", $data);
	}

	public function getPerbaikanAbsen($userid)
	{
		if ($this->request->isAJAX()) {

			$filter = $this->request->getVar("filter");
			$dateTime = new DateTime();
			$tahun = $dateTime->format("Y");
			$bulan = $dateTime->format("m");

			if ($filter) {
				$perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithFilter($userid, $filter, $tahun);
			} else {
				$perbaikanAbsen = $this->perbaikanabsenModel->getPerbaikanWithFilter($userid, $bulan, $tahun);
			}
			$data = [
				'perbaikanAbsen' => $perbaikanAbsen
			];

			return json_encode($data);
		}
	}

	public function getId()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar("id_perbaikan");
			$perbaikanabsen = $this->perbaikanabsenModel->getId($id);

			return json_encode($perbaikanabsen);
		}
	}

	public function savePerbaikan()
	{
		if ($this->request->isAJAX()) {

			$validation = \Config\Services::validation();
			if (!$this->validate([
				'pengajuanPerbaikan' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Pengajuan Perbaikan Tidak Boleh Kosong'
					]
				],
				'file' => [
					'rules'  => 'required|is_image[file]|ext_in[file,png,jpg,jpeg]',
					'errors' => [
						'required' => 'Bukti Keterangan Tidak Boleh Kosong',
						'is_image' => 'yang anda upload bukan gambar',
						'ext_in' => 'file yang anda upload bukan png/jpg/jpeg'
					]
				]
			])) {
				$message = [
					'error' => [
						'pengajuanPerbaikan' => $validation->getError("pengajuanPerbaikan"),
						'file'	=> $validation->getError("file")
					],
				];
			} else {
				$id_perbaikan = $this->request->getVar("id_perbaikan");
				$userid = $this->request->getVar("userid");
				$pengajuanPerbaikan = $this->request->getVar("pengajuanPerbaikan");
				$fileBukti = $this->request->getFile("file");
				$nameFile = $fileBukti->getRandomName();

				$fileBukti->move('perbaikan', $nameFile);

				$this->perbaikanabsenModel->update($id_perbaikan, [
					'id_perbaikan' => $id_perbaikan,
					'userid' => $userid,
					'pengajuanPerbaikan' => $pengajuanPerbaikan,
					'status' => 0,
					'file' => $nameFile,
				]);
				$message = [
					'success' => "data berhasil di simpan",
				];
			}
			return json_encode($message);
		}
	}
	public function cetakPDFPerbaikan($userid)
	{
		setlocale(LC_TIME, 'id');
		$date = new DateTime();
		$bulan = $date->format("m");
		$tahun = $date->format("Y");

		$month = strftime('%B %Y', $date->getTimestamp());

		$data = [

			'month' => $month
		];

		$mpdf = new Mpdf(["mode" => 'utf-8', "format" => "A4-P"]);

		$html = view("users/cetakPdfPerbaikan", $data);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Perbaikan Absen - ' . session("name") . ".pdf", \Mpdf\Output\Destination::INLINE);
	}
}
