<li class="breadcrumb-item active" aria-current="page">My Classes</li>
</ol>
</div>
</div>

<!-- errors & success-->
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

<div class="container">
<form method='get' action='<?php echo site_url('classes/classAction')?>' class="form-inline">
    <input class="form-control col-8" type="search" id = "search_desc" name="search_desc" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success col-2" type="submit" name="search_button" value="1"> <i class="fas fa-search"></i> </button>
    <button class="btn btn-outline-success col-2" type="submit" name="all" value="2"> <i class="fas fa-list"></i> </button>
</div>
<?php $bg_arr = array('bg-primary', 'bg-success','bg-danger','bg-danger','bg-info', 'bg-warning', 'bg-dark')?>
<!-- CALL ON ANOTHER METHOD!-->
<?php 
if (isset($classL)){
    foreach ($classL as $class){ ?>
    <?php $color = $bg_arr[array_rand($bg_arr,1)]?>
<div class="card  ">
<div class="card-header <?php echo $class->class_status != 2? ' text-white '.$color : 'text-white bg-secondary'; ?>"><?php echo $class->class_name?></div>
  <div class="card-body ">
    <p class="card-text <?php echo $class->class_status==2? 'd-none' : ''?>">
        <?php 
        echo $class->description;
        echo '<br>';
        echo $class->start_date.'  -  '.$class->end_date;
        echo '<br>';
        echo $class->start_time.'  -  '.$class->end_time;
        ?>
    </p>
    <a href = "<?php echo site_url('classes/viewClass/')?><?php echo $class->class_id?>">
    <button class="btn btn-lg float-right" type="submit" name="view" value="<?php echo $class->class_id?>"><i class="fas fa-eye"></i></button>
    </a>
</div>
</div>
<?}}?>