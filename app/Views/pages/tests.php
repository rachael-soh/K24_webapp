<li class="breadcrumb-item"> <a href="<?php echo site_url('classes/viewClass/')?><?php echo session()->get('class_id') ?>" class="text-light"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item active" aria-current="page">Tests</li>
</ol>
</nav>

<?php if (session()->get('error')): ?>
    <div class="alert alert-danger" role="alert">
    <?= session()->get('error') ?>
    </div>
<?php endif; ?>
<?php if (session()->get('success')): ?>
    <div class="alert alert-success" role="alert">
    <?= session()->get('success') ?>
    </div>
<?php endif; ?>

<div class="row  <?php echo session()->get('role_id') != 3? ' d-none ' : ''; ?>">
<div class="card col-6">
<div class="card-body">
    <h5 class="card-title">PreTest Score: </h5>
    <h2 class="card-text">
        <?php 
        if (isset($score['pretest'])){
            echo $score['pretest'].'/100';
        }else {
            echo '/100';
        }
        
        ?>
    </h2>
  </div>
</div>
<div class="card col-6">
<div class="card-body">
    <h5 class="card-title">PostTest Score: </h5>
    <h2 class="card-text">
        <?php 
        if (isset($score['posttest'])){
            echo $score['posttest'].'/100';
        } else {
            echo '/100';
        }
        ?>
    </h2>
  </div>
</div>
</div>

<ul class="list-group">
    
    <a href="<?php echo site_url('TestReport/classReport/')?><?php echo session()->get('class_id') ?>" class="list-group-item list-group-item-action <?php echo session()->get('role_id') == 3? ' d-none ' : ''; ?> "> 
    <p class="py-2 m-0 flex-grow-1">View Reports</p>
    </a>

    <li class="list-group-item d-flex justify-content-between"> 
    <p class="py-2 m-0 flex-grow-1">Pretest</p>
    <form method='post' action="<?php echo site_url('TestReport/testAction')?>">
    <button  type="submit" name="edit-pretest" value = "pretest" class="btn btn-lg float-right <?php echo session()->get('role_id') ==3 ? ' d-none ' : ''; ?>"><i class="fa fa-edit"></i></button>
    <button type="submit" name="take-pretest" value = "pretest" class="btn btn-lg float-right  <?php echo session()->get('role_id') != 3 || session()->get('class_status')==2 ? ' d-none ' : ''; ?>"><i class="fa fa-pencil-alt"></i></button>
    </li>
    

    
    <li class="list-group-item d-flex justify-content-between"> 
   
    <p class="py-2 m-0 flex-grow-1">Posttest</p>
    <form method='post' action="<?php echo site_url('TestReport/testAction')?>">
    <button type="submit" name="edit-posttest" value = "posttest" class="btn btn-lg float-right <?php echo session()->get('role_id') == 3? ' d-none ' : ''; ?>"><i class="fa fa-edit"></i></button>
    <button type="submit" name="take-posttest" value = "pretest"class="btn btn-lg float-right <?php echo session()->get('role_id') != 3 || session()->get('class_status')==2 ? 'd-none ' : ''; ?>"><i class="fa fa-pencil-alt"></i></button>
    </form>
    </li>
    
    
</ul>