<?php
  session_start();
  include('vendor/inc/config.php');
  include('vendor/inc/checklogin.php');

  error_reporting(E_ALL);
 ini_set('display_errors', 1);

  check_login();
  $aid=$_SESSION['admin_id'];
  //Add USer
  if(isset($_POST['update_hall']))
    {
            $h_id = $_GET['hall_id'];
            $h_name=$_POST['h_name'];
            $h_reg_no = $_POST['h_reg_no'];
            $h_category=$_POST['h_category'];
            $h_capacity=$_POST['h_capacity'];
            $h_status=$_POST['h_status'];
            $h_dpic=$_FILES["h_dpic"]["name"];
            $h_dpic_tmp = $_FILES["h_dpic"]["tmp_name"];
            $upload_path = "../vendor/img/";

        // Move uploaded file to destination directory
        $upload_path = "../vendor/img/";
        if(move_uploaded_file($h_dpic_tmp, $upload_path . $h_dpic)) {
        // Prepare SQL query
        $query = "UPDATE FCT_halls SET hall_name=?, hall_number=?, hall_capacity=?, hall_category=?,hall_status=?, hall_pic=?  WHERE hall_id=?";
        $stmt = $mysqli->prepare($query);
        
        // Bind parameters and execute query
        $stmt->bind_param('ssssssi', $h_name, $h_reg_no, $h_capacity, $h_category,$h_status, $h_dpic, $h_id);
        $stmt->execute();
        
        if($stmt->affected_rows > 0) {
            $succ = "Hall Updated";
        } else {
            $err = "Failed to update Hall. Please try again.";
        }
        
        $stmt->close();
    } else {
        $err = "Failed to upload file. Please try again later.";
    }
}
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
            <a href="#">Halls</a>
          </li>
          <li class="breadcrumb-item active">Update Hall</li>
        </ol>
        <hr>
        <div class="card">
        <div class="card-header">
            Update Hall
        </div>
        <div class="card-body">
          <!--Add User Form-->
          <?php
            $aid=$_GET['hall_id'];
            $ret="select * from FCT_halls where hall_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$aid);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
        {
        ?>
          <form method ="POST" enctype="multipart/form-data"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Hall Name</label>
                <input type="text" value="<?php echo $row->hall_name;?>" required class="form-control" id="exampleInputEmail1" name="h_name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Hall Registration Number</label>
                <input type="text" value="<?php echo $row->hall_number;?>" class="form-control" id="exampleInputEmail1" name="h_reg_no">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Number Of Seats</label>
                <input type="text" value="<?php echo $row->hall_capacity;?>" class="form-control" id="exampleInputEmail1" name="h_capacity">
            </div>
            
            <div class="form-group">
              <label for="exampleFormControlSelect1">Hall Category</label>
              <select class="form-control" name="h_category" id="exampleFormControlSelect1">
                 <option <?php if($row->hall_category == 'Lecture Hall') echo 'selected'; ?>>Lecture Hall</option>
                 <option <?php if($row->hall_category == 'Computer Lab') echo 'selected'; ?>>Computer Lab</option>
                 <option <?php if($row->hall_category == 'Physics Lab') echo 'selected'; ?>>Physics Lab</option>
                 <option <?php if($row->hall_category == 'Chemistry Lab') echo 'selected'; ?>>Chemistry Lab</option>
              </select>
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect1">Hall Status</label>
              <select class="form-control" name="h_status" id="exampleFormControlSelect1">
                  <option <?php if($row->hall_status == 'Booked') echo 'selected'; ?>>Booked</option>
                  <option <?php if($row->hall_status == 'Available') echo 'selected'; ?>>Available</option>
              </select>
            </div>

            <div class="card form-group" style="width: 30rem">
            <img src="../vendor/img/<?php echo $row->hall_pic;?>" class="card-img-top" >
            <div class="card-body">
                <h5 class="card-title">Hall Picture</h5>
                <input type="file" class="btn btn-success" id="exampleInputEmail1" name="h_dpic">
            </div>
            </div>
            <hr>
            <button type="submit" name="update_hall" class="btn btn-success">Update Hall</button>
          </form>
          <!-- End Form-->
          <?php }?>
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
