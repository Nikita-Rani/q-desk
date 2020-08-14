<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="/media/fold.css">
     <style>
       /* .nav-profile{
        text-decoration:none;
        margin-top:14px;
        padding:2px;
        text-decoration: none;
        padding: 14px;
        text-align: center;
        align-items: center;
      }  */
      .img{
        height:35px;
        margin-top:10px;
      }
      .logout{
        height: 40px;
    margin-top: 5px;
    border-radius: 8px;
    padding: 6px 11px;

      }
      .text{
        font-size:22px;
        
      }
     </style> 

    <title>Q-Desk</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
 
  
  <?php
  echo  '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand text font" href="home.php">Q-Desk</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text font" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text font" href="about.php">About Us</a>
      </li>

    </ul>
    <div class="row ml-2">';
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ){
      include 'connect.php';

      $user_email= $_SESSION['useremail'];
      $sql = "SELECT * from `user_info` WHERE user_email = '$user_email'";
      $result=mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $user_id=$row['user_id'];
    echo '<a class="nav-profile mr-2  lead" href="profile.php?user_id='.$user_id.' "> <img src="img/profile.png" class="img" alt=""></a>
  </li>
    <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <input class="form-control mr-sm-2 search" type="search" name="search" placeholder="Search your queries" aria-label="Search">
      <button class="btn btn-success font" type="submit">Search</button>
    </form>

      <a href="files/logouthandler.php" class="btn btn-success ml-2 logout font">Logout</a>
      </form';
    }
    else{
    echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search your queries" aria-label="Search">
      <button class="btn btn-success font search" type="submit">Search</button>
    </form>
    <button class="btn btn-outline-success ml-2 font" data-toggle="modal" data-target="#loginModal">Login</button>
      <button class="btn btn-outline-success mx-2 font" data-toggle="modal" data-target="#signupModal">Signup</button>';
    }
    echo'</div>
      </div>
    </nav>';
    ?>
<?php
  include 'files/loginmodals.php';
  include 'files/signupmodals.php';
  if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
             Successfully logged in.
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
         </div>';
  }
  if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
              Click on the link send in your Email to verify your account!!!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>';
  }
  if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
         $error = $_GET['error'];
    echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
              ' . $error . '
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>';
  }
  if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
    $error = $_GET['error'];
echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
         ' . $error . '
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
     </div>';
}
if(isset($_GET['searchsuccess']) && $_GET['searchsuccess']=="false"){
  $error = $_GET['error'];
echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
       ' . $error . '
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
   </div>';
}

if(isset($_GET['logoutsuccess']) && $_GET['logoutsuccess']=="true"){
echo '<div class="alert alert-success alert-dismissible fade show my-0 font" role="alert">
       Successfuly logout
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
   </div>';
}
  
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>