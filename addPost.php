<?php
    include "databaseFunctions.php";
    session_start();

    $categories = showCategory();
    $user_id = $_SESSION['user_id'];

    $author = getAuthor($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1eaebda83d.js" crossorigin="anonymous"></script>
</head>
<body>
<a href="post.php"><i class="fas fa-angle-left fa-3x text-secondary ml-3 mt-3"></i></a>
    <div class="container w-50 mt-5">
        <h1 class="display-3 text-center"><i class="far fa-edit"></i>Add Post</h1>
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="text" name="title" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder="TITLE">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="date" name="date" class="border border-top-0 border-left-0 border-right-0 form-control" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <select name="category" id="category" class="form-control">
                        <option hidden>CATEGORY</option>

                    <?php

                    if(empty($categories)){
                        echo "error".$conn->error;
   
                    }else{
                        foreach($categories as $category){ 
                    ?>
                    
                    <option value="<?php echo $category['category_id']; ?>"><?php echo  $category['category_name']; ?></option>
                    
                    <?php
                        }
                    }
                    ?>

                    </select>

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <textarea name="message" id="" cols="30" rows="10" class="border border-top-0 border-left-0 border-right-0 form-control" placeholder="MESSAGE"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-1 p-0">
                    <p class="bg-dark text-white rounded-left p-2">Author:</p>   
                </div>
                <div class="form-group col-md-11 d-inline p-0">
                <p class="bg-secondary text-white rounded-right p-2"><?php echo $author['first_name'].' '.$author['last_name'];?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="submit" name="post" value="POST" class="btn btn-dark form-control">
                </div>
            </div>
        </form>

        <?php
            if(isset($_POST['post'])){
                $title = $_POST['title'];
                $date = $_POST['date'];
                $category = $_POST['category'];
                $message = $_POST['message'];
                

                addPost($title, $date, $category, $message, $user_id);
            }
        ?>

        
    </div>
</body>
</html>