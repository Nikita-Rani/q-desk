<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Search Results</title>
    <link rel="icon" href="img/qdesklogo.jpg">

    <link rel="stylesheet" href="style.css">
    <style>
        body{
            background-image: url('img/bckgnd.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container{
            min-height:74vh;
        }
        .container-2{
            min-height:40vh;
        }
        h1{
            color:white;
        }
        .h3{
            color:white;
        }
        .p{
            color:white;
        }
        /* .container-show{
            height:74vh;
        } */
    </style>
</head>

<body>
    <?php include('files/connect.php'); ?>
    <?php include('files/nav.php'); ?>

    <div class="container my-3">
        
        <?php
        $show=false;
        $showError="false";
        $query=$_GET["search"];
         if(empty($query)){
            $showError="search your query first";
            echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                    search your query first
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
   </div>';
            exit();
        }
        else{
         echo '<h1 class="py-3 font">Search Results for "<em>'.$query.'</em>"</h1>';
        
         $sql = "select * FROM queries WHERE MATCH (thread_title,thread_desc) against ('$query')";
         $result=mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)){
             $search_title=$row['thread_title'];
             $search_desc=$row['thread_desc'];
             $search_id=$row['thread_id'];
             $show=true;
            echo '<div class="result font">
                    <h3><a href="threadlist.php?threadid=' . $search_id . '" class=" font h3">' . $search_title . '</a></h3>
                    <p class="p"> ' . $search_desc . '</p>
                </div>';
         }
        if(!$show){
            echo '<div class="container-2">
            <div class="jumbotron jumbotron-fluid">
                  <div class="container-show">
                    <h2 class="text-center py-2 font">No Result Found</h2>
                    <p class="lead text-center font"> Post your Queries to get the results from the community </p>
                  </div>
                  </div>
                </div>';
        }
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

</html>