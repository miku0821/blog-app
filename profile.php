<?php
    include "databaseFunctions.php";
    session_start();
    $user_id = $_SESSION['user_id'];

    if(empty($_SESSION)){
        session_unset();
        session_destroy();
        header("Location: login.php");
        die;
    }

    $user_details = getUserDetails($user_id);
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/1eaebda83d.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
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

        <div class="container-fluid bg-primary p-4">
            <i class="fas fa-user-alt fa-4x text-white"></i>
            <p class="display-2 d-inline text-white">Profile</p>
        </div>
        <div class="container w-50 mt-5">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" name="new_first_name" id="first_name" value="<?php echo $user_details['first_name'];?>" placeholder="First Name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="new_last_name" id="last_name" value="<?php echo $user_details['last_name'];?>" placeholder="Last Name" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="address">Address</label>
                            <input type="text"  name="new_address" id="adress" value="<?php echo $user_details['address'];?>" placeholder="Address" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" name="new_contact_number" id="contact_number" value="<?php echo $user_details['contact_number'];?>" placeholder="Contact Number" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="new_email" id="email" value="<?php echo $user_details['email'];?>" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="username">Username</label>
                            <input type="text" name="new_username" id="username" value="<?php echo $user_details['username'];?>" placeholder="Username" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="password">Password</label>
                            <input type="password" name="new_password" id="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="confirm_pword">Confirm password</label>
                        <input type="password" id="confirm_pword" name="confirm_pword" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="from-group col-md-12">
                        <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#confirmPassword">UPDATE</button>
                        </div>
                    </div>
                </div>
                    
                <!-- MODAL CONTAINER -->
                <div class="container">
                    <!-- Modal -->
                    <div class="modal fade" id="confirmPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title text-center" id="exampleModalLongTitle">CONFIRM YOUR OLD PASSWORD</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <!-- MODAL FORM -->
                                    <div class="form-row">
                                        <div class="form-group col-md-12 mb-0">
                                            <input type="password" name="confirm_old_password" id="" class="form-control form-control-lg text-center" placeholder="PASSWORD">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-row text-right">
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary mr-2">Submit</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div> 
                                  </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
        <?php
            if(isset($_POST['update'])){
                $first_name = $_POST['new_first_name'];
                $last_name = $_POST['new_last_name'];
                $address = $_POST['new_address'];
                $contact_number = $_POST['new_contact_number'];
                $email = $_POST['new_email'];
                $username = $_POST['new_username'];
                $user_id = $user_details['user_id'];
                $confirm_pward = password_hash($_POST['confirm_pword'], PASSWORD_DEFAULT);

                if(empty($_POST['new_password'])){
                    $password = user_details['password'];
                }else{
                    $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                }
            }
                    ?>
                    
                    
                    <?php

        ?>
 
</body>
</html>