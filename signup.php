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
        $name = mysqli_real_escape_string($con, $_POST['reg_name']);
        $email = mysqli_real_escape_string($con, $_POST['reg_email']);
        $user_name = mysqli_real_escape_string($con,$_POST['reg_user_name']);
        $password = mysqli_real_escape_string($con,$_POST['reg_password']);
        //echo $name ." ". $email . " ".$user_name." " .$password;

        // $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '".$_POST['email']."'");
        // if(mysqli_num_rows($select)) {
        //     exit('This email address is already used!');
        // }
        $uppC = preg_match('@[A-Z]@', $password);
        $number = preg_match('@[0-9]@', $password);

        // validate fielf on the signup page
        if($name == ""){
            $error = "Your name is required";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        }elseif($user_name == ""){
            $error = "A username is required";
        }elseif(!$uppC || !$number || strlen($password) < 6){
            $error = "Password should be at least 6 characters in length and should include at least one upper case letter and a number";
        }elseif($password == ""){
            $error = "Password is required";
        }else{
            
            
            $checkForEmail = mysqli_query($con, "SELECT email, user_name FROM users WHERE user_name ='".$user_name."' OR email = '".$email."'");
        
            if(mysqli_num_rows($checkForEmail)){

                while($row = mysqli_fetch_assoc($checkForEmail)){

                    $dbuname = $row['user_name'];
                    $dbemail = $row['email'];

                  }

                //   check if username and email exist
                  if($dbemail == $email){
                    $error = "Email address already exist.";
                  }

                  if($dbuname == $user_name){
                    $error = "Username address already exist.";
                  }

                
            
            }else{

                if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
                {
                    //save to database 
                    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                    $user_id = random_num(20);
                    $query = "INSERT INTO users (user_id,user_name,password, email, name) values ('$user_id','$user_name','$password_hashed', '$email', '$name')";

                    mysqli_query($con, $query);
                    mysqli_close($con);
                    $success = "Account created";

                    $name = "";
                    $email = ""; 
                    $user_name = "";

                }else
                {
                    $error =  "Please enter some valid information!"; 
                }
            }
        }
    }

?> 


<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

<?php
                if(isset($error)){
                    
                    echo '<div class="alert alert-danger" role="alert">
                    '.$error.'
                  </div>';
                }elseif(isset($success)){
                    echo '<div class="alert alert-success" role="alert">
                    '.$success.'
                    <a href="login.php">Back to the login page</a>
                  </div>';
                }else{
                    echo "";
                }
            ?>
<div id="mainContainer">
    <div id="box">
        
        <form method="post">
        <h1 align="center">Register</h1>
            
             <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/ajkxzzfb.json"
                trigger="loop"
                style="width:50px;height:50px">
            </lord-icon><label> Name </label> 
            <input class="text" type="text" name="reg_name" id="reg_name" value="<?php echo isset($name) ? $name : ''; ?>">
            <br><br>
            <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/pdpnqfoe.json"
                trigger="loop"
                colors="primary:#f24c00,secondary:#66d7ee"
                style="width: 50px;height:50px">
            </lord-icon><label>Email</label> 
           <label> Name </label> <input class="text" type="emial" name="reg_email" id="reg_email" value="<?php echo isset($email) ? $email : ''; ?>">
            <br><br>
            <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/ajkxzzfb.json"
                trigger="loop"
                style="width:50px;height:50px">
            </lord-icon> <label> Username </label> 
            <input class="text" type="text" name="reg_user_name" id="reg_user_name" value="<?php echo isset($user_name) ? $user_name : ''; ?>">
            <br><br>
            <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/xtrjgsiz.json"
                trigger="loop"
                style="width:50px;height:50px">
            </lord-icon><label>Password</label> 
            <input class="text" type="password" name="reg_password" id="reg_password">
            <br><br>
            
            <input id="button" type="submit" value="Submit" align="center">
            
            
            <br><br>

            <a href="login.php" id="suplink">Login</a><br><br>
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