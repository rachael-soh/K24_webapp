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
<form method='get' action='<?php echo site_url('classes/myClasses')?>' class="form-inline">
    <input class="form-control col-8" type="search" id = "search_desc" name="search_desc" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success col-2" type="submit" name="search_button" value="1"> <i class="fas fa-search"></i> </button>
    <button class="btn btn-outline-success col-2" type="submit" name="all" value="2"> <i class="fas fa-list"></i> </button>
</div>
<!-- CALL ON ANOTHER METHOD!-->
<?php 
if (isset($classL)){
    foreach ($classL as $class){ ?>
    <a style = "text-decoration: none !important" class="text-dark" href = "<?php echo site_url('classes/viewClass/'); echo $class->class_id ?>">
<div class="card my-2">
<div style= "background-color: <?php echo $class->color?>" class="card-header <?php echo $class->class_status != 2? ' text-white ' : 'text-white bg-secondary'; ?>"><?php echo $class->class_name?></div>
  <div class="card-body ">
    <p class="card-text <?php echo $class->class_status==2? 'd-none' : ''?>">
        <?php 
        echo $class->description;
        echo '<br>';
        echo date('j F Y', strtotime($class->start_date)).'  -  '.date('j F Y', strtotime($class->end_date));
        echo '<br>';
        echo date('H:i', strtotime($class->start_time)).'  -  '.date('H:i', strtotime($class->end_time));
        ?>
    </p>
    </a>
</div>
</div>
<?}}?>