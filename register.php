<?php
    include "databaseFunctions.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container mt-5 w-50">
        <h1 class="my-5 text-center">Registration</h1>
        <form action="" method="post">
            <div class="form-row col-md-12 text-white">
                <div class="form-group col-md-6 text-white">
                    <input type="text" name="first_name" id="fname" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder="First Name">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="last_name" id="l_name" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder="Last Name">
                </div>
            </div>
            <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                    <input type="email" name="email" id="email" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder="Email">
                </div>
            </div>
            <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                    <input type="text" name="address" id="address" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder="Address">
                </div>
            </div>
            <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                    <input type="text" name="contact_number" id="con_num" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder=" Contact Number">
                </div>
            </div>
            <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                    <input type="text" name="username" id="username" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder="username">
                </div>
            </div>
            <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                    <input type="password" name="password" id="password" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder="password">
                </div>
            </div>
            <div class="form-row col-md-12">
                <div class="form-group col-md-6">
                    <input type="submit" name="register" value="Register" class="btn btn-dark form-control">
                </div>
                <div class="form-group col-md-6 text-center mt-3">
                    <a href="login.php" class="text-dark">Have an account?  <span class="text-primary">Sign in</span></a>
                </div>
            </div>
        </form>


        <?php
        if(isset($_POST['register'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $contact_number = $_POST['contact_number'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $check_user_result = checkUser($username);

            if($check_user_result == false){
                register($first_name, $last_name, $email, $address, $contact_number, $username, $password);
            }else{
                echo "Username taken";
        ?>

        <?php
            }
        }
        ?>
    </div>
</body>
</html>