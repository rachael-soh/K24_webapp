<li class="breadcrumb-item active" aria-current="page"><?php echo 'Create class' ?></li>
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

<form name="edit" method="post" action="<?php echo site_url('classes/create')?>">
    <h2 class="col-sm-10">Create New Class</h2>
    <div class="container">
    <div class="form-group row">
    <label for="class_name" class="col-sm-2 col-form-label">Class Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="class_name" name="class_name" value = "<?= set_value('class_name') ?>"?>
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="description" name="description" value = "<?= set_value('description') ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="call_link" class="col-sm-2 col-form-label">Call link</label>
    <div class="col-sm-10">
      <input type="url" class="form-control" id="call_link" name="call_link" value = "<?= set_value('call_link') ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="start_time" class="col-sm-2 col-form-label">Start Time</label>
    <div class="col-sm-4">
    <input type="time" class="form-control" name="start_time" id="start_time" value = "<?= set_value('start_time') ?>"> 
    </div>
    <label for="end_time" class="col-sm-2 col-form-label">End Time</label>
    <div class="col-sm-4">
    <input type="time" class="form-control" name="end_time" id="end_time" value = "<?= set_value('end_time') ?>">    
    </div>
    </div>
  </div>
  <div class="container">
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Recurring</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="recurring" id="recurring" value=1 onChange="getValue(this)" checked>
          <label class="form-check-label" for="recurring">
            1 day
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="recurring" id="recurring" value=2 onChange="getValue(this)" >
          <label class="form-check-label" for="recurring">
            Weekly
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="recurring" id="recurring" value=3 onChange="getValue(this)" >
          <label class="form-check-label" for="recurring">
            Monthly
          </label>
        </div>
      </div>
    </div>
  </fieldset>
  </div>

  <div class="container">
  <div class="form-group row">
    <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
    <div class="col-sm-4"> 
        <input type="date" class="form-control" id = "start_date" name="start_date" value = "<?= set_value('start_date') ?>"> 
    </div>
    <label for="end_date" id = "end_date" style="display:none" class="col-sm-2 col-form-label"> End Date</label>
    <div class="col-sm-4" id = "end_date1" name="end_date_1" style="display:none">
    <input type="date" class="form-control" id = "end_date" name="end_date" value = "<?= set_value('end_date') ?>"> 
    </div>
    </div>
  </div>
  </div>
  <script type="text/javascript">


function getValue(x) {
  if(x.value == 1){
    document.getElementById("days").style.display = 'none'; // you need a identifier for changes
    document.getElementById("end_date").style.display = 'none'; // you need a identifier for changes
    document.getElementById("end_date1").style.display = 'none';
  }
  else{
    document.getElementById("days").style.display = 'block';  // you need a identifier for changes
    document.getElementById("end_date").style.display = 'block'; // you need a identifier for changes
    document.getElementById("end_date1").style.display = 'block'; // you need a identifier for changes

  }
}
</script>
<div class="container">
  <div id = "days" class="form-group row" style="display:none">
    <div class="col-sm-2">Days</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="dow" name="dow[]" value=1 >
        <label class="form-check-label" for="mon">
          Monday
        </label>
      </div>
      <div class="form-check">
      <input class="form-check-input" type="checkbox" id="dow" name="dow[]"value=2 >
        <label class="form-check-label" for="tue">
          Tuesday
        </label>
        </div>
        <div class="form-check">
      <input class="form-check-input" type="checkbox" id="dow" name="dow[]"value=3 >
        <label class="form-check-label" for="wed">
          Wednesday
        </label>
      </div>
      <div class="form-check">
      <input class="form-check-input" type="checkbox" id="dow" name="dow[]"value = 4 >
        <label class="form-check-label" for="thurs">
          Thursday
        </label>
      </div>
      <div class="form-check">
      <input class="form-check-input" type="checkbox" id="fri" name="dow[]" value = 5 >
        <label class="form-check-label" for="fri">
          Friday
        </label>
      </div>
      <div class="form-check">
      <input class="form-check-input" type="checkbox" id="dow" name="dow[]" value = 6 >
        <label class="form-check-label" for="sat">
          Saturday
        </label>
      </div>
      <div class="form-check">
      <input class="form-check-input" type="checkbox" id="dow" name="dow[]" value = 7>
        <label class="form-check-label" for="sun">
          Sunday
        </label>
      </div>
    </div>
  </div>
  <?php if (isset($validation)): ?>
      <div class="col-12">
      <div class="alert alert-danger" role="alert">
          <?= $validation->listErrors() ?>
      </div>
      </div>
  <?php endif; ?>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" value="create" class="btn btn-success w-100"> Create </button>
    </div>
  </div>
  </div>
</form>
</div>