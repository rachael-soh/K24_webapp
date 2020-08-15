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
        // Get perms
        $permModel = new ManagePermission();
        $user_id = session()->get('user_id');
        $class_id = session()->get('class_id');
        $role_id = session()->get('role_id');
        $isHost = session()->get('isHost');
        if ($isHost == 1){
            $allowed = $permModel->fetchRolePerms(2);
        } else if ($role_id == 2 && $isHost ==0){
            $allowed = $permModel->fetchRolePerms(3);
        } else {
            $allowed = $permModel->fetchRolePerms($role_id);
        }
        
        if ($this->request->getMethod()== "post"){
            if ($this->request->getPost("add")){
                // upload new note
                if (in_array(7, $allowed)){
                    return redirect()->to('/k24/public/Notes/addNote');
                } else {
                    session()->setFlashData('error', 'No permission to add note');
                }
            } else if ($this->request->getPost('edit')){
                if (in_array(8, $allowed)){
                    $noteModel = new NoteModel();
                    $note_id = $this->request->getPost('edit');
                    return redirect()->to('/k24/public/Notes/editNote/'.$note_id);
                } else {
                    session()->setFlashData('error', 'No permission to edit note');
                }
            } else if ($this->request->getPost('delete')){
                if (in_array(10, $allowed)){
                    $noteModel = new NoteModel();
                    $note_id = $this->request->getPost('delete');
                    $note = $noteModel->deleteNote($note_id);
                    session()->setFlashData('success','Successfully deleted!');
                } else {
                    session()->setFlashData('error', 'No permission to edit note');
                }
            }
        }

        $noteModel = new NoteModel();
        $notes = $noteModel->getNotes($class_id);
        $data['notes'] = $notes;

        echo view("templates/header");
        echo view("pages/notes", $data);
        echo view("templates/footer");
    }


    public function addNote(){
        $noteModel = new NoteModel();
        
        // Get perms
        $permModel = new ManagePermission();
        $user_id = session()->get('user_id');
        $class_id = session()->get('class_id');
        $role_id = session()->get('role_id');
        $isHost = session()->get('isHost');
        if ($isHost == 1){
            $allowed = $permModel->fetchRolePerms(2);
        } else if ($role_id == 2 && $isHost ==0){
            $allowed = $permModel->fetchRolePerms(3);
        } else {
            $allowed = $permModel->fetchRolePerms($role_id);
        }

        if ($this->request->getMethod()=="post"){
            // check if allowed to add note
            if (in_array(7, $allowed)){
                $class_id = session()->get('class_id');
                $file = $this->request->getFile('note_doc');
                $dir = str_replace('writable','public', WRITEPATH);

                print_r($file);
                $newName = $file->getRandomName();
                $file->move($dir.'uploads', $newName);

                $filename = $file->getName();
                $path = $newName;
                
                $data = [
                    "class_id"=>$class_id,
                    "note_name"=>$this->request->getPost('note_name'),
                    "note_doc"=>$filename,
                    "path"=>$path,
                ];
                $noteModel->addNote($data);
                session()->setFlashData('success', 'Added note!');
                return redirect()->to('/k24/public/Notes/notes');
            } else {
                session()->setFlashData('error', 'No permission to add note');
            }
        }
        echo view("templates/header");
        echo view("pages/addNote");
        echo view("templates/footer");
    }
    public function editNote($note_id){
        $noteModel = new NoteModel();
        // Get perms
        $permModel = new ManagePermission();
        $user_id = session()->get('user_id');
        $class_id = session()->get('class_id');
        $role_id = session()->get('role_id');
        $isHost = session()->get('isHost');
        if ($isHost == 1){
            $allowed = $permModel->fetchRolePerms(2);
        } else if ($role_id == 2 && $isHost ==0){
            $allowed = $permModel->fetchRolePerms(3);
        } else {
            $allowed = $permModel->fetchRolePerms($role_id);
        }
        $note = $noteModel->getNote($note_id);
        $data['note'] = $note;

        if ($this->request->getMethod()=="post"){
            if (in_array(8, $allowed)){
                $file = $this->request->getFile('note_doc');
                $note_name = $this->request->getPost('note_name');
                $filename = $file->getName();
                //$path = $file->store();
                $data = [
                    "note_name"=>$note_name,
                    "note_doc"=>$filename,
                ];
                $noteModel->editNote($data, $note_id);
                session()->setFlashData('sucess', 'Edited note!');
                return redirect()->to('/k24/public/Notes/notes');
            } else {
                session()->setFlashData('error', 'No permission to edit note');
            }
        }
        echo view("templates/header");
        echo view("pages/editNote", $data);
        echo view("templates/footer");
    }
}