
 <?php 

try {
// This script retrieves all the records from the users table.
require('mysql_connect.php'); 

if(isset($_POST['login'])){

$email=$_POST['email'];
$ps=$_POST['password'];

      $q = "SELECT * FROM user WHERE email='$email'";
      $result=@mysqli_query($dbcon,$q);
      $num_row=@mysqli_num_rows($result);
      $row=@mysqli_fetch_array($result,MYSQLI_ASSOC);

      if($num_row==1)
      {
        
        $pshash= $row['password'];
        
        if(password_verify($ps,$pshash))
            {
              
              session_start();
              $_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);
              $_SESSION['user_level'] = (int) $row['user_level']; 
              echo $_SESSION['user_level'];
              // Ensure that the user level is an integer
              if($_SESSION['user_level'] === 1)
               {
                  echo header('Location: index.php');             
              }
               else {
               echo header('Location: sign_up.php');               
              }                
               }         
           else {
             echo 'Mật khẩu hoặc id sai!';
           }        

      }
      else{
        echo 'Mật khẩu';
      }
  }
}
catch(Exception $id) // We finally handle any problems here                
   {
     // print "An Exception occurred. Message: " . $e->getMessage();
     print "The system is busy please try later";
   }
   catch(Error $id)
   {
      //print "An Error occurred. Message: " . $e->getMessage();
      print "The system is busy please try again later.";
   }
  ?>



  

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <title>Login</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" method="POST">
              <div class="form-label-group">
                <label for="inputEmail">Email</label>
                <input class="input--style-4" type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" id="email"   placeholder="email">
                <p id="notice_email"></p>               
              </div>

              <div class="form-label-group">
                <label for="inputPassword">Password</label>
                <input class="input--style-4" id="password" type="password" name="password" placeholder="password" value="<?php if (isset($_POST['email'])) echo $_POST['password']; ?>">
                <p id="notice_password"></p>              
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div>
              <input type="submit" class="btn btn-success btn-block" name="login" value="Masuk" />
              <input type="submit" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" id="bt_sign_in" name="reg" value="Login">
              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<link rel="stylesheet" type="text/css" href="css/mycss.css"> 
<script src="Js/jquery-3.4.1.min.js"></script>
<script src="Js/login.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="Js/bootstrap.js"></script>
</body>
</html> 
