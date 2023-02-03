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

        $id = $_GET['cat_id'];
        $sql = "SELECT * FROM `forum` WHERE category_id =$id";
        $result = mysqli_query($conn,$sql);
        while($row= mysqli_fetch_assoc($result)){
            $cat_name = $row['category_name'];
            $cat_desc = $row['category_description'];
            
        }
?>

<?php //take data from form and put in thread table
        
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $title = $_POST['title'];
            $t_desc = $_POST['desc'];
            $sno = $_POST['sno'];
            $sql ="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$title', '$t_desc', '$id', '$sno', CURRENT_TIMESTAMP)";
            mysqli_query($conn,$sql);
            $showAlert= true;
        }
        
         

?>

<!--jumbtron start-->
    <div class="container">
        <div class="jumbotron mt-2">
            <h1 class="display-5">Welcome to <?php echo $cat_name;?> Froum</h1>
            <p class="lead"><?php  echo $cat_desc;?></p>
            <hr class="my-4">
            <p class="lead">No Spam / Advertising / Self-promote in the forums
                ,Do not post copyright-infringing materia
                ,Do not post “offensive” posts, links or images
                ,Do not cross post questions</p>
        </div>


        <!--form to submit thread-->
       
            <h2 class=" mt-4">Start a discussion.</h2>
<?php
       if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem title</label>
                    <input type="text" class="form-control" id="t_title" name="title" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Keep it as short as possible.</small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Problem description</label>
                    <textarea class="form-control" id="t_desc" name="desc" rows="2"></textarea>
                    <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                    
                </div>
                <button type="submit" class="btn btn-success">Submit Problem</button>
            </form>';
       }
       else {
        echo 'logged in to post';
       }
?>
        <!--jumbtron ends here-->

        <!--media starts herer-->
<?php
          echo '<h2  class="mt-4">Browse questions.</h2>';
            $id = $_GET['cat_id'];
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($conn,$sql);
            $no_result = true;
            while($row= mysqli_fetch_assoc($result)){
                $no_result = false;
                $thread_id = $row['thread_id'];
                $thread_title = $row['thread_title'];
                $thread_desc = $row['thread_desc'];
                $thread_user = $row['thread_user_id'];

                $sql2 = "SELECT username FROM `users` WHERE sno=$thread_user";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo '<div class="container">
                <div class="media">
                    <img src="img/avatar.jpg" style="width: 4rem;" class="mr-3" alt="...">
                    <div class="media-body">
                    <p class="my-0">posted by : '.$row2['username'].'</p>
                        <h5 class="mt-0"><a href="thread.php?thread_id='.$thread_id.'">'.$thread_title.'</a></h5>
                        <p >'.$thread_desc.'</p>
                    </div>
                </div>
            </div>';
          
            }
            //check if their is no result then print no result found
            if($no_result){
                echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h1 class="display-4">No threads found.</h1>
                        <p class="lead">Be the first to ask the thread.</p>
                        </div>
                    </div>';
                echo '';
            }
            
?>
    </div>
    <!--media ends here-->





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