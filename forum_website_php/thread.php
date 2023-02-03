<?php include 'file/_db_connect.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>PHP forum website</title>
</head>

<body>
    <?php include 'file/header.php' ?>
    <?php include 'file/_db_connect.php'; ?>

    <?php
    //insert comment in database comment table
    $id = $_GET['thread_id'];
    $showAlert = false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method =='POST'){
        $desc = $_POST['desc'];
        $sno = $_POST['sn2o'];

       $sql= "INSERT INTO `comment` (`comment_content`, `thread_id`, `comment_by`, `comment_date`) VALUES ('$desc', '$id', '$sno', CURRENT_TIMESTAMP)";
       mysqli_query($conn,$sql);
       $showAlert = true;
    }

    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Comment inserted!</strong> successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>


    <?php
    //fetch data from threads table and display in jumbtr;on;
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn,$sql);
    while($row= mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }
?>
    <!--jumbtron start-->
    <div class="container">
        <div class="jumbotron mt-4">
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="lead"><?php  echo $desc;?></p>
            <hr class="my-4">
            <p class="lead">No Spam / Advertising / Self-promote in the forums
                ,Do not post copyright-infringing materia
                ,Do not post “offensive” posts, links or images
                ,Do not cross post questions</p>
        </div> 
    </div>

    


    <!--comment form-->
    <?php
    echo '<div class="container mb-4">';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '
            <h2>Post a comment</h2>
            <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Type your comment</label>
                        <textarea class="form-control" id="t_desc" name="desc" rows="2"></textarea>
                        <input type="hidden" name="sn2o" value="'.$_SESSION['sno'].'">
                    </div>
                    <button type="submit" class="btn btn-success">Post</button>
                </form>';
        
       }else{
             echo 'login to post';
        }
        echo '</div>';
    ?>
    <div class="container mb-3"><h2>Discussion</h2></div>
    <?php
    //fetch data from comment database and show in thread.php file
    $id = $_GET['thread_id'];
    $sql = "SELECT * FROM `comment` WHERE thread_id= $id ";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $content = $row['comment_content'];
        $comment_date =$row['comment_date'];
        $comment_by = $row['comment_by'];
        //get username from user table
        $sql2 ="SELECT username FROM `users` WHERE sno=$comment_by";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        echo '<div class="container">
                <div class="media">
                    <img src="img/avatar.jpg" style="width: 4rem;" class="mr-3" alt="...">
                    <div class="media-body">
                        <h6 class="mt-0"><b>'.$row2['username'].' commented at:</b> '.$comment_date.'</a></h6>
                        <p>'.$content.'</p>
                    </div>
                </div>
            </div>';
    }
    

    ?>

    <!--footer-->
    <?php include 'file/footer.php' ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>