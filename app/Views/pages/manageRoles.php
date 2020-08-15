<li class="breadcrumb-item text-dark"><a class="text-dark" href="<?php echo site_url('dashboard/manageUsers')?>">Manage User & Permission</a></li>
<li class="breadcrumb-item active" aria-current="page">User Role</li>
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

<div class="table-responsive">
<table class="table">
<thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
        <!-- <th class="cell">Permissions</th> -->
    </tr>
</thead>

<form method='post' action='<?php echo site_url('ManageUsers/userRoles')?>'>
<div class="btn-group d-flex" role="group" aria-label="Basic example">
  <button type="submit" class="btn btn-outline-success <?php echo session()->get('tab')=='all'? 'active' : ''?>" name="action" value='allTab'>All</button>
  <button type="submit" class="btn btn-outline-success <?php echo session()->get('tab')=='admin'? 'active' : ''?>" name="action" value='adminTab'>Admin</button>
  <button type="submit" class="btn btn-outline-success <?php echo session()->get('tab')=='host'? 'active' : ''?>" name="action" value='hostTab'>Host</button>
  <button type="submit" class="btn btn-outline-success <?php echo session()->get('tab')=='peserta'? 'active' : ''?>" name="action" value='pesertaTab'>Peserta</button>
</div>
</form>


<tbody>
<?php foreach ($userL as $user) { ?>
    <tr class="<?php echo $user->user_status != 1? "table-secondary" : "none" ?>">
        <td ><?php echo $user->fname.' '.$user->lname; ?> </td>

        <td >
        <form method='post' action='<?php echo site_url('ManageUsers/userRoles')?>'>
        
        <select class="custom-select custom-select-sm " name="newrole">
            <option value="1" <?php echo $user->role_id == 1? 'selected="selected"' : ''; ?>>Admin</option>
            <option value="2" <?php echo $user->role_id == 2? 'selected="selected"' : ''; ?>>Host</option>
            <option value="3" <?php echo $user->role_id == 3? 'selected="selected"' : ''; ?>>Peserta</option>
        </select>

        </td>
        <td >
            
            <div class="btn-group-vertical btn-group-sm d-flex">
             <button type="submit" name="save" value="<?php echo $user->user_id ?>" class="btn btn-primary"> <i class="fa fa-save" aria-hidden="true"></i> </button>
             <button type="submit" name="delete" value="<?php echo $user->user_id ?>" class="btn btn-danger  <?php echo $user->user_status != 1? "d-none": "" ?>"> <i class="fa fa-times" aria-hidden="true"></i> </button>
             <button type="submit" name="activate" value="<?php echo $user->user_id ?>" class="btn btn-success <?php echo $user->user_status == 1? "d-none": "" ?>"> Activate </button>
             </div>
             </form>
        </td>
        
        
    </tr>
    <?php } ?>
</tbody>
</div>
