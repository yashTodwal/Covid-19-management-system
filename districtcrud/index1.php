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
  $sql = "DELETE FROM `districtid` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
//echo $_SERVER['REQUEST_METHOD'];
//exit();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    //update the record
    $sno = $_POST["snoEdit"];
    $did = $_POST["didEdit"];
    $dname = $_POST["dnameEdit"];
    $infected = $_POST["infectedEdit"];
    $death = $_POST["deathEdit"];
    $recovered = $_POST["recoveredEdit"];
    $sid = $_POST["sidEdit"];
// Sql query to be executed
$sql = "UPDATE `districtid` SET `did` = '$did', `dname` = '$dname', `infected` = '$infected', `death` = '$death', `recovered` = '$recovered' ,`sid` = '$sid' WHERE `districtid`.`sno` = $sno";
$result = mysqli_query($conn, $sql);
if($result){
  $update = true;
}
    
  }
  else{
  $did = $_POST["did"];
  $dname = $_POST["dname"];
  $infected = $_POST["infected"];
  $death = $_POST["death"];
  $recovered = $_POST["recovered"];
  $sid = $_POST["sid"];
// Sql query to be executed
$sql = "INSERT INTO `districtid`(`did`, `dname`, `infected`, `death`, `recovered`, `sid`) VALUES ('$did', '$dname', '$infected', '$death', '$recovered' ,'$sid')";
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
  <title>District Table</title>
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
      <form action="/districtcrud/index1.php" method="post">
      <input type="hidden" name="snoEdit" id="snoEdit">
      <div class="form-group">
        <label for="did">District ID</label>
        <input type="text" class="form-control" id="didEdit" name="didEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="dname">District Name</label>
        <input type="text" class="form-control" id="dnameEdit" name="dnameEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="infected">Infected</label>
        <input type="text" class="form-control" id="infectedEdit" name="infectedEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="death">Deaths</label>
        <input type="text" class="form-control" id="deathEdit" name="deathEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="recovered">Recovered</label>
        <input type="text" class="form-control" id="recoveredEdit" name="recoveredEdit" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="sid">State ID</label>
        <input type="text" class="form-control" id="sidEdit" name="sidEdit" aria-describedby="emailHelp">
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
    <a class="navbar-brand" href="#">District Table</a>
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
    <form action="/districtcrud/index1.php" method="post">
      <div class="form-group">
        <label for="did">District ID</label>
        <input type="text" class="form-control" id="did" name="did" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="dname">District Name</label>
        <input type="text" class="form-control" id="dname" name="dname" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="infected">Infected</label>
        <input type="text" class="form-control" id="infected" name="infected" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="death">Deaths</label>
        <input type="text" class="form-control" id="death" name="death" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="recovered">Recovered</label>
        <input type="text" class="form-control" id="recovered" name="recovered" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="sid">State ID</label>
        <input type="text" class="form-control" id="sid" name="sid" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Insert</button>
    </form>
  </div>
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Did</th>
          <th scope="col">Dname</th>
          <th scope="col">Infected</th>
          <th scope="col">Death</th>
          <th scope="col">Recovered</th>
          <th scope="col">Sid</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $sql = "SELECT * FROM `districtid`";
      $result = mysqli_query($conn, $sql);
      $sno=0;
      while($row = mysqli_fetch_assoc($result)){
        $sno=$sno+1;
        echo "<tr>
        <th scope='row'>" . $sno. "</th>
        <td>" . $row['did'] . "</td>
        <td>" . $row['dname'] . "</td>
        <td>" . $row['infected'] . "</td>
        <td>" . $row['death'] . "</td>
        <td>" . $row['recovered'] . "</td>
        <td>" . $row['sid'] . "</td>
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
      did=tr.getElementsByTagName("td")[0].innerText;
      dname=tr.getElementsByTagName("td")[1].innerText;
      infected=tr.getElementsByTagName("td")[2].innerText;
      death=tr.getElementsByTagName("td")[3].innerText;
      recovered=tr.getElementsByTagName("td")[4].innerText;
      sid=tr.getElementsByTagName("td")[5].innerText;
      console.log(did, dname, infected, death, recovered, sid);
      didEdit.value = did;
      dnameEdit.value = dname;
      infectedEdit.value = infected;
      deathEdit.value = death;
      recoveredEdit.value = recovered;
      sidEdit.value = sid;
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
        window.location=`/districtcrud/index1.php?delete=${sno}`;
      }
      else{
        console.log("no");
      }
     
    })
  })  
  
  </script>
</body>

</html>