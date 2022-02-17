<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\Admin\BulanModel;
use App\Models\Admin\JadwalModel;
use App\Models\Admin\ShiftModel;
use App\Models\Admin\UserinfoModel;
use DateTime;

class Jadwal extends BaseController
{
    protected $jadwalModel;
    protected $userinfoModel;
    protected $shiftModel;
    protected $bulanModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->userinfoModel = new UserinfoModel();
        $this->shiftModel = new ShiftModel();
        $this->bulanModel = new BulanModel();
    }

    public function index($userid)
    {
        $date = new DateTime();
        $bulan = $date->format("m");
        $tahun = $date->format("Y");

        $currentPage = $this->request->getVar("page") ? $this->request->getVar('page') : 1;
        $data = [
            'title' => "PJLP Admin | Jadwal Kerja",
            'anggota' => $this->userinfoModel->getUserInfoById($userid),
            'shift' => $this->shiftModel->findAll(),
            'bulan' => $this->bulanModel->findAll(),
            'jadwal' => $this->jadwalModel->getJadwalById($userid, $bulan, $tahun)->paginate(10, 'jadwal'),
            'pager' => $this->jadwalModel->pager,
            'currentPage' => $currentPage
        ];
        return view("admin/jadwal", $data);
    }

    public function addJadwal()
    {

        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            if (!$this->validate([
                'tanggal_masuk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Tanggal Masuk Tidak Boleh Kosong",
                    ]
                ],
                'tanggal_pulang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Pulang Tidak Boleh Kosong'
                    ]
                ],
                'shift_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Shift Tidak Boleh Kosong'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'tanggal_masuk' => $validation->getError('tanggal_masuk'),
                        'tanggal_pulang' => $validation->getError('tanggal_pulang'),
                        'shift_id' => $validation->getError('shift_id')
                    ]
                ];
            } else {
                $userid = $this->request->getVar("userid");
                $tanggal_masuk = $this->request->getVar("tanggal_masuk");
                $tanggal_pulang = $this->request->getVar("tanggal_pulang");
                $shift_id = $this->request->getVar("shift_id");

                $this->jadwalModel->save([
                    'userid' => $userid,
                    'tanggal_masuk' => $tanggal_masuk,
                    'tanggal_pulang' => $tanggal_pulang,
                    'shift_id' => $shift_id
                ]);

                $msg = [
                    'success' => 'Data Berhasil disimpan'
                ];
            }
            return json_encode($msg);
        }
    }

    public function getJadwal($id)
    {
        if ($this->request->isAJAX()) {
            $date = new DateTime();
            $bulan = $date->format("m");
            $tahun = $date->format("Y");

            $filter = $this->request->getVar("filter");

            if ($filter) {
                $jadwal = $this->jadwalModel->getJadwalById($id, $filter, $tahun);
            } else {
                $jadwal = $this->jadwalModel->getJadwalById($id, $bulan, $tahun);
            }
            return json_encode($jadwal);
        }
    }

    public function editJadwal()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVAR('id_jadwal');

            $jadwal = $this->jadwalModel->getRowJadwal($id_jadwal);

            return json_encode($jadwal);
        }
    }

    public function updateJadwal()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar('id_jadwal');
            $userid = $this->request->getVar('userid');
            $tanggal_masuk = $this->request->getVar('tanggal_masuk');
            $tanggal_pulang = $this->request->getVar('tanggal_pulang');
            $shift_id = $this->request->getVar('shift_id');

            $this->jadwalModel->update($id_jadwal, [
                'id_jadwal' => $id_jadwal,
                'userid'    => $userid,
                'tanggal_masuk' => $tanggal_masuk,
                'tanggal_pulang'    => $tanggal_pulang,
                'shift_id'          => $shift_id
            ]);

            $message = [
                'success' => 'Data Jadwal Berhasil diubah!'
            ];
            return json_encode($message);
        }
    }

    public function hapusJadwal()
    {
        if ($this->request->isAJAX()) {
            $id_jadwal = $this->request->getVar("id_jadwal");

            $jadwal = $this->jadwalModel->delete($id_jadwal);

            $msg = [
                'success' => 'Data Berhasil di Hapus'
            ];

            return json_encode($msg);
        }
    }
}
