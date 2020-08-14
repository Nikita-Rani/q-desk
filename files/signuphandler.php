<?php
$showError="false";
//include 'connect.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    require_once 'emailcontroller.php';
include 'connect.php';

    $user_email = $_POST['user_email'];
    $user_name= $_POST['user_name'];
    $user_pass= $_POST['user_pass'];
    $user_cpass= $_POST['user_cpass'];
    if(empty($user_name)){
        $showError="Username required";
        header("Location:/forum/home.php?signupsuccess=false&error=$showError");
                exit();
        }
    if(empty($user_email)){
        $showError="Email required";
        header("Location:/forum/home.php?signupsuccess=false&error=$showError");
                exit();
    }
    if(empty($user_pass)){
        $showError="Password required";
        header("Location:/forum/home.php?signupsuccess=false&error=$showError");
                exit();
    }
    if($showError=="false"){
    $sql="SELECT * FROM `user_info` WHERE user_email = '$user_email' AND verified ='1'";
    $result = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($result);
        if($num_rows>0){
            $showError = "Email already exist";
            header("Location:/forum/home.php?signupsuccess=false&error=$showError");
            exit();
         }
        else {
            if ($user_pass==$user_cpass) {
                $password= password_hash($user_pass,PASSWORD_DEFAULT);
                $verified=false;
                $token= bin2hex(random_bytes(50));
                $sql2="INSERT INTO `user_info` (`user_email`, `user_name`, `user_pass`, `token`, `verified`) VALUES ( '$user_email', '$user_name', '$password', '$token', '$verified')";
                $result2 = mysqli_query($conn,$sql2);
                if($result2){
                    
                    sendVerificationEmail($user_email,$token);

                    // $showAlert = true;
                    header("Location:/forum/home.php?signupsuccess=true");
                     exit();
                }
                else {
                    $showError = "something went wrong please try again";
                    header("Location:/forum/home.php?signupsuccess=false&error=$showError");
                    exit();
                    
                }

            }
            else{
                $showError = "Passwords do not match";
                header("Location:/forum/home.php?signupsuccess=false&error=$showError");
                exit();
            }
        }
        
    }
}
function verifyuser($token){
    global $conn;
    $sql="SELECT * FROM `user_info` WHERE token='$token'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) >0){
        $row=mysqli_fetch_assoc($result);
        $user_id=$row['user_id'];
        $user_email=$row['user_email'];
        $sql2="UPDATE `user_info` SET `verified` = '1' WHERE `user_info`.`user_id` = $user_id AND `user_info`.`user_email` = '$user_email'";
        $result2 = mysqli_query($conn,$sql2);

        if($result2){
            echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
             Successfully Registered ! Please login with your Registered account .
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
         </div>';
        }
        else {
            echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
             User is already Verified . Try using another Email account
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
         </div>';
        }

    }
    else {
        echo"invalid token";
    }
}

?>