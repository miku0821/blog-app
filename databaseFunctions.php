<?php
    require_once "connection.php";


    function checkUser($username){
        $conn = db_connect();

        $sql = "SELECT username FROM accounts WHERE username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows == 0){
            return false;
        }else{
            return true;
        }
    }


    function register($first_name, $last_name, $email, $address, $contact_number, $username, $password){
        $conn = db_connect();

        $sql_accounts = "INSERT INTO accounts (username, password) VALUES ('$username', '$password')";  

        if($conn->query($sql_accounts)){
            $user_account_id = $conn->insert_id;

            $sql_users = "INSERT INTO users (first_name, last_name, email, address, contact_number, account_id) VALUES ('$first_name', '$last_name', '$email', '$address', '$contact_number', '$user_account_id')";

            if($conn->query($sql_users)){
                header("Location: login.php");
                $conn->close();
            }else{
            die("Error in inserting data into Users table: ".$conn->error);
            $conn->close();
            }
        }else{
            die("Error in inserting data into Accounts table: ".$conn->error);
            $conn->close();
        }
    }


    function login($username, $password){
        $conn = db_connect();

        $sql = "SELECT * FROM users INNER JOIN accounts ON users.account_id = accounts.account_id WHERE username = '$username'";

        $result = $conn->query($sql);

        // $sql_status = "SELECT status FROM accounts WHERE username = '$username'";
        // $status_result = $conn->query($sql_status);

        if($result->num_rows == 1){

            $row = $result->fetch_assoc();

            if(password_verify($password, $row['password'])){

                $_SESSION['username'] = $row['username'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['status'] = $row['status'];
                $_SESSION['account_id'] = $row['account_id'];
                $_SESSION['user_id'] = $row['user_id'];

                if($row['status'] == "A"){
                    header("Location: dashboard.php");
                    $conn->close();
                }elseif($row['status'] == "U"){
                    header("Location: profile.php");
                    $conn->close();
                }
            }else{
                return "Invalid Password";
                $conn->close();
            }

        }else{
            return "Invalid Username";
            $conn->close();
        }
    }

    function getAuthor($user_id){
        $conn = db_connect();

        $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

        if($result->num_rows == 1){
            return $result->fetch_assoc();
        }
    }


    function categoryTable($category){
        $conn = db_connect();

        $sql = "INSERT INTO categories (category_name) VALUES ('$category')";
        $result = $conn->query($sql);

        $table_data = "SELECT * FROM categories";
        $table_result = $conn->query($table_data);


        if($table_result->num_rows > 0){

        while($categories = $table_result->fetch_assoc()){
                $rows[] = $categories;
            }
                return $rows;
        }else{
            return false;
        }

    }
    
    
    function displayAllUsers(){
        $conn = db_connect();

        $sql = "SELECT * FROM users INNER JOIN accounts ON users.account_id = accounts.account_id";
        $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($users = $result->fetch_assoc()){
                    $rows[] = $users;
                }
                 return $rows;
            }else{
                return false;
            }
    }

    function showPost($user_id){
        $conn = db_connect();

        $sql = "SELECT * FROM posts INNER JOIN categories ON posts.category_id = categories.category_id WHERE posts.user_id = '$user_id'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($posts = $result->fetch_assoc()){
                $rows[] = $posts;
            }
            return $rows;
        }else{
           return false;
        }

    }

    function showCategory(){
        $conn = db_connect();
        
        $sql = "SELECT * FROM categories";
        $result =$conn->query($sql);

        if($result->num_rows > 0){
            while($category = $result->fetch_assoc()){
                $categories[] = $category;
            }
            return $categories;
        }else{
            die("Please add category");
        }

    }

    function addPost($title, $date, $category, $message, $user_id){
        $conn = db_connect();

        $sql = "INSERT INTO posts (post_title, date_posted, category_id, post_message, posts.user_id) VALUES ('$title', '$date', '$category', '$message', '$user_id')";

        if($conn->query($sql)){
            header("Location: post.php");
            $conn->close();
        }else{
            die("Error in inserting Post data: ".$conn->error);
        }

    }

    function postDetail($post_id){
        $conn = db_connect();
        
        $sql = "SELECT * FROM posts INNER JOIN categories ON posts.category_id = categories.category_id WHERE posts.post_id = '$post_id'";
        $result = $conn->query($sql);

        if($result->num_rows == 1){
            return $result->fetch_assoc();
            $conn->close();
        }else{
            return false;
            $conn->close();
        }
    }

    function authorName($post_id){
        $conn = db_connect();

        $sql = "SELECT first_name, last_name FROM users INNER JOIN posts ON users.user_id = posts.user_id WHERE post_id = '$post_id'";
        $result = $conn->query($sql);

        if($result->num_rows == 1){
            return $result->fetch_assoc();
        }

    }


    function updatePost($post_title, $date_posted, $category_id, $post_message, $post_id){
        $conn = db_connect();
        
        $sql = "UPDATE posts INNER JOIN categories ON posts.category_id = categories.category_id 
                SET posts.post_title = '$post_title',
                    posts.date_posted = '$date_posted',
                    posts.category_id = '$category_id',
                    posts.post_message = '$post_message'
                WHERE posts.post_id = '$post_id'
                ";

        if($conn->query($sql)){
            header("Location: post.php");
            $conn->close;
        }else{
            die("false".$conn->error);
            $conn->close();
        }
    }

    function getUserDetails($user_id){
        $conn = db_connect();

        $sql = "SELECT * FROM users INNER JOIN accounts ON users.account_id = accounts.account_id WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

            if($result->num_rows > 0){
                return $result->fetch_assoc();
                
            }else{
                return false;
            }
    }

    function checkOldPassword($user_id){
        $conn = db_connect();

        $confirm_old_password = md5($_POST['confirm_old_password']);

        $sql = "SELECT password FROM accounts INNER JOIN users ON users.account_id = accounts.account_id WHERE users.user_id = '$user_id' AND password = '$confirm_old_password'";
        $result = $conn->query($sql);
        
        if($result->num_rows == 1){
            return 1; //true
        }else{
            echo $conn->error;
        }
    }


    function updateProfile($first_name, $last_name, $address, $contact_number, $email, $username,$user_id, $password){
        $conn = db_connect();

        $sql = "UPDATE users INNER JOIN accounts ON users.account_id = accounts.account_id
                SET users.first_name = '$first_name',
                    users.last_name = '$last_name',
                    users.address = '$address',
                    users.contact_number = '$contact_number',
                    users.emamil = '$email',
                    accounts.username = '$username',
                    accounts.password = '$password' 
                WHERE users.user_id = '$user_id'
            ";

        if($conn->query($sql)){
            header("Location: profile.php");
        }else{
            die("ERREOR: ".$conn->error);
        }
    }
?>