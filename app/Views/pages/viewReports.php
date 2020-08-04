<li class="breadcrumb-item active" aria-current="page">View Reports</li>
</ol>
</nav>
<?php $bg_arr = array('bg-primary', 'bg-success','bg-danger','bg-danger','bg-info', 'bg-warning', 'bg-dark')?>
<?php if (session()->get('allowed')): ?>
    <div class="alert alert-danger" role="alert">
    <?= session()->get('allowed') ?>
    </div>
<?php endif; ?>

<nav class="navbar navbar-light bg-light">
<form method='post' action='/k24/public/TestReport/getScore'class="form-inline" >
    <input class="form-control col-8" type="search" id = "search_desc" name="search_desc" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success col-2" type="submit" name="search_button" value="1"> <i class="fas fa-search"></i> </button>
    <button class="btn btn-outline-success col-2" type="submit" name="all" value="2"> <i class="fas fa-list"></i> </button>
</nav>


<div class="btn-group col-12 btn-group-lg" role="group" aria-label="Basic example">
  <button type="submit" class="btn btn-outline-secondary <?php echo session()->get('report')=='class'? 'active' : ''?>" name="action" value='byClass'>By Class</button>
  <button type="submit" class="btn btn-outline-secondary <?php echo session()->get('report')=='user'? 'active' : ''?>" name="action" value='byUser'>By User</button>
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
        <tr >
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
        if (!$user->posttest || !$user->pretest) { 
                echo "-";
            } else if ($user->posttest >= 50){
                echo "Pass";
            } else {
                echo "Fail";
            }
        ?>
        </td>
    <?php }
    } else if (isset($classL)) {
        foreach ($classL as $class) {?>
            <?php $color = $bg_arr[array_rand($bg_arr,1)]?>
            <div class="card ">
            <div class="card-header <?php echo $class->class_status == 2? "bg-secondary text-white" : "text-white ".$color?>"><?php echo $class->class_name?></div>
            <div class="card-body <?php echo $class->class_status == 2? "bg-secondary text-white": "" ?>">
                <p class="card-text <?php echo $class->class_status == 2? "d-none" : ""?>">
                <?php 
                echo $class->description;
                echo '<br>';
                echo $class->start_date.'  -  '.$class->end_date;
                echo '<br>';
                echo $class->start_time.'  -  '.$class->end_time;
                ?>
            </p>
            <button class="btn float-left btn-lg" type="submit" id="view" name="view" value="<?php echo $class->class_id?>"><i class="fas fa-eye"></i></button>
        </div>
        </div>
<?php }
}?>

</form>