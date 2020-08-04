
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <!-- FUllcalendar -->
    <link href='http://localhost:8080/k24/fullcalendar/lib/main.css' rel='stylesheet' />
    <script src='http://localhost:8080/k24/fullcalendar/lib/main.js'></script>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events:<?php echo $events?>,
      headerToolbar:{
      start:'title',
      center:'',
      end:'dayGridMonth,timeGridWeek,timeGridDay'
      },
      footerToolbar:{
        start:'',
        center:'today prev,next',
        end:''
      },
      handleWindowResize:true,
      stickyHeaderDates:false,
    });
    calendar.render();
});
</script>
</head> 
<body>
    <?php $uri = service('uri'); ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success" aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent">
      <li class="breadcrumb-item"><a href="/k24/public/" class="text-light">Home</a></li>
    </ol>
    </nav>
<br/>

  <div class='container col-12'>
  <div class='row center-block'>
    <h2>My Schedule</h2>
  </div>
  <div id="calendar"></div>
  </div>

  <br/>

      
</body>
</html>