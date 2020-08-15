<li class="breadcrumb-item text-dark <?php echo session()->get('viewAll') == 1? 'd-none': ''?>"> <a class="text-dark" href="<?php echo site_url('classes/viewClass/').session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item text-dark <?php echo session()->get('viewAll') == 1? 'd-none': ''?>"> <a class="text-dark" href=<?php echo site_url("TestReport/tests")?> class="text-white"> Tests </a></li>
<li class="breadcrumb-item text-dark <?php echo session()->get('viewAll') == 1? '': 'd-none'?>"> <a class="text-dark" href=<?php echo site_url("TestReport/viewReports")?> class="text-white"> View all reports </a></li>
<li class="breadcrumb-item active" aria-current="page">Class Report</li>
</ol>
</div>
</div>
<!-- errors -->
<?php if (session()->get('success')): ?>
    <div class="alert alert-success" role="alert">
    <?= session()->get('success') ?>
    </div>
<?php endif; ?>  
<?php  if (session()->get('error')): ?>
<div class="alert alert-danger" role="alert">
<?= session()->get('error') ?>
</div>
<?php endif; ?>

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
        <tr class="<?php echo $user->host == 1? 'font-weight-bold' : ''?>">
        <td class="cell"><?php echo $user->fname.' '.$user->lname; ?> </td>
        <td class="cell"><?php echo $user->class_name; ?> </td>
        <td class="cell"> <?php echo $user->pretest ?></td>
        <td class="cell"> <?php echo $user->posttest;?></td>
        <td class="cell"> 
        <?php if (is_null($user->posttest) && is_null($user->pretest)) { 
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
        } else if ($user->posttest && $user->posttest < 50){
            echo "Fail";
        } else {
            echo "-";
        }
        ?>
        </td>
        </tr>
    <?php }