<?php $bg_arr = array('bg-primary', 'bg-success','bg-danger','bg-danger','bg-info', 'bg-warning', 'bg-dark')?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <?php if (session()->get('role_id') == 1): ?>
        <!-- ADMIN -->
        <div class="container m-1 p-1">
        <h2>Hello, Admin </h2>
        </div>
        <ul class="list-group">
        <!-- Manage users-->
        <a href="<?php echo site_url('dashboard/manageUsers')?>"> 
        <li class="list-group-item list-group-item-action"> <i class="fas fa-users"></i> Manage Users and Permissions </li>
        </a>
        <!-- view reports-->
        <a href="<?php echo site_url('dashboard/viewReports')?>"> 
        <li class="list-group-item list-group-item-action"> <i class="fas fa-file"></i> View Reports </li>
        </a>
        
        <!-- BUTTON GROUP FOR EXPLORE & CREATE CLASS-->
        <div class="btn-group d-flex" role="group">
        <a class="btn btn-outline-secondary p-2  w-100" href="<?php echo site_url('classes/explore')?>" role="button"><i class="fa fa-search"></i> Explore Classes</a>
        <a class="btn btn-outline-secondary p-2  w-100" href="<?php echo site_url('classes/create')?>" role="button"><i class="fa fa-plus"></i> Create Classes</a>
        </div>

        <!-- All sched-->
        <a href="<?php echo site_url('dashboard/schedule')?>">
        <li class="list-group-item list-group-item-action"> <i class="fas fa-calendar"></i> Schedule </li>
        </a>
        </ul>

      <!-- HOST -->
      <?php elseif (session()->get('role_id') == 2): ?>
        <div class="container m-1 p-1">
        <h2>Hello, <?php echo session()->get('fname')?> </h2>
        </div>
        <div class="container p-0">
        </div> 
        <a href="<?php echo site_url('classes/myClasses')?>" class="h5 p-2 text-dark"> My Classes:</a>
        
        <div class="container p-2">
        <div class="row flex-row flex-nowrap overflow-auto" >
        <?php foreach ($classes as $class){?>
          <?php $color = $bg_arr[array_rand($bg_arr,1)]?>
          <div class="col-10">
          <a style = "text-decoration: none !important" class="text-dark" href = "<?php echo site_url('classes/viewClass/'); echo $class->class_id?>">
          <div class="card card-block">
              <h5 style= "background-color: <?php echo $class->color?>" class="card-header <?php echo $class->class_status != 2? ' text-white ' : 'text-white bg-secondary'; ?>"><?php echo $class->class_name ?></h5>
              <div class="card-body">
                  <p class="card-text"> <?php echo $class->description ?> </p>
                  <button style="border-radius: 60%;" class = "btn float-right btn-outline-light"> <i class="fa fa-angle-right" ></i></button> 
              </div>
          </div>
          </div>
          </a>
        <?php }?>
        </div> 
        </div> 
        <!-- BUTTON GROUP FOR EXPLORE & CREATE CLASS-->
        <ul class="list-group pt-1 mt-1">
        <div class="btn-group d-flex" role="group">
        <a class="btn btn-outline-secondary p-2 w-100" href="<?php echo site_url('classes/explore')?>" role="button"><i class="fa fa-search"></i> Explore Classes</a>
        <a class="btn btn-outline-secondary p-2 w-100" href="<?php echo site_url('classes/create')?>" role="button"><i class="fa fa-plus"></i> Create Classes</a>
        </div>

        <!-- My sched-->
        <a href="<?php echo site_url('dashboard/schedule')?>">
        <li class="list-group-item list-group-item-action"> <i class="fas fa-calendar"></i> Schedule </li>
        </a>
      </ul>

      <!-- PESERTA -->
      <?php else: ?>
        <div class="container mx-1 p-1">
        <h2>Hello, <?php echo session()->get('fname')?> </h2>
        </div>
        <a href="<?php echo site_url('classes/myClasses')?>" class="h5 p-2 text-dark"> My Classes: </a>
        
        <div class="container p-2">
        <div class="row flex-row flex-nowrap overflow-auto" >
        <?php foreach ($classes as $class){?>
          <?php $color = $bg_arr[array_rand($bg_arr,1)]?>
          
          <div class="col-10">
          <a style = "text-decoration: none !important" class="text-dark" href = "<?php echo site_url('classes/viewClass/'); echo $class->class_id?>">
          <div class="card card-block">
              <h5 style= "background-color: <?php echo $class->color?>" class="card-header <?php echo $class->class_status != 2? ' text-white ' : 'text-white bg-secondary'; ?>"><?php echo $class->class_name ?></h5>
              <div class="card-body">
                  <p class="card-text"> <?php echo $class->description ?> </p>
                  <button style="border-radius: 60%" class = "btn float-right btn-outline-light"> <i class="fa fa-angle-right" ></i></button> 
              </div>
          </div>
          </div>
          </a>
        <?php }?>
        </div> 
        </div> 
                
        <br>
        <ul class="list-group">
        <!-- Explore classes-->
        <a href="<?php echo site_url('classes/explore')?>"> 
        <li class="list-group-item list-group-item-action"> <i class="fas fa-file"></i> Explore Classes </li>
        </a>
        <!-- My sched-->
        <a href="<?php echo site_url('dashboard/schedule')?>">
        <li class="list-group-item list-group-item-action"> <i class="fas fa-calendar"></i> Schedule </li>
        </a>
      </ul>
      <?php endif;?>
    </div>
  </div>
</div>

