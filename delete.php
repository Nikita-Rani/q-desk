<?php
include 'files/connect.php';
$thread_id = $_GET['threadid'];
$user_id = $_GET['userid'];
$message="";
$sql = "DELETE FROM `queries` WHERE `queries`.`thread_id` = $thread_id";
$result=mysqli_query($conn, $sql);
if($result){

    $message = "succesfully deleted";
    echo $message;
    header("Location:/forum/profile.php?user_id='.$user_id.'&message='.$message.'");

}
else{
    $message = "something went wrong";
    echo $message;
    header("Location:/forum/profile.php?user_id='.$user_id.'&message='.$message.'");
}
?>