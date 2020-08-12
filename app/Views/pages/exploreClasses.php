<li class="breadcrumb-item active" aria-current="page">Explore Class</li>
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


<div class="container my-1 p-1">
<form method='get' action='<?php echo site_url('classes/classAction')?>' class="form-inline">
    <input class="form-control col-8" type="search" id = "search_desc" name="search_desc" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success col-2" type="submit" name="search_button" value="1"> <i class="fas fa-search"></i> </button>
    <button class="btn btn-outline-success col-2" type="submit" name="all" value="2"> <i class="fas fa-list"></i> </button>
</form>
</div> 

<?php $bg_arr = array('bg-primary', 'bg-success','bg-danger','bg-danger','bg-info', 'bg-warning', 'bg-dark')?>
<!-- CALL ON ANOTHER METHOD!-->
<form method='get' action='<?php echo site_url('classes/classAction')?>'>
<div class="card-column">
<?php 
if (isset($classL)){
    foreach ($classL as $class){ ?>
    <?php $color = $bg_arr[array_rand($bg_arr,1)]?>
    <a style = "text-decoration: none !important" class="text-dark" href = "<?php echo site_url('classes/viewClass/'); echo $class->class_id ?>">
    <div class="card my-2 <?php echo session()->get('role_id') != 1 && $class->class_status == 2? 'd-none':''?>">
    <div class="card-header <?php echo $class->class_status != 2? ' text-white '.$color : 'text-white bg-secondary'; ?>"><?php echo $class->class_name?></div>
      <div class="card-body">
        <p class="card-text <?php echo $class->class_status==2? 'd-none' : ''?>">
            <?php 
            echo $class->description;
            echo '<br>';
            echo $class->start_date.'  -  '.$class->end_date;
            echo '<br>';
            echo $class->start_time.'  -  '.$class->end_time;
            ?>
        </p>
        <button style="border-radius: 90%; border-width: 2px;" class="btn btn-outline-success m-2 float-right <?php echo $class->class_status==2? 'd-none' : ''?>" <?php echo $class->class_status != 0 || in_array($class->class_id, $userClasses)? ' disabled ' : ''; ?> type="submit" name="join" value="<?php echo $class->class_id?>"><i class="fas fa-plus"></i></button>
        <button style="border-radius: 90%; border-width: 2px;" class="btn btn-outline-danger m-2 float-right  <?php echo session()->get('role_id') != 1 || $class->class_status == 2? ' d-none ' : ''; ?> "  type="submit" name="remove" value="<?php echo $class->class_id?>"><i class="fas fa-minus"></i></button>
      </div>
    </div>
    </a>
    <?}}?>
</div>
</form>
