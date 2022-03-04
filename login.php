 <?php

session_start();

    include("connection.php");
    include("functions.php");

 
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {

            //read from database 
            $query = "select * from users where user_name = '$user_name' limit 1";
            $result = mysqli_query($con, $query);

            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {

                    $user_data = mysqli_fetch_assoc($result);
                    
                    if($user_data['password'] == $password)
                    {
                        
                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: index.php");
                        die;
                    }
                }
            }
           
            echo "Wrong username or password";
        }else
        {
            echo "Wrong username or password!"; 
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<style type="text/css">

    #text{

        height: 25px;
        border-radius: 5px;
        padding: 4px;
        border: solid thin #aaa;
        width: 100%;
    }

    #button{

        padding: 10px;
        width: 100px;
        color: black;
        background-color: lightblue;
        border: none;
    } 

    

    #box{

        background-color: lightgrey;
        margin: auto;
        width: 300px;
        padding: 20px;
        border:  14px ridge #0c107a;
    }

</style>
<center>
<img src="https://play-lh.googleusercontent.com/vO2ZhuemEOzb7aKeJ2UWGKQdDp48VbXwLtmXQibhPvv92-NcRtCqdKjPtW0TPxV3JQ" width="450" height="200" />
</center>
<div id="box">

    <form method="post">
       <center> <div style="font-size: 20px;margin: 10px;color: black;">Login</div></center>
        
        <label><img src="https://icon-library.com/images/user-icon-image/user-icon-image-20.jpg" width="20" height="20" /> Username </label> 
        <input id="text" type="text" name="user_name" required><br><br>
        <label><img src="https://www.maxpixel.net/static/photo/1x/Lock-Image-Security-Lock-Cyber-Security-Lock-Icon-1915628.png" width="26" height="25" /> Password</label> 
        <input id="text" type="password" name="password" required><br><br>

        <center><input id="button" type="submit" value="Login"><br><br></center>

        <a href="signup.php">Click to Signup</a><br><br>
    </form>

</div>

</body>
</html>
