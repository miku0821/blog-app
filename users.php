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
  <title>Users</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/1eaebda83d.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
          <nav class="navbar navbar-expand-md bg-dark">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                      <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="post.php">Posts</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="categories.php">Categories</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="users.php">Users</a>
                  </li>
              </ul>
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a class="nav-link text-white" href="profile.php">Hello, <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name'];?></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="logout.php"><i class="fas fa-user-times"></i></a>
                  </li>
              </ul>
        </nav>
      </header>
  <div class="container-fluid bg-warning pt-4">
    <h1 class="display-2 text-white"><i class="fas fa-users fa-1x"></i>Users</h1>
  </div>
  <div class="container w-50 mt-5">
    <h2 class="display-4 text-center">Add User</h2>

        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                  <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group col-md-4">
                  <input type="text" name="contact_number" id="contact_number" placeholder="Contact Number" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <input type="text"  name="address" id="adress" placeholder="Address" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" name="username" id="username" placeholder="Username" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="submit" value="Add" name="register" class="btn btn-warning text-white form-control">
                </div>
            </div>
        </form> 
  
      <?php
        $user_rows = displayAllUsers();

        if(isset($_POST['register'])){
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $email = $_POST['email'];
          $address = $_POST['address'];
          $contact_number = $_POST['contact_number'];
          $username = $_POST['username'];
          $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

          $check_result = checkUser($username);


          if($check_user_result == false){
            register($first_name, $last_name, $email, $address, $contact_number, $username, $password);
          }else{
            echo "Username taken";

          }
        }
      ?>

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th class="text-center">USER ID</th>
            <th class="text-center">FULL NAME</th>
            <th class="text-center">EMAIL</th>
            <th class="text-center">CONTACT NUMBER</th>
            <th class="text-center">ADDRESS</th>
            <th class="text-center">USERNAME</th>
          </tr>
        </thead>
        <tbody>
      
      <?php

        if(empty($user_rows)){
        ?>
        
        <tr>
          <td colspan='5' class="text-center"><strong>NO USERS FOUND</strong></td>
        </tr>
        
          <?php      
            }else{
          
            foreach($user_rows as $row){
          ?>
            <tr>
              <td class="text-center"><?php echo $row['user_id']; ?></td>
              <td class="text-center"><?php echo $row['first_name']; ?></td>
              <td class="text-center"><?php echo $row['email']; ?></td>
              <td class="text-center"><?php echo $row['contact_number']; ?></td>
              <td class="text-center"><?php echo $row['address']; ?></td>
              <td class="text-center"><?php echo $row['username']; ?></td>
            </tr>
            
          <?php
            }
          }
            $user_id = $_SESSION['user_id'];
        
          ?>
          </tbody>
        </table>
  </div>
</body>
</html>