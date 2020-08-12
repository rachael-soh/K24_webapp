<li class="breadcrumb-item"> <a href="<?php echo site_url('classes/viewClass/')?><?php echo session()->get('class_id') ?>" class="text-light"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item"> <a href="<?php echo site_url('TestReport/tests/')?>" class="text-light"> Tests </a></li>
<li class="breadcrumb-item active" aria-current="page">Submitted</li>
</ol>
</nav>

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

<div class="card">
<div class="card-body">
    <h5 class="card-title">Test Score: </h5>
    <h2 class="card-text">
        <?php 
        echo $score.' / 100';
        ?>
    </h2>
    <a href="<?php echo site_url('TestReport/testAction')?>"><button class="btn btn-secondary" type="submit" name="view">Back to class</button> </a>
  </div>
</div>