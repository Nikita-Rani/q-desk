<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Q-Desk</title>
    <link rel="icon" href="img/qdesklogo.jpg">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php 

        include('files/nav.php');
        include('files/connect.php'); 

        include('files/signuphandler.php');
        
        if(isset($_GET['token'])){
            $token=$_GET['token'];
            verifyuser($token);
        }
        

     ?>
    
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slide.jpg" class="d-block w-100 height=260px " style="height: 390px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slide1.jpg" class="d-block w-100 height=260px" style="height: 390px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slide3.jpg" class="d-block w-100 height=260px" style="height: 390px" alt="...">
            </div>
        </div>
    </div>
    <div class="head text-center my-3 font">
        <h3>Browse Categories</h3>
    </div>

    <div class="row">
    <?php 
    $sql = "SELECT * FROM category_engineering";
    $result=mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
    $cat_id = $row['cat_id'];
    $cat_img = $row['cat_img'];
    $cat = $row['cat_title'];
    $cat_desc = $row['cat_desc'];
    echo '<div class="col-md-4 my-1 mr-0 ">
            <div class="card" style="width: 25rem;">
            <img src=" ' .$cat_img. ' " class="card-img-top" style="height:210px" alt="...">
              <div class="card-body">
                <h5 class="card-title"><a href="thread.php?catid=' . $cat_id . '" class="text-success font">' . $cat. '</a></h5>
                <p class="card-text">' . substr($cat_desc, 0, 90). '....</p>
                <a href="thread.php?catid=' . $cat_id . '" class="btn btn-success font">View Queries here</a>
              </div>
            </div>
          </div>';
    }

    ?>
    </div>
    <?php include('files/footer.php'); ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>
<!-- <?php include('files/footer.php'); ?> -->

</html>