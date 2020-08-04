<li class="breadcrumb-item active" aria-current="page"><?php echo $class_info->class_name ?></li>
</ol>
</nav>
<?php $bg_arr = array('bg-primary', 'bg-success','bg-danger','bg-danger','bg-info', 'bg-warning', 'bg-dark')?>
<?php $color = $bg_arr[array_rand($bg_arr,1)]?>

    <div class="card <?php echo $class_info->class_status != 2? ' text-white '.$color : 'text-white bg-secondary'; ?>">
    <div class="card-body">
    <h5 class="card-title text-white text-center"><?php echo $class_info->class_name ?></h5>
    <p class="card-text text-white text-center">
        <?php 
        echo $class_info->description;
        echo '<br>';
        echo $class_info->start_date.'  -  '.$class_info->end_date;
        echo '<br>';
        echo $class_info->start_time.'  -  '.$class_info->end_time;
        ?>
    </p>
    <form method="get" action="/k24/public/Classes/classAction">
    <button class="btn btn-lg text-white text-center <?php echo in_array($class_info->class_id, $user_classes)? 'd-none' : '';  ?>" type="submit" name="join" value=""><i class="fa fa-plus-circle"></i></button>
    <button class="btn btn-lg text-white float-right text-center <?php echo session()->get('role_id') == 3 ? 'd-none' : ''; ?> "  type="submit" name="edit" value="<?php echo $class_info->class_id?>"><i class="fa fa-edit"></i></button>
    <form>
  </div>
</div>
    <div class="list-group">
    <a href="<?php echo $class_info->call_link?>" class="list-group-item list-group-item-action <?php echo ($class_info->class_status == 2)? "disabled" : "" ?>">Meeting</a>
    <a href="/k24/public/Notes/notes" class="list-group-item list-group-item-action">Notes</a>
    <a href="/k24/public/TestReport/tests" class="list-group-item list-group-item-action">Tests</a>
    <a href="/k24/public/Classes/people" class="list-group-item list-group-item-action <?php echo ($class_info->class_status == 2)? "disabled" : "" ?>">People</a>
    </div>





