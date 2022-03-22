<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();

session_start();
include("connection.php");
include("functions.php");

$userLgId = "";
$userEM = "";
    
    if(isset($_SESSION['User_id']) && isset($_SESSION['Email_Address'])){
 
        $userEM = $_SESSION['Email_Address'];
        $userLgId = $_SESSION['User_Id'];
    }

    
//   $user_data = check_login($con);

//   $uid = 50554027;
//   $user_data['user_name'] = "test@email.com";

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: logout.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Styles/index.css">
   
    <title><?php
    
    if(isset($_SESSION['Email_Address'])){
       
       echo $_SESSION['Email_Address'];
    }
    
    ?></title>

</head>

<body>
<?php
                if(isset($error)){
                    
                    echo '<div class="alert alert-danger" role="alert">
                    '.$error.'
                  </div>';
                }elseif(isset($success)){
                    echo '<div class="alert alert-success" role="alert">
                    '. $success.'
                  </div>';
                   
                }else{
                    echo "";
                }
            ?>
    <div class="d-flex align-items-start">


        <nav class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24"
                        class="d-inline-block align-text-top">
                    Farmers Bank
                </a>
            </div>
            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Transactions</button>
            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
                type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Transfers</button>
            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"
                type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Accounts</button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"
                type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                <input type="button" aria-selected="false" class="btn btn-primary" value="Log me out" onclick=" relocate_home()">

            <script>
            function relocate_home()
            {
                location.href = "logout.php";
            } 
            </script>
        </nav>
        <main class="container">
            <section class="tab-content" id="v-pills-tabContent">
                <section class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">
                    <nav class="navbar navbar-light">
                        <div class="container-fluid">
                            <a class="navbar-brand">
                                <h3>Transactions</h3>
                            </a>
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Search transactions"
                                    aria-label="Search">
                                <button class="btn" type="submit">Search</button>
                            </form>
                        </div>
                    </nav>

                    <section class="row">
                        <div class="col-sm-6">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Total Balance</div>
                                <div class="card-body">
                                    <h5 class="card-title">Total Balance:</h5>
                                    <p class="card-text">
                                    <?php
                                    $accBalanceCheck = mysqli_query($con, "SELECT accountBalance FROM accountSum WHERE user_id = '".$_SESSION['User_Id']."'");

                                    if($accBalanceCheck){
                                
                                        if(mysqli_num_rows($accBalanceCheck) > 0 ){
                                            $error = "money";
                                            //$userFound = mysqli_fetch_assoc($checkForEmail); 
                                            while($row = mysqli_fetch_assoc($accBalanceCheck)) {
                                                    $formatter = new NumberFormatter('JMD',  NumberFormatter::CURRENCY);
                                                    $accBal = $row['accountBalance'];
                                                    echo $formatter->formatCurrency($accBal, 'JMD'), PHP_EOL;
                                                }
                                        }
                                    }

                                    //mysqli_close($con);
                                    ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Header</div>
                                <div class="card-body">
                                    <h5 class="card-title">Total Balance:</h5>
                                    <p class="card-text">$10,000.00</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <nav class="navbar navbar-light">
                        <div class="container-fluid">
                            <a class="navbar-brand">
                                <h5 class="sub-heading">Transactions List</h5>
                            </a>
                            <!-- <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Search transactions"
                                    aria-label="Search">
                                <button class="btn" type="submit">Search</button>
                            </form> -->

                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Credit / Debit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                                    
                                        $checkForAccount = mysqli_query($con, "SELECT transaction_date, transaction_amount,transaction_type, transaction_processtype  FROM transactions WHERE user_id = '".$_SESSION['User_Id']."'");

                                        if($checkForAccount){
                                    
                                            if(mysqli_num_rows($checkForAccount) > 0 ){
                                    
                                                //$userFound = mysqli_fetch_assoc($checkForEmail); 
                                                while($row = mysqli_fetch_assoc($checkForAccount)) {

                                                    $tranDate = $row['transaction_date'];
                                                    $tranAmount = $row['transaction_amount'];
                                                    $tranType = $row['transaction_type'];
                                                    $tranProcesty = $row['transaction_processtype'];

                                                    echo'
                                                        <tr>
                                                            <th scope="row">'.$tranDate.'</th>
                                                            <td>'.$tranAmount.'</td>
                                                            <td>'.$tranType.'</td>
                                                            <td>'.$tranProcesty.'</td>
                                                        </tr>
                                                        ';
                                                    }
                                            }else{
                                                echo'
                                                        <tr>
                                                            <th scope="row"><p class="text-info">No Records Found</p></th>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        ';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </nav>
                </section>

                <section class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                    aria-labelledby="v-pills-profile-tab">

                    <section class="tab-content" id="v-pills-tabContent">
                        <section class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <nav class="navbar navbar-light">
                                <div class="container-fluid">
                                    <a class="navbar-brand">
                                        <h3>Transfers</h3>
                                    </a>
                                </div>
                            </nav>


                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Account to Account</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">External Transfer</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Recurring Transfer</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Manage
                                        Beneficiaries</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">...</div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">...</div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">...</div>
                            </div>
                        </section>
                        <section class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">
                            ...
                        </section>
                        <section class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                            aria-labelledby="v-pills-settings-tab">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde architecto ex, natus atque
                                maxime
                                numquam est perspiciatis cumque cum reiciendis eum exercitationem aliquam eveniet
                                tempore. Sequi
                                ea est sunt eum!</p>
                        </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    </main>
</body>

</html>