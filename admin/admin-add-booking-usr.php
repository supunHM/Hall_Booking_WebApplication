<?php
  session_start();
  include('vendor/inc/config.php');
  include('vendor/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['admin_id'];
  //Add Booking
  if(isset($_POST['book_hall']))
    {
            $u_id = $_GET['u_id'];
            //$u_fname=$_POST['u_fname'];
            //$u_lname = $_POST['u_lname'];
            //$u_phone=$_POST['u_phone'];
            //$u_addr=$_POST['u_addr'];
            $hall_type = $_POST['hall_type'];
            $hall_number  = $_POST['hall_number'];
            $book_date = $_POST['book_date'];
            $book_status  = $_POST['book_status'];
            $query="update FCT_Users set hall_type=?, book_date=?, hall_number=?, book_status=? where u_id=?";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('ssssi', $hall_type, $book_date, $hall_number, $book_status, $u_id);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "User Booking Added";
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
            <a href="#">Bookings</a>
          </li>
          <li class="breadcrumb-item active">Add</li>
        </ol>
        <hr>
        <div class="card">
        <div class="card-header">
          Add Booking
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
                <input type="text" value="<?php echo $row->u_f_name;?>" required class="form-control" id="exampleInputEmail1" name="u_fname">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="text" class="form-control" value="<?php echo $row->u_l_name;?>" id="exampleInputEmail1" name="u_lname">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Contact</label>
                <input type="text" class="form-control" value="<?php echo $row->u_phone_number;?>" id="exampleInputEmail1" name="u_phone">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" class="form-control" value="<?php echo $row->u_address;?>" id="exampleInputEmail1" name="u_addr">
            </div>

            <div class="form-group" style="display:none">
                <label for="exampleInputEmail1">Category</label>
                <input type="text" class="form-control" id="exampleInputEmail1" value="User" name="u_category">
            </div>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" value="<?php echo $row->u_email;?>" class="form-control" name="u_email"">
            </div>

            

            <div class="form-group">
              <label for="exampleFormControlSelect1">Hall Category</label>
              <select class="form-control" name="hall_type" id="exampleFormControlSelect1">
                <option value="Lecture Hall" <?php if($row->hall_type == 'Lecture Hall') echo 'selected'; ?>>Lecture Hall</option>
                <option value="Computer Lab" <?php if($row->hall_type == 'Computer Lab') echo 'selected'; ?>>Computer Lab</option>
                <option value="Physics Lab" <?php if($row->hall_type == 'Physics Lab') echo 'selected'; ?>>Physics Lab</option>
                <option value="Chemistry Lab" <?php if($row->hall_type == 'Chemistry Lab') echo 'selected'; ?>>Chemistry Lab</option>
              </select>
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect1">Hall Number</label>
              <select class="form-control" name="hall_number" id="exampleFormControlSelect1">
                <?php

                $ret="SELECT * FROM FCT_halls  "; //sql code to get to all vehicles
                $stmt= $mysqli->prepare($ret) ;
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                $cnt=1;
                while($row=$res->fetch_object())
                {
                ?>
                <option><?php echo $row->hall_number;?></option>
                <?php }?> 
              </select>
            </div>

            

            <div class="form-group">
                <label for="exampleInputEmail1">Booking Date</label>
                <input type="date" class="form-control" id="exampleInputEmail1"  name="book_date">
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect1">Booking Status</label>
              <select class="form-control" name="book_status" id="exampleFormControlSelect1">
                  <option value="Approved" <?php if ($row->book_status == 'Approved') echo 'selected'; ?>>Approved</option>
                  <option value="Pending" <?php if ($row->book_status == 'Pending') echo 'selected'; ?>>Pending</option>
              </select>
            </div>

            <button type="submit" name="book_hall" class="btn btn-success">Confirm Booking</button>
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
