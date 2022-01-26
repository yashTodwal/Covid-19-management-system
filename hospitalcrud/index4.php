<?php
//INSERT INTO `stateid` (`sid`, `sname`, `infected`, `death`, `recovered`) VALUES ('12', 'rajasthan', '34000', '2000', '30000');
// Connecting to the Database
$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "dbmsproj01";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `hospitalid` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
//echo $_SERVER['REQUEST_METHOD'];
//exit();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    //update the record
    $sno = $_POST["snoEdit"];
    $hid = $_POST["hidEdit"];
    $hname = $_POST["hnameEdit"];
    $bavl = $_POST["bavlEdit"];
    $htype = $_POST["htypeEdit"];
    $pid = $_POST["pidEdit"];
    $did = $_POST["didEdit"];
// Sql query to be executed
$sql = "UPDATE `hospitalid` SET `hid` = '$hid', `hname` = '$hname', `bavl` = '$bavl', `htype` = '$htype', `pid` = '$pid' ,`did` = '$did' WHERE `hospitalid`.`sno` = $sno";
$result = mysqli_query($conn, $sql);
if($result){
  $update = true;
}
    
  }
  else{
    $hid = $_POST["hid"];
    $hname = $_POST["hname"];
    $bavl = $_POST["bavl"];
    $htype = $_POST["htype"];
    $pid = $_POST["pid"];
    $did = $_POST["did"];
// Sql query to be executed
$sql = "INSERT INTO `hospitalid`(`hid`, `hname`, `bavl`, `htype`, `pid`, `did`) VALUES ('$hid', '$hname', '$bavl', '$htype', '$pid' ,'$did')";
$result = mysqli_query($conn, $sql);

// Add a new trip to the Trip table in the database
if($result){
    //echo "The record has been inserted successfully successfully!<br>";
    $insert = true;
}
else{
    echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
}
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    
    </script>
  <title>Hospital Table</title>
</head>

<body>
<!-- Edit modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
Edit modal
</button>-->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit This Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/hospitalcrud/index4.php" method="post">
      <input type="hidden" name="snoEdit" id="snoEdit">
      <div class="form-group">
        <label for="hid">Hospital ID</label>
        <input type="text" class="form-control" id="hidEdit" name="hidEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="hname">Hospital Name</label>
        <input type="text" class="form-control" id="hnameEdit" name="hnameEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="bavl">Beds Available</label>
        <input type="text" class="form-control" id="bavlEdit" name="bavlEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="htype">Hospital Type</label>
        <input type="text" class="form-control" id="htypeEdit" name="htypeEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="pid">Patient ID</label>
        <input type="text" class="form-control" id="pidEdit" name="pidEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="did">District ID</label>
        <input type="text" class="form-control" id="didEdit" name="didEdit" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Update Record</button>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Hospital Table</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/loginsystem/welcome.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/loginsystem/aboutus.php">About Us</a>
        </li>
        </ul>
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link pull-right" href="/loginsystem/logout.php">LogOut</a>
        </li>
      </ul>
      
    </div>
  </nav>
  <?php
  if($insert)
  {
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> You data is Inserted Successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete)
  {
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> You data is Deleted Successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update)
  {
    echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> You data is Updated Successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h3>Insert New Data</h3>
    <form action="/hospitalcrud/index4.php" method="post">
    <div class="form-group">
        <label for="hid">Hospital ID</label>
        <input type="text" class="form-control" id="hid" name="hid" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="hname">Hospital Name</label>
        <input type="text" class="form-control" id="hname" name="hname" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="bavl">Beds Available</label>
        <input type="text" class="form-control" id="bavl" name="bavl" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="htype">Hospital Type</label>
        <input type="text" class="form-control" id="htype" name="htype" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="pid">Patient ID</label>
        <input type="text" class="form-control" id="pid" name="pid" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="did">District ID</label>
        <input type="text" class="form-control" id="did" name="did" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Insert</button>
    </form>
  </div>
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Hos Id</th>
          <th scope="col">Hos Name</th>
          <th scope="col">Beds Available</th>
          <th scope="col">Hos Type</th>
          <th scope="col">Pid</th>
          <th scope="col">Did</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $sql = "SELECT * FROM `hospitalid`";
      $result = mysqli_query($conn, $sql);
      $sno=0;
      while($row = mysqli_fetch_assoc($result)){
        $sno=$sno+1;
        echo "<tr>
        <th scope='row'>" . $sno. "</th>
        <td>" . $row['hid'] . "</td>
        <td>" . $row['hname'] . "</td>
        <td>" . $row['bavl'] . "</td>
        <td>" . $row['htype'] . "</td>
        <td>" . $row['pid'] . "</td>
        <td>" . $row['did'] . "</td>
        <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button></td>
          </tr>";
    }
      ?>
      
      </tbody>
    </table>
  </div>
  <hr>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
   edits = document.getElementsByClassName('edit');
   Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("edit ",);
      tr=e.target.parentNode.parentNode;
      hid=tr.getElementsByTagName("td")[0].innerText;
      hname=tr.getElementsByTagName("td")[1].innerText;
      bavl=tr.getElementsByTagName("td")[2].innerText;
      htype=tr.getElementsByTagName("td")[3].innerText;
      pid=tr.getElementsByTagName("td")[4].innerText;
      did=tr.getElementsByTagName("td")[5].innerText;
      console.log(hid, hname, bavl, htype, pid, did);
      hidEdit.value = hid;
      hnameEdit.value = hname;
      bavlEdit.value = bavl;
      htypeEdit.value = htype;
      pidEdit.value = pid;
      didEdit.value = did;
      snoEdit.value=e.target.id;
      console.log(e.target.id);
      $('#editModal').modal('toggle');
    })
  })  
  deletes = document.getElementsByClassName('delete');
   Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("edit ",);
      sno=e.target.id.substr(1,);
      if(confirm("Do you want to Delete this Record?")){
        console.log("yes");
        window.location=`/hospitalcrud/index4.php?delete=${sno}`;
      }
      else{
        console.log("no");
      }
     
    })
  })  
  
  </script>
</body>

</html>