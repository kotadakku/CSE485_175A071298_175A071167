<?php

function Insert($email,$password,$user_level,$dbcon)
{
  $q = "INSERT INTO user
                  VALUES ('$email','$password',NOW(),'$user_level')";      
                  $result = @mysqli_query ($dbcon, $q); // Run the query.
                  if ($result) { // If it runs
                     echo header("Location: index.php");
                     exit();      
                   } else { // If it did not run
        // Message:
                      echo 'System Error! You could not be registered due to a system error. We apologize for any inconvenience.'; 
                    } // End of if ($result)
                     mysqli_close($dbcon); // Close the database connection.
                     exit();
}



try {
// This script retrieves all the records from the users table.
require('mysql_connect.php'); 

if(isset($_POST['register'])){

$email=$_POST['email'];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
if(!empty($_POST["email"]) &&! empty($_POST["password"]) && !empty($_POST["password"]) && $password!=$_POST['repassword'])
{


    $p="SELECT * FROM user WHERE email='$email'";
    $result=@mysqli_query($dbcon,$p);
    $num_row=@mysqli_num_rows($result);
        if($num_row==0)
        {
           $p="SELECT * FROM student WHERE email='$email'";
            $result1=@mysqli_query($dbcon,$p);
            $num_row1=@mysqli_num_rows($result1);
            if($num_row1==0)
            {
                 $p2="SELECT * FROM teacher WHERE email='$email'";
                  $result2=@mysqli_query($dbcon,$p2);
                  $num_row2=@mysqli_num_rows($result2);
                  if($num_row2!=0){
                  $user_level=1;
                  
                  Insert($email,$password,$user_level,$dbcon);
            }
          }
        else {
            $user_level=2;
            Insert($email,$password,$user_level,$dbcon);
            }
        }
}
}
else {
  echo 'string';
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
    <title>Au Register Forms by Colorlib</title>
</head>

<body>
 <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins" id="form_sign_up">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Sign Up</h2>
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-12">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" id="email"   placeholder="email">
                                    <i id="notice_email"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-12">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" id="password" type="password" name="password" placeholder="password" value="<?php if (isset($_POST['email'])) echo $_POST['password']; ?>">
                                    <i id="notice_password"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-12">
                                <div class="input-group">
                                    <label class="label">Repassword</label>
                                    <input class="input--style-4" id="repassword" type="password" name="repassword" value="<?php if (isset($_POST['email'])) echo $_POST['repassword']; ?>">
                                    <i id="notice_repassword"></i>
                                </div>
                            </div>
                        </div>
                        
                          
                        </div>
                        <div class="p-t-15 ">
                            <button class="btn btn--radius-2 btn--blue" type="submit" id="bt_signup" name="register">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
<link rel="stylesheet" type="text/css" href="css/mycss.css">
<script src="Js/jquery-3.4.1.min.js"></script>
<script src="Js/sign_up.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">
<script src="Js/bootstrap.js"></script>

</body>

</html>
