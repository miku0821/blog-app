<?php
    include "databaseFunctions.php";

    $post_id = $_GET['post_id'];

    $author_name = authorName($post_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1eaebda83d.js" crossorigin="anonymous"></script>
</head>
<body>

<a href="post.php"><i class="fas fa-angle-left fa-3x text-secondary ml-3 mt-3"></i></a>
<div class="text-right mr-5 mt-2"><a href="editPost.php?post_id=<?php echo $post_id;?>" class="bg-secondary text-white rounded p-2"><i class="fas fa-pen"></i> Update Post</a></div>


    <?php
        $post = postDetail($post_id);

        if(empty($post_id)){
            echo "Error";
        }else{
    ?>

    <div class="container mt-5 w-50">
        <p class="display-2"><?php echo $post['post_title']?></p>
        <p>By: <span class="text-primary"><?php echo $author_name['first_name'].' '.$author_name['last_name']?> </span><?php echo ', '.$post['date_posted'].', '. $post['category_name']?></p>
        <p class="mt-5"><?php echo $post['post_message'];?></p>
    </div>
 
    <?php
        }
    ?>

</body>
</html>