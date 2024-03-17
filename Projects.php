<?php  
// INSERT INTO Table
$insert1 = false;
$update1 = false;
$delete1 = false;
// Connect to the Database 
include('admindb.php');

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete1 = true;
  $sql = "DELETE FROM `projects` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $name = $_POST["nameEdit"];
    $date = $_POST["dateEdit"];
    $dur = $_POST["durEdit"];
    $stat = $_POST["statEdit"];
    $empnum = $_POST["empnumEdit"];
  // Sql query to be executed
  $sql = "UPDATE `projects` SET `pname` = '$name', `start` = '$date', `duration` = '$dur', `status` = '$stat', `emp` = '$empnum'   WHERE `projects`.`sno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update1 = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $name = $_POST["nameEdit"];
    $date = $_POST["dateEdit"];
    $dur = $_POST["durEdit"];
    $stat = $_POST["statEdit"];
    $empnum = $_POST["empnumEdit"];
  // Sql query to be executed
  $sql = "INSERT INTO `projects` (`pname`,`start`,`duration`,`status`,`emp`) VALUES ('$name','$date','$dur','$stat','$empnum')";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert1 = true;
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
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


  <title>Projects</title>

</head>

<body>
 

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Project Database</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="Projects.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="name">Project Name</label>
              <input type="text" class="form-control" id="nameEdit" name="nameEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="date">Start Date</label>
              <input type="date" class="form-control" id="dateEdit" name="dateEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="dur">Duration</label>
              <input type="number" class="form-control" id="durEdit" name="durEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="stat">Status</label>
              <select class="form-control" id="statEdit" name="statEdit" aria-describedby="emailHelp">
              <option value="Completed">Completed</option>
              <option value="Pending">Pending</option>
              <option value="Ongoing">Ongoing</option>
              </select>
            </div>
            <div class="form-group">
              <label for="empnum">Manpower</label>
              <input type="number" class="form-control" id="empnumEdit" name="empnumEdit" aria-describedby="emailHelp">
            </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="images/logo.png" height="28px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <?php
  if($insert1){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your project has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete1){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your project has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update1){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your project has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h2>Projects</h2>
    <form action="Projects.php" method="POST">
      <div class="form-group">
        <label for="name">Project Name</label>
        <input type="text" class="form-control" id="nameEdit" name="nameEdit" aria-describedby="emailHelp">
        <label for="date">Start Date</label>
        <input type="date" class="form-control" id="dateEdit" name="dateEdit" aria-describedby="emailHelp">
        <label for="dur">Duration</label>
        <input type="number" class="form-control" id="durEdit" name="durEdit" aria-describedby="emailHelp">
        <label for="stat">Status</label>
        <select class="form-control" id="statEdit" name="statEdit" aria-describedby="emailHelp">
        <option value="Completed">Completed</option>
        <option value="Pending">Pending</option>
        <option value="Ongoing">Ongoing</option>
        </select>
        <label for="empnum">Manpower</label>
        <input type="number" class="form-control" id="empnumEdit" name="empnumEdit" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Add Project</button>
    </form>
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sl.No</th>
          <th scope="col">Name</th>
          <th scope="col">Start Date</th>
          <th scope="col">Duration</th>
          <th scope="col">Status</th>
          <th scope="col">Manpower</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `projects`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['pname'] . "</td>
            <td>". $row['start'] . "</td>
            <td>". $row['duration'] . "</td>
            <td>". $row['status'] . "</td>
            <td>". $row['emp'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>  </td>
          </tr>";
        } 
          ?>
      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
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
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        date = tr.getElementsByTagName("td")[0].innerText;
        dur = tr.getElementsByTagName("td")[0].innerText;
        stat = tr.getElementsByTagName("td")[0].innerText;
        empnum = tr.getElementsByTagName("td")[0].innerText;
        console.log(name,date,dur,stat,empnum);
        nameEdit.value = name;
        dateEdit.value = date;
        durEdit.value = dur;
        statEdit.value = stat;
        empnumEdit.value = empnum;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this project!")) {
          console.log("yes");
          window.location = `Projects.php?delete=${sno}`;
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>
<style>
  body{
    background-color:cornsilk;
  }
  table tr{
    background-color:antiquewhite;
  }
</style>

</html>
