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

    <title>PHP forum website</title>
</head>

<body>

    <?php include 'file/header.php' ?>


    <!--carsouel start here-->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/node.png" class="d-block w-100" style="height:30rem;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/quote.png" class="d-block w-100" style="height:30rem;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/quote1.jpg" class="d-block w-100" style="height:30rem;" alt="...">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!--carsouel ends here-->


    <!--card bootstrap-->
    <div class="container">
        <h2 class="text-center">Forum- Categories</h2>

        <div class="row">
            <?php
                $sql = 'SELECT * FROM `forum`';
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    //echo $row['category_id'];
                    $cat_id = $row['category_id'];
                    $desc = $row["category_description"];
                    $name = $row["category_name"];
                    echo '
                    <div class="col my-3">
                        <div class="card" style="width: 15rem;">
                            <img src="python.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><a href="threads_list.php?cat_id='.$cat_id.'">'.$name.'</a></h5>
                                <p class="card-text">'. substr($desc,0,90).'....</p>
                                <a href="threads_list.php?cat_id='.$cat_id.'" class="btn btn-primary">Load More</a>
                            </div>
                        </div>
                    </div>';
                    }
            ?>

        </div>
    </div>




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
</body>

</html>