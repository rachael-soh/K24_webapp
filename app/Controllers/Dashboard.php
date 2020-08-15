<?php namespace App\Controllers;
use App\Models\ClassModel;

class Dashboard extends BaseController
{
    public function index(){
        $classModel = new ClassModel();
        $data['classes'] = $classModel->myClasses(session()->get('user_id'));
        session()->set('explore',0);

        echo view("templates/dashboard-header");
        echo view("pages/dashboard", $data);
        echo view("templates/footer");
    }

    public function manageUsers(){
        echo view("templates/header");
        echo view("pages/manageUsers");
        echo view("templates/footer");
    }

    public function viewReports(){
        $model = new ClassModel();
        $data['classL'] = $model->getClasses();
        // go to classes page
        session()->set('report', 'class');
        echo view("templates/header");
        echo view("pages/viewReports", $data);
        echo view("templates/footer");
    }

    public function createClass(){
        echo view("templates/header");
        echo view("pages/createClass");
        echo view("templates/footer");
    }

    public function exploreClass(){
        echo view("templates/header");
        echo view("pages/exploreClasses");
        echo view("templates/footer");
    }

    public function schedule(){
        $model = new ClassModel();
        
        if (session()->get('role_id') == 1){
            $events = $model->fullSchedule();
        } else {
            $events = $model->mySchedule(session()->get('user_id'));
        }
        $data['events']= json_encode($events);
        echo view("pages/fullCalendar",$data);
    }
} 