<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
}
else{
  $loggedin = false;
}
echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/loginsystem">Covid-19 App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="/loginsystem/welcome.php"aria-current="page">Home</a>
        </li>';
        if(!$loggedin){
        echo '<li class="nav-item">
          <a class="nav-link" href="/loginsystem/login.php">Login</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="/loginsystem/signup.php">SignUp</a>
        </li>
        ';
      }
      if($loggedin){
        echo '<li class="nav-item">
          <a class="nav-link" href="/loginsystem/aboutus.php">About Us</a>
        </li>
        </ul>
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link pull-right" href="/loginsystem/logout.php">LogOut</a>
        </li>';
      }
      echo '</ul>
    </div>
  </div>
</nav>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="https://cdn.sanity.io/images/0vv8moc6/physpractice/1fbefc837b2407dd6782f10f0cba0de6aa8f7246-1000x600.png?fit=crop&auto=format" alt="" width="30" height="24" class="d-inline-block align-text-top">
      <b><u> A mask is all it takes</u></b>
    </a>
  </div>
</nav>
  </div>
</nav>';
?>