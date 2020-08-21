<?php namespace App\Models;
use CodeIgniter\Model;

class ClassModel extends Model{
    public function addClass(array $newData, $user_id){
        $db = \Config\Database::connect();
        $builder = $db->table('classes');
        $builder->insert($newData);
        $classID = $db->insertID();
        // insert into class
        $db->query('INSERT INTO tests (test_id, class_id, test_status) VALUES ('.$newData['pretest_id'].','.$classID.',1)');
        $db->query('INSERT INTO tests (test_id, class_id, test_status) VALUES ('.$newData['posttest_id'].','.$classID.',2)');
        $db->query('INSERT INTO user_classes (user_id, class_id, host) VALUES ('.$user_id.','.$classID.','.'1)');
    }
    
    public function autoinc(){
        $db = \Config\Database::connect();
        $res = $db->query('SELECT MAX(test_id) as id FROM tests');
        $res = $res->getRow();
        return $res->id;
    }

    public function editClass($class_id, $newData){
        $db = \Config\Database::connect();
        $builder = $db->table('classes');
        $builder->set($newData);
        $builder->where('class_id',$class_id);
        $builder->update();
    }

    public function getClassByID(int $class_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM classes WHERE class_id='.$class_id);
        $results = $query->getRow();
        return $results;
    }

    public function getPeserta($class_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM users u, user_classes uc, roles r WHERE u.user_id = uc.user_id AND u.role_id = r.role_id AND u.user_status = 1 AND uc.class_id='.$class_id.' ORDER BY u.role_id');
        $results = $query->getResult();
        return $results;
    }
    public function removePeserta($user_id, $class_id){
        $db = \Config\Database::connect();
        $query = $db->query('DELETE FROM user_classes WHERE user_id='.$user_id.' AND class_id='.$class_id);
    }
    
    public function getClasses(){
        $db = \Config\Database::connect();
        helper('Time');

        // check the class statuses before getting all
        $query = $db->query('SELECT * FROM classes');
        $results = $query->getResult();

        foreach($results as $result){
            $end = date('Y-m-d H:i:s', strtotime("$result->end_date $result->end_time"));
            $start = date('Y-m-d H:i:s', strtotime("$result->start_date $result->start_time"));

            if ($result->class_status == 2){
                // already inactive. leave it
                // if tests empty? fail them score = 0
                $query = $db->query('UPDATE user_scores SET score = 0 WHERE score IS NULL and class_id='.$result->class_id);

            } else if (isBeforeToday($end)){
                //class completely inactive
                $query = $db->query('UPDATE classes SET class_status = 2 WHERE class_id='.$result->class_id);
                // inactivate test too 
                $query = $db->query('UPDATE tests SET test_status = 3 WHERE class_id='.$result->class_id);
                // if tests empty? fail them score = 0
                $query = $db->query('UPDATE user_scores SET score = 0 WHERE score IS NULL and class_id='.$result->class_id);
            } else if (isBeforeToday($start)){
                $query = $db->query('UPDATE classes SET class_status = 1 WHERE class_id='.$result->class_id);
            } else {
                //class still open to join! 
                $query = $db->query('UPDATE classes SET class_status = 0 WHERE class_id='.$result->class_id);
            }
        }

        $query1 = $db->query('SELECT * FROM classes ORDER BY class_status');
        $results1 = $query1->getResult();
        return $results1;
    }

    public function fetchAllActive()
	{
        // fetch all active classes, joinable or not
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM users INNER JOIN roles ON users.role_id = roles.role_id WHERE users.user_status <> 2');
        $results = $query->getResult();
        return $results;
    }


    public function canJoin($class_id){
        $db = \Config\Database::connect();
        // the class is active & joinable
        $query = $db->query('SELECT class_status FROM classes WHERE class_id='.$class_id);
        $status = $query->getRow();
        $status = $status->class_status;
        if ($status == 0){
            return True;
        } else {
            return False;
        }
    }
    public function joinedClass($user_id, $class_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT class_id FROM user_classes WHERE user_id='.$user_id);
        $classes = $query->getResult();

        foreach($classes as $c){
            if ($class_id == $c->class_id){
                return True;
            }
        }
        return False;
    }
    public function noTimeConflict($user_id, $newClass_id){
        $db = \Config\Database::connect();
        // get all classes of this user
        helper('Time');

        $query = $db->query('SELECT * FROM user_classes uc, classes c WHERE uc.class_id = c.class_id AND uc.user_id='.$user_id.' AND c.class_status <> 2');
        $query2 = $db->query('SELECT * FROM classes WHERE class_id='.$newClass_id);

        $results = $query->getResult();
        $newClassTime = $query2->getResult();

        // Check if the added class conflicts w any other active classes they're joined in 
        $data = array();
        foreach($results as $result){
            if (isOverlapping($newClassTime[0]->start_date, $newClassTime[0]->end_date, $result->start_date, $result->end_date)){
                return False;
            } elseif ($newClass_id == $result->class_id){
                return False;
            }
        }
        return True;
    }

    public function joinClass($user_id, $newClass_id){
        $db = \Config\Database::connect();
        // When joining a class, we add it to user_classes table & also a score for them in the user_scores
        $db->query('INSERT INTO user_classes (user_id, class_id, host) VALUES ('.$user_id.','.$newClass_id.',0)');
        $query = $db->query('SELECT * FROM classes WHERE class_id ='.$newClass_id);
        $class = $query->getRow();
        $db->query('INSERT INTO user_scores (user_id, class_id, test_id, test_status) VALUES ('.$user_id.','.$newClass_id.','.$class->pretest_id.',1)');
        $db->query('INSERT INTO user_scores (user_id, class_id, test_id, test_status) VALUES ('.$user_id.','.$newClass_id.','.$class->posttest_id.',2)');
    }

    public function removeClass($newClass_id){
        // Admin remove class
        $db = \Config\Database::connect();
        $query = $db->query('UPDATE classes SET class_status=2 WHERE class_id='.$newClass_id);
    }

    public function searchClass($desc){
        // Search class by name
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM classes WHERE class_name LIKE "%'.$desc.'%"');
        $results = $query->getResult();
        return $results;
    }

    public function searchMyClass($user_id, $desc){
        // Search class by name
        $db = \Config\Database::connect();

        $query1 = $db->query('SELECT * FROM user_classes uc, classes c WHERE uc.class_id = c.class_id AND uc.user_id='.$user_id.' AND c.class_name LIKE "%'.$desc.'%" ORDER BY c.class_status');
        $results1 = $query1->getResult();
        return $results1;
    }

    public function fullSchedule(){
        // Schedule of all classes for Admin
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM classes ORDER BY class_id');
        $results = $query->getResult();
        
        foreach ($results as $result){
            if ($result->recurring == '1'){
                $data[] = array(
                    'id'=>$result->class_id,
                    'title'=>$result->class_name,
                    'start'=>date('Y-m-d',strtotime($result->start_date)).' '.date('H:i:s', strtotime($result->start_time)),
                    'end'=>date('Y-m-d',strtotime($result->end_date)).' '.date('H:i:s', strtotime($result->end_time)),
                    'allDay'=>False,
                    'color'=>$result->color,
                );
            } else {
                $data[] = array(
                    'id'=>$result->class_id,
                    'title'=>$result->class_name,
                    'startTime'=>$result->start_time,
                    'endTime'=>$result->end_time,
                    'startRecur'=>$result->start_date,
                    'endRecur'=>$result->end_date,
                    'daysOfWeek'=> str_split($result->dow),
                    'allDay'=>False,
                    'backgroundColor'=>$result->color,
                );
            }
        }
        return $data;
    }

    public function mySchedule($user_id){
        // Get classes of a user in JSON encode format to turn into schedule
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM user_classes uc, classes c WHERE uc.class_id = c.class_id AND uc.user_id='.$user_id);
        $results = $query->getResult();
        
        foreach ($results as $result){
            if ($result->recurring == '1'){
                $data[] = array(
                    'id'=>$result->class_id,
                    'title'=>$result->class_name,
                    'start'=>date('Y-m-d',strtotime($result->start_date)).' '.date('H:i:s', strtotime($result->start_time)),
                    'end'=>date('Y-m-d',strtotime($result->end_date)).' '.date('H:i:s', strtotime($result->end_time)),
                    'allDay'=>False,
                    'color'=>$result->color,
                );
            } else {
                $data[] = array(
                    'id'=>$result->class_id,
                    'title'=>$result->class_name,
                    'startTime'=>$result->start_time,
                    'endTime'=>$result->end_time,
                    'startRecur'=>$result->start_date,
                    'endRecur'=>$result->end_date,
                    'daysOfWeek'=> str_split($result->dow),
                    'allDay'=>False,
                    'backgroundColor'=>$result->color,
                );
            }
        }
        return $data;
    }  

    public function rgba_color(){
        $randomcolor = '#' . dechex(rand(256,16777215));
        return $randomcolor;
    }

    public function userClasses($user_id){
        // Get class of a user
        $db = \Config\Database::connect();
        $query = $db->query('SELECT class_id FROM user_classes WHERE user_id='.$user_id);
        $result = $query->getResult();
        $classes = [];
        foreach ($result as $r){
            $classes[] = $r->class_id;
        }
        return $classes;
    }
    
    public function myClasses($user_id){
        // Get class of a user
        $db = \Config\Database::connect();
        helper('Time');

        $query = $db->query('SELECT * FROM user_classes uc, classes c WHERE uc.class_id = c.class_id AND uc.user_id='.$user_id.' ORDER BY c.class_status');
        $results = $query->getResult();    

        foreach($results as $result){
            $end = date('Y-m-d H:i:s', strtotime("$result->end_date $result->end_time"));
            $start = date('Y-m-d H:i:s', strtotime("$result->start_date $result->start_time"));

            if ($result->class_status == 2){
                // already inactive. leave it
                // if tests empty? fail them score = 0
                $query = $db->query('UPDATE user_scores SET score = 0 WHERE score IS NULL and class_id='.$result->class_id);

            } else if (isBeforeToday($end)){
                //class completely inactive
                $query = $db->query('UPDATE classes SET class_status = 2 WHERE class_id='.$result->class_id);
                // inactivate test too 
                $query = $db->query('UPDATE tests SET test_status = 3 WHERE class_id='.$result->class_id);
                // if tests empty? fail them score = 0
                $query = $db->query('UPDATE user_scores SET score = 0 WHERE score IS NULL and class_id='.$result->class_id);
            } else if (isBeforeToday($start)){
                $query = $db->query('UPDATE classes SET class_status = 1 WHERE class_id='.$result->class_id);
            } else {
                //class still open to join! 
                $query = $db->query('UPDATE classes SET class_status = 0 WHERE class_id='.$result->class_id);
            }
        }
        $query1 = $db->query('SELECT * FROM user_classes uc, classes c WHERE uc.class_id = c.class_id AND uc.user_id='.$user_id.' ORDER BY c.class_status');
        $results1 = $query1->getResult();
        return $results1;
    }
}   

    

?>