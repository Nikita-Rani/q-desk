<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Q-DESK</title>
    <link rel="icon" href="img/qdesklogo.jpg">

    <style>
        .profile{
            height: 38px;
        }
        .containerdisp{
            width:
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
    </style>
</head>

<body>
    <?php include('files/nav.php'); ?>
    <?php include('files/connect.php'); ?>
    <?php
    $thread_id= $_GET['threadid'];
    $sql = "SELECT * FROM `queries` WHERE thread_id=$thread_id";
    $result=mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $thread_title = $row['thread_title'];
        $thread_desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        $sql2 = "SELECT * FROM `user_info` WHERE user_id=$thread_user_id";
        $result2=mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $postBy = $row2['user_name'];
    }
    ?>
    </div>
          <div class="container my-4">
            <div class="jumbotron">
                <h1 class="display-4 font"> <?php echo $thread_title; ?></h1>
                <p class="lead font"> <?php echo $thread_desc; ?></p>
                <hr class="my-4">
                <p class="font">No Spam / Advertising / Self-promote in the forums.Do not post copyright-infringing material.Do not post
                    “offensive” posts, links or images.Do not cross post questions.Do not PM users asking for help.Remain
                    respectful of other members at all times</p>
                <p class="font">Posted by : <strong><?php echo $postBy; ?></strong></p>
            </div>
    </div>

     
    <?php
     $show=false;
     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ){
         $user_email=$_SESSION['useremail'];
         $show=true;
         $sql = "SELECT * from `user_info` WHERE user_email = '$user_email'";
         $result=mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
         $user_id=$row['user_id'];
         $user_name=$row['user_name'];
        $method = $_SERVER['REQUEST_METHOD'];
        $pop=false;
        if($show){
            echo '<div class="container font">
            <h3>Comment on Query</h3>
            <form action=" ' .$_SERVER['REQUEST_URI']. ' " method="post">
                <div class="form-group">
                    <label for="text">Enter your suggestion</label>
                    <input type="text" class="form-control" id="text" name="comment" aria-describedby="emailHelp">
                </div>
               <button type="submit" class="btn btn-success">Comment</button>
            </form>
        </div>';
        if($method=='POST'){
            $comment_content= $_POST['comment'];
            if(empty($comment_content)){
                echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                    comment your solution first!!
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
   </div>';
            }
            else {
            
            $sql= "INSERT INTO `comments` ( `comment_content`, `thread_id`, `user_id`) VALUES ('$comment_content',  '$thread_id', '$user_id')";
            $result=mysqli_query($conn, $sql);
            $pop=true;
            if($pop){
                echo '<div class="alert alert-success alert-dismissible fade show font" role="alert">
                        <strong>Success!</strong> Successfully posted
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';

            }
        }

        }
    }
    }
    else{
        echo '<div class="container lead font">
        <h3>Please login to comment on Queries</h3>
        </div>';
    }

    ?>
  
    <div class="container my-3">
        <div class="h1 my-3 ml-3 font"><h1>Discussions</h1></div>
        <?php
            $pop = true;
            $sql = "SELECT * FROM `comments` WHERE thread_id=$thread_id ORDER BY comment_id DESC";
            $result=mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $comment_id = $row['thread_id'];
                $comment_content = $row['comment_content'];
                $stamp = $row['comment_time'];
                $user_id = $row['user_id'];
                $pop =false;
                $sql2 = "SELECT * FROM `user_info` WHERE user_id = '$user_id' ";
                $result2=mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $user_name = $row2['user_name'];
                echo'<div class="pagedisp  mx-2 ">
                <div class="img1"><img src="img/profile.png" alt=""style="height:41px"></div>
                <p class= "para">'.$comment_content.'</p>
                <p class="asked">commented by:'.$user_name.'</p>

                </div><br>';
            }
            if($pop){
                echo '<div class="jumbotron jumbotron-fluid">
                  <div class="container font">
                    <h1>No Comments Found</h1>
                    <p class="lead font"> wait for the community to respond </p>
                  </div>
                </div>';
            }
        ?>
        </div>

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