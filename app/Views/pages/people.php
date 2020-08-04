<li class="breadcrumb-item"> <a class="text-light" href="/k24/public/Classes/viewClass/<?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item active"> People </a></li>
</ol>
</nav>

<table class="table"> 
    <thead>
        <tr class="column">
            <th class="cell">Name</th>
            <th class="cell">Role</th>
            <?php if (session()->get('role_id') != 3) { echo '<th class="cell">Action</th>';} ?>
        </tr>
    </thead>

<?php foreach($peserta as $p){?>
<tr>
    <td class="cell"><?php echo $p->fname.' '.$p->lname; ?> </td>
    <td class="cell"><?php echo $p->role_desc; ?> </td>

    <td class="cell">
        <form method="post" action="/k24/public/Classes/people">
        <button type="submit" name="host_request" value="<?php echo $p->user_id ?>" class="btn btn-secondary <?php echo session()->get('role_id') == 3 || $p->role_id != 3? "d-none": "" ?>"> Make Host </button>
        <button type="submit" name="delete" value="<?php echo $p->user_id ?>" class="btn btn-danger <?php echo session()->get('role_id') == 3 || $p->user_id == session()->get('user_id') || $p->role_id != 3? "d-none": "" ?>"> Delete </button>
        </form>
    </td>
</tr>
<?php }?>
</table>
<br>

<form method = "post" action = "/k24/public/Classes/people">
<div class="form-row">
    <div class="form-group col-12">
    <label for="user" class="col-3"> User:</label>
    <input type="email" class="col-7" id="user" name="user" placeholder="user@email.com">
    <button type="submit" name="invite" id = "invite" value = "invite" class=" btn btn-primary mb-2 text-light"><i class="fa fa-user-plus"></i></button>
    </div>
</div>
</form>