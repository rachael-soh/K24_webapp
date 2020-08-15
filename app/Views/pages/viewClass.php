<li class="breadcrumb-item text-dark <?php echo session()->get('explore') == 1? '':'d-none'?>"> <a class="text-dark" href="<?php echo site_url('classes/explore')?>"> Explore </li></a>

<li class="breadcrumb-item active" aria-current="page"><?php echo $class_info->class_name ?></li>
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

    <div style= "background-color: <?php echo $class_info->color?>" class="card <?php echo $class_info->class_status != 2? 'text-white': 'text-white bg-secondary'; ?>">
    <div class="card-body">
    <h5 class="card-title text-white text-center"><?php echo $class_info->class_name ?></h5>
    <p class="card-text text-white text-center">
        <?php 
        echo $class_info->description;
        echo '<br>';
        echo date('j F Y', strtotime($class_info->start_date)).'  -  '.date('j F Y', strtotime($class_info->end_date));
        echo '<br>';
        echo date('H:i', strtotime($class_info->start_time)).'  -  '.date('H:i', strtotime($class_info->end_time));
        ?>
    </p>
    <form method="get" action="<?php echo site_url('classes/classAction')?>">
    <button class="btn btn-lg text-white text-center <?php echo session()->get('joined') == 1? 'd-none' : '';  ?>" type="submit" name="join" value="<?php echo $class_info->class_id?>"><i class="fa fa-plus"></i></button>
    <button class="btn btn-lg text-white text-center <?php echo session()->get('joined') == 1? '' : 'd-none';  ?>" type="submit" name="drop" value="<?php echo $class_info->class_id?>"><i class="fa fa-minus"></i></button>
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





