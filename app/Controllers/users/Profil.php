<?php

namespace App\Controllers\users;

use App\Controllers\BaseController;
use App\Models\Admin\GroupusersModel;
use App\Models\Admin\SeksibagianModel;
use App\Models\Users\ImageModel;
use App\Models\users\ProfilModel;


class Profil extends BaseController
{
    protected $profilModel;
    protected $seksiBagianModel;
    protected $groupUserModel;
    protected $imageModel;

    public function __construct()
    {
        $this->profilModel = new ProfilModel();
        $this->seksiBagianModel = new SeksibagianModel();
        $this->groupUserModel = new GroupusersModel();
        $this->imageModel = new ImageModel();
    }
    public function index($userid)
    {
        $validation =  \Config\Services::validation();
        $data = [
            "title" => "PJLP | Profil",
            "profil" => $this->profilModel->getData($userid),
            "validation" => $validation
        ];
        if (empty($data["profil"]["userid"])) {

            return redirect()->back();
        }
        return view('users/profil', $data);
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

    public function edit($userid)
    {
        $validation = \Config\Services::validation();
        $data = [
            "title" => "PJLP | Edit Profil",
            "validation" => $validation,
            "profil" => $this->profilModel->getData($userid),
            "seksi" => $this->seksiBagianModel->where(["id_seksi !=" => 3])->findAll()
        ];

        return view('users/edit_profil', $data);
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

                $userid_group = $this->request->getVar('userid');
                $seksi_bagian = $this->request->getVar("seksi_bagian");

                $this->profilModel->update($userid, [
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
                        'userid_group' => $userid_group,
                        'seksi_id' => $seksi_bagian
                    ]);
                } else {
                    $this->groupUserModel->save([
                        'userid_group' => $userid_group,
                        'seksi_id' => $seksi_bagian
                    ]);
                }
                $dataSeksi = $this->groupUserModel->getGroupUserid($userid);

                $sessionData = [
                    'name' => $this->request->getVar('name'),
                    'seksi_bagian' => $dataSeksi["seksi_bagian"]
                    // 'photo' => $this->request->getFile('photo')
                ];
                session()->set($sessionData);
                $messeage = [
                    'pesan' => 'Data Berhasil diubah!'
                ];
            }
            return json_encode($messeage);
        }
    }

    public function getData($userid)
    {
        if ($this->request->isAJAX()) {

            $profil = $this->profilModel->getData($userid);

            return json_encode($profil);
        }
    }
}
