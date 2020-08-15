<?php namespace App\Controllers;
use App\Models\ClassModel;
use App\Models\ManagePermission;
use App\Models\ManageUser;

class Classes extends BaseController
{
    public function create(){
        // check if can create class
        $permModel = new ManagePermission();
        $role_id =session()->get('role_id');
        $allowed = $permModel->fetchRolePerms($role_id);
        
        $data = [];
        helper(['form']);
        $classModel = new ClassModel();
        if ( in_array(3, $allowed)){
            if ($this->request->getMethod() == 'post' ){
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
                    $pretest = $classModel->autoinc() + 1;
                    $posttest = $classModel->autoinc() + 2;
                    $color = $classModel->rgba_color();
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
                        'dow'=>$dow,
                        'color'=>$color
                    ];
                    } else {
                        $pretest = $classModel->autoinc() + 1;
                        $posttest = $classModel->autoinc() + 2;
                        $color = $classModel->rgba_color();
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
                            'color'=>$color
                        ];
                    }
                    $user_id = session()->get('user_id');

                    $classModel->addClass($newData, $user_id); 
                    session()->setFlashData('success', 'Created class!');
                    return redirect()->to('/k24/public/Classes/create');
                }
            }           
        } else {
            session()->setFlashData('error', 'Not allowed to make class!');
        }

        echo view("templates/header");
        echo view("pages/createClass",$data);
        echo view("templates/footer");
    }


    public function edit($class_id){
        $permModel = new ManagePermission();
        $role_id =session()->get('role_id');
        $user_id =session()->get('user_id');
        $class_id =session()->get('class_id');
        $isHost = session()->get('isHost');
        // if host of class, have special perms
        if ($isHost == 1){
            $allowed = $permModel->fetchRolePerms(2);
        } else if ($role_id == 2 && $isHost ==0){
            $allowed = $permModel->fetchRolePerms(3);
        } else {
            $allowed = $permModel->fetchRolePerms($role_id);
        }

        helper(['form']);
        $classModel = new ClassModel();
        $class = $classModel->getClassByID($class_id);
        $data['class'] = $class;
        
        if (in_array(17, $allowed)){
            if ($this->request->getMethod() == 'post'){
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
            } 
        } else {
            session()->setFlashData('error', 'Not allowed to edit class!');
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
        $userClasses = $model->userClasses($user_id);
        $data['userClasses'] = array_values($userClasses);

        session()->set('explore',1);

        echo view("templates/header");
        echo view("pages/exploreClasses", $data);
        echo view("templates/footer");
    }
    
    public function classAction(){
        $permModel = new ManagePermission();
        $user_id = session()->get('user_id');
        $allowed = $permModel->fetchRolePerms(session()->get('role_id'));
        
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
                    session()->setFlashData('success', 'Joined class!');
                    return redirect()->to(site_url('classes/explore'));
                } else if (!$model->canJoin($class_id)){
                    session()->setFlashData('error', 'Inactive class!');
                    return redirect()->to(site_url('classes/explore'));
                } else {
                    session()->setFlashData('error', 'Time conflict!');
                    return redirect()->to(site_url('classes/explore'));
                }
            } 
            // Edit class info
            else if ($this->request->getVar('edit')){
                $class_id = $this->request->getVar('edit');
                $isHost = $permModel->isHost($user_id, $class_id);
                if ($isHost == 1){
                    return redirect()->to(site_url('classes/edit/'.$class_id));
                } else {
                    session()->setFlashdata('error', "Cannot edit class!");
                    return redirect()->to(site_url('classes/viewclass/'.$class_id));
                }
            }
            // drop class
            else if ($this->request->getVar('drop')){
                if (session()->get('isHost') == 0){
                    $class_id = $this->request->getVar('drop');
                    $model->removePeserta($user_id, $class_id);
                    return redirect()->to(site_url('classes/viewclass/'.$class_id));
                } else {
                    $model->removeClass($class_id);
                    return redirect()->to(site_url('classes/viewclass/'.$class_id));
                }
                
            }
            // remove class. only admin can remove
            else if($this->request->getVar('remove')){
                // change class status to inactive 
                if (in_array(16, $allowed)){
                    $class_id = $this->request->getVar('remove');
                    $model->removeClass($class_id);
                    return redirect()->to(site_url('classes/explore'));
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
                session()->setFlashdata('explore',1);
                return redirect()->to('/k24/public/Classes/viewClass/'.$class_id);
            }
        } 
        session()->set('explore',1);
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
        $classModel = new ClassModel();
        $permModel = new ManagePermission();
        $user_id = session()->get('user_id');
        $isHost = $permModel->isHost($user_id, $class_info->class_id);
        $joined = $classModel->joinedClass($user_id, $class_info->class_id);
        $data = [
            'class_id' => $class_info->class_id,
            'class_name' => $class_info->class_name,
            'pretest_id' => $class_info->pretest_id,
            'posttest_id' => $class_info->posttest_id,
            'class_status' => $class_info->class_status,
            'isHost' => $isHost,
            'joined' => $joined
        ];
        session()->set($data);
    }

    public function people(){
        $classModel = new ClassModel();
        $roleModel = new ManageUser();

        $permModel = new ManagePermission();
        $role_id =session()->get('role_id');
        $user_id =session()->get('user_id');
        $class_id =session()->get('class_id');
        $isHost = session()->get('isHost');
        // if host of class, have special perms
        if ($isHost == 1){
            $allowed = $permModel->fetchRolePerms(2);
        } else if ($role_id == 2 && $isHost ==0){
            // is a host but is not a host of this class
            $allowed = $permModel->fetchRolePerms(3);
        } else {
            $allowed = $permModel->fetchRolePerms($role_id);
        }

        if ($this->request->getPost("invite")){
            if (in_array(4, $allowed)){
                $recipient = $this->request->getPost("user");
                $message = site_url('classes/viewClass').$class_id;
                $this->sendEmail($recipient, $message);
            } else {
                session()->setFlashData('error', 'No permission to invite user');
            }
        } 
        else if ($this->request->getPost("host_request")){
            if (in_array(6, $allowed)){
                $user_id = $this->request->getPost("host_request");
                $roleModel->addHostReq($user_id, $class_id);
                session()->setFlashData('success', 'Pending host request');
            } else {
                session()->setFlashData('error', 'No permission to request host');
            }
           
        } else if ($this->request->getPost("delete")){
            if (in_array(19, $allowed)){
                $user_id =$this->request->getPost("delete");
                $classModel->removePeserta($user_id, $class_id);
            } else {
                session()->setFlashData('error', 'No permission to remove user');
            }
        }   

        $class_id = session()->get('class_id');
        $peserta = $classModel->getPeserta($class_id);
        $data['peserta'] = $peserta;

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
            session()->setFlashData('error', 'Email not sent');
        } else {
            session()->setFlashData('success', 'Sent');
        }
    }
} 