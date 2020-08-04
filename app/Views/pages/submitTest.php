<li class="breadcrumb-item"> <a href="/k24/public/Classes/viewClass/<?php echo session()->get('class_id') ?>" class="text-light"> <?php echo session()->get('class_name') ?> </a> </li>
<li class="breadcrumb-item"> <a href="/k24/public/TestReport/tests" class="text-light"> Tests </a></li>
<li class="breadcrumb-item active" aria-current="page">Submitted</li>
</ol>
</nav>

<div class="card">
<div class="card-body">
    <h5 class="card-title">Test Score: </h5>
    <h2 class="card-text">
        <?php 
        echo $score.' / 100';
        ?>
    </h2>
    <a href="/k24/public/TestReport/testAction"><button class="btn btn-secondary" type="submit" name="view">Back to class</button> </a>
  </div>
</div>