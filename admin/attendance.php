<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit(); // Exit after redirection
}
?>
<!-- HTML and PHP code continues... -->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Gym System Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>

<?php include 'includes/topheader.php'?>
<?php  $page="attendance"; include 'includes/sidebar.php'?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="attendance.php" class="current">Manage Attendance</a> </div>
    <h1 class="text-center">Attendance List <i class="fas fa-calendar"></i></h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Attendance Table</h5>
          </div>
          <div class='widget-content nopadding'> 
            <table class='table table-bordered table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fullname</th>
                  <th>Contact Number</th>
                  <th>Choosen Service</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
              include "dbcon.php";
              date_default_timezone_set('Asia/Kathmandu');
              $current_date = date('Y-m-d');
              $qry = "SELECT * FROM members WHERE status = 'Active'";
              $result = mysqli_query($conn, $qry);
              $cnt = 1;
              while ($row = mysqli_fetch_array($result)) {
              ?>
              <tbody>
                <tr>
                  <td><div class='text-center'><?php echo $cnt; ?></div></td>
                  <td><div class='text-center'><?php echo $row['fullname']; ?></div></td>
                  <td><div class='text-center'><?php echo $row['contact']; ?></div></td>
                  <td><div class='text-center'><?php echo $row['services']; ?></div></td>
                  <td>
                    <?php
                    $qry = "SELECT * FROM attendance WHERE curr_date = '$current_date' AND user_id = '".$row['user_id']."'";
                    $res = $conn->query($qry);
                    $row_exist = mysqli_fetch_array($res);
                    if ($row_exist) {
                    ?>
                    <div class='text-center'><span class="label label-inverse"><?php echo $row_exist['curr_date'] . ' ' . $row_exist['curr_time']; ?></span></div>
                    <div class='text-center'><a href='actions/delete-attendance.php?id=<?php echo $row['user_id'];?>'><button class='btn btn-danger'>Check Out <i class='fas fa-clock'></i></button></a></div>
                    <?php
                    } else {
                    ?>
                    <div class='text-center'><a href='actions/check-attendance.php?id=<?php echo $row['user_id'];?>'><button class='btn btn-info'>Check In <i class='fas fa-map-marker-alt'></i></button></a></div>
                    <?php
                    }
                    ?>
                  </td>
                </tr>
              </tbody>
              <?php
              $cnt++;
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Developed By Naseeb Bajracharya</a> </div>
</div>

<style>
#footer {
  color: white;
}
</style>

<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script>  
<script src="../js/matrix.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 

</body>
</html>
