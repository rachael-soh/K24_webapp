<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">  
    <link rel="stylesheet" href="/assets/css/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <title></title>

  </head>
  <body>
  <?php $uri = service('uri'); ?>

<div class='container col-12'>
<img src="<?php echo base_url().'/Logo_Apotek_K-24.png' ?>"  style="width:50%; height:50%;"class=" m-2 p-2 img-fluid mx-auto d-block" alt="Responsive image">
<div>
<div class='container col-10 mx-auto px-3 '>
<ul class="nav nav-pills justify-content-center nav-fill">
  <li class="nav-item">
    <a  class="nav-link <?php echo ( $uri->getSegment(1) == '' || $uri->getSegment(1) == 'pages' && $uri->getSegment(2) == ''? 'active bg-success text-light': 'text-success') ?>" href="<?php echo site_url('pages')?>">Login</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo  ($uri->getSegment(1) == 'pages' && $uri->getSegment(2) == 'signup' ? 'active bg-success text-light': 'text-success') ?>" href="<?php echo site_url('pages/signup')?>">Sign up</a>
  </li>
</ul>
</div>
