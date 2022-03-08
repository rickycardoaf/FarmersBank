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
        $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {

            //read from database 
            // fix OR clause
            $checkForEmail = mysqli_query($con, "SELECT user_id, user_name, password, email FROM users WHERE user_name = '".$user_name."' OR email = '".$user_name."'");

            if($checkForEmail){

                if(mysqli_num_rows($checkForEmail) > 0 ){

                    //$userFound = mysqli_fetch_assoc($checkForEmail); 
                    while($row = mysqli_fetch_assoc($checkForEmail)) {
                        $dbpass = $row['password'];
                        $u_id = $row['user_id'];
                      }
                    // echo $dbpass;
                    // echo $u_id;
                    
                        // verify hash against user typed password
                        if(password_verify($password, $dbpass)){ 
                            $_SESSION['user_id'] = $u_id;
                            header("Location: index.php");
                        }
                    
                }else{

                    $error = "Incorrect Username or Password";
                    
                }
            }

            // $query = "select user_name, password, email from users where user_name = '$user_name' limit 1";
            // $result = mysqli_query($con, $query);

            // if($result)
            // {
            //     if($result && mysqli_num_rows($result) > 0)
            //     {
            //         $user_data = mysqli_fetch_assoc($result);
                    
            //         if($user_data['password'] == $password)
            //         {
            //             $_SESSION['user_id'] = $user_data['user_id'];
            //             header("Location: index.php");
            //             die;
            //         }
            //     }
            // }
           
            // echo "Wrong username or password";
        }else{

            $error = "Username or password should not be left empty";

        }
    }

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
    <script src="https://cdn.lordicon.com/lusqsztk.js"></script>

<style>
   #h1t{
    width:100%; 
    background-color: lightblue;
    height:40px;
   }
   h1{
    font-family: “Playfair Display”, “Didot”, "Times New Roman", Times, serif;

   }
</style>
</head>
<body>
    <div id="h1t">
        <!-- <h2 align="center" >Welcome to the Farmer's Bank Please login to continue</h2> -->
    </div >

<hr>
<?php
                if(isset($error)){
                    
                    echo '<div class="alert alert-danger" role="alert">
                    '.$error.'
                  </div>';
                }else{
                    echo "";
                }
            ?>
<div id="mainContainer">
    <div id="box">

        <form method="post">
        <h1 align="center">Login here please</h1>
            
            <!-- <label><img src="https://icon-library.com/images/user-icon-image/user-icon-image-20.jpg" width="20" height="20" /> Username </label>  -->
            <lord-icon
                src="https://cdn.lordicon.com/pdpnqfoe.json"
                trigger="loop"
                colors="primary:#f24c00,secondary:#66d7ee"
                style="width: 50px;height:50px">
            </lord-icon>
            <label for="">Username/Email</label>
            <input class="text" type="text" name="user_name" ><br><br>
            <!-- <label><img src="https://www.maxpixel.net/static/photo/1x/Lock-Image-Security-Lock-Cyber-Security-Lock-Icon-1915628.png" width="26" height="25" /> Password</label>  -->
            <lord-icon
                src="https://cdn.lordicon.com/xtrjgsiz.json"
                trigger="loop"
                style="width:50px;height:50px">
            </lord-icon>
            <label for="">Password</label>
            <input class="text" type="password" name="password" >
            <br><br>

            <input id="button" type="submit" value="Login" align="center">
            <br><br>

            <a href="signup.php" id="suplink">Click to Signup</a><br><br>
        </form>
    </div>
    <div id="imgDiv">
    <img id="logoImg" src="images/fmimg.png"/>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
