<?php
 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ){
    $thread_id= $_GET['thread_id'];
    $sql= "SELECT * FROM `user_info` WHERE user_id = $user_id";
    $result=mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      $user_name=$row['user_name'];
    }
  }
?>