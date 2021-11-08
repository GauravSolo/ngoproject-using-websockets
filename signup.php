<?php
// header('Access-Control-Allow-Origin: *');

  include 'config.php';
  session_start();
  
     if(isset($_POST['inputusername']))
    {
      $uname = $_POST['inputusername'];
      $uemail = $_POST['inputemail'];
      $upassword = $_POST['inputpassword'];
      $ucity = $_POST['select'];
      $umoney = 0;
      $urole = 0;
      $uaddress = $_SERVER['REMOTE_ADDR'];
      $udate = date('d M,Y');

      // function isValidEmail($uemail){ 
      //     return filter_var($uemail, FILTER_VALIDATE_EMAIL) !== false;
      // }

      // function validate_mobile($uemail)
      // {
      //     return preg_match('/^[0-9]{10}+$/', $uemail);
      // }

      // if(!isValidEmail($uemail) && !validate_mobile($uemail))
      // {
      //   echo "<div class='alert alert-warning m-0' role='alert'>Please enter valid email or phone!<div>";
      // }

            if($_FILES['profilepic']['size'] == 0 && $_FILES['profilepic']['error'] == 0)
            {
              
              $image_name = 'user.svg';
            }else{
              $file_name = $_FILES['profilepic']['name'];
              $file_size = $_FILES['profilepic']['size'];
              $file_tmp = $_FILES['profilepic']['tmp_name'];
              $file_type = $_FILES['profilepic']['type'];
              $file_ext = strtolower(end(explode('.',$file_name)));
              $extension = array('jpeg','jpg','png','svg');

              $error = "";

              if(in_array($file_ext,$extension) === false)
              {
                $error = "<div class='alert alert-danger m-0 p-0' style='font-size:20px;background-color:tomato;' role='alert'>This extension file not allowed. Please choose a PNG,JPG or SVG!</div>";
              }

              if($file_size > 10000000)
              {
                $error = "<div class='alert alert-danger m-0 p-0' style='font-size:20px;background-color:tomato;' role='alert'>File size must be 10mb or lower!</div>";
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
                $target = "upload/". $image_name;
                move_uploaded_file($file_tmp,$target);
              }
              else{
                $error = "<div class='alert alert-danger m-0 p-0' style='font-size:20px;background-color:tomato;' role='alert'>Something went wrong in uploading image!</div>";
              }
          }
   

            $sql = "SELECT contactid FROM usersdata WHERE contactid = '{$uemail}'";
            $result = mysqli_query($conn,$sql) or die('couldnt run query');
            
            if(mysqli_num_rows($result) > 0)
            {
              $error = "<div class='alert alert-warning m-0 p-0' style='font-size:20px;background-color:yellow;' role='alert'>This user already exists!</div>";
            }
            else
            {
              $sql = "INSERT INTO usersdata(username,password,contactid,address,city,money,role,date,image) VALUE('{$uname}','{$upassword}','{$uemail}','{$uaddress}','{$ucity}',{$umoney},{$urole},'{$udate}','{$image_name}')";
              $result = mysqli_query($conn,$sql) or die("couldnt run query --> signup form");
                if($result)
                {
                  $error = "<div class='alert alert-success m-0 p-0' style='font-size:18px;' role='alert'>You've successfully signed up! Now do login!</div>";
                  mysqli_close($conn);
                }
            }
            echo json_encode(array('res'=>$error));

          }else{
            
            echo json_encode(array('res'=>"no data"));

          }
    

?>
