<?php namespace App\Models;
use CodeIgniter\Model;

class ManagePermission extends Model{

    public function fetchAllPerms(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM perms');
        $results = $query->getResult();
        return $results;
    }

    public function fetchRolePerms(int $role_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT p.perm_id FROM role_perm rp, perms p 
                            WHERE rp.perm_id = p.perm_id AND rp.role_id ='.$role_id);
        $result = $query->getResult();
        $results = array();
        foreach($result as $r){
            array_push($results, $r->perm_id);
        }
        return $results;
    }

    public function setPerms(array $newPerms, int $role_id){
        $db = \Config\Database::connect();
        $builder = $db->table('role_perm');
        $query1 = $db->query('DELETE FROM role_perm WHERE role_id ='.$role_id);
        $set = [];
        foreach ($newPerms as $newPerm){
            array_push($set, ['role_id'=>$role_id, 'perm_id'=> $newPerm]);
        }
        
        $builder->insertBatch($set);
    }
    // We get a user's permissions, then before doing something, check if the value is in this? 
    public function getUserPerms(int $user_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT p.perm_id FROM users u, role_perm rp, perms p 
                            WHERE rp.perm_id = p.perm_id AND rp.role_id = u.role_id AND u.user_id ='.$user_id);
        $result = $query->getResult();
        $results = array();
        foreach($result as $r){
            array_push($results, $r->perm_id);
        }
        return $results;
    }


    /* Don't do it one by one?? 
    public function permViewAllReport(int $user_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT p.perm_id FROM users u, role_perm rp, perms p 
                            WHERE rp.perm_id = p.perm_id AND rp.role_id = u.role_id AND u.user_id ='.$user_id);
        $result = $query->getResult();
        foreach($result as $r){
            if ($r->perm_id == 1){
                return True;
            }
        }
        return False;
    }

    public function permManageRole(){
    }
    
    public function permMakeClass(){
    }

    public function permJoinClass(){

    }
    public function permInviteUser(){

    }
    public function permRequestHost(){

    }
    public function permCreateNote(){

    }
    public function permEditNote(){

    }
    public function permViewNote(){

    }
    public function permDeleteNote(){

    }
    public function permCreateTest(){

    }
    public function permEditTest(){

    }
    public function permTakeTest(){

    }
    public function permViewTest(){

    }*/
}

?>