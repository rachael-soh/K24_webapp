<?php $bg_arr = array('bg-primary', 'bg-success','bg-danger','bg-danger','bg-info', 'bg-warning', 'bg-dark')?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <?php if (session()->get('role_id') == 1): ?>
        <!-- ADMIN -->
        <h2>Hello, Admin </h2>
        <hr>
        <ul class="list-group">
        <!-- Manage users-->
        <a href="/k24/public/Dashboard/manageUsers"> 
        <li class="list-group-item list-group-item-action"> <i class="fas fa-users"></i> Manage Users and Permissions </li>
        </a>
        <!-- view reports-->
        <a href="/k24/public/Dashboard/viewReports"> 
        <li class="list-group-item list-group-item-action"> <i class="fas fa-file"></i> View Reports </li>
        </a>
        
        <!-- BUTTON GROUP FOR EXPLORE & CREATE CLASS-->
        <div class="btn-group d-flex" role="group">
        <a class="btn btn-outline-secondary w-100" href="/k24/public/Classes/explore" role="button"><i class="fa fa-search"></i> Explore Classes</a>
        <a class="btn btn-outline-secondary w-100" href="/k24/public/Classes/create" role="button"><i class="fa fa-plus"></i> Create Classes</a>
        </div>

        <!-- All sched-->
        <a href="/k24/public/Dashboard/schedule">
        <li class="list-group-item list-group-item-action"> <i class="fas fa-calendar"></i> Schedule </li>
        </a>
        </ul>

      <!-- HOST -->
      <?php elseif (session()->get('role_id') == 2): ?>
        <h2>Hello, <?= session()->get('fname') ?></h2>
        <hr>
        <!-- My classes-->
        <a href = "/k24/public/Classes/myClasses">  <h4> My classes:</h4></a>
        <div class="container-fluid"> 
        <!-- My classes-->
        <div class="card-deck">
        <?php foreach ($classes as $class){?>
        <?php $color = $bg_arr[array_rand($bg_arr,1)]?>
        <div class="card">
        <h5 class="card-header <?php echo $class->class_status != 2? ' text-white '.$color : 'text-white bg-secondary'; ?>"><?php echo $class->class_name ?></h5>
          <div class="card-body">
            <p class="card-text"> <?php echo $class->description ?> </p>
            <form method="get" action='/k24/public/Classes/viewClass/<?php echo $class->class_id; ?>'> 
            <button class = "btn btn-primary" name="viewclass_id"  id="viewclass_id" value="<?php echo $class->class_id; ?>"> View </button> 
            </form>
          </div>
        </div>
        <?php }?>
        </div>
        </div>
        <!-- BUTTON GROUP FOR EXPLORE & CREATE CLASS-->
        <ul class="list-group">
        <div class="btn-group d-flex" role="group">
        <a class="btn btn-outline-secondary w-100" href="/k24/public/Classes/explore" role="button"><i class="fa fa-search"></i> Explore Classes</a>
        <a class="btn btn-outline-secondary w-100" href="/k24/public/Classes/create" role="button"><i class="fa fa-plus"></i> Create Classes</a>
        </div>

        <!-- My sched-->
        <a href="/k24/public/Dashboard/schedule">
        <li class="list-group-item list-group-item-action"> <i class="fas fa-calendar"></i> Schedule </li>
        </a>
      </ul>

      <!-- PESERTA -->
      <?php else: ?>
        <h2>Hello, <?= session()->get('fname') ?></h2>
        <br>
        <a href = "/k24/public/Classes/myClasses">  <h4> My classes:</h4></a>
        <div class="container-fluid"> 
        <!-- My classes-->
        <div class="card-deck">
        <?php foreach ($classes as $class){?>
        <?php $color = $bg_arr[array_rand($bg_arr,1)]?>
        <div class="card">
        <h5 class="card-header <?php echo $class->class_status != 2? ' text-white '.$color : 'text-white bg-secondary'; ?>"><?php echo $class->class_name ?></h5>
          <div class="card-body">
            <p class="card-text"> <?php echo $class->description ?> </p>
            <form method="get" action='/k24/public/Classes/viewClass/<?php echo $class->class_id?>'> 
            <button class = "btn btn-lg float-right" name="viewclass_id"  id="viewclass_id" value="<?php echo $class->class_id; ?>"> <i class="fas fa-eye"></i> </button> 
            </form>
          </div> 
        </div>
        <?php }?>
        </div>
        </div>
        
        <br>
        <ul class="list-group">
        <!-- Explore classes-->
        <a href="/k24/public/Classes/explore"> 
        <li class="list-group-item list-group-item-action"> <i class="fas fa-file"></i> Explore Classes </li>
        </a>
        <!-- My sched-->
        <a href="/k24/public/Dashboard/schedule">
        <li class="list-group-item list-group-item-action"> <i class="fas fa-calendar"></i> Schedule </li>
        </a>
      </ul>
      <?php endif;?>
    </div>
  </div>
</div>