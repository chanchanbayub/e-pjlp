<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UserinfoModel;
use App\Models\Admin\GajiModel;
use App\Models\Admin\GroupusersModel;
use App\Models\Admin\SeksibagianModel;
use App\Models\Users\ImageModel;
use DateTime;

class Userinfo extends BaseController
{
    protected $userinfo;
    protected $gaji;
    protected $seksiBagianModel;
    protected $groupUserModel;
    protected $imageModel;

    public function __construct()
    {
        $this->userinfo = new UserinfoModel();
        $this->gajiModel = new GajiModel();
        $this->seksiBagianModel = new SeksibagianModel();
        $this->groupUserModel = new GroupusersModel();
        $this->imageModel = new ImageModel();
    }

    public function index()
    {
        if (session('level') == 14 || session('level') == 12) {
            $anggota = $this->groupUserModel->getUserWithSeksi(session('userid'));
        } else if (session('level') == 2) {
            $anggota = $this->groupUserModel->getUserWithSeksi(session('userid'), session('id_seksi'));
        }

        $currentPage = $this->request->getVar("page") ? $this->request->getVar('page') : 1;
        $data = [
            "title" => "PJLP | Admin Anggota",
            'anggota' => $anggota->paginate(10, 'group_user'),
            'pager' => $this->groupUserModel->pager,
            'currentPage' => $currentPage
        ];
        return view('admin/anggota', $data);
    }

    public function getProfil($userid)
    {
        $validation =  \Config\Services::validation();

        $data = [
            "title" => "PJLP | Profil",
            "profil" => $this->userinfo->getDataUser($userid),
            "validation" => $validation
        ];
        if (empty($data["profil"]["userid"])) {

            return redirect()->back();
        }
        return view('admin/profil', $data);
    }
    public function editProfil($userid)
    {
        $validation = \Config\Services::validation();
        $data = [
            "title" => "PJLP | Edit Profil",
            "validation" => $validation,
            "profil" => $this->userinfo->getDataUser($userid),
            "seksi" => $this->seksiBagianModel->findAll()
        ];

        return view('admin/edit_profil', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            // cek validasi
            $validation = \Config\Services::validation();
            if (!$this->validate([
                'name' => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Nama Tidak Boleh Kosong"
                    ]
                ],
                'Birthday' => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Tanggal Lahir Tidak boleh kosong"
                    ]
                ],
                'Password' => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Tidak Boleh Kosong"
                    ]
                ],
                'Gender' => [
                    "rules" => "required",
                    "errors" => [
                        'required' => "Jenis Kelamin Tidak Boleh Kosong",
                    ]
                ],
                'seksi_bagian' => [
                    "rules" => "required",
                    "errors" => [
                        'required' => "Data Seksi Tidak Boleh Kosong",
                    ]
                ],

            ])) {

                $messeage = [
                    'error' => [
                        'name' => $validation->getError('name'),
                        'Password' => $validation->getError('Password'),
                        'Birthday' => $validation->getError('Birthday'),
                        'Gender' => $validation->getError('Gender'),
                        'seksi_bagian' => $validation->getError('seksi_bagian'),
                    ]
                ];
            } else {
                $userid = $this->request->getVar('userid');
                $badgenumber = $this->request->getVar('badgenumber');
                $name = $this->request->getVar('name');
                $password = $this->request->getVar('Password');
                $birthday = $this->request->getVar("Birthday");
                $gender = $this->request->getVar("Gender");

                $seksi_bagian = $this->request->getVar("seksi_bagian");

                $this->userinfo->update($userid, [
                    'userid' => $userid,
                    'badgenumber' => $badgenumber,
                    'name' => $name,
                    'Birthday' => $birthday,
                    'Gender' => $gender,
                    'Password' => $password
                ]);

                $dataGroup = $this->groupUserModel->getGroupUserid($userid);
                if ($dataGroup > 0) {
                    $this->groupUserModel->update($dataGroup["id_user_group"], [
                        'userid_group' => $userid,
                        'seksi_id' => $seksi_bagian
                    ]);
                } else {
                    $this->groupUserModel->save([
                        'userid_group' => $userid,
                        'seksi_id' => $seksi_bagian,

                    ]);
                }
                $dataSeksi = $this->groupUserModel->getGroupUserid($userid);
                $sessionData = [
                    'name' => $this->request->getVar('name'),
                    'seksi_bagian' => $dataSeksi["seksi_bagian"],
                    'id_seksi' => $dataSeksi["id_seksi"]
                ];
                session()->set($sessionData);
                $messeage = [
                    'pesan' => 'Data Berhasil diubah!',
                ];
            }
            return json_encode($messeage);
        }
    }

    public function saveImage($userid)
    {
        $validation = \Config\Services::validation();

        if (!$this->validate([

            'image' => [
                "rules" => "uploaded[image]|is_image[image]|max_size[image,200]",
                "errors" => [
                    "uploaded" => "Foto Tidak Boleh Kosong ",
                    "is_image" => "Yang anda Upload Bukan Foto",
                    "max_size" => "Ukuran Foto Terlalu Besar, Maximal 200kb"
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }
        $image = $this->request->getFile('image');

        $nameImage = $image->getRandomName();
        $image->move('assets/img/pjlp/', $nameImage);
        $this->imageModel->save([
            'userid_image' => $userid,
            'image' => $nameImage
        ]);
        session()->set('image', $nameImage);
        return redirect()->back()->withInput();
    }

    public function getDataUser()
    {
        if ($this->request->isAJAX()) {
            $userid = $this->request->getVar("userid");

            $anggota = $this->userinfo->getDataUser($userid);
            return json_encode($anggota);
        }
    }

    public function getAnggotaWhereId()
    {
        if ($this->request->isAJAX()) {
            $userid = $this->request->getVar('userid');

            $anggota = $this->userinfo->getUserInfoById($userid);

            return json_encode($anggota);
        }
    }

    public function detail($userid)
    {
        $date = new DateTime();
        $bulan = $date->format("m");
        $tahun = $date->format("Y");

        $data = [
            'title' => "PJLP ADMIN | DETAIL",
            'anggota' => $this->userinfo->getUserInfoById($userid),
            'gaji'      => $this->gajiModel->getGajiWithMonth($userid, $bulan, $tahun)
        ];

        return view('admin/detail', $data);
    }
}
