<?php
    include "databaseFunctions.php";
    session_start();
    $user_id = $_SESSION['user_id'];
    $post_result = showPost($user_id);

    if(empty($_SESSION)){
        session_unset();
        session_destroy();
        header("Location: login.php");
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

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
                      <a class="nav-link text-white" href="profile.php?user_id=<?php echo $user_id;?>">Hello, <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name'];?></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="logout.php"><i class="fas fa-user-times"></i></a>
                  </li>
              </ul>
        </nav>
      </header>


  <div class="container-fluid bg-primary p-4">
    <i class="fas fa-cog text-white fa-5x"></i>
    <p class="display-2 d-inline text-white">Dashboard</p>
  </div>


  <div class="container-fluid mt-5">
      <div class ="row col-md-9 mx-auto p-0">
          <a href="addPost.php?user_id=<?php echo $user_id;?>" class="btn btn-primary col-md-3 ml-5"><i class="fas fa-plus-circle"></i>Add Post</a>
          <a href="categories.php" class="btn btn-success col-md-3 mx-auto"><i class="fas fa-folder-plus"></i>Add Category</a>
          <a href="users.php" class="btn btn-warning text-light col-md-3"><i class="fas fa-user-plus"></i>Add User</a>    
      </div>

        <div class="row col-md-9 mx-auto mt-4 p-0">
          <div class="col-md-9 px-4">
              <div class="table px-5">
              <table class="table mt-5">
                <thead class="thead-dark text-center">
                  <tr>
                    <th>Post ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th colspan="2" class="text-left pl-5">Date Posted</th>
                  </tr>
                </thead>
                <tbody class="text-center">

                <?php 
                if(empty($post_result)){
                ?>
                  <tr>
                    <td colspan='5' class="text-center"><strong>NO RECORDS FOUND</strong></td>
                  </tr>
                <?php
                }else{
                  foreach($post_result as $row){
                ?>
                  <tr>
                    <td><?php echo $row['post_id']; ?></td>
                    <td><?php echo $row['post_title']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo $row['date_posted']; ?></td>
                    <td><a href="postDetails.php?post_id=<?php echo $row['post_id'];?>" class="btn btn-outline-dark"><i class="fas fa-angle-double-right"></i>Details</a></td>
                  </tr>

                <?php   
                  }
                }
                ?>

                </tbody>
              </table>
            </div>
          </div>

            <div class="col-md-3">
              <div class="posts bg-primary text-white p-4 text-center mt-3">
                <p class="h2">Posts</p>
                <i class="fas fa-pencil-alt fa-2x"></i>
                <button type="submit" class="btn btn-outline-light d-block mx-auto mt-2">View</button>
              </div>
              <div class="category bg-success text-white p-4 text-center mt-3">
                <p class="h2">Category</p>
                <i class="far fa-folder-open fa-2x"></i>
                <button type="submit" class="btn btn-outline-light d-block mx-auto mt-2">View</button>
              </div>
              <div class="users bg-warning text-white p-4 text-center mt-3">
                <p class="h2">Users</p>
                <i class="fas fa-users fa-2x"></i>
                <button type="submit" class="btn btn-outline-light d-block mx-auto mt-2">View</button>
            </div>
          </div>
        </div>
</div>
</body>
</html>