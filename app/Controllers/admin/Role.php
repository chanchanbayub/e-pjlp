<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\Admin\RolemanagementModel;

class Role extends BaseController
{

    protected $roleManagementModel;

    public function __construct()
    {
        $this->roleManagementModel = new RolemanagementModel();
    }

    public function index()
    {
        $data = [
            "title" => "PJLP | Role Management",
            "role" => $this->roleManagementModel->countAllResults()
        ];
        return view('admin/role', $data);
    }

    public function getRole()
    {
        if ($this->request->isAjax()) {
            $role = $this->roleManagementModel->getResultRole();
            return json_encode($role);
        };
    }
    public function addRole()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'id_role' => [
                    'rules' => 'required|is_unique[rolemanagement.id_role]',
                    'errors' => [
                        'required' => 'ID Role Tidak Boleh Kosong',
                        'is_unique' => 'ID Role Sudah Terdaftar'
                    ]
                ],
                'role_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Tidak Boleh Kosong'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'id_role' => $validation->getError('id_role'),
                        'role_name' => $validation->getError('role_name')
                    ]
                ];
            } else {
                $id_role = $this->request->getVar("id_role");
                $role_name = $this->request->getVar("role_name");

                $this->roleManagementModel->save([
                    'id_role' => $id_role,
                    'role_name' => $role_name
                ]);

                $messeage = [
                    'success' => 'Data Role Baru telah ditambahkan!'
                ];
            }
            // dd($id_role);
            return json_encode($messeage);
        }
    }

    public function getDataRole()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar("id");

            $dataRole = $this->roleManagementModel->where(["id" => $id])->first();

            return json_encode($dataRole);
        }
    }
    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            if (!$this->validate([
                'role_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Tidak Boleh Kosong'
                    ]
                ]
            ])) {
                $messeage = [
                    'error' => [
                        'role_name' => $validation->getError('role_name')
                    ]
                ];
            } else {
                $id = $this->request->getVar('id');
                $id_role = $this->request->getVar('id_role');
                $role_name = $this->request->getVar("role_name");

                $this->roleManagementModel->update($id, [
                    'id' => $id,
                    'id_role' => $id_role,
                    'role_name' => $role_name
                ]);

                $messeage = [
                    'success' => 'Data Role Baru Berhasil diperbaharui!'
                ];
            }
            return json_encode($messeage);
        }
    }
    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar("id");

            $role = $this->roleManagementModel->delete($id);

            $messeage = [
                'success' => 'Data Berhasil dihapus!'
            ];
            return json_encode($messeage);
        }
    }
}
