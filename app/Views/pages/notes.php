<li class="breadcrumb-item text-dark"> <a class="text-dark" href="<?php echo site_url('classes/viewClass/')?><?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item active" aria-current="page">Notes</li>
</ol>
</div>
</div>
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

<form method="post" action=<?php echo site_url("Notes/noteAction") ?>>
<div class ="container m-1 p-1"> <h4> Total Notes: <?php echo count($notes);?> </h4> </div>

<div class="list-group">
<?php foreach($notes as $note) {?>
    <a href="<?php echo base_url()."/uploads/".$note->note_path?>" class="list-group-item list-group-item-action  d-flex justify-content-between"> 
    <p class="py-2 m-0 flex-grow-1"><?php echo $note->note_name;?></p>
    <button type="submit" name="edit" value =<?php echo $note->note_id ?> class="btn text-success float-right"><i class="fa fa-edit"></i></button>
    <button type="submit" name="delete" value =<?php echo $note->note_id ?> class="btn text-danger float-right"><i class="fa fa-times"></i></button>
    </a>
<?php } ?>
</div>
<div class="form-group">
<button type="submit" name="add" value = "add" class="btn btn-outline-success col-12 <?php echo session()->isHost == 0? 'd-none' : ''?>"> <i class="fa fa-plus"> </i></button>
</div>
</form>