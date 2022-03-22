<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

    include("connection.php");
    include("functions.php");

 
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $useremail = mysqli_real_escape_string($con, $_POST['useremail']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $uppC = preg_match('@[A-Z]@', $password);
        $number = preg_match('@[0-9]@', $password);

        if($useremail == "" || $password == ""){
            $error = "Email and password required";
        }elseif (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        }elseif(!$uppC || !$number || strlen($password) < 6){
            $error = "Password should be at least 6 characters in length and should include at least one upper case letter and a number";
        }else{
        

            //read from database 
            // fix OR clause
            $checkForEmail = mysqli_query($con, "SELECT User_Id, Email_Address, User_Password FROM Users WHERE Email_Address = '".$useremail."'");
            //$checkForEmail = mysqli_query($con, "SELECT user_id, user_name, password, email FROM users WHERE user_name = '".$user_name."' OR email = '".$user_name."'");

            if($checkForEmail){

                if(mysqli_num_rows($checkForEmail) > 0 ){

                    //$userFound = mysqli_fetch_assoc($checkForEmail); 
                    while($row = mysqli_fetch_assoc($checkForEmail)) {
                        $dbpass = $row['User_Password'];
                        $u_id = $row['User_Id'];
                        $dbemaladd = $row['Email_Address'];
                      }
                    
                      
                        // // verify hash against user typed password
                        if(password_verify($password, $dbpass)){ 
                           
                            $_SESSION['Email_Address'] = $dbemaladd;
                             $_SESSION['User_Id'] = $u_id;
                            
                            header('Location:index2.php');
                            
                        }else{
                            $error = "Incorrect Username or Password";
                        }
                    
                }else{

                    $error = "No account found for user with email address : ". "" . '<p><u class="link-danger">'.$useremail.'</u></p>';
                    
                }
            }

           
        }
    }

?>

<!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <meta http-equiv="Cache-control" content="no-cache">
     <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    
     <link rel="stylesheet" href="Styles/style.css">

     <title>Farmers Bank Login Page</title>
 </head>

 <body>
     <!-- <div id="h1t">
         <h2 align="center" >Welcome to the Farmer's Bank Please login to continue</h2>
     </div> -->
     <?php
                if(isset($error)){
                    
                    echo '<div class="alert alert-danger" role="alert">
                    '.$error.'
                  </div>';
                }elseif(isset($success)){
                    echo '<div class="alert alert-success" role="alert">
                    '.$success.'
                  </div>';
                }
            ?>

     <div class="container">
         <div class="row px-3">
             <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
                 <div class="img-right d-none d-md-flex">
                     <img src="images/nate-johnston-MRh6Kb16afE-unsplash - Copy.jpg" alt="">
                 </div>

                 <div class="card-body">
                     <h4 class="title text-center mt-4">Welcome Back</h4>
                     <p class="text-center">Welcome Back! Please enter your details</p>
                     <form class="form-box px-3" method="post">
                         <div class="form-input">
                             <span><i class="fa fa-envelope-o"></i></span>
                             <label for="email">Email</label><br>
                             <input type="email" name="useremail" id="useremail" placeholder="Email" tabindex="10" required />
                         </div>
                         <div class="form-input">
                             <span><i class="fa fa-key"></i></span>
                             <label for="password">Password</label><br>
                             <input type="password" name="password" id="password" placeholder="Password" required />
                         </div>

                         <div class="mb-3">
                             <div class="custom-control custom-checkbox">
                                 <input type="checkbox" class="custom-control-input" id="cb1" name="" />
                                 <label class="custom-control-label" for="cb1">Remember me</label>
                             </div>
                         </div>

                         <div class="mb-3">
                             <button type="submit" class="btn btn-block text-uppercase">
                                 Login
                             </button>
                         </div>

                         <div class="text-right">
                             <a href="#" class="forget-link"> Forget Password? </a>
                         </div>

                         <hr class="my-4" />

                         <div class="text-center mb-2">
                             Don't have an account?
                             <a href="signup.php" class="register-link"> Register here </a>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>

 </body>

 </html>