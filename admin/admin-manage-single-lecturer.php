<?php
  session_start();

  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);

  include('vendor/inc/config.php');
  include('vendor/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['admin_id'];
  //Add USer
  if(isset($_POST['update_lecturer']))
    {
            $l_id= $_GET['u_id'];
            $l_fname=$_POST['l_fname'];
            $l_lname = $_POST['l_lname'];
            $l_phone=$_POST['l_phone'];
            $l_addr=$_POST['l_addr'];
            $l_email=$_POST['l_email'];
            $l_pwd=$_POST['l_pwd'];
            $l_category=$_POST['l_category'];
            $query="update FCT_Users set u_f_name=?, u_l_name=?, u_phone_number=?, u_address=?, u_category=?, u_email=?, u_password=? where u_id=?";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('sssssssi', $l_fname,  $l_lname, $l_phone, $l_addr, $l_category, $l_email, $l_pwd, $l_id);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "Lecturer Updated";
                }
                else 
                {
                    $err = "Please Try Again Later";
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
            <a href="#">Lecturers</a>
          </li>
          <li class="breadcrumb-item active">Add Lecturers</li>
        </ol>
        <hr>
        <div class="card">
        <div class="card-header">
          Add Lecturers
        </div>
        <div class="card-body">
          <!--Add User Form-->
          <?php
            $aid=$_GET['u_id'];
            $ret="select * from FCT_Users where u_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$aid);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
        {
        ?>
          <form method ="POST"> 
            <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="text" value="<?php echo $row->u_f_name;?>" required class="form-control" id="exampleInputEmail1" name="l_fname">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="text" class="form-control" value="<?php echo $row->u_l_name;?>" id="exampleInputEmail1" name="l_lname">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Contact</label>
                <input type="text" class="form-control" value="<?php echo $row->u_phone_number;?>" id="exampleInputEmail1" name="l_phone">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" class="form-control" value="<?php echo $row->u_address;?>" id="exampleInputEmail1" name="l_addr">
            </div>

            <div class="form-group" style="display:none">
                <label for="exampleInputEmail1">Category</label>
                <input type="text" class="form-control" id="exampleInputEmail1" value="lecturer" name="l_category">
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" value="<?php echo $row->u_email;?>" class="form-control" name="l_email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" value="<?php echo $row->u_password;?>" name="l_pwd" id="exampleInputPassword1">
            </div>

            <button type="submit" name="update_lecturer" class="btn btn-success">Update Lecturer</button>
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

