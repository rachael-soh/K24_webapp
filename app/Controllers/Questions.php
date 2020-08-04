<?php namespace App\Controllers;
use App\Models\ClassModel;
use App\Models\ManagePermission;
use App\Models\TestModel;
use App\Models\QuestionModel;

class Questions extends BaseController
{
    public function editQuestion(){
        $perms = new ManagePermission();
        $user_id = session()->get('user_id');
        $allowed = $perms->getUserPerms($user_id);

        $questionModel = new QuestionModel();
        $test_id = session()->get('test_id');
        $question_id = session()->get('question_id');
        
        if (in_array(12, $allowed)){
            // but what if we submit? 
            if ($this->request->getMethod()=="post"){
                
                // changes the question itself
                if ($this->request->getPost("question")){
                    $newQn = $this->request->getPost("question");
                    $questionModel->editQuestion($question_id, $newQn);
                }
                // remove an option 
                if ($this->request->getPost("remove")){
                    $option_id = $this->request->getPost("remove");
                    $questionModel->removeOption($option_id);
                }
                // edit old options
                if ($this->request->getPost("options_id") ){
                    $options_id = $this->request->getPost("options_id");
                    $options = $this->request->getPost("options");
                    $ans = $this->request->getPost("option_ans");
                    $questionModel->editOptions($question_id, $options_id, $options, $ans);
                } 
                // add new options?
                if ($this->request->getPost("newOptions")){
                    $newOptions = $this->request->getPost("newOptions");
                    $isans = $this->request->getPost("newAns");
                    $questionModel->addOptions($newOptions, $isans, $question_id);
                }
            } 
            $question = $questionModel->getQuestion($question_id);
            $options = $questionModel->getOptions($question_id);
            $data['question'] = $question;
            $data['options'] = $options;
        } else {
            session()->setFlashdata('error', 'Not allowed to edit test!');
        }

        echo view("templates/header");
        echo view("pages/editQuestion", $data);
        echo view("templates/footer");
    }

    public function deleteQuestion(){
        $questionModel = new QuestionModel();
        $testModel = new TestModel();

        // get rid of the question & options
        $question_id = session()->get('question_id');
        $questionModel->deleteQuestion($question_id);

        // display new set of questions
        $test_id = session()->get('test_id');
        $test = $testModel->getTest($test_id);
        $questions = $testModel->getQuestions($test_id);

        // placeholders & new questions
        $data['test_date'] = $test->test_date;
        $data['start_time'] = $test->start_time; 
        $data['end_time'] = $test->end_time; 
        $data['questions'] = $questions;
        return redirect()->to('/k24/public/TestReport/editTest');

        echo view("templates/header");
        echo view("pages/editTest", $data);
        echo view("templates/footer");
    }
    public function addQuestion(){
        $questionModel = new QuestionModel();
        $test_id = session()->get('test_id');
        $question_id = $questionModel->addQuestion($test_id);
        session()->set('question_id', $question_id);

        echo view("templates/header");
        echo view("pages/editQuestion");
        echo view("templates/footer");
    }

    // TAKE A TEST
    
    public function submitQuestion(){
        $questionModel = new QuestionModel();
        $testModel = new TestModel();

        // these are questions for that exam
        $test_id = session()->get('test_id'); 
        $test = $testModel->getTest($test_id);
        $questions = $testModel->getQuestions($test_id);

        // keep array of qns
        foreach ($questions as $question){
            $data['qns'][] = ["$question->question" => $questionModel->getOptions($question->question_id)];
        }
        $end = count($questions);
        $data['end'] = $end;

        // last question!! Time to submit
        if ($this->request->getPost("submit")  == $end - 1){
            $option_id = $this->request->getPost("option");
            $option = $questionModel->getOption($option_id);
            $questionModel->submitAnswer($option->question_id, $option);
            // submit exam 
            return redirect()->to("/k24/public/TestReport/submitTest");

        } 
        // otherwise, keep going
        else if ($this->request->getPost("submit")  < $end-1){
            $data['index'] = $this->request->getPost("submit") + 1;
            session()->set('qnNum', $this->request->getPost("submit"));
            $option_id = $this->request->getPost("option");
            $option = $questionModel->getOption($option_id);
            $questionModel->submitAnswer($option->question_id, $option);
        } 
        // just refreshing. no submission
        else {
            $data['index'] = session()->get('qnNum') + 1;
        }

        //echo session()->get('qnNum').' and '.$data['index'];
        echo view("templates/dashboard-header");
        echo view("pages/takeTest", $data);
        echo view("templates/footer");
    }
}