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
        $allowed = $permModel->getUserPerms(session()->get('user_id'));

        // Can manage roles!
        if (in_array(2,$allowed)){
            // Process whether we want to save/delete/activate user
            if ($this->request->getPost('save')){
                $model->updateUser($this->request->getPost('save'),$newRole_id);
            } 
            if ($this->request->getPost('delete')) {
                $model->deleteUser($this->request->getPost('delete'));
            } 
            if ($this->request->getPost('activate')) {
                $model->activateUser($this->request->getPost('activate'));
            } 
            // Displays list of users  
            if ($action == 'adminTab'){
                $data['userL'] = $model->fetchUsersByRole(1);
                
            } elseif ($action == 'hostTab'){
                $data['userL'] = $model->fetchUsersByRole(2);

            } elseif ($action == 'pesertaTab'){
                $data['userL'] = $model->fetchUsersByRole(3);
            } else {
                $data['userL'] = $model->fetchAllUsers();
            }
        }
        echo view("templates/header");
        echo view("pages/manageRoles", $data);
        echo view("templates/footer");
    }

    public function hostRequests(){
        $model = new ManageUser();
        $data = [];
        
        // approve?
        if ($this->request->getPost('approve')){
            $user_id = $this->request->getPost('approve');
            $model->makeHost($user_id);
        } else if ($this->request->getPost('reject')){
            $user_id = $this->request->getPost('reject');
            $model->rejectHost($user_id);
        }

        $data['hostReqs'] = $model->getHostReqs();

        echo view("templates/header");
        echo view("pages/hostRequests", $data);
        echo view("templates/footer");
    }



} 