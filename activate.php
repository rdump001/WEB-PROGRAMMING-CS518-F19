<?php
//The user is re-directed to this file after clicking the activation link
//Signup link contains two GET parameters: email and activation key
session_start();
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Account Activation</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            h1{
                color:red;
            }
            .contactForm{
                border:1px solid #7c73f6;
                margin-top: 50px;
                border-radius: 15px;
            }
        </style>

    </head>
        <body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10 contactForm">
            <h1>Account Activation</h1>
<?php
//If email or activation key is missing show an error
if(!isset($_GET['email']) || !isset($_GET['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the activation link you received by email.</div>'; exit;
}
//else
    //Store them in two variables
$email = $_GET['email'];
$key = $_GET['key'];
    //Prepare variables for the query
$email = mysqli_real_escape_string($conn, $email);
$key = mysqli_real_escape_string($conn, $key);
    //Run query: set activation field to "activated" for the provided email
$sql = "UPDATE user SET activation='activated' WHERE (emailId='$email' AND activation='$key') LIMIT 1";
$result = mysqli_query($conn, $sql);
    //If query is successful, show success message and invite user to login
if(mysqli_affected_rows($conn) == 1){
    #echo '<div class="alert alert-success">Your account has been activated.</div>';
    #echo '<a href="index.php" type="button" class="btn-lg btn-sucess">Log in<a/>';
    echo "<script>alert (\"Your account has been activated\")</script>";

                header("refresh:1; url=./../index.php");

}else{
    //Show error message
    #echo '<div class="alert alert-danger">Your account could not be activated. Please try again later.</div>';
    #echo '<div class="alert alert-danger">' . mysqli_error($conn) . '</div>';
    echo "<script>alert (\"Your account could not be activated. Please try again later.\")</script>";

                header("refresh:1; url=./../index.php");

}
?>
        </div>
    </div>
</div>
        </body>
</html>