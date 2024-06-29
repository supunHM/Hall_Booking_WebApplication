<!--Server Side Scripting To inject Login-->
<?php
  //session_start();

   error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include('vendor/inc/config.php');
  //include('vendor/inc/checklogin.php');
  //check_login();
  //$aid=$_SESSION['a_id'];
  //Add USer
  if(isset($_POST['add_user']))
    {

            $u_f_name=$_POST['u_f_name'];
            $u_l_name = $_POST['u_l_name'];
            $u_phone_number=$_POST['u_phone_number'];
            $u_address=$_POST['u_address'];
            $u_email=$_POST['u_email'];
            $u_password=$_POST['u_password'];
            $u_category=$_POST['u_category'];
            $query="insert into FCT_Users (u_f_name, u_l_name, u_phone_number, u_address, u_category, u_email, u_password) values(?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('sssssss', $u_f_name,  $u_l_name, $u_phone_number, $u_address, $u_category, $u_email, $u_password);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "Account Created Proceed To Log In";
                }
                else 
                {
                    $err = "Please Try Again Later";
                }
            }
?>
<!--End Server Side Scriptiong-->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Tranport Management System, Saccos, Matwana Culture">
  <meta name="author" content="MartDevelopers ">

  <title>User Registration System - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="vendor/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
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
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Create An Account With Us</div>
      <div class="card-body">
        <!--Start Form-->
        <form method = "post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                <input type="text" required class="form-control" id="exampleInputEmail1" name="u_f_name">
                  <label for="firstName">First name</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                <input type="text" class="form-control" id="exampleInputEmail1" name="u_l_name">
                  <label for="lastName">Last name</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                <input type="text" class="form-control" id="exampleInputEmail1" name="u_phone_number">
                  <label for="lastName">Contact</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
            <input type="text" class="form-control" id="exampleInputEmail1" name="u_address">
              <label for="inputEmail">Address</label>
            </div>
          </div>
          <div class="form-group" style ="display:none">
            <div class="form-label-group">
            <input type="text" class="form-control" id="exampleInputEmail1" value="Student" name="u_category">
              <label for="inputEmail">User Category</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
            <input type="email" class="form-control" name="u_email"">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                <input type="password" class="form-control" name="u_password" id="exampleInputPassword1">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" name="add_user" class="btn btn-success">Create Account</button>
        </form>
        <!--End FOrm-->
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Login Page</a>
          <a class="d-block small" href="usr-forgot-pwd.php">Forgot Password?</a>
        </div>
        
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!--INject Sweet alert js-->
 <script src="vendor/js/swal.js"></script>

</body>

</html>
