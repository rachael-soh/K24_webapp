<li class="breadcrumb-item text-dark"> <a class="text-dark" href="<?php echo site_url('classes/viewClass/')?><?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item text-dark"> <a class="text-dark" href="<?php echo site_url('notes/notes')?>"> Notes </a> </li>
<li class="breadcrumb-item active" aria-current="page">Edit Note</li>
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

<div class="container">
<form method="post" action="<?php echo site_url('notes/editNote/'.$note->note_id)?>" enctype="multipart/form-data">
<?php #$note = session()->get('note')?>

  <div class="form-group row">
    <label for="note_name" class="col-sm-2 col-form-label">Note name</label>
    <div class="container">
      <input type="text" class="form-control" id="note_name" name="note_name" placeholder="<?php echo $note->note_name ?>" value = "<?php echo $note->note_name ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="note_doc" class="col-sm-2 col-form-label">Upload file</label>
    <div class="container">
      <input type="file" class="form-control" id="note_doc" name="note_doc" value = "<?php echo $note->note_doc ?>">
    </div>
  </div>

  <div class="form-row">
  <button type="submit" name="save" value="upload" class="btn btn-success w-100"> Save </button>
  </div>
</form>
</div>

