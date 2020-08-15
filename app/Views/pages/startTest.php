<li class="breadcrumb-item text-dark"> <a href="<?php echo site_url('classes/viewClass/')?><?php echo session()->get('class_id') ?>" class="text-dark"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item text-dark"> <a href="<?php echo site_url('TestReport/tests')?>" class="text-dark"> Tests </a> </li>
<li class="breadcrumb-item" aria-current="page"><?php echo $test->test_status == 1? "Pretest" : "Posttest" ?></li>
</ol>
</div>
</div>
<div class="container m-1 p-1"> 
<h3> Beginning <?php echo $test->test_status == 1? "Pretest" : "Posttest" ?>: </h3>
<hr>
<p> Date: <?php echo $test->test_date?> </p>
<p> Start Time: <?php echo $test->start_time?> </p>
<p> End Time: <?php echo $test->end_time?> </p>
<p>Duration: <?php echo $test->duration ?> Minutes</p>
<p>Total Score: <?php echo $test->total_score ?></p>
</div>
<form method = 'post' action="<?php echo site_url('TestReport/startTest') ?>"> 
<button class="btn btn-lg btn-outline-primary w-100" type = "submit">Begin test</button>
</form>