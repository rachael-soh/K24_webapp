<?php namespace App\Controllers;
use App\Models\ClassModel;
use App\Models\ManagePermission;
use App\Models\TestModel;
use App\Models\QuestionModel;

class TestReport extends BaseController
{
    public function viewReports(){
        $permModel = new ManagePermission();
        $role_id =session()->get('role_id');
        $allowed = $permModel->fetchRolePerms($role_id);
        
        
        $classModel = new ClassModel();
        $testModel = new TestModel();
        #session()->set('report', 'class');
        $data['classL'] = $classModel->getClasses();
        if (in_array(1, $allowed)){
            if ($this->request->getMethod() == "post"){
                $action = $this->request->getPost("action");
                // get reports by class
                if ($action == "byClass"){
                    $data['classL'] = $classModel->getClasses();
                    session()->set('report', 'class');
                } 
                // get all user report
                else if ($action == "byUser"){
                    $data['userL'] = $testModel->getAllUserReports();
                    session()->set('report', 'user');
                } 
                // search by class name
                else if($this->request->getVar('search_button') && session()->get('report') == 'class'){
                    $desc = $this->request->getVar('search_desc');
                    $data['classL'] = $classModel->searchClass($desc);
                } 
                // search by user name
                else if($this->request->getVar('search_button') && session()->get('report') == 'user'){
                    $desc = $this->request->getVar('search_desc');
                    $data['userL'] = $testModel->searchUser($desc);
                } 
                // get all classes
                else if($this->request->getVar('all')){
                    session()->set('report', 'class');
                    $data['classL'] = $classModel->getClasses();
                } 
                else if ($this->request->getPost("view")){
                    // view a class's reports
                    $class_id = $this->request->getPost("view");
                    session()->setFlashdata('viewAll',1);
                    return redirect()->to(site_url('TestReport/classReport/').$class_id);
                }
            } else {
                session()->set('report', 'class');
            }
        } else {
            session()->setFlashdata('error', 'Not allowed to view all report');
        }
        echo view("templates/header");
        echo view("pages/viewReports", $data);
        echo view("templates/footer");
    }

    public function classReport($class_id){
        $testModel = new TestModel();
        // get the reports of each user
        $scores = $testModel->getClassReports($class_id);
        //print_r($scores);
        $data['userL'] = $scores;
        
        echo view("templates/header");
        echo view("pages/classReport", $data);
        echo view("templates/footer");
    }

    public function tests(){
        // score of a user?
        $testModel = new TestModel();
        $classModel = new ClassModel();
        $user_id = session()->get('user_id');
        $class_id = session()->get('class_id');

        // User score to display
        $data['score'] = $testModel->getUserScore($user_id, $class_id);
        // test status auto updated by class: getClasses()

        echo view("templates/header");
        echo view("pages/tests", $data);
        echo view("templates/footer");
    }

    public function testAction(){
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

        $testModel = new TestModel();
        if ($this->request->getPost('edit-pretest')){
            if (in_array(12, $allowed)){
                // edit pretest
                $test_id = session()->get('pretest_id');
                $test = $testModel->getTest($test_id);
                if ($test_id == NULL){
                    session()->setFlashdata('error', 'Test does not exist');
                } else if ($test->test_status == 3){
                    session()->setFlashdata('error', 'Test expired');
                } else {
                    session()->set('test_id', $test_id);
                    return redirect()->to(site_url('TestReport/editTest'));
                }   
            } else {
                session()->set('error', 'Not allowed to edit test!');
            }
                     
        } 
        // edit posttest
        else if ($this->request->getPost('edit-posttest')){
            if (in_array(12, $allowed)){
                $test_id = session()->get('posttest_id');
                $test = $testModel->getTest($test_id);
                if ($test_id == NULL){
                    session()->setFlashdata('error', 'Test does not exist');
                } else if ($test->test_status == 3){
                    session()->setFlashdata('error', 'Test expired');
                } else {
                    session()->set('test_id', $test_id);
                    return redirect()->to(site_url('TestReport/editTest'));
                }
            } else {
                session()->setFlashdata('error', 'Not allowed to edit test!');
            }
        } 
        // take pretest
        else if ($this->request->getPost('take-pretest')){
            if (in_array(13,$allowed)){
                $test_id = session()->get('pretest_id');
                session()->set('test_id', $test_id);
                session()->set('test_type', 1);
                $testModel->resetUserScore($user_id, $test_id);
                return redirect()->to(site_url('TestReport/startTest'));
            } else {
                    session()->setFlashdata('error', 'Not allowed to edit test!');
                }
        } 
        // take posttest
        else if ($this->request->getPost('take-posttest')){
            if (in_array(13,$allowed)){
                $test_id = session()->get('posttest_id');
                session()->set('test_id', $test_id);
                session()->set('test_type', 2);
                return redirect()->to(site_url('TestReport/startTest'));
            } else {
                session()->setFlashdata('error', 'Not allowed to edit test!');
            }
        }
        

        // score of a user?
        $class_id = session()->get('class_id');
        $data['score'] = $testModel->getUserScore($user_id, $class_id);

        echo view("templates/header");
        echo view("pages/tests",$data);
        echo view("templates/footer");
    }

    public function editTest(){
        $perms = new ManagePermission();
        $user_id = session()->get('user_id');
        $allowed = $perms->getUserPerms($user_id);

        $testModel = new TestModel();
        $test_id = session()->get("test_id");
        if (in_array(12, $allowed)){
            $test = $testModel->getTest($test_id);
            // get new inputs
            $questions = $testModel->getQuestions($test_id);
            $data['test_date'] = $test->test_date;
            $data['start_time'] = $test->start_time; 
            $data['end_time'] = $test->end_time; 
            $data['duration'] = $test->duration;
            $data['test_status'] = $test->test_status;
            $data['questions'] = $questions;

            // update total score
            $testModel->newScore(count($questions), $test_id);
        } else {
            session()->setFlashdata('error', 'Not allowed to edit test!');
        }

        echo view("templates/header");
        echo view("pages/editTest", $data);
        echo view("templates/footer");
    }

    public function questionAction(){
        $perms = new ManagePermission();
        $user_id = session()->get('user_id');
        $allowed = $perms->getUserPerms($user_id);

        $test_id = session()->get('test_id');
        $testModel = new TestModel();
        if (in_array(12, $allowed)){
            // edit question
            if ($this->request->getPost('edit')){
                $question_id = $this->request->getPost('edit');
                session()->set('question_id', $question_id);
                return redirect()->to(site_url('Questions/editQuestion'));
            } 
            // delete question
            else if ($this->request->getPost('delete')){
                $question_id = $this->request->getPost('delete');
                // just remove from the DB
                return redirect()->to("/k24/public/Questions/deleteQuestion")->with('question_id', $question_id);
            } 
            // add new question
            else if ($this->request->getPost('add')){
                // insert into db form data
                return redirect()->to("/k24/public/Questions/addQuestion");
            } 
            // save test info
            else if ($this->request->getPost('save')){
                // check inputs 

                if ($testModel->getStatus($test_id) == 1){
                    $rules = [
                        'end_time' => 'compareTime[start_time,end_time]',
                    ];
                } else {
                    $rules = [
                        'end_time' => 'compareTime[start_time,end_time]',
                        'test_date' => 'startCorrect',
                    ];
                }
                
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
                // return errors
                if (! $this->validate($rules,$errors)){
                    $data['validation'] = $this->validator;
                } 
                else {
                    // save all inputs
                    helper('Time');
                    if ($testModel->getStatus($test_id) == 1){
                        $test_data = [
                            'duration'=>$this->request->getPost('duration') 
                        ];
                        $testModel->saveTest($test_id, $test_data);
                    } else {
                        $test_data = [
                            'test_date' => $this->request->getPost('test_date'),
                            'start_time' => $this->request->getPost('start_time'),
                            'end_time' => $this->request->getPost('end_time'),
                            'duration' => difference($this->request->getPost('start_time'),$this->request->getPost('end_time')),
                        ];
                        $testModel->saveTest($test_id, $test_data);
                    }
                    session()->setFlashdata('success','Edited test!');
                } 
            }   
            $test = $testModel->getTest($test_id);
            $questions = $testModel->getQuestions($test_id);
            $data['test_date'] = $test->test_date;
            $data['start_time'] = $test->start_time; 
            $data['end_time'] = $test->end_time; 
            $data['duration'] = $test->duration; 
            $data['test_status'] = $test->test_status; 
            $data['questions'] = $questions;
        } else {
            session()->setFlashdata('error', 'No permission to edit test!');
        }
        echo view("templates/header");
        echo view("pages/editTest", $data);
        echo view("templates/footer");
    }
    public function startTest(){
        $testModel = new TestModel();
        $questionModel = new QuestionModel();
        // When someone decides to take a test, set the session
        $test_id = session()->get('test_id'); 
        $test_type = session()->get('test_type');
        $test = $testModel->getTest($test_id);
        $user_score = $testModel->getUserScoreStatus($test_id, session()->get('user_id'));
        $data['test'] = $test;

        if ($this->request->getMethod() == 'post'){
            if ($test->duration == 0){
                session()->setFlashdata('error', 'Test not ready!');

            } else if ($test_type == 1){
                $duration = $test->duration; 
                $end_time = time() + $duration * 60;
                $end_time = date("Y-m-d H:i:s", $end_time);
                session()->set('end_time', $end_time);
                return redirect()->to(site_url('TestReport/takeTest'));

            } else if ($test->test_status == 2 && $user_score == 2){
                $start_time = date('Y-m-d H:i:s', strtotime("$test->test_date $test->start_time"));
                $end_time = date('Y-m-d H:i:s', strtotime("$test->test_date $test->end_time"));
                $now = date('Y-m-d H:i:s', time());
                
                if (!isset($test->test_date)){
                    session()->setFlashdata('error', 'Test not ready! Date missing');
                    return redirect()->to('/k24/public/TestReport/testAction');
                }
                // start test!
                else if ($now >= $start_time  && $now <= $end_time ){
                    session()->setFlashdata('success', 'Test ongoing! Good luck!');
                    $data['end_time'] = $end_time;
                    session()->set('end_time', $end_time);
                    return redirect()->to(site_url('TestReport/takeTest'));
                }
                // too early to take test
                else if ($now < $start_time ){
                    session()->setFlashData('error', "Cannot take test yet");
                    return redirect()->to('/k24/public/TestReport/testAction');
                } 
                // test is over. can't be taken anymore
                else if ($now > $end_time){
                    $testModel->testOver($test_id);
                    session()->setFlashData('error', "Test is over!");
                    return redirect()->to('/k24/public/TestReport/testAction');
                } 
            }
            // posttest taken!  
            else if ($test->test_status == 2 && $user_score == 3){
                session()->setFlashData('error', "Posttest taken already!");
                return redirect()->to('/k24/public/TestReport/testAction');
            }
            // test can't be taken anymore
            else if ($test->test_status == 3){
                session()->setFlashData('error', "Test can't be taken anymore!");
                return redirect()->to('/k24/public/TestReport/testAction');
            } 
            
        } 
        
        echo view("templates/header");
        echo view("pages/startTest", $data);
        echo view("templates/footer");
    }

    public function takeTest(){
        $testModel = new TestModel();
        $questionModel = new QuestionModel();
        // When someone decides to take a test, set the session
        $test_id = session()->get('test_id'); 
        $test_type = session()->get('test_type');
        $test = $testModel->getTest($test_id);

        // these are questions for that exam
        $questions = $testModel->getQuestions($test_id);
        // keep array of qns !! CAN Randomize if we want 
        foreach ($questions as $question){
            $data['qns'][] = ["$question->question" => $questionModel->getOptions($question->question_id)];
        }
        $end = count($questions);
        $data['end'] = $end;
        // Keep track of what qn we're on! 
        session()->set('qnNum', 0);
        $data['index'] = 0;

        echo view("templates/dashboard-header");
        echo view("pages/takeTest", $data);
        echo view("templates/footer");
    } 
    
    public function submitTest(){
        $testModel = new TestModel();
        $user_id = session()->get('user_id');
        $test_id = session()->get('test_id');
        $test_type = session()->get('test_type');
        
        // get & insert our user test score :)
        $score = $testModel->userScore($user_id, $test_id);
        session()->setFlashdata('success', 'Submitted test!');
        // done with test & display score
        $test = $testModel->getTest($test_id);
        $data['score'] = $score;
        $data['total'] = $test->total_score;

        echo view("templates/header");
        echo view("pages/submitTest", $data);
        echo view("templates/footer");
    }
}