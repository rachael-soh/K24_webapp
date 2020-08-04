<?php namespace App\Controllers;
use App\Models\ClassModel;
use App\Models\ManagePermission;
use App\Models\ManageUser;

class Classes extends BaseController
{
    public function create(){
        $data = [];
        helper(['form']);
        $perms = new ManagePermission();
        $allowed = $perms->getUserPerms(session()->get('user_id'));
        $model = new ClassModel();

        if ($this->request->getMethod() == 'post' && in_array(3, $allowed)){
            // validate class creation 
            if ($this->request->getPost('recurring') == 1){
                $rules = [
                    'call_link' => 'required|valid_url',
                    'start_time' => 'required',
                    'end_time' => 'required|compareTime[start_time,end_time]',
                    'start_date' => 'required|valid_date|startCorrect',
                ];    
            } else {
                $rules = [
                    'call_link' => 'required|valid_url',
                    'start_time' => 'required',
                    'end_time' => 'required|compareTime[start_time,end_time]',
                    'start_date' => 'required|valid_date|startCorrect',
                    'end_date' => 'required|valid_date|compareDate[start_date,end_date]',
                ];
            }
            
            // unique error message
            $errors = [
                'start_date' => [
                    'startCorrect' => 'Cannot begin before today'
                    ],
                'end_time' => [
                'compareTime' => 'Time ending after start time'
                ],
				'end_date' => [
					'compareDate' => 'Date ending after start date'
				]
            ];

            // Return errors? 
            if (! $this->validate($rules,$errors)){
                $data['validation'] = $this->validator;
            } else {
                if ($this->request->getPost('recurring') != 1){
                $dow = $this->request->getPost('dow');
                $dow = implode('',$dow);
                $pretest = $model->autoinc() + 1;
                $posttest = $model->autoinc() + 2;
                $newData = [
                    'class_name'=> $this->request->getPost('class_name'),
                    'description'=> $this->request->getPost('description'),
                    'call_link'=> $this->request->getPost('call_link'),
                    'start_time'=> $this->request->getPost('start_time'),
                    'end_time'=> $this->request->getPost('end_time'),
                    'start_date'=> $this->request->getPost('start_date'),
                    'end_date'=> $this->request->getPost('end_date'),
                    'recurring' => $this->request->getPost('recurring'),
                    'pretest_id'=>$pretest,
                    'posttest_id'=>$posttest,
                    'class_status' => 0,
                    'dow'=>$dow
                ];
                } else {
                    $pretest = $model->autoinc() + 1;
                    $posttest = $model->autoinc() + 2;
                    $newData = [
                        'class_name'=> $this->request->getPost('class_name'),
                        'description'=> $this->request->getPost('description'),
                        'call_link'=> $this->request->getPost('call_link'),
                        'start_time'=> $this->request->getPost('start_time'),
                        'end_time'=> $this->request->getPost('end_time'),
                        'start_date'=> $this->request->getPost('start_date'),
                        'end_date'=> $this->request->getPost('start_date'),
                        'recurring' => $this->request->getPost('recurring'),
                        'pretest_id'=>$pretest,
                        'posttest_id'=>$posttest,
                        'class_status' => 0,
                    ];
                }
                $model->addClass($newData); 
                $session = session();
                $session->setFlashData('success', 'Created class!');
                return redirect()->to('/k24/public/Classes/create');
            }
        } elseif (!in_array(3, $allowed)) {
            echo "Not allowed to make class!";
        }

        echo view("templates/header", $data);
        echo view("pages/createClass");
        echo view("templates/footer");
    }


    public function edit($class_id){
        $data = [];
        helper(['form']);
        $perms = new ManagePermission();
        $allowed = $perms->getUserPerms(session()->get('user_id'));

        $classModel = new ClassModel();
        $class = $classModel->getClassByID($class_id);
        $data['class'] = $class;
        

        if ($this->request->getMethod() == 'post' && in_array(17, $allowed)){
            if ($this->request->getPost('recurring') == 1){
                $rules = [
                    'call_link' => 'required|valid_url',
                    'start_time' => 'required',
                    'end_time' => 'required|compareTime[start_time,end_time]',
                    'start_date' => 'required|valid_date|startCorrect',
                ];    
            } else {
                $rules = [
                    'call_link' => 'required|valid_url',
                    'start_time' => 'required',
                    'end_time' => 'required|compareTime[start_time,end_time]',
                    'start_date' => 'required|valid_date|startCorrect',
                    'end_date' => 'required|valid_date|compareDate[start_date,end_date]',
                ];
            }
            
            // unique error message
            $errors = [
                'start_date' => [
                    'startCorrect' => 'Cannot begin before today'
                    ],
                'end_time' => [
                'compareTime' => 'Time ending after start time'
                ],
				'end_date' => [
					'compareDate' => 'Date ending after start date'
				]
            ];
            if (! $this->validate($rules,$errors)){
                $data['validation'] = $this->validator;
            } else {
                // validate class editing. recurring = 1 is one day. 
                if ($this->request->getPost('recurring') != 1){
                    $dow = $this->request->getPost('dow');
                    $dow = implode('',$dow);
                    $newData = [
                        'class_name'=> $this->request->getPost('class_name'),
                        'description'=> $this->request->getPost('description'),
                        'call_link'=> $this->request->getPost('call_link'),
                        'start_time'=> $this->request->getPost('start_time'),
                        'end_time'=> $this->request->getPost('end_time'),
                        'start_date'=> $this->request->getPost('start_date'),
                        'end_date'=> $this->request->getPost('end_date'),
                        'recurring' => $this->request->getPost('recurring'),
                        'class_status' => 0,
                        'dow'=>$dow
                    ];
                } else {    
                    $newData = [
                        'class_name'=> $this->request->getPost('class_name'),
                        'description'=> $this->request->getPost('description'),
                        'call_link'=> $this->request->getPost('call_link'),
                        'start_time'=> $this->request->getPost('start_time'),
                        'end_time'=> $this->request->getPost('end_time'),
                        'start_date'=> $this->request->getPost('start_date'),
                        'end_date'=> $this->request->getPost('start_date'),
                        'recurring' => $this->request->getPost('recurring'),
                        'class_status' => 0,
                    ];
                }
                $classModel->editClass($class_id, $newData); 
                session()->setFlashData('success', 'Edited class!');
                return redirect()->to('/k24/public/Classes/viewClass/'.$class_id);
            } 
        // no permission
        } else if (!in_array(17, $allowed)) {
            echo "Not allowed to edit class!";
        }

        echo view("templates/header");
        echo view("pages/editClass", $data);
        echo view("templates/footer");
    }

    public function myClasses(){
        $model = new ClassModel();
        $user_id = session()->get('user_id');

        $data['classL'] = $model->myClasses($user_id);
        
        echo view("templates/header");
        echo view("pages/myClasses", $data);
        echo view("templates/footer");
    }

    public function explore(){
        $model = new ClassModel();
        $data = [];
        $user_id = session()->get('user_id');

        $data['classL'] = $model->getClasses();
        $userClasses = $model->myClasses($user_id);
        $data['userClasses'] = array_values($userClasses);


        echo view("templates/header");
        echo view("pages/exploreClasses", $data);
        echo view("templates/footer");
    }
    
    public function classAction(){
        $perms = new ManagePermission();
        $user_id = session()->get('user_id');
        $allowed = $perms->getUserPerms($user_id);
        
        $model = new ClassModel();
        $data['classL'] = $model->getClasses();
        $userClasses = $model->myClasses($user_id);
        $data['userClasses'] = array_values($userClasses);
        
        if ($this->request->getMethod() == "get"){
            // join class
            if ($this->request->getVar('join')){
                $class_id = $this->request->getVar('join');
                // check for time conflict
                if ($model->noTimeConflict($user_id, $class_id) && $model->canJoin($class_id)){
                    $model->joinClass($user_id, $class_id);
                    echo "JOINED SUCCESFULLY";
                } else if (!$model->canJoin($class_id)){
                    echo "Class inactive";
                } else {
                    echo 'TIME CONFLICT';
                }
            } 
            // Edit class info
            else if ($this->request->getVar('edit')){
                $class_id = $this->request->getVar('edit');
                return redirect()->to('/k24/public/Classes/edit/'.$class_id);
            }
            // remove class
            else if($this->request->getVar('remove')){
                // change class status to inactive 
                if (in_array(16, $allowed)){
                    $class_id = $this->request->getVar('remove');
                    $model->removeClass($class_id);
                }
            } 
            // search for class
            else if($this->request->getVar('search_button')){
                $desc = $this->request->getVar('search_desc');
                $data['classL'] = $model->searchClass($desc);

            } 
            // get all classes
            else if($this->request->getVar('all')){
                $data['classL'] = $model->getClasses();
            } 
            // view a specific class
            else if($this->request->getVar('view')){
                $class_id = $this->request->getVar('view');
                session()->set('class_id', $class_id);
                return redirect()->to('/k24/public/Classes/viewClass/'.$class_id);
            }
        } 
        echo view("templates/header");
        echo view("pages/exploreClasses", $data);
        echo view("templates/footer");
    }

    public function viewClass($class_id){
        $classModel = new ClassModel();
        // get class info 
        $class_info = $classModel->getClassByID($class_id);
        $this->setClassSession($class_info);
        $data['class_info'] = $class_info;
        // get user info
        $user_classes = $classModel->userClasses(session()->get('user_id'));
        $data['user_classes'] = array_values($user_classes);

        echo view("templates/header");
        echo view("pages/viewClass", $data);
        echo view("templates/footer");
    }

    private function setClassSession($class_info){
        $data = [
            'class_id' => $class_info->class_id,
            'class_name' => $class_info->class_name,
            'pretest_id' => $class_info->pretest_id,
            'posttest_id' => $class_info->posttest_id,
            'class_status' => $class_info->class_status,
        ];
        session()->set($data);
    }

    public function people(){
        $classModel = new ClassModel();
        $roleModel = new ManageUser();

        $class_id = session()->get('class_id');
        $peserta = $classModel->getPeserta($class_id);
        $data['peserta'] = $peserta;
        
        if ($this->request->getPost("invite")){
            $recipient = $this->request->getPost("user");
            $message = base_url().'/k24/public/Classes/viewClass/'.$class_id;
            $this->sendEmail($recipient, $message);
        } 
        else if ($this->request->getPost("host_request")){
            $user_id = $this->request->getPost("host_request");
            $roleModel->addHostReq($user_id);
            echo "Pending request!";
        } else if ($this->request->getPost("delete")){

        }   
        echo view("templates/header");
        echo view("pages/people",$data);
        echo view("templates/footer");
    }

    private function sendEmail($recipient, $message){
        $email = \Config\Services::email();

        $email->setFrom('rachael.suhendra012@gmail.com', 'Rachael Soh');
        $email->setTo($recipient);

        $email->setSubject('Invite Test');
        $email->setMessage($message);

        if (!$email->send()){
            echo "Not sent";
        } else {
            echo "sent";
        }
    }
} 