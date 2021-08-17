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
  <title>Posts</title>
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
              <a class="nav-link text-white" href="profile.php">Hello, <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name'];?>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="logout.php"><i class="fas fa-user-times"></i></a>
          </li>
      </ul>
    </nav>
      </header>
  <div class="container-fluid bg-info p-4">
    <i class="fas fa-pencil-alt fa-5x text-white"></i>
    <p class="display-2 d-inline text-white">Posts</p>
  </div>
  <div class="container mt-5 w-50">
    <a href="addPost.php" class="bg-secondary text-white p-2 rounded"><i class="far fa-edit"></i>Add Post</a>


    <table class="table mt-5">
      <thead class="thead-dark text-center">
        <tr>
          <th>Post ID</th>
          <th>Title</th>
          <th>Category</th>
          <th colspan="2">Date Posted</th>
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
</body>
</html>