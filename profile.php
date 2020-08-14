<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<!--<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">-->

    <title>Profile</title>
    <link rel="icon" href="img/qdesklogo.jpg">

    <link rel="stylesheet" href="style.css">
    <style>
      .container1{
       min-height:31vh;
     } 
     body{
            background-image: url('img/abtbackgnd.jpg');
            background-repeat: no-repeat;
            background-size: cover; 
     }
     .logo{
       height:150px;
     }
      h1{
            color:green;
        }
        .pagedisp{
            
            margin-left: 175px;
            border: 2px solid #c0e0c294 ;
            margin-bottom:2px;
            border-radius: 13px;
            margin-right: 47px;
            background-color: #c0e0c294;
            margin:2px
            
        }
        .img1{
            margin-top:0px;
            flex-direction: row;
            float:left;
            padding: 23px 10px;
        }
        .para{
            
            
            margin-left: 59px;
            margin-right: 10px;

        }
        .asked{
            margin-left:62px;
        }
        .anchor{
            color:black;
        }

     /* .container2{
       min-height:10vh;
     } */
    </style>
</head>

<body>
    <?php
         include('files/nav.php'); 
         include('files/connect.php');
    ?>

    <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ){
        $show=true;
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            $thread_id = $_GET['thread_id'];
            $user_id = $_GET['user_id'];

            $sql = "DELETE FROM `queries` WHERE `queries`.`thread_id` = $thread_id";
            $result=mysqli_query($conn, $sql);
            if($result){
              echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
              successfully deleted
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>';
 
            }
        }
        // $message= $_GET['message'];
        $user_id= $_GET['user_id'];

        $sql= "SELECT * FROM `user_info` WHERE user_id = $user_id";
        $result=mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          $user_name=$row['user_name'];
        }
        echo '<div class="container">
          <h1 class="text-center my-3 font">Q-Desk</h1>
        </div>
        <div class="profile text-center my-4"><img src="img/profile.png" class="logo" alt=""></div>
        <div class="h1 text-center font"><h2>' . $user_name . '</h2></div>
        <h1 class="text-center Lead my-2 font">Queries Asked</h1>
        <div class="container1" id="myTable">';
        $sql = "SELECT * FROM `queries` WHERE thread_user_id=$user_id ORDER BY thread_id DESC";
        $result=mysqli_query($conn, $sql);
        if($result){
        while($row = mysqli_fetch_assoc($result)){
          $thread_id=$row['thread_id'];
          $thread_title=$row['thread_title'];
          $thread_desc=$row['thread_desc'];
          $show=false;
        echo '<div class="container ml-3" >
        <div class="pagedisp  mx-2 ">
        <div class="img1"><img src="img/profile.png" alt=""style="height:41px"></div>
        <h3><a href="threadlist.php?threadid='.$thread_id.'"class="anchor">'.$thread_title.'</a></h3>
        <p class= "para">'.$thread_desc.'</p>
        

        </div>
                    <form action="profile.php?thread_id='.$thread_id.'&user_id='.$user_id.'" method="post">
                    <button class="btn btn-success font dark my-1 py-2 ml-2" type="submit">
                    Delete Post</button>
                    </form>
                    
                    </div>';

      }
      if($show){
        echo '<div class=" jumbotron jumbotron mx-4  ">
        <div class="container mx-4">
          <h1 class="display-4 font">No Queries asked till now</h1>
          <p class="lead"> <a href="home.php" class="text-dark font">Ask your first Query</a> </p>
        </div>
        </div>';
      }
    }
      echo'</div>';
    
    }
    // <button class="btn btn-success font" type="submit">Search</button>

    ?>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
   <!-- <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>-->
    <script>
      $(document).ready( function () {
        $('#myTable').pagination({
          items:5,
          contents:'container1'
          previous:'Previous'
          next:'Next'
          position:'bottom'
        });
      } );
    </script>
</body>

</html>