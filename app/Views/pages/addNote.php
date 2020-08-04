<li class="breadcrumb-item"> <a href="/k24/public/Classes/viewClass/<?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item"> <a href="/k24/public/Notes/notes"> Notes </a> </li>
<li class="breadcrumb-item active" aria-current="page">Add Note</li>
</ol>
</nav>

<form method="post" action="/k24/public/Notes/addNote" enctype="multipart/form-data">
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