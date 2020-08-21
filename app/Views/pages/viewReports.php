<li class="breadcrumb-item active" aria-current="page">View Reports</li>
</ol>
</div>
</div>
<?php $bg_arr = array('bg-primary', 'bg-success','bg-danger','bg-danger','bg-info', 'bg-warning', 'bg-dark')?>

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



    

<div class="container my-1 p-1">
<form method='post' action='<?php echo site_url('TestReport/viewReports')?>'class="form-inline" >
    <input class="form-control col-8" type="search" id = "search_desc" name="search_desc" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success col-2" type="submit" name="search_button" value="1"> <i class="fas fa-search"></i> </button>
    <button class="btn btn-outline-success col-2" type="submit" name="all" value="2"> <i class="fas fa-list"></i> </button>
</form>
</div> 


<form method='post' action='<?php echo site_url('TestReport/viewReports')?>' >
<div class="container col-12 m-0 p-0">
<div class="btn-group w-100 btn-group-lg" role="group" aria-label="Basic example">
  <button type="submit" class="btn btn-outline-success <?php echo session()->get('report')=='class'? 'active' : ''?>" name="action" value='byClass'>By Class</button>
  <button type="submit" class="btn btn-outline-success <?php echo session()->get('report')=='user'? 'active' : ''?>" name="action" value='byUser'>By User</button>
</div>
</div>

<?php 
if (isset($userL)){ ?>

    <table class="table"> 
    <thead>
        <tr class="column">
            <th class="cell">Name</th>
            <th class="cell">Class</th>
            <th class="cell">PreTest</th>
            <th class="cell">PostTest</th>
            <th class="cell">Progress</th>
            <th class="cell">Pass</th>
            <!-- <th class="cell">Permissions</th> -->
        </tr>
    </thead>
    <?php foreach ($userL as $user){?>
        <tr class="<?php echo $user->host == 1? 'd-none' : ''?>">
        <td class="cell"><?php echo $user->fname.' '.$user->lname; ?> </td>
        <td class="cell"><?php echo $user->class_name; ?> </td>

        <td class="cell"> <?php echo !is_null($user->pretest)? $user->pretest : '-'; ?></td>
        <td class="cell"> <?php echo !is_null($user->pretest)? $user->posttest : '-'; ?></td>
        <td class="cell"> 
        <?php if (is_null($user->posttest) && is_null($user->pretest) || $user->posttest === $user->pretest) { 
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
            if (is_null($user->pretest) && is_null($user->posttest)){
                echo '-';
            }
            else if ($user->posttest >= 50) { 
                echo "Pass";
            } else if ($user->posttest < 50){
                echo "Fail";
            } else {
                echo "-";
            }
        ?>
        </td>
    <?php }
    } else if (isset($classL)) {
        foreach ($classL as $class) {?>
            <?php $color = $bg_arr[array_rand($bg_arr,1)]?>
            <div class="card ">
            <div style= "background-color: <?php echo $class->color?>" class="card-header <?php echo $class->class_status == 2? "bg-secondary text-white" : "text-white "?>"><?php echo $class->class_name?></div>
            <div class="card-body ">
                <p class="card-text <?php echo $class->class_status == 2? "d-none" : ""?>">
                <?php 
                echo $class->description;
                echo '<br>';
                echo date('j F Y', strtotime($class->start_date)).'  -  '.date('j F Y', strtotime($class->end_date));
                echo '<br>';
                echo date('H:i', strtotime($class->start_time)).'  -  '.date('H:i', strtotime($class->end_time));
                ?>
            </p>
            <button style="border-radius: 60%; border-color:#D3D3D3" class = "btn float-right btn-outline-secondary"type="submit" id="view" name="view" value="<?php echo $class->class_id?>"> <i class="fa fa-angle-right" ></i></button> 
        </div>
        </div>
<?php }
}?>

</form>