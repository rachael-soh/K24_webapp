<li class="breadcrumb-item"><a class="text-light" href="<?php echo site_url('dashboard/manageUsers')?>">Manage User & Permission</a></li>
<li class="breadcrumb-item active" aria-current="page">Role Permissions</li>
</ol>
</nav>

<!-- error & success -->
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

<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Admin
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"  data-parent="#accordion">
      <div class="card-body">
        <form method='post' action='<?php echo site_url('ManagePermissions/managePermissions')?>'>
        <?php 
        foreach($all as $a){
            if (in_array($a->perm_id,$admins)){
                echo '<input class="form-check-input" type="checkbox" id="perms" name="perms[]" value=" '.$a->perm_id.'" checked>';
                echo '<label class="form-check-label" for="perms">'.$a->perm_name.'</label>';
                echo '<br>';
            } else {
                echo '<input class="form-check-input" type="checkbox" id="perms" name="perms[]" value=" '.$a->perm_id.'">';
                echo '<label class="form-check-label" for="perms">'.$a->perm_name.'</label>';
                echo '<br>';
            }
        }
        ?>
        <button class = "btn btn-primary text-center" name="action" value="admin" type="submit"> Save </button>
        </form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Host
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <form method='post' action='<?php echo site_url('ManagePermissions/managePermissions')?>'>
        <?php foreach($all as $a){
            if (in_array($a->perm_id,$hosts)){
                echo '<input class="form-check-input" type="checkbox" id="perms" name="perms[]" value=" '.$a->perm_id.'" checked>';
                echo '<label class="form-check-label" for="perms">'.$a->perm_name.'</label>';
                echo '<br>';
            } else {
                echo '<input class="form-check-input" type="checkbox" id="perms" name="perms[]" value=" '.$a->perm_id.'">';
                echo '<label class="form-check-label" for="perms">'.$a->perm_name.'</label>';
                echo '<br>';
            }
        } ?>
        <button class = "btn btn-primary text-center" name="action" value="host" type="submit"> Save </button>
        </form>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Peserta
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <form method='post' action='<?php echo site_url('ManagePermissions/managePermissions')?>'>
        <?php foreach($all as $a){
            if (in_array($a->perm_id,$peserta)){
                echo '<input class="form-check-input" type="checkbox" id="perms" name="perms[]" value=" '.$a->perm_id.'" checked>';
                echo '<label class="form-check-label" for="perms">'.$a->perm_name.'</label>';
                echo '<br>';
            } else {
                echo '<input class="form-check-input" type="checkbox" id="perms" name="perms[]" value=" '.$a->perm_id.'">';
                echo '<label class="form-check-label" for="perms">'.$a->perm_name.'</label>';
                echo '<br>';
            }
        }
        ?>   
        <button class = "btn btn-primary text-center"  name="action" value="peserta" type="submit"> Save </button>
        </form>   
        </div>
    </div>
  </div>
</div>
<div class= "col-12 text-center">
<?php

?>
</div>


