<?php
  session_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  include('vendor/inc/config.php');
  include('vendor/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['admin_id'];

  //Add Hall
  if(isset($_POST['add_halls']))
    {

            $h_name=$_POST['h_name'];
            $h_reg_no = $_POST['h_reg_no'];
            $h_category=$_POST['h_category'];
            $h_capacity=$_POST['h_capacity'];
            $h_status=$_POST['h_status'];
            $h_dpic=$_FILES["h_dpic"]["name"];
            $h_dpic_tmp = $_FILES["h_dpic"]["tmp_name"];
            $upload_path = "../vendor/img/";

            if (move_uploaded_file($h_dpic_tmp, $upload_path . $h_dpic)) {
              $query = "INSERT INTO FCT_halls (hall_name, hall_capacity, hall_number, hall_category, hall_pic, hall_status) VALUES (?, ?, ?, ?, ?, ?)";
              $stmt = $mysqli->prepare($query);
              $stmt->bind_param('ssssss', $h_name, $h_capacity, $h_reg_no, $h_category, $h_dpic, $h_status);
              
              if ($stmt->execute()) {
                  $succ = "Hall Added Successfully";
              } else {
                  $err = "Failed to add Hall. Please try again.";
              }
          } else {
              $err = "Failed to upload file. Please try again later.";
          }
     }

		        // move_uploaded_file($_FILES["h_dpic"]["tmp_name"],"../vendor/img/".$_FILES["h_dpic"]["name"]);
            // $query="insert into FCT_halls (hall_name, hall_capacity, hall_number, hall_category, hall_pic, hall_status ) values(?,?,?,?,?,?)";
            // $stmt = $mysqli->prepare($query);
            // $rc=$stmt->bind_param('ssssss', $h_name, $h_capacity,  $h_reg_no, $h_category, $h_dpic, $h_status);
            // $stmt->execute();
            //     if($stmt)
            //     {
            //         $succ = "Vehicle Added";
            //     }
            //     else 
            //     {
            //         $err = "Please Try Again Later";
            //     }
            // }
?>
<!DOCTYPE html>
<html lang="en">

<?php include('vendor/inc/head.php');?>

<body id="page-top">
 <!--Start Navigation Bar-->
  <?php include("vendor/inc/nav.php");?>
  <!--Navigation Bar-->

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include("vendor/inc/sidebar.php");?>
    <!--End Sidebar-->
    <div id="content-wrapper">

      <div class="container-fluid">
      <?php if(isset($succ)) {?>
                        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Success!","<?php echo $succ;?>!","success");
                    },
                        100);
        </script>

        <?php } ?>
        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Failed!","<?php echo $err;?>!","Failed");
                    },
                        100);
        </script>

        <?php } ?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">FCT Halls</a>
          </li>
          <li class="breadcrumb-item active">Add Hall</li>
        </ol>
        <hr>
        <div class="card">
        <div class="card-header">
          Add Hall
        </div>
        <div class="card-body">
          <!--Add User Form-->
          <form method ="POST" enctype="multipart/form-data"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Hall Name</label>
                <input type="text" required class="form-control" id="exampleInputEmail1" name="h_name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Hall Registration Number</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="h_reg_no">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Number Of Seats</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="h_capacity">
            </div>
           

            <div class="form-group">
              <label for="exampleFormControlSelect1">Hall Category</label>
              <select class="form-control" name="h_category" id="exampleFormControlSelect1">
                <option>Lecture Hall</option>
                <option>Computer Lab</option>
                <option>Physics Lab</option>
                <option>Chemistry Lab</option>

              </select>
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect1">Hall Status</label>
              <select class="form-control" name="h_status" id="exampleFormControlSelect1">
                <option>Available</option>
                <option>Booked</option>
                
              </select>
            </div>

            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Hall Picture</label>
                <input type="file" class="btn btn-success" id="exampleInputEmail1" name="h_dpic">
            </div>

            <button type="submit" name="add_halls" class="btn btn-success">Add Hall</button>
          </form>
          <!-- End Form-->
        </div>
      </div>
       
      <hr>
     

      <!-- Sticky Footer -->
      <?php include("vendor/inc/footer.php");?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="admin-logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="vendor/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="vendor/js/demo/datatables-demo.js"></script>
  <script src="vendor/js/demo/chart-area-demo.js"></script>
 <!--INject Sweet alert js-->
 <script src="vendor/js/swal.js"></script>

</body>

</html>
