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
  $sql = "DELETE FROM `patientid` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
//echo $_SERVER['REQUEST_METHOD'];
//exit();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    //update the record
    $sno = $_POST["snoEdit"];
    $pid = $_POST["pidEdit"];
    $pname = $_POST["pnameEdit"];
    $corstage = $_POST["corstageEdit"];
    $status = $_POST["statusEdit"];
    $address = $_POST["addressEdit"];
    $contact_no = $_POST["contact_noEdit"];
    $email = $_POST["emailEdit"];
    $aid = $_POST["aidEdit"];
    $did = $_POST["didEdit"];
// Sql query to be executed
$sql = "UPDATE `patientid` SET `pid` = '$pid', `pname` = '$pname', `corstage` = '$corstage', `status` = '$status', `address` = '$address' , `contact_no` = '$contact_no', `email` = '$email', `aid` = '$aid', `did` = '$did' WHERE `patientid`.`sno` = $sno";
$result = mysqli_query($conn, $sql);
if($result){
  $update = true;
}
    
  }
  else{
    $pid = $_POST["pid"];
    $pname = $_POST["pname"];
    $corstage = $_POST["corstage"];
    $status = $_POST["status"];
    $address = $_POST["address"];
    $contact_no = $_POST["contact_no"];
    $email = $_POST["email"];
    $aid = $_POST["aid"];
    $did = $_POST["did"];
// Sql query to be executed
$sql = "INSERT INTO `patientid`(`pid`, `pname`, `corstage`, `status`, `address`, `contact_no`, `email`, `aid`, `did`) VALUES ('$pid', '$pname', '$corstage', '$status', '$address' ,'$contact_no', '$email' , '$aid' , '$did' )";
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
  <title>Patient Table</title>
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
      <form action="/patientcrud/index3.php" method="post">
      <input type="hidden" name="snoEdit" id="snoEdit">
      <div class="form-group">
        <label for="pid">Patient ID</label>
        <input type="text" class="form-control" id="pidEdit" name="pidEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="pname">Patient Name</label>
        <input type="text" class="form-control" id="pnameEdit" name="pnameEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="corstage">Corona Stage</label>
        <input type="text" class="form-control" id="corstageEdit" name="corstageEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control" id="statusEdit" name="statusEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="addressEdit" name="addressEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="contact_no">Contact Number</label>
        <input type="text" class="form-control" id="contact_noEdit" name="contact_noEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="emailEdit" name="emailEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="aid">Area ID</label>
        <input type="text" class="form-control" id="aidEdit" name="aidEdit" aria-describedby="emailHelp">
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
    <a class="navbar-brand" href="#">Patient Table</a>
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
    <form action="/patientcrud/index3.php" method="post">
    <div class="form-group">
        <label for="pid">Patient ID</label>
        <input type="text" class="form-control" id="pid" name="pid" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="pname">Patient Name</label>
        <input type="text" class="form-control" id="pname" name="pname" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="corstage">Corona Stage</label>
        <input type="text" class="form-control" id="corstage" name="corstage" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control" id="status" name="status" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="contact_no">Contact Number</label>
        <input type="text" class="form-control" id="contact_no" name="contact_no" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="aid">Area ID</label>
        <input type="text" class="form-control" id="aid" name="aid" aria-describedby="emailHelp">
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
          <th scope="col">Pid</th>
          <th scope="col">Pname</th>
          <th scope="col">Corona Stage</th>
          <th scope="col">Status</th>
          <th scope="col">Address</th>
          <th scope="col">Contact No</th>
          <th scope="col">Email</th>
          <th scope="col">Aid</th>
          <th scope="col">Did</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $sql = "SELECT * FROM `patientid`";
      $result = mysqli_query($conn, $sql);
      $sno=0;
      while($row = mysqli_fetch_assoc($result)){
        $sno=$sno+1;
        echo "<tr>
        <th scope='row'>" . $sno. "</th>
        <td>" . $row['pid'] . "</td>
        <td>" . $row['pname'] . "</td>
        <td>" . $row['corstage'] . "</td>
        <td>" . $row['status'] . "</td>
        <td>" . $row['address'] . "</td>
        <td>" . $row['contact_no'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['aid'] . "</td>
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
      pid=tr.getElementsByTagName("td")[0].innerText;
      pname=tr.getElementsByTagName("td")[1].innerText;
      corstage=tr.getElementsByTagName("td")[2].innerText;
      status=tr.getElementsByTagName("td")[3].innerText;
      address=tr.getElementsByTagName("td")[4].innerText;
      contact_no=tr.getElementsByTagName("td")[5].innerText;
      email=tr.getElementsByTagName("td")[6].innerText;
      aid=tr.getElementsByTagName("td")[7].innerText;
      did=tr.getElementsByTagName("td")[8].innerText;
      console.log(pid, pname, corstage, status, address, contact_no, email, aid, did);
      pidEdit.value = pid;
      pnameEdit.value = pname;
      corstageEdit.value = corstage;
      statusEdit.value = status;
      addressEdit.value = address;
      contact_noEdit.value = contact_no;
      emailEdit.value = email;
      aidEdit.value = aid;
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
        window.location=`/patientcrud/index3.php?delete=${sno}`;
      }
      else{
        console.log("no");
      }
     
    })
  })  
  
  </script>
</body>

</html>