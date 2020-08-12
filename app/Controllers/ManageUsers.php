<?php namespace App\Controllers;

use App\Models\ManageUser;
use App\Models\ManagePermission;

class ManageUsers extends BaseController
{    
    public function userRoles(){
        $model = new ManageUser();
        $permModel = new ManagePermission();
        $data = [];
        $action = $this->request->getPost('action');
        $newRole_id = $this->request->getPost('newrole');
        $allowed = $permModel->fetchRolePerms(session()->get('role_id'));
        // Can manage roles!
        if (in_array(2,$allowed)){
            // Process whether we want to save/delete/activate user
            if ($this->request->getPost('save')){
                $model->updateUser($this->request->getPost('save'), $newRole_id);
            } 
            if ($this->request->getPost('delete')) {
                $model->deleteUser($this->request->getPost('delete'));
            } 
            if ($this->request->getPost('activate')) {
                $model->activateUser($this->request->getPost('activate'));
            } 
            // Displays list of users  
            if ($action == 'adminTab'){
                session()->set('tab', 'admin');
                $data['userL'] = $model->fetchUsersByRole(1);
                
            } elseif ($action == 'hostTab'){
                session()->set('tab', 'host');
                $data['userL'] = $model->fetchUsersByRole(2);

            } elseif ($action == 'pesertaTab'){
                session()->set('tab', 'peserta');
                $data['userL'] = $model->fetchUsersByRole(3);
            } else {
                session()->set('tab', 'all');
                $data['userL'] = $model->fetchAllUsers();
            }
        } else {
            session()->setFlashdata('error', 'Not allowed to manage user roles');
        }
        echo view("templates/header");
        echo view("pages/manageRoles", $data);
        echo view("templates/footer");
    }

    public function hostRequests(){
        $model = new ManageUser();
        $data = [];
        $permModel = new ManagePermission();
        $allowed = $permModel->fetchRolePerms(session()->get('role_id'));
        // approve?
        if (in_array(18, $allowed)){
            if ($this->request->getPost('approve')){
                $hr_id = $this->request->getPost('approve');
                $model->makeHost($hr_id);
            } else if ($this->request->getPost('reject')){
                $hr_id = $this->request->getPost('reject');
                $model->rejectHost($hr_id);
            }
        } else {
            session()->setFlashdata('error', 'Not allowed to approve host request');
        }
        

        $data['hostReqs'] = $model->getHostReqs();

        echo view("templates/header");
        echo view("pages/hostRequests", $data);
        echo view("templates/footer");
    }



} 