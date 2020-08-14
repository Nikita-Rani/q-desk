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
            height:38px;
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

    </style>
</head>

<body>
    <?php 
    include('files/connect.php'); 
     include('files/nav.php');
      ?>

    
    <?php
    $cat_id= $_GET['catid'];
    $sql = "SELECT * FROM `category_engineering` WHERE cat_id=$cat_id";
    $result=mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $cat_title = $row['cat_title'];
        $cat_desc = $row['cat_desc'];
       
    }

    ?>
    
   
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4 font">Welcome to <?php echo $cat_title; ?> Engineering forum</h1>
            <p class="lead font"> <?php echo $cat_desc; ?></p>
            <hr class="my-4 font">
            <p>No Spam / Advertising / Self-promote in the forums.Do not post copyright-infringing material.Do not post
                “offensive” posts, links or images.Do not cross post questions.Do not PM users asking for help.Remain
                respectful of other members at all times</p>
            <p class="Lead font">posted by- <strong>Q-Desk</strong></p>
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
            <h3>Post your Queries</h3>
            <form action=" ' .$_SERVER['REQUEST_URI']. ' " method="post">
                <div class="form-group">
                    <label for="text font">Enter your Queries</label>
                    <input type="text" class="form-control" id="text" name="form_title" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">enter your title of queries as short and crisp as
                        possible.</small>
                </div>
                <div class="form-group font">
                    <label for="text">Ellaborate your concern</label>
                    <textarea class="form-control" id="concern" name="form_desc" rows="3"></textarea>
                </div>
    
                <button type="submit" class="btn btn-success font">Post</button>
            </form>
        </div>';
            }
            if($method=='POST'){
                $th_title = $_POST['form_title'];
                $th_desc = $_POST['form_desc'];
                $show=true;
                if(empty($th_title)&&empty($th_desc)){
                    $show=false;
                    echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                    query title and description required!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                
                }
                elseif(empty($th_title)){
                    $show=false;
                    echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                    title required!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                    
                }
                elseif(empty($th_desc)){
                    $show=false;
                    echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                    description of query required!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                   </button>
                </div>';
                
                }
                if($show){
                $sql="INSERT INTO `queries` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES   ('$th_title', '$th_desc', '$cat_id', '$user_id')";
                $result=mysqli_query($conn, $sql);
                $pop=true;
    
                if($pop){
                    echo '<div class="alert alert-success alert-dismissible fade show font" role="alert">
                            <strong>Success!</strong> Successfully posted please wait for the community to respond
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
    
                }
            }
        }
    }
    else{
        echo '<div class="container lead font">
        <h3>Please login to post your Queries</h3>
        </div>';
    }

    
    ?>

    <div class="container  my-4">
        <div class="container  my-4">
            <h1 class="py-2 font">Browse Questions</h1>
        </div>
    </div>
            <?php
            //date_default_timezone_set("Asia/Kolkata");
            
            $display =true;
            $cat_id= $_GET['catid'];
            $sql2= "SELECT * FROM `queries` WHERE thread_cat_id= '$cat_id'ORDER BY thread_id DESC";
            $result2=mysqli_query($conn, $sql2);
                while($row2 = mysqli_fetch_assoc($result2)){
                    $thread_id = $row2['thread_id'];
                    $thread_title = $row2['thread_title'];
                    $thread_desc = $row2['thread_desc'];
                    $thread_user_id = $row2['thread_user_id'];
                    $stamp = $row2['stamp'];
                    
                    
                    $display =false;
                    $sql3 = "SELECT * from `user_info` WHERE user_id = '$thread_user_id'";
                    $result3=mysqli_query($conn, $sql3);
                    while( $row3 = mysqli_fetch_assoc($result3)){
                    $askedBy=$row3['user_name'];
                    echo'<div class="pagedisp  mx-2 ">
                    <div class="img1"><img src="img/profile.png" alt=""style="height:41px"></div>
                    <h3><a href="threadlist.php?threadid='.$thread_id.'"class="anchor">'.$thread_title.'</a></h3>
                    <p class= "para">'.$thread_desc.'</p>
                    <p class="asked">asked by:'.$askedBy.'</p>

                    </div><br>';
                    }
                }

            if($display){
                echo '<div class="jumbotron jumbotron-fluid">
                  <div class="container">
                    <h1 class="display-4 font">No Queries posted in ' . $cat_title . ' forum</h1>
                    <p class="lead font"> Be the first one to ask a question . </p>
                  </div>
                </div>';
            }
        ?>
       



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