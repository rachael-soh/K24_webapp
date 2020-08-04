<?php
namespace App\Validation;
use App\Models\Classes;
use CodeIgniter\I18n\Time;

class ClassRules
{
    function compareDate() {
        $startDate = strtotime($_POST['start_date']);
        $endDate = strtotime($_POST['end_date']);


        if ($endDate >= $startDate)
          return True;
        else {
          return False;
        }
    }


    function startCorrect() {
      if (isset($_POST['start_date'])){
        $startDate = strtotime($_POST['start_date']);
      } else if (isset($_POST['test_date'])){
        $startDate = strtotime($_POST['test_date']);
      }
        
        
        $today = new Time('now');
        $today = $today->toDateTimeString();
        $today = strtotime($today);

        if ($startDate >= $today)
          return True;
        else {
          return False;
        }
    }


    function compareTime() {
        $starttime = strtotime($_POST['start_time']);
        $endtime = strtotime($_POST['end_time']);

        if ($endtime >= $starttime)
          return true;
        else {
          return false;
        }
    }
}
