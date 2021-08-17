<?php
  include "databaseFunctions.php";

    session_start();

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
  <title>Categories</title>
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
  <div class="container-fluid bg-success p-4">
    <i class="far fa-folder-open fa-5x text-white"></i> 
    <p class="display-2 d-inline text-white">Categories</p>
  </div>
  <div class="container mt-5 w-50">
    <form action="" method="post" class="form-inline">
      <div class="form-row col-md-10 mx-auto">
        <div class="form-group col-md-2 p-0 ml-5"> 
          <label for="category" class="ml-3">Add Category</label>
        </div>
        <div class="form-group col-md-6 p-0">
          <input type="text" id="category" name="category" class="form-control col-md-11 mx-auto">
        </div>
        <div class="form-group">
          <input type="submit" name="add" value="ADD" class="btn btn-success form-control">
        </div>
      </div>
    </form>

  <?php
  if(isset($_POST['add'])){
    $category = $_POST['category'];
    $category_rows = categoryTable($category);
 }
?>

<table class="table mt-5 mx-auto w-75 ">
  <thead class="thead-dark">
    <tr>
      <th class="text-center">CATOGORY ID</th>
      <th colspan="3">CATEGORY NAME</th>
    </tr>
  </thead>
  <tbody>

  <?php 
     if(empty($category_rows)){
  ?>
    <tr>
      <td colspan='5' class="text-center"><strong>NO CATEGORIES FOUND</strong></td>
    </tr>
      
      <?php
       }else{  
        foreach($category_rows as $category_detail){
      ?>
      
  <tr>
    <td  class="text-center"><?php echo $category_detail['category_id']?></td>
    <td class="text-center"><?php echo $category_detail['category_name']?></td>
    <td  class="text-center"><a href="" class="btn btn-warning mx-auto">Update</a></td>
    <td  class="text-center"><a href="" class="btn btn-danger">Delete</a></td>
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