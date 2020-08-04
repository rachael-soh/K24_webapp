<?php namespace App\Controllers;
use App\Models\NoteModel;
use App\Models\ManagePermission;

class Notes extends BaseController
{
    public function notes(){
        $class_id = session()->get('class_id');
        $noteModel = new NoteModel();
        $notes = $noteModel->getNotes($class_id);
        $data['notes'] = $notes;
        echo view("templates/header");
        echo view("pages/notes",$data);
        echo view("templates/footer");
    }

    public function noteAction(){
        if ($this->request->getMethod()== "post"){
            if ($this->request->getPost("add")){
                // upload new note
                return redirect()->to('/k24/public/Notes/addNote');

            } else if ($this->request->getPost('edit')){
                $noteModel = new NoteModel();
                $note_id = $this->request->getPost('edit');
                $note = $noteModel->getNote($note_id);
                session()->setFlashData('note',$note);
                return redirect()->to('/k24/public/Notes/editNote');
            } else if ($this->request->getPost('view')){

            }
        }

        $class_id = session()->get('class_id');
        $noteModel = new NoteModel();
        $notes = $noteModel->getNotes($class_id);
        $data['notes'] = $notes;

        echo view("templates/header");
        echo view("pages/notes", $data);
        echo view("templates/footer");
    }
    public function addNote(){
        $noteModel = new NoteModel();
        if ($this->request->getMethod()=="post"){
            echo "Adding note";
            $file = $this->request->getFile('note_doc');
            
            $filename = $file->getName();
            $path = $file->store();
            //$path = $file->getTempName();
            
            $data = [
                "class_id"=>session()->get('class_id'),
                "note_name"=>$this->request->getPost('note_name'),
                "note_doc"=>$filename,
                "path"=>$path,
            ];
            $noteModel->addNote($data);
            return redirect()->to('/k24/public/Notes/notes');
        }
        echo view("templates/header");
        echo view("pages/addNote");
        echo view("templates/footer");
    }
    public function editNote(){
        if ($this->request->getMethod()=="post"){
            $file = $this->request->getFile('note_doc');
            $note_name = $this->request->getPost('note_name');
            $filename = $file->getName();
            //$path = $file->store();
            $data = [
                "note_name"=>$note_name,
                "note_doc"=>$filename,
            ];
            $noteModel->editNote($data);
            return redirect()->to('/k24/public/Notes/notes');
        }
        echo view("templates/header");
        echo view("pages/editNote");
        echo view("templates/footer");
    }
}