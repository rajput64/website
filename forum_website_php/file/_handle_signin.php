<?php
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "POST"){
        include '_db_connect.php';
        $email= $_POST['email'];
        $username = $_POST['text'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $existuser = "SELECT * FROM `users` WHERE email='$email'";
        $result= mysqli_query($conn,$existuser);
        $rows= mysqli_num_rows($result);
        if($rows > 0){
            $showerror= 'user exists';
        }else{
            if($password == $cpassword){
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`username`, `email`, `password`, `date_time`) VALUES ('$username', '$email', '$hash', CURRENT_TIMESTAMP)";
                
                $result = mysqli_query($conn,$sql);
                if($result){
                    $showalert = 'user created';
                    header("location: /forum_website_php/index.php?alert=$showalert");
                }                
            }else{
                $showerror = 'password not match';
            }
            }
            header("location: /forum_website_php/index.php?error=$showerror");
        }
    
?>