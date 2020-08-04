<li class="breadcrumb-item active" aria-current="page">My Classes</li>
</ol>
</nav>

<nav class="navbar navbar-light bg-light">
<form method='get' action='/k24/public/Classes/classAction' class="form-inline">
    <input class="form-control col-8" type="search" id = "search_desc" name="search_desc" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success col-2" type="submit" name="search_button" value="1"> <i class="fas fa-search"></i> </button>
    <button class="btn btn-outline-success col-2" type="submit" name="all" value="2"> <i class="fas fa-list"></i> </button>
</nav>
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
    <a href = "/k24/public/Classes/viewClass/ <?php echo $class->class_id?>">
    <button class="btn btn-lg float-right" type="submit" name="view" value="<?php echo $class->class_id?>"><i class="fas fa-eye"></i></button>
    </a>
</div>
</div>
<?}}?>