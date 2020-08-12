<li class="breadcrumb-item text-light"> <a class="text-light" href="<?php echo site_url('classes/viewclass/')?><?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item text-light"> <a class="text-light" href="<?php echo site_url('notes/notes')?>"> Notes </a> </li>
<li class="breadcrumb-item active" aria-current="page">Add Note</li>
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


<form method="post" action="<?php echo site_url('notes/addNote')?>" enctype="multipart/form-data">
<div class="form-group row">
    <label for="note_name" class="col-sm-2 col-form-label">Note name</label>
    <div class="container">
      <input type="text" class="form-control" id="note_name" name="note_name" >
    </div>
  </div>
  <div class="form-group row">
    <label for="note_doc" class="col-sm-2 col-form-label">Upload file</label>
    <div class="container">
      <input type="file" class="form-control" id="note_doc" name="note_doc" >
    </div>
  </div>
  <div class="form-group row">
  <button type="submit" name="addnote" value="upload" class="btn btn-primary"> Create </button>
  </div>
</form>