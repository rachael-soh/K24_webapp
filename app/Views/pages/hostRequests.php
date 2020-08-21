<li class="breadcrumb-item text-dark"><a class="text-dark" href="<?php echo site_url('dashboard/manageUsers')?>">Manage User & Permission</a></li>
<li class="breadcrumb-item active" aria-current="page">Host Request</li>
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

<table class="table">
<thead>
    <tr class="column">
        <th class="cell">Name</th>
        <th class="cell">Class Name </th>
        <th class="cell">Action</th>
    </tr>
</thead>

<form method='post' action='<?php echo site_url('ManageUsers/hostRequests')?>'>

<tbody>
<?php foreach ($hostReqs as $user) { ?>
    <tr>
        <td class="cell"><?php echo $user->fname.' '.$user->lname; ?> </td>
        <td class="cell"><?php echo $user->class_name; ?> </td>
        <td class="cell">
        <div class="btn-group-vertical btn-group-sm d-flex">
            <?php
            echo '<button type="submit" name="approve" value="'.$user->request_id.'" class="btn btn-success"> <i class="fa fa-check"></i> </button>';
            echo '<button type="submit" name="reject" value = "'.$user->request_id.'" class="btn btn-danger"><i class="fa fa-times"></i> </button>';
            ?>
            </div>
        </td>
        </form>
        
    </tr>
    <?php } ?>
</tbody>

