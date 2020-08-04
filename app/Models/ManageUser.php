<?php namespace App\Models;
use CodeIgniter\Model;

class ManageUser extends Model{

    // Get useRs by role
    public function fetchAllActive()
	{
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM users INNER JOIN roles ON users.role_id = roles.role_id WHERE users.user_status = 1');
        $results = $query->getResult();
        return $results;
    }

    public function fetchAllUsers()
	{
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM users INNER JOIN roles ON users.role_id = roles.role_id');
        $results = $query->getResult();
        return $results;
    }
    
    public function fetchUsersByRole(int $role_id)
	{
        $db = \Config\Database::connect();
		$query = $db->query('SELECT * FROM users INNER JOIN roles on users.role_id = roles.role_id WHERE users.user_status = 1 AND users.role_id ='.$role_id);
        $results = $query->getResult();
        return $results;
    }

    public function updateUser(int $user_id, int $role_id)
	{
        $db = \Config\Database::connect();
		$query = $db->query('UPDATE users SET role_id='.$role_id.' WHERE user_id='.$user_id);
    }

    public function deleteUser(int $user_id)
	{
        $db = \Config\Database::connect();
		$query = $db->query('UPDATE users SET user_status=0 WHERE user_id='.$user_id);
    }
    public function activateUser(int $user_id)
	{
        $db = \Config\Database::connect();
		$query = $db->query('UPDATE users SET user_status=1 WHERE user_id='.$user_id);
    }
    public function getHostReqs()
	{
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM hostRequest hr, users u WHERE u.user_id = hr.user_id AND hr.request_status=1');
        return $query->getResult();
    }
    public function addHostReq($user_id){
        // 1 for pending host request
        $db = \Config\Database::connect();
		$query = $db->query('INSERT INTO hostRequest (user_id, request_status) VALUES ('.$user_id.',1)');
    }
    public function makeHost($user_id){
        $db = \Config\Database::connect();
        $query = $db->query('UPDATE users SET role_id = 2 WHERE user_id='.$user_id);
        // after approving, set request status as done
        $query = $db->query('UPDATE hostRequest SET request_status = 0 WHERE user_id='.$user_id);
    }
    public function rejectHost($user_id){
        $db = \Config\Database::connect();
        // after reject, set request status as done
        $query = $db->query('UPDATE hostRequest SET request_status = 0 WHERE user_id='.$user_id);
    }

}

?>