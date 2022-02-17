<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\Admin\ShiftModel;

class Shift extends BaseController
{

    protected $shiftModel;

    public function __construct()
    {
        $this->shiftModel = new ShiftModel();
    }

    public function index()
    {

        $data = [
            "title" => "PJLP | Admin Shift",

        ];
        return view('admin/shift', $data);
    }

    public function getShift()
    {
        if ($this->request->isAjax()) {
            $shift = $this->shiftModel->getResultShift();
            return json_encode($shift);
        };
    }

    public function addShift()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'shift_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Shift Tidak Boleh Kosong'
                    ]
                ],
                'shift_masuk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Jam Masuk Tidak Boleh Kosong"
                    ]
                ],
                'shift_pulang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Jam Pulang Tidak Boleh Kosong"
                    ]
                ]
            ])) {
                $message = [
                    'error' => [
                        'shift_name' => $validation->getError('shift_name'),
                        'shift_masuk' => $validation->getError('shift_masuk'),
                        'shift_pulang' => $validation->getError('shift_pulang'),

                    ]
                ];
            } else {
                $shift_name = $this->request->getVar("shift_name");
                $shift_masuk = $this->request->getVar("shift_masuk");
                $shift_pulang = $this->request->getVar("shift_pulang");

                $this->shiftModel->save([
                    'shift_name' => $shift_name,
                    'shift_masuk' => $shift_masuk,
                    'shift_pulang' => $shift_pulang
                ]);

                $message = [
                    'success' => 'Data Berhasil Ditambahkan!',
                ];
            }
            return  json_encode($message);
        }
    }
    public function getDataShift()
    {
        if ($this->request->isAJAX()) {
            $id_shift = $this->request->getVar("id_shift");
            $data = $this->shiftModel->getDataShift($id_shift);
            return json_encode($data);
        }
    }
    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'shift_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Shift Tidak Boleh Kosong'
                    ]
                ],
                'shift_masuk' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Jam Masuk Tidak Boleh Kosong"
                    ]
                ],
                'shift_pulang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Jam Pulang Tidak Boleh Kosong"
                    ]
                ]
            ])) {
                $message = [
                    'error' => [
                        'shift_name' => $validation->getError('shift_name'),
                        'shift_masuk' => $validation->getError('shift_masuk'),
                        'shift_pulang' => $validation->getError('shift_pulang'),

                    ]
                ];
            } else {
                $id_shift = $this->request->getVar('id_shift');
                $shift_name = $this->request->getVar("shift_name");
                $shift_masuk = $this->request->getVar("shift_masuk");
                $shift_pulang = $this->request->getVar("shift_pulang");

                $this->shiftModel->update($id_shift, [
                    'id_shift' => $id_shift,
                    'shift_name' => $shift_name,
                    'shift_masuk' => $shift_masuk,
                    'shift_pulang' => $shift_pulang
                ]);

                $message = [
                    'success' => 'Data Berhasil Ditambahkan!',
                ];
            }
            return  json_encode($message);
        }
    }
    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id_shift = $this->request->getVar("id_shift");

            $shift = $this->shiftModel->delete($id_shift);

            return json_encode($shift);
        }
    }
}
