<li class="breadcrumb-item active" aria-current="page"><?php echo $class_info->class_name ?></li>
</ol>
</nav>

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
    <form method="get" action="<?php echo site_url('classes/classAction')?>">
    <button class="btn btn-lg text-white text-center <?php echo session()->get('joined') == 1? 'd-none' : '';  ?>" type="submit" name="join" value="<?php echo $class_info->class_id?>"><i class="fa fa-plus"></i></button>
    <button class="btn btn-lg text-white float-right text-center <?php echo session()->get('role_id') == 3 ? 'd-none' : ''; ?> "  type="submit" name="edit" value="<?php echo $class_info->class_id?>"><i class="fa fa-edit"></i></button>
    <form>
  </div>
</div>
    <div class="list-group">
    <a href="<?php echo $class_info->call_link?>" class="list-group-item list-group-item-action <?php echo ($class_info->class_status == 2) || session()->get('joined') == 0? "disabled" : "" ?>"><i class="fa fa-video"></i> Meeting</a>
    <a href="<?php echo site_url('notes/notes')?>" class="list-group-item list-group-item-action <?php echo session()->get('joined') == 0? "disabled" : "" ?>""><i class="fa fa-book"></i> Notes</a>
    <a href="<?php echo site_url('TestReport/tests')?>" class="list-group-item list-group-item-action <?php echo session()->get('joined') == 0? "disabled" : "" ?>""><i class="fa fa-pen"></i> Tests</a>
    <a href="<?php echo site_url('classes/people')?>" class="list-group-item list-group-item-action <?php echo ($class_info->class_status == 2) || session()->get('joined') == 0? "disabled" : "" ?>"><i class="fa fa-users"></i> People</a>
    </div>





