<?php namespace App\Models;
use CodeIgniter\Model;

class TestModel extends Model{
    public function getClassReports($class_id){
        $db = \Config\Database::connect();
        // people: get people in class
        // score: get scores of students in that class
        // final: set score of pretest & posttest

        $query = $db->query('
        WITH people AS (
        SELECT u.fname, u.lname, c.class_name, c.class_id, uc.user_id
        FROM users u, classes c, user_classes uc 
        WHERE u.user_id = uc.user_id AND uc.class_id = c.class_id AND c.class_id ='.$class_id.'), 

        scores AS (
        SELECT fname, lname, class_name, score, test_status, people.user_id 
        FROM people
        LEFT JOIN user_scores
        ON people.user_id = user_scores.user_id 
        WHERE people.class_id = user_scores.class_id)
        
        SELECT user_id, fname, lname, class_name,
        (CASE WHEN test_status=1 THEN score ELSE NULL END) AS pretest,
        (CASE WHEN (test_status=2 OR test_status = 3) THEN score ELSE NULL END) AS posttest
        FROM scores
        GROUP BY user_id');

        $queryA = $db->query('
        WITH pretest AS (SELECT us.user_id, us.score as pretest, us.class_id FROM classes c, user_scores us WHERE c.pretest_id = us.test_id),
        posttest AS (SELECT us.user_id, us.score as posttest, us.class_id FROM classes c, user_scores us WHERE c.posttest_id = us.test_id),
        people AS (SELECT u.fname, u.lname, c.class_name, c.class_id, u.user_id, uc.host FROM users u, classes c, user_classes uc WHERE uc.class_id = c.class_id AND uc.user_id = u.user_id)
        SELECT people.user_id, fname, lname, class_name, pretest, posttest, host
        FROM people
        LEFT JOIN pretest ON pretest.user_id = people.user_id AND pretest.class_id = people.class_id
        LEFT JOIN posttest ON posttest.user_id = people.user_id AND posttest.class_id = people.class_id
        WHERE people.class_id='.$class_id);

        $results = $queryA->getResult();
        return $results;
    }
    
    public function getAllUserReports(){
        $db = \Config\Database::connect();
        // people: get people in class
        // score: get scores of students in that class
        // final: set score of pretest & posttest
       
        $query = $db->query('
        WITH pretest AS (SELECT us.user_id, us.score as pretest, us.class_id FROM classes c, user_scores us WHERE c.pretest_id = us.test_id),
        posttest AS (SELECT us.user_id, us.score as posttest, us.class_id FROM classes c, user_scores us WHERE c.posttest_id = us.test_id),
        people AS (SELECT u.fname, u.lname, c.class_name, c.class_id, u.user_id FROM users u, classes c, user_classes uc WHERE uc.class_id = c.class_id AND uc.user_id = u.user_id)
        SELECT fname, lname, class_name, pretest, posttest
        FROM people
        LEFT JOIN pretest ON pretest.user_id = people.user_id AND pretest.class_id = people.class_id
        LEFT JOIN posttest ON posttest.user_id = people.user_id AND posttest.class_id = people.class_id
        ORDER BY people.class_id');

        $results = $query->getResult();
        return $results;
    }

    public function searchUser($desc){
        // Search class by name
        $db = \Config\Database::connect();
        
        // people: get people by searching name
        // score: get scores of students in that class
        // final: set score of pretest & posttest

        $queryB = $db->query('
        WITH pretest AS (SELECT us.user_id, us.score as pretest, us.class_id FROM classes c, user_scores us WHERE c.pretest_id = us.test_id),
        posttest AS (SELECT us.user_id, us.score as posttest, us.class_id FROM classes c, user_scores us WHERE c.posttest_id = us.test_id),
        people AS (SELECT u.fname, u.lname, c.class_name, c.class_id, u.user_id FROM users u, classes c, user_classes uc WHERE uc.class_id = c.class_id AND uc.user_id = u.user_id AND
        (u.fname LIKE "%'.$desc.'%" OR u.lname LIKE "%'.$desc.'%"))
        SELECT fname, lname, class_name, pretest, posttest
        FROM people
        LEFT JOIN pretest ON pretest.user_id = people.user_id AND pretest.class_id = people.class_id
        LEFT JOIN posttest ON posttest.user_id = people.user_id AND posttest.class_id = people.class_id
        ORDER BY people.class_id
        ');

        $results = $queryB->getResult();
        return $results;
    }

    public function classOver($class_id){
        // Update test status? 
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM classes c, user_classes uc WHERE c.class_id = uc.class_id AND class_id='.$class_id);
        $students = $query->getResult();
        $query = $db->query('UPDATE ');
    }
    /*
    public function createTest($test_data, $class_id, $test_type){
        $db = \Config\Database::connect();
        // create new test in test-id
        $builder = $db->table('tests');
        $builder->insert($test_data);
        $testID = $db->insertID();
        // insert this test id into the class's pre/post test id
        $db->query('UPDATE classes set '.$test_type.'_id='.$testID.' WHERE class_id='.$class_id);
    }*/

    public function getTestID($class_id, $test_type){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT '.$test_type.'_id FROM classes WHERE class_id='.$class_id);
        return $query->getResult();
    }   
    /*
    public function hasTest($test_type){
        $db = \Config\Database::connect();
        $class_id = session()->get("class_id");
        $query = $db->query('SELECT '.$test_type.'_id FROM classes WHERE class_id='.$class_id);
        $result = $query->getRowArray();
        
        if (array_values($result)[0] != NULL){
            return True;
        } else {
            return False;
        }
    }*/
    public function saveTest($test_id, $data){
        $db = \Config\Database::connect();
        foreach ($data as $key=>$value){
            if ($value){
                $db->query('UPDATE tests SET '.$key.'="'.$value.'" WHERE test_id='.$test_id);
            }
        } 
    }

    public function getTest($test_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tests WHERE test_id='.$test_id);
        return $query->getRow();
    }

    public function getQuestions($test_id){
        // get all qns in test
        $db = \Config\Database::connect();
        $db->query('DELETE FROM questions WHERE question='.'""');
        $query = $db->query('SELECT * FROM questions WHERE test_id='.$test_id);
        return $query->getResult();   
    }

    public function newScore($qnNum, $test_id){
        // update total when we add new qn
        $db = \Config\Database::connect();
        $query = $db->query('UPDATE tests SET total_score='.$qnNum.' WHERE test_id='.$test_id);
    }

    public function userScore($user_id, $test_id){
        $db = \Config\Database::connect();
        $test_type = session()->get('test_type');
        $result = $db->query('SELECT SUM(marks) total FROM user_test_answer WHERE user_id='.$user_id.' AND test_id='.$test_id);
        $result = $result->getRow();

        // THIS IS USER SCORE
        $score = $result->total;
        //total score
        $result = $db->query('SELECT total_score FROM tests WHERE test_id='.$test_id);
        $total = $result->getRow();
        //Percentage
        $score = ($score/$total->total_score) * 100;

        // if a prettest & just update
        if ($test_type == 1){
            $db->query('UPDATE user_scores SET score="'.$score.'"WHERE user_id ='.$user_id.' AND test_id='.$test_id);
        } 
        // if posttest, once taken, change status to 3 to mark inactive
        else if ($test_type == 2){
            $db->query('UPDATE user_scores SET score="'.$score.'", test_status = 3 WHERE user_id='.$user_id.'AND test_id='.$test_id);
        }
        return $score;
    }

    public function getUserScore($user_id, $class_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT score FROM user_scores WHERE user_id ='.$user_id.' AND class_id = '.$class_id.' ORDER BY test_status');
        $results = $query->getResult();
        if ($results){
            $score['pretest'] = $results[0]->score;
            $score['posttest'] = $results[1]->score;
        } else {
            $score['pretest'] = NULL;
            $score['posttest'] = NULL;
        }
        return $score;
    }

    public function getUserScoreStatus($test_id, $user_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT test_status FROM user_scores WHERE user_id ='.$user_id.' AND test_id='.$test_id);
        $results = $query->getRow();
        return $results->test_status;
    }

    public function resetUserScore($user_id, $test_id){
        $db = \Config\Database::connect();
        $db->query('UPDATE user_test_answer SET marks=0 WHERE user_id ='.$user_id.' AND test_id='.$test_id);
    }
    public function testOver($test_id){
        $db = \Config\Database::connect();
        $db->query('UPDATE tests SET test_status=3 WHERE test_id='.$test_id);

    }
    public function getStatus($test_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT test_status FROM tests WHERE test_id='.$test_id);
        $result =  $query->getRow();
        return $result->test_status;
    }
    
}