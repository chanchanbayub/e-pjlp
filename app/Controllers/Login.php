<?php

namespace App\Controllers;

use App\Models\users\ProfilModel;
use App\Models\LoginModel;

class Login extends BaseController
{
    protected $profilModel;
    protected $loginModel;

    public function __construct()
    {
        $this->profilModel = new ProfilModel();
        $this->loginModel = new LoginModel();
    }

    public function index()
    {
        // $session = session();
        if (session("userid")) {
            return redirect()->to("/pjlp/beranda")->withInput();
        }
        $validation = \Config\Services::validation();

        $data = [
            "title" => "PJLP | Login",
            "validation" => $validation
        ];

        return view('login', $data);
    }

    public function login()
    {
        // validation ()
        if (!$this->validate([
            "userid" => [
                "rules" => "required",
                "errors" => [
                    "required" => "No PJLP tidak boleh kosong"
                ]
            ],
            "password" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Password tidak boleh kosong",
                ]
            ]

        ])) {
            return redirect()->back()->withInput();
        }
        $userid = $this->request->getVar("userid");
        $password = $this->request->getVar("password");
        $row  = $this->loginModel->getDataLogin($userid);

        if ($row > 0) {
            if ($row["Password"] == null) {
                if ($password == $row["userid"]) {
                    if ($row["Privilege"] == 14) {
                        $sessionLog = [
                            'name' => strtolower($row["name"]),
                            'userid' => $row["userid"],
                            'badgenumber' => $row["badgenumber"],
                            'level' => $row["Privilege"]
                        ];
                        session()->set($sessionLog);
                        session()->setFlashdata('pesan', 'Berhasil Login');
                        return redirect()->to("/pjlp/admin/")->withInput();
                    } else if ($row["Privilege"] == 0) {
                        $sessionLog = [
                            'name' => strtolower($row["name"]),
                            'userid' => $row["userid"],
                            'badgenumber' => $row["badgenumber"],
                            'level' => $row["Privilege"]
                        ];
                        session()->set($sessionLog);
                        session()->setFlashdata('pesan', 'Berhasil Login');
                        return redirect()->to("/pjlp/beranda/")->withInput();
                    } else if ($row["Privilege"] == 2) {
                        $sessionLog = [
                            'name' => strtolower($row["name"]),
                            'userid' => $row["userid"],
                            'badgenumber' => $row["badgenumber"],
                            'level' => $row["Privilege"]
                        ];
                        session()->set($sessionLog);
                        session()->setFlashdata('pesan', 'Berhasil Login');
                        return redirect()->to("/pjlp/admin/")->withInput();
                    }
                }
            } else if ($row["Password"] != null) {
                if ($password == $row["Password"]) {
                    if ($row["Privilege"] == 14 || $row["Privilege"] == 12 || $row["Privilege"] == 2) {
                        $sessionLog = [
                            'name' => strtolower($row["name"]),
                            'userid' => $row["userid"],
                            'badgenumber' => $row["badgenumber"],
                            'level' => $row["Privilege"],
                            'image' => $row["image"],
                            'seksi_bagian' => $row["seksi_bagian"],
                            'id_seksi' => $row["id_seksi"]
                        ];
                        session()->set($sessionLog);
                        session()->setFlashdata('pesan', 'Berhasil Login');
                        return redirect()->to("/pjlp/admin/")->withInput();
                    } else if ($row["Privilege"] == 0) {
                        $sessionLog = [
                            'name' => strtolower($row["name"]),
                            'userid' => $row["userid"],
                            'badgenumber' => $row["badgenumber"],
                            'level' => $row["Privilege"],
                            'image' => $row["image"],
                            'seksi_bagian' => $row["seksi_bagian"],
                            'id_seksi' => $row["id_seksi"]
                        ];
                        session()->set($sessionLog);
                        session()->setFlashdata('pesan', 'Berhasil Login');
                        return redirect()->to("/pjlp/beranda/")->withInput();
                    }
                }
            }
        } else if ($row == 0) {
            session()->setFlashdata('pesan', 'No PJLP tidak ditemukan');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata("pesan", "No PJLP atau Password Salah !");
        return redirect()->back()->withInput();
    }

    public function Logout()
    {
        $session  = session();
        $session->destroy();

        $session->setFlashdata("pesan", "Anda Berhasil Log Out, Trimakasih!");

        return redirect()->to('/login')->withInput();
    }
}
