<li class="breadcrumb-item"> <a class="text-light" href="<?php echo site_url('classes/viewClass/')?><?php echo session()->get('class_id') ?>"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item"> <a class="text-light" href="<?php echo site_url('TestReport/tests')?>" > Tests </a></li>
<li class="breadcrumb-item active" aria-current="page">Test Editing</li>
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

<form method="post" action="<?php echo site_url('TestReport/questionAction')?>">
<div class="card">
<div class="form-group row <?php echo $test_status == 1? 'd-none' : ''?>">
    <label for="test_date" class="col-4 "> Test Date</label>
    <div class="col-8"> 
        <input class="form-control" type="text" id = "test_date" name= "test_date" placeholder="<?php echo $test_date;?>" value="<?php echo $test_date;?>"
            onfocus="(this.type='date')"
            onblur="(this.type='text')"> 
    </div>
</div>

<div class="form-group row <?php echo $test_status == 1? 'd-none' : ''?>">
    <label for="end_time" class="col-4 ">Starting Time:</label>
    <div class="col-8">
    <input class="form-control" type="text" name="start_time" placeholder="<?php echo $start_time;?>" value="<?php echo $start_time;?>"
        onfocus="(this.type='time')"
        onblur="(this.type='text')"> 
    </div>
    
    <label for="end_time" class="col-4 ">Ending Time:</label>
    <div class="col-8">
    <input class="form-control" type="text" name="end_time" placeholder="<?php echo $end_time;?>" value="<?php echo $end_time;?>"
        onfocus="(this.type='time')"
        onblur="(this.type='text')"> 
    </div>
</div>
<div class="form-group row <?php echo $test_status == 1? '' : 'd-none'?>">
    <label for="duration" class="col">Duration</label>
    <div class="col">
        <input type="number" class="form-control" id="duration" name="duration" placeholder="<?php echo $duration?>"> 
    </div>
    <div class="col">
        Menit
    </div>
</div>
<?php if (isset($validation)): ?>
      <div class="col-12">
      <div class="alert alert-danger" role="alert">
          <?= $validation->listErrors() ?>
      </div>
      </div>
  <?php endif; ?>
</div>  



<div class ="card"> 
    <div class="card-header">Total Questions:  <?php echo count($questions);?> </div>
<div class="list-group">
<?php foreach($questions as $question) {?>
    <a href="/k24/public/TestReport/questionAction" class="list-group-item list-group-item-action"> <?php echo $question->question;?>
    <div class="btn-group float-right" role="group" aria-label="Basic example">
        <button type="submit" name="edit" value =<?php echo $question->question_id ?> class="btn "><i class="fa fa-edit"></i></button>
        <button type="submit" name="delete" value =<?php echo $question->question_id ?> class="btn "><i class="fa fa-times"></i></button>
    </div></a>
<?php } ?>
</div>
<button type="submit" name="add" value = "add" class="btn btn-lg"> <i class="fa fa-plus-circle"></i> </button>
<button type="submit" name="save" value = "save" class="btn btn-lg"> <i class="fa fa-save"></i> </button>
</form>
</div>

