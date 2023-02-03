<?php

$method = $_SERVER['REQUEST_METHOD'];
if($method == 'POST'){
    include '_db_connect.php';
    $email= $_POST['email'];
    $password = $_POST['password'];

    $sql="SELECT * FROM `users` WHERE email='$email'";
    $result = mysqli_query($conn,$sql);
    $numrows = mysqli_num_rows($result);
    if($numrows == 1){
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password,$row['password'])){
                session_start();
                $_SESSION['loggedin'] =true;
                $_SESSION['email'] = $email;
                $_SESSION['sno'] = $row['sno'];
                header("location: /forum_website_php/index.php?loggedin=true");
                //echo 'match';
                //echo $_SESSION['sno'];
            }
        else{
            $error = 'password not match';
            header("location: /forum_website_php/index.php?loggedin=$error");
        }
    }
    }else{
        $error='register to login';
        header("location: /forum_website_php/index.php?loggedin=$error");
    }
}
?>