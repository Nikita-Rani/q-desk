<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <title>Reset Your Password</title>

    <link rel="stylesheet" href="../style.css">
    <style>
    .container {
        min-height: 71vh;
    }
    </style>

</head>
<body>
    <?php
        include('files/nav.php');
        
        include('files/connect.php');
        //include('files/signuphandler.php');
    ?>
    <?php
    if(isset($_GET['password-token'])){
        $passtoken=$_GET['password-token'];
        $sql="SELECT * FROM `user_info` WHERE token='$passtoken'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) >0){
            $row=mysqli_fetch_assoc($result);
            $_SESSION['user_email']=$row['user_email'];
            
            //header('location:resetform.php?user_email='.$user_email.'');
            //exit();
         }
}    
        if(isset($_SESSION['user_email'])){
            $user_email=$_SESSION['user_email'];
            if($_SERVER["REQUEST_METHOD"]=="POST"){
            
            $user_pass = $_POST['user_pass'];
            $user_cpass = $_POST['user_cpass'];
                if(empty($user_pass) && empty($user_cpass)){
                echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                Please enter new password and confirm password
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
             </button>
            </div>';    
            
                }
                elseif (empty($user_pass)) {
                    echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                password required
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
             </button>
            </div>';
                
                }
                elseif (empty($user_cpass)) {
                echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                confirm password required
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
             </button>
            </div>';
                
                }

                if ($user_pass==$user_cpass) {
                //var_dump($passtoken);

                    $password= password_hash($user_pass,PASSWORD_DEFAULT);
                    $sql2="UPDATE `user_info` SET `user_pass` = '$password' WHERE `user_info`.`user_email` = '$user_email'";
                    //var_dump($sql2);
                    $result2 = mysqli_query($conn,$sql2);
                    if($result2){
                        
                        echo '<div class="alert alert-success alert-dismissible fade show my-0 font" role="alert">
                        Password is successfully changed ! Please log in with your new Password
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                     </button>
                    </div>';
                    }
                    else {
                        echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                        Something went wrong!please try again.
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                     </button>
                    </div>';
                    }
    
                }
                else{
                    //$showError = "Passwords do not match";
                    //header("Location:/forum/home.php?signupsuccess=false&error=$showError");
                    //exit();
                    echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                    Password do not match!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                 </button>
                </div>';
                }
            

        }
    }

    ?>

    
    <div class="container font my-3">
        <h1 class="font my-3 text-center">Reset Your Password</h1>
        <form action="resetform.php" method="post">
            <label for="password" class="font py-2">Please Enter Your new password</label>
            <input type="password" class="form-control font" id="pass" aria-describedby="passwordHelp" name="user_pass">
            <label for="cpassword" class="font py-2">Confirm Password</label>
            <input type="password" class="form-control font" id="cpass" aria-describedby="cpasswordHelp" name="user_cpass">

            <button type="submit" class="btn btn-success font my-2 py-3">Submit</button>

        </form>

    </div>



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
<?php include('files/footer.php'); ?>

</html>