<?php
    include "databaseFunctions.php";
    $post_id = $_GET['post_id'];

    $categories = showCategory();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1eaebda83d.js" crossorigin="anonymous"></script>
</head>
<body>
<a href="post.php"><i class="fas fa-angle-left fa-3x text-secondary ml-3 mt-3"></i></a>

    <?php
        $post = postDetail($post_id);

        if(empty($post_id)){
            echo "Error";
        }else{
    ?>
    


    <div class="container mt-5 w-50">
        <h1><i class="fas fa-pen"></i>Update Post</h1>

        <form action="" method="post">
            <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                    <input type="text" name="new_post_title" value="<?php echo $post['post_title'];?>" class="border border-top-0 border-left-0 border-right-0 form-control">
                </div>
            </div>
            <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                    <input type="text" name="new_date_posted" value="<?php echo $post['date_posted'];?>" class="border border-top-0 border-left-0 border-right-0 form-control">
                </div>
            </div>
            <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                    <select name="new_category_name" id="category" class="form-control">
                        <option value="<?php echo $category_id;?>" hidden><?php echo $post['category_name'];?></option>

                        <?php

                        if(empty($categories)){
                            echo "error".$conn->error;
    
                        }else{
                            foreach($categories as $category){ 
                        ?>
                        
                        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                        
                        <?php
                            }
                        }
                        ?>

                        </select>
                </div>
            </div>
            <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                    <textarea name="new_post_message" id="" cols="30" rows="10" class="form-control"><?php echo $post['post_message'];?></textarea>
                </div>
            </div>
            <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                    <input type="submit" name="update" value="UPDATE" class="btn btn-dark form-control">
                </div>
            </div>
        </form>   
    <?php
        }

        if(isset($_POST['update'])){
            $post_title = $_POST['new_post_title'];
            $date_posted = $_POST['new_date_posted'];
            $category_id = $_POST['new_category_name'];
            $post_message = $_POST['new_post_message'];
            $post_id = $_GET['post_id'];

            $update = updatePost($post_title, $date_posted, $category_id, $post_message, $post_id);

            if($update == false){
                
    ?>
            
                <div class="alert alert-danger text-center" role="alert">
                <p><strong>THERE WAS SOMETHING WRONG WITH THE UPDATE</strong></p>
                <a href="post.php" class="btn btn-light">Go back to Post page</a>
            </div> 

    <?php
            }
        }
    ?>
    </div>
</body>
</html>