

<!-- Display the countdown timer in an element -->
<p id="demo"></p>
<script>

// Set the date we're counting down to
var countDownDate = new Date("<?php echo session()->get('end_time');?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML =  hours + "h " + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    window.location.href = "http://localhost:8080/k24/public/TestReport/submitTest";
  }
}, 1000);
</script>


<form method="post" action="/k24/public/Questions/submitQuestion">
<div class = "card">
<div class="card-body">
    <h5 class="card-title"><?php echo key($qns[$index])?></h5>
    <p class="card-text">
        <?php foreach($qns[$index][key($qns[$index])] as $option){?> 
            <div class="form-check">
            <input class="form-check-input" required type="radio" name="option" id="option" value="<?php echo $option->option_id?>">
            <label class="form-check-label" for="option">
                <?php echo $option->option_desc;?>
            </label>
            </div>
        <?php }
        ?>
    </p>
    <button class="btn btn-secondary <?php echo $index == $end-1? ' d-none ' : ''; ?> " type="submit" name="submit" value=<?php echo $index ?>>Submit Question</button>
    <button class="btn btn-secondary <?php echo $index != $end-1? ' d-none ' : ''; ?> " type="submit" name="submit" value=<?php echo $index ?>>Submit Exam</button>
  </div>
</div>
</form>