<?php namespace App\Controllers;
use App\Models\ClassModel;
use App\Models\ManagePermission;

class Classes extends BaseController
{
    public function create(){
        $data = [];
        helper(['form']);
        $perms = new ManagePermission();
        $allowed = $perms->getUserPerms(session()->get('user_id'));

        if ($this->request->getMethod() == 'post' && in_array(3, $allowed)){
            // validate class creation 
            $rules = [
                'call_link' => 'required|valid_url',
                'start_time' => 'required',
                'end_time' => 'required|compareTime[start_time,end_time]',
                'start_date' => 'required|valid_date|startCorrect',
                'end_date' => 'required|valid_date|compareDate[start_date,end_date]',
            ];

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
                
                $model = new ClassModel();

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
                    'dow'=>$dow
                ];
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

    public function explore(){
        $model = new ClassModel();
        $data = [];
        
        $data['classL'] = $model->getClasses();

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
        
        if ($this->request->getMethod() == "post"){
            print_r($this->request->getPost("search"));
            
            print_r($this->request->getPost("remove"));
            if ($this->request->getPost('join')){
                $newClass_id = $this->request->getPost('join');
                // check for time conflict
                if ($model->noTimeConflict($user_id, $newClass_id)){
                    $model->joinClass($user_id, $newClass_id);
                } else {
                    echo 'TIME CONFLICT';
                }
            
            } else if($this->request->getPost('remove')){
                // check perms, if admin, then they can remove it. 
                // change class status to inactive 
                if (in_array(16, $allowed)){
                    $newClass_id = $this->request->getPost('remove');
                    $model->removeClass($newClass_id);
                }
            } else if($this->request->getPost('search_button')){
                $desc = $this->request->getPost('search_desc');
                print_r($desc);
                $data['classL'] = $model->searchClass($desc);
            } else if($this->request->getPost('all')){
                $data['classL'] = $model->getClasses();
            } else if($this->request->getPost('view')){
                $newClass_id = $this->request->getPost('view');
                session()->setFlashdata('viewclass_id', $newClass_id);
                return redirect()->to('/k24/public/Classes/viewClass');
            }
        } 
        echo view("templates/header");
        echo view("pages/exploreClasses", $data);
        echo view("templates/footer");
    }

    public function viewClass(){
        $newClass_id = session()->get("viewclass_id");
        $model = new ClassModel();
        if ($newClass_id){
            $class_info = $model->getClassByID($newClass_id);
            $data['class_info'] = $class_info;  
        }  
        session()->setFlashdata('viewclass_id', $newClass_id);
        echo view("templates/header");
        echo view("pages/viewClass",$data);
        echo view("templates/footer");
    }
} 