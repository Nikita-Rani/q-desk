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
    ?>
    <?php 
        

    
        
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            require_once 'resetpasswordemail.php';
            $user_email = $_POST['user_email'];
            if(empty($user_email)){
                echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                Please enter your Email Id first!!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
             </button>
            </div>';
            }
            else{
            $sql="SELECT * FROM `user_info` WHERE user_email='$user_email' ";
            $result = mysqli_query($conn,$sql);
            
            
           // $num_rows = mysqli_num_rows($result);
            if(mysqli_num_rows($result) >0){
            
                $row=mysqli_fetch_assoc($result);
                $token=$row['token'];
                echo '<div class="alert alert-success alert-dismissible fade show my-0 font" role="alert">
                We sent verification link to rest your password in your registerd email id.kindly click on the link to reset your Password!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
             </button>
            </div>';
            
                resetPasswordEmail($user_email,$token);
                
            }
        
            else {
                echo '<div class="alert alert-danger alert-dismissible fade show my-0 font" role="alert">
                        Email Id is not registered in Q Desk ! kindly enter your registered Email Id
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
        <form action="reset.php" method="post">
            <label for="email" class="font py-2">Please Enter Your Registered Email Id </label>
            <input type="email" class="form-control font" id="email" aria-describedby="emailHelp" name="user_email">
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