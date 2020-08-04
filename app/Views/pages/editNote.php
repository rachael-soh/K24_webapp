<li class="breadcrumb-item"> <a href="/k24/public/Classes/viewClass/<?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item"> <a href="/k24/public/Notes/notes"> Notes </a> </li>
<li class="breadcrumb-item active" aria-current="page">Edit Note</li>
</ol>
</nav>

<form method="post" action="/k24/public/Notes/editNote" enctype="multipart/form-data">
<?php $note = session()->get('note')?>
<div class="form-group row">
    <label for="note_name" class="col-sm-2 col-form-label">Note name</label>
    <div class="container">
      <input type="text" class="form-control" id="note_name" name="note_name" placeholder="<?php echo $note->note_name?>" >
    </div>
  </div>
  <div class="form-group row">
    <label for="note_doc" class="col-sm-2 col-form-label">Upload file</label>
    <div class="container">
      <input type="file" class="form-control" id="note_doc" name="note_doc" >
    </div>
  </div>
  <div class="form-group row">
  <button type="submit" name="save" value="upload" class="btn btn-primary"> Save </button>
  </div>
</form>