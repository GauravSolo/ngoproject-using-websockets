<?php

    include "config.php";
    session_start();
    if(!$_SESSION['id'])
    {
      include "config.php";
      header("Location: {$host}");
    }

     if($_FILES['profilepic']['size'] == 0 && $_FILES['profilepic']['error'] == 0)
    {
      $image_name = '';
      $error = "no image";
    }else{
      $file_name = $_FILES['profilepic']['name'];
      $file_size = $_FILES['profilepic']['size'];
      $file_tmp = $_FILES['profilepic']['tmp_name'];
      $file_type = $_FILES['profilepic']['type'];
      $exp  = explode('.',$file_name);
      $end = end($exp);
      $file_ext = strtolower($end);
      $extension = array('jpeg','jpg','png','svg');

      $error = "";

      if(in_array($file_ext,$extension) === false)
      {
        $error = "This extension file not allowed. Please choose a PNG,JPG or SVG";
      }

      if($file_size > 10000000)
      {
        $error = "File size must be 10mb or lower";
      }
      if($file_size > 1000000)
      {
        if($file_type == 'image/jpeg')
        {
          $img = imagecreatefromjpeg($file_tmp);
        }elseif($file_type == 'image/png'){
          $img = imagecreatefrompng($file_tmp);
        }

        if(isset($img)){
          imagejpeg($img,$file_tmp,30);
        }
      }
      

      $new_name = time().'-'.basename($file_name);
      $image_name = $new_name;
      $target = "";

      if($error == "")
      {
        $target = "../upload/".$image_name;
        move_uploaded_file($file_tmp,$target);
      }
      else{
         $error = "something went wrong in uploading image!";
      }
    }

    $id = $_POST['ctd'];
    $name = $_POST['uname'];
    $mail = $_POST['mail'];
    $pass = $_POST['password'];
    $city = $_POST['city'];
    if($_SESSION['role'])
        $money = $_POST['money'];

        if($_SESSION['role']){
          if($image_name == ''){
              $sql = "UPDATE usersdata SET username = '{$name}', password = '{$pass}', contactid = '{$mail}',city = '{$city}',money = {$money} WHERE user_id = {$id}";
          }else{
              $sql = "UPDATE usersdata SET username = '{$name}', password = '{$pass}', contactid = '{$mail}',city = '{$city}',money = {$money} ,image = '{$image_name}' WHERE user_id = {$id}";
          }
        }else{
          if($image_name == ''){
            $sql = "UPDATE usersdata SET username = '{$name}', password = '{$pass}', contactid = '{$mail}',city = '{$city}' WHERE user_id = {$id}";
          }else{
              $sql = "UPDATE usersdata SET username = '{$name}', password = '{$pass}', contactid = '{$mail}',city = '{$city}',image = '{$image_name}' WHERE user_id = {$id}";
          }
        }

    if($id == $_SESSION['id'])
    {
      $same = '1';
    }
    else
    {
      $same = '0';
    }
   
    $result = mysqli_query($conn,$sql) or die("couldnt run query --> update file");

    if($result)
    {
        echo json_encode(array('int'=>'1','name'=>$image_name,'username'=>$name,'mail'=>$mail,'same'=>$same));
    }else{
        echo json_encode(array('int'=>'0'));
    }
?>