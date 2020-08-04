<li class="breadcrumb-item"> <a href="/k24/public/Classes/viewClass/<?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item"> <a href="/k24/public/TestReport/tests" > Tests </a></li>
<li class="breadcrumb-item active" aria-current="page">Test Creation</li>
</ol>
</nav>

<form method="post" action="/k24/public/TestReport/createTest">
    <h2 class="col-sm-10">Create <?php echo session()->get('testtype');?></h2>
    <?PHP if (session()->get('testtype') == 'posttest'){ ?>
    <div class="form-group row">
    <label for="test_date" class="col-4">Test Date</label>
    <div class="col-8">
      <input type="date" class="form-control" id="test_date" name="test_date" >
    </div>
  </div>
  
  <div class="form-group row">
    <label for="start_time" class="col-4">Start Time</label>
    <div class="col-8">
      <input type="time" class="form-control" id="start_time" name="start_time" >
    </div>
    <label for="end_time" class="col-4">End Time</label>
    <div class="col-8">
    <input type="time" class="form-control" id="end_time" name="end_time" >
    </div>
    </div>
  </div>

    <?php } else if (session()->get('testtype') == 'pretest'){ ?>
      <div class="form-group row">
      <label for="duration" class="col">Duration</label>
      <div class="col">
          <input type="number" class="form-control" id="duration" name="duration"> 
      </div>
      <div class="col">
          Menit
      </div>
</div>
    <?php }?> 

      <button type="submit" value="create" class="btn btn-lg"> <i class="fa fa-save"></i>< </button>
    </div>
  </div>
</form>
<?php if (isset($validation)): ?>
      <div class="col-12">
      <div class="alert alert-danger" role="alert">
          <?= $validation->listErrors() ?>
      </div>
      </div>
  <?php endif; ?>