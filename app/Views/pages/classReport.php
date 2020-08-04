<li class="breadcrumb-item "> <a class="text-white" href="/k24/public/Classes/viewClass/<?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item "> <a href="/k24/public/TestReport/tests" class="text-white"> Tests </a></li>
<li class="breadcrumb-item active" aria-current="page">Class Report</li>
</ol>
</nav>

<table class="table"> 
    <thead>
        <tr class="column">
            <th class="cell">Name</th>
            <th class="cell">Class</th>
            <th class="cell">PreTest</th>
            <th class="cell">PostTest</th>
            <th class="cell">Progress</th>
            <th class="cell">Pass</th>
        </tr>
    </thead>
    <?php 
    
    foreach ($userL as $user){ ?>
        <tr>
        <td class="cell"><?php echo $user->fname.' '.$user->lname; ?> </td>
        <td class="cell"><?php echo $user->class_name; ?> </td>
        <td class="cell"> <?php echo $user->pretest? $user->pretest : "-"; ?></td>
        <td class="cell"> <?php echo $user->posttest? $user->posttest : "-"; ?></td>
        <td class="cell"> 
        <?php if (!$user->posttest || !$user->pretest) { 
                echo "-";
            } else if ($user->posttest >= $user->pretest){
                echo "Naik";
            } else {
                echo "Turun";
            }
        ?>
        </td>
        <td class="cell"> 
        <?php 
        if ($user->posttest >= 50) { 
                echo "Pass";
        } else if (!$user->posttest || !$user->pretest){
            echo "-";
        } else {
            echo "Fail";
        }
        ?>
        </td>
    <?php }