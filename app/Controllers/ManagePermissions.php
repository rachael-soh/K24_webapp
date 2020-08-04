<?php namespace App\Controllers;

use App\Models\ManagePermission;

class ManagePermissions extends BaseController
{    

    public function managePermissions(){
        $model = new ManagePermission();

        $allowed = $model->getUserPerms(session()->get('user_id'));

        // update role permissions if admin
        if ($this->request->getMethod() == 'post' && in_array(2,$allowed)){
            $action = $this->request->getPost('action');
            $newPerms = $this->request->getPost("perms");
           
            if ($action == 'admin'){
                $model->setPerms($newPerms,1);
            } elseif ($action == 'host'){
                $model->setPerms($newPerms,2);
            } else {
                $model->setPerms($newPerms,3);
            }
        } 

        $data['all'] = $model -> fetchAllPerms();
        $data['admins'] = $model->fetchRolePerms(1);
        $data['hosts'] = $model->fetchRolePerms(2);
        $data['peserta'] = $model->fetchRolePerms(3);

        echo view("templates/header");
        echo view("pages/managePermissions", $data);
        echo view("templates/footer");
    }

} 