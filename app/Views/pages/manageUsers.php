<li class="breadcrumb-item active" aria-current="page">Manage User & Permission</li>
</ol>
</nav>

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


<div class="list-group">
  <a href="<?php echo site_url('ManageUsers/userRoles')?>" class="list-group-item list-group-item-action"> Let's manage roles 
  </a>
  <a href="<?php echo site_url('ManagePermissions/managePermissions')?>" class="list-group-item list-group-item-action"> Role permissions</a>
  <a href="<?php echo site_url('manageUsers/hostRequests')?>" class="list-group-item list-group-item-action">  Host requests </a>
</div>
