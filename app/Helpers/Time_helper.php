<?php use CodeIgniter\I18n\Time;
    function isBefore($time1, $time2){
        $T1 = strtotime($time1);
        $T2 = strtotime($time2);
        if ($T1 <= $T2){
            return True;
        } else {
            return False;
        }
    }
    
    function isBeforeToday($time1){
        $T1 = strtotime($time1);

        $today = new Time('now');
        $today = $today->toDateTimeString();
        $today = strtotime($today);
        
        if ($T1 <= $today){
            return True;
        } else {
            return False;
        }
    }

    function difference($time1, $time2){
        $T1 = strtotime($time1);
        $T2 = strtotime($time2);

        return round(abs($T1 - $T2) / 60, 2);
    }

    function isOverlapping($newStart, $newEnd, $start, $end){
        $newStart = strtotime($newStart);
        $newEnd = strtotime($newEnd);
        $start = strtotime($start);
        $end = strtotime($end);
        // [  ---]
        //    [---new ] front overlap
        if ($newStart <= $end && $newStart>=$start && $end <= $newEnd){
            return True;
        } elseif ($newStart <= $start && $newEnd >= $start && $newEnd <= $end){
            // [ new--]
            //    [---      ] back overlap
            return True;
        } elseif ($newStart >= $start && $newEnd <= $end){
            //     [new]
            //  [   ---   ] full small overlap
            return True;
        } elseif ($newStart <= $start && $newEnd >= $end){
            //     [---]
            //  [   new    ] full big overlap
            return True;
        } elseif ($newStart == $start && $newEnd == $end){
            //     [---]
            //  [   new    ] full big overlap
            return True;
        } else {
            return False;
        }
    
        function countDown($duration){
            
        }
    }