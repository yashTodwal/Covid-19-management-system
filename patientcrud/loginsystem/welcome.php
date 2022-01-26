<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Welcome - <?php $_SESSION['username']?></title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    
    <div class="container my-4">
      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Welcome - <?php echo strtoupper($_SESSION['username'])?></h4>
        <p>Welcome to Covid-19 Management System.</p><p>You are logged in as <?php echo $_SESSION['username']?>.</p><p>We Hope you are taking appropriate measures to take care of yourself and your family. Please go outside only if it is very necessary.</p>
        <hr>
        <p class="mb-0">Please always be sure to Logout.</p>
      </div>
    </div>
    <div class ="container">
      <div class="alert alert-primary" role="alert">
      To access State Table click here <a href="/statecrud/index.php" class="alert-link"><button type="submit" class="btn btn-primary">State Table</button></a>.
      </div>
      <div class="alert alert-primary" role="alert">
      To access District Table click here <a href="/districtcrud/index1.php" class="alert-link"><button type="submit" class="btn btn-primary">District Table</button></a>.
      </div>
      <div class="alert alert-primary" role="alert">
      To access Area Table click here <a href="/areacrud/index2.php" class="alert-link"><button type="submit" class="btn btn-primary">Area Table</button></a>.
      </div>
      <div class="alert alert-primary" role="alert">
      To access Patient Table click here <a href="/patientcrud/index3.php" class="alert-link"><button type="submit" class="btn btn-primary">Patient Table</button></a>.
      </div>
      <div class="alert alert-primary" role="alert">
      To access Hospital Table click here <a href="/hospitalcrud/index4.php" class="alert-link"><button type="submit" class="btn btn-primary">Hospital Table</button></a>.
      </div>
      <div class="alert alert-primary" role="alert">
      For Government Guidelines <a href="https://mohfw.gov.in/" class="alert-link">Click here</a>.
      </div>
      <div class="alert alert-primary" role="alert">
      To Book your vaccination slot on COWIN <a href="https://www.cowin.gov.in/" class="alert-link">Click here</a>.
      </div>
      <div class="alert alert-primary" role="alert">
      Having some Mental Issues <a href="https://www.onlinecounselling4u.com/" class="alert-link">Click here</a>.
      </div>
      <!-- <div class="alert alert-primary" role="alert">
      seCUREME developed by our TeamMate <a href="http://helpnsecure.me/doc.html" class="alert-link">Click here</a>.
      </div> -->
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>
</body>
</html>