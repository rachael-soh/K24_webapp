<?php namespace App\Models;
use CodeIgniter\Model;

class NoteModel extends Model{
    public function getNotes($class_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM notes WHERE class_id='.$class_id);
        return $query->getResult();
    }
    public function getNote($note_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM notes WHERE note_id='.$note_id);
        return $query->getRow();
    }

    public function addNote($note_data){
        $db = \Config\Database::connect();
        echo 'INSERT INTO notes (class_id,note_name, note_doc) VALUES ('.$note_data['class_id'].','.$note_data['note_name'].',"'.$note_data['note_doc'].'")';

        $query = $db->query('INSERT INTO notes (class_id,note_name, note_doc, note_path) VALUES ('.$note_data['class_id'].',"'.$note_data['note_name'].'","'.$note_data['note_doc'].'","'.$note_data['path'].'")');
    }
    public function deleteNote($note_id){
        $db = \Config\Database::connect();
        $query = $db->query('DELETE FROM notes WHERE note_id = '.$note_id);
    }
    public function editNote($note_id){
        $db = \Config\Database::connect();
        foreach ($data as $key=>$value){
            if ($value){
                $db->query('UPDATE notes SET '.$key.'="'.$value.'" WHERE note_id='.$note_id);
            }
        } 
    }
}
