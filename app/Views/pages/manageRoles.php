<li class="breadcrumb-item"><a class="text-light" href="/k24/public/Dashboard/manageUsers">Manage User & Permission</a></li>
<li class="breadcrumb-item active" aria-current="page">User Role</li>
</ol>
</nav>

<div class=" table-responsive">
<table class="table">
<thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
        <!-- <th class="cell">Permissions</th> -->
    </tr>
</thead>

<form method='post' action='/k24/public/ManageUsers/userRoles'>
<div class="btn-group d-flex" role="group" aria-label="Basic example">
  <button type="submit" class="btn btn-outline-secondary" name="action" value='allTab'>All</button>
  <button type="submit" class="btn btn-outline-secondary" name="action" value='adminTab'>Admin</button>
  <button type="submit" class="btn btn-outline-secondary" name="action" value='hostTab'>Host</button>
  <button type="submit" class="btn btn-outline-secondary" name="action" value='pesertaTab'>Peserta</button>
</div>
</form>


<tbody>
<?php foreach ($userL as $user) { ?>
    <tr class="<?php echo $user->user_status != 1? "table-secondary" : "none" ?>">
        <td ><?php echo $user->fname.' '.$user->lname; ?> </td>
        <td ><?php echo $user->email; ?> </td>

        <td >
        
        
        <select class="custom-select custom-select-sm " name="newrole">
            <option value="1" <?php echo $user->role_id == 1? 'selected="selected"' : ''; ?>>Admin</option>
            <option value="2" <?php echo $user->role_id == 2? 'selected="selected"' : ''; ?>>Host</option>
            <option value="3" <?php echo $user->role_id == 3? 'selected="selected"' : ''; ?>>Peserta</option>
        </select>
        


        </td>
        <td >
            <form method='post' action='/k24/public/ManageUsers/userRoles'>
            <div class="btn-group-vertical btn-group-sm d-flex">
             <button type="submit" name="save" value="<?php echo $user->user_id ?>" class="btn btn-primary"> Save </button>
             <button type="submit" name="delete" value="<?php echo $user->user_id ?>" class="btn btn-danger <?php echo $user->user_status != 1? "d-none": "" ?>"> Delete </button>
             <button type="submit" name="activate" value="<?php echo $user->user_id ?>" class="btn btn-success <?php echo $user->user_status == 1? "d-none": "" ?>"> Activate </button>
             </div>
             </form>
        </td>
        
        
    </tr>
    <?php } ?>
</tbody>
</div>
