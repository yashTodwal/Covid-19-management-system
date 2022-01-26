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
  $sql = "DELETE FROM `areaid` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
//echo $_SERVER['REQUEST_METHOD'];
//exit();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    //update the record
    $sno = $_POST["snoEdit"];
    $aid = $_POST["aidEdit"];
    $aname = $_POST["anameEdit"];
    $atype = $_POST["atypeEdit"];
    $did = $_POST["didEdit"];
// Sql query to be executed
$sql = "UPDATE `areaid` SET `aid` = '$aid', `aname` = '$aname',`atype` = '$atype' ,`did` = '$did' WHERE `areaid`.`sno` = $sno";
$result = mysqli_query($conn, $sql);
if($result){
  $update = true;
}
    
  }
  else{
  $aid = $_POST["aid"];
  $aname = $_POST["aname"];
  $atype = $_POST["atype"];
  $did = $_POST["did"];
// Sql query to be executed
$sql = "INSERT INTO `areaid`(`aid`, `aname`, `atype`, `did`) VALUES ('$aid', '$aname', '$atype' ,'$did')";
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
  <title>Area Table</title>
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
      <form action="/areacrud/index2.php" method="post">
      <input type="hidden" name="snoEdit" id="snoEdit">
      <div class="form-group">
        <label for="aid">Area ID</label>
        <input type="text" class="form-control" id="aidEdit" name="aidEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="aname">Area Name</label>
        <input type="text" class="form-control" id="anameEdit" name="anameEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="atype">Area Type</label>
        <input type="text" class="form-control" id="atypeEdit" name="atypeEdit" aria-describedby="emailHelp">
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
    <a class="navbar-brand" href="#">Area Table</a>
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
    <form action="/areacrud/index2.php" method="post">
      <div class="form-group">
        <label for="aid">Area ID</label>
        <input type="text" class="form-control" id="aid" name="aid" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="aname">Area Name</label>
        <input type="text" class="form-control" id="aname" name="aname" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="atype">Area Type</label>
        <input type="text" class="form-control" id="atype" name="atype" aria-describedby="emailHelp">
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
          <th scope="col">Aid</th>
          <th scope="col">Aname</th>
          <th scope="col">Atype</th>
          <th scope="col">Did</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $sql = "SELECT * FROM `areaid`";
      $result = mysqli_query($conn, $sql);
      $sno=0;
      while($row = mysqli_fetch_assoc($result)){
        $sno=$sno+1;
        echo "<tr>
        <th scope='row'>" . $sno. "</th>
        <td>" . $row['aid'] . "</td>
        <td>" . $row['aname'] . "</td>
        <td>" . $row['atype'] . "</td>
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
      aid=tr.getElementsByTagName("td")[0].innerText;
      aname=tr.getElementsByTagName("td")[1].innerText;
      atype=tr.getElementsByTagName("td")[2].innerText;
      did=tr.getElementsByTagName("td")[3].innerText;
      console.log(aid, aname, atype, did);
      aidEdit.value = aid;
      anameEdit.value = aname;
      atypeEdit.value = atype;
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
        window.location=`/areacrud/index2.php?delete=${sno}`;
      }
      else{
        console.log("no");
      }
     
    })
  })  
  
  </script>
</body>

</html>