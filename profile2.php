<?php
    include "databaseFunctions.php";
    session_start();
    $user_id = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/319afa374e.js"></script>
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

    <div class="container-fluid bg-secondary text-white">
        <h2 class="display-1"><i class="fas fa-user"></i> Profile</h2>
    </div>

    <div class="container ml-5 mt-5">
        <?php 
            $user_details = getUserDetails($user_id);
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <form action="" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="new_first_name">First Name</label>
                                <input type="text" name="new_first_name" id="new_first_name" value="<?php echo $user_details['first_name'];?>" class="form-control" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="new_last_name">Last Name</label>
                                <input type="text" name="new_last_name" id="new_last_name" value="<?php echo $user_details['last_name'];?>" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="new_address">New Address</label>
                                <input type="text" name="new_address" id="new_address" value="<?php echo $user_details['address'];?>" class="form-control" placeholder="Address">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="new_contact_number">Contact Number</label>
                                <input type="text" name="new_contact_number" id="new_contact_number" value="<?php echo $user_details['contact_number'];?>" class="form-control" placeholder="Contact Number">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="new_email">Email</label>
                                <input type="text" name="new_email" id="new_email" value="<?php echo $user_details['email'];?>" class="form-control" placeholder="New Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="new_username">Userame</label>
                                <input type="text" name="new_username" id="new_username" value="<?php echo $user_details['username'];?>" class="form-control" placeholder="New Username">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control" placeholder="Confirm Password">
                            </div>
                        </div>
                        <input type="hidden" name="old_password" value="<?php echo $user_details['password'];?>">

                        <!-- button-trigger-modal -->
                        <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#confirmPassword">UPDATE</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- modal container -->
        <div class="container">
            <!-- modal -->
            <div class="modal fade" id="confirmPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" area-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-titrle text-center" id="exampleModalLongTiele">CONFIRM YOUR OLD PASSWORD</h3>
                            <button tyoe="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- modal form -->
                            <div class="form-row">
                                <div class="form-group col-md-12 mb-0">
                                    <input type="password" name="confirm_old_password" id="" class="form-control form-control-lg text-center" plasceholder="PASSWORD">
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
        if(isset($_POST['submit'])){
            $password_check = checkOldPassword($user_id);

            if($password_check == 1){
                $first_name = $_POST['new_first_name'];
                $last_name = $_POST['new_last_name'];
                $address = $_POST['new_address'];
                $contact_number = $_POST['new_contact_number'];
                $email = $_POST['new_email'];
                $username = $_POST['new_username'];
                
                if(empty($_POST['new_password'])){
                    $password = $_POST['old_password'];
                }elseif(!empty($_POST['new_password']) && $_POST['new_password'] == $_POST['confirm_password']){
                    $password = md5($_POST['new_password']);
                }

                updateProfile($first_name, $last_name, $address, $contact_number, $email, $username,$user_id, $password);
            }else{
            ?>
                <div class='alert alert-danger text-center' role='alert'>
                        <strong>INCORRECT OLD PASSWORD</strong>
                </div>
            <?php
            }
        }
    ?>


</body>
</html>