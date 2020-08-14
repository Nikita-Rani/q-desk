<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'connect.php';
    $user_email = $_POST['user_email'];
    // $user_name= $_POST['user_name'];
    $user_pass= $_POST['user_pass'];
    // $user_cpass= $_POST['user_cpass'];

    if(empty($user_email)){
        $showError="email required";
        header("Location:/forum/home.php?loginsuccess=false&error=$showError");
                // exit();
    }
    if(empty($user_pass)){
        $showError="password required";
        header("Location:/forum/home.php?loginsuccess=false&error=$showError");
        exit();
    }
    if($showError=="false"){
    $sql="SELECT * FROM `user_info` WHERE user_email = '$user_email' ";
    $result = mysqli_query($conn,$sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows>0){
        $row=mysqli_fetch_assoc($result);
        $verified=$row['verified'];
        if($verified==1){

            if(password_verify($user_pass, $row['user_pass'])){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['useremail'] = $user_email;
                header("Location:/forum/home.php?loginsuccess=true");
                exit();
            }
            else{
                $showError="invalid credentials";
                header("Location:/forum/home.php?loginsuccess=false&error=$showError");
                // exit();
            }
        }
        else {
            $showError="user is not verified .please verify your email first !";
            header("Location:/forum/home.php?loginsuccess=false&error=$showError");
            exit();
        }

    }
    else{
        $showError="email do not exist";
        header("Location:/forum/home.php?loginsuccess=false&error=$showError");
        // exit();
    }
}
}
else{
    $showError="something went wrong";
    header("Location:/forum/home.php?loginsuccess=false&error=$showError");
    // exit();
}
?>