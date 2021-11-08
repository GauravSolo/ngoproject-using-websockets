<?php

    


    include 'config.php';
      if(isset($_POST['inputnameemail']))
      {
        $lname = mysqli_real_escape_string($conn,$_POST['inputnameemail']);
        $lpass = mysqli_real_escape_string($conn,$_POST['inputuserpassword']);
        $sql = "SELECT user_id,contactid,role FROM usersdata WHERE contactid = '{$lname}' AND password = '{$lpass}'";
        $result = mysqli_query($conn,$sql) or die("couldnt run query");
        if(mysqli_num_rows($result) > 0)
        {
          $rows = mysqli_fetch_assoc($result);

          session_start();

          $_SESSION['id'] = $rows['user_id'];
          $_SESSION['mailid'] = $rows['contactid'];
          $_SESSION['role'] = $rows['role'];
          $error = "<div class='alert alert-success m-0 p-0' style='font-size:18px;' role='alert'>You've successfully logged in!</div>";
          echo json_encode(array('res'=>$error,'ok'=>'1'));
        }
        else
        {
          $error = "<div class='alert alert-warning m-0 p-0' style='font-size:18px;' role='alert'>Wrong Credentials!</div>";
          echo json_encode(array('res'=>$error,'ok'=>'0'));
        }

      }


?>