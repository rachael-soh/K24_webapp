<?php namespace App\Models;
use CodeIgniter\Model;

class QuestionModel extends Model{
    public function deleteQuestion($question_id){
        $db = \Config\Database::connect();
        // get rid of the question & all its options
        $query = $db->query('DELETE FROM questions WHERE question_id='.$question_id);
        $query = $db->query('DELETE FROM options WHERE question_id='.$question_id);
    }
    public function getQuestion($question_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM questions WHERE question_id='.$question_id);
        $results = $query->getRow();
        return $results;
    }
    public function editQuestion($question_id, $question){
        $db = \Config\Database::connect();
        $query = $db->query('UPDATE questions SET question="'.$question.'" WHERE question_id='.$question_id);
    }
    
    public function getOptions($question_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM options WHERE question_id='.$question_id);
        $results = $query->getResult();
        return $results;
    }

    public function getOption($option_id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM options WHERE option_id='.$option_id);
        $results = $query->getRow();
        return $results;
    }

    public function addOptions($newOptions, $isans, $question_id){
        $db = \Config\Database::connect();
        $len = count($newOptions);
        $i = 0;
        // Remove the 0s before 1s from the hidden input. This was we have only whether the option 
        // is an answer or not.
        while ($i < count($isans) - 1){
            if ($isans[$i] == 0 && $isans[$i+1] == 1){
                $isans = array_merge(array_slice($isans, 0, $i), array_slice($isans, $i+1));
                $i++;
            }
            $i++;
        }
        for($j = 0; $j < $len; $j++){
            $db->query('INSERT INTO `options`(`question_id`, `option_desc`, `ans`) VALUES ('.$question_id.',"'.$newOptions[$j].'",'.$isans[$j].')');
        }
    }

    public function removeOption($option_id){
        $db = \Config\Database::connect();
        $db->query('DELETE FROM options WHERE option_id='.$option_id);
    }

    public function editOptions($question_id, $options_id, $options, $ans){
        $db = \Config\Database::connect();
        $len = count($options_id);
        // Update all our options with new ones
        for ($i = 0; $i <$len; $i++){
            if ($options[$i]){
                $db->query('UPDATE options SET option_desc="'.$options[$i].'" WHERE option_id='.$options_id[$i]);
            }
        }
        // if the answer changed, also update that!
        $db->query('UPDATE options SET ans=0 WHERE question_id='.$question_id);
        if (isset($ans)){
            foreach ($ans as $a){
                $db->query('UPDATE options SET ans=1 WHERE option_id='.$a);
            }
        }
        
    }
    
    public function addQuestion($test_id){
        $db = \Config\Database::connect();
        $builder = $db->table('questions');
        $data = [
            'test_id'=>$test_id,
        ];
        $builder->insert($data);
        $question_id = $db->insertID();
        return $question_id;
        
    }

    public function submitAnswer($question_id, $option){
        $db = \Config\Database::connect();
        $builder = $db->table('user_test_answer');
        $user_id = session()->get('user_id');
        $test_id = session()->get('test_id');
        $query = $db->query('SELECT * FROM user_test_answer WHERE user_id ='.$user_id.' AND test_id='.$test_id.' AND question_id='.$question_id);
        $exists = $query->getRow();

        if ($exists){
            $db->query('UPDATE user_test_answer SET marks="'.$option->ans.'"WHERE user_id ='.$user_id.' AND test_id='.$test_id.' AND question_id='.$question_id);
        } else {
            $db->query('INSERT INTO user_test_answer (user_id, test_id, question_id, marks) VALUES ('.session()->get('user_id').','.session()->get('test_id').','.$question_id.','.$option->ans.')');
        }
    }
}