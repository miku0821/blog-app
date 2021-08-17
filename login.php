<?php
  include "databaseFunctions.php";
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/1eaebda83d.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container w-50 mt-5">
    <h1 class="text-center">Login</h1>
    <form action="" method="post">
      <div class="form-row col-md-12 mt-5">
        <div class="from-group mx-auto col-md-7">
          <input type="text" name="username" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder="USERNAME" required>
        </div>
      </div>
      <div class="form-row col-md-12 mt-3">
        <div class="form-group col-md-7 mx-auto">
          <input type="password" name="password" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder="PASSWORD" required>
        </div>
      </div>
      <div class="form-row col-md-12">
        <div class="form-group mx-auto col-md-7">
          <input type="submit" name="login" value="Enter" class="btn btn-dark form-control">
        </div>
      </div>
    </form>
    <div class="row col-md-12 mt-4">
      <div class="group col-md-6 text-center">
        <a href="register.php" class="text-dark">Create an Account</a>
      </div>
      <div class="group col-md-6 text-center">
        <a href="" class="text-dark">Recover Account</a>
      </div>
    </div>
  </div>

    <?php
      if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
       
        $login_result = login($username, $password);

 

        if($login_result == "Invalid Username"){
    ?>
        <div class="alert alert-danger text-center" role="alert">
        <strong>INVALID USERNAME</strong>
        </div>

    <?php
        }elseif($login_result == "Invalid Password"){
    ?>
          <div class="alert alert-danger text-center" role="alert">
          <strong>INVALID PASSWORD</strong>
          </div>
    <?php
        }
      }
    ?>
  </div>
</body>
</html>