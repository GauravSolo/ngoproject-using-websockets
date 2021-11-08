<?php
    session_start();
    if(!$_SESSION['id'])
    {
      include "config.php";
      header("Location: {$host}");
    }

     
    include "config.php";
    $sql3 = "SELECT * FROM usersdata WHERE user_id = {$_SESSION['id']}";
    $result3 = mysqli_query($conn,$sql3) or die("couldnt run query --> fetching data");

    if(isset($_GET['chat']))
    {
      $chat  = 1;
    }
    else{
      $chat = 0;
    }
    $rows3 = mysqli_fetch_assoc($result3);




    if(isset($_POST['submiteditvideo'])){
      $editvideo = $_POST['editvideo'];
      $videoid = $_POST['videoid'];
      $sql5 = "UPDATE videos SET videos = '{$editvideo}' WHERE video_id = {$videoid}";
      mysqli_query($conn,$sql5) or die("couldnt run query--> edit video");
      header("Location: {$host}admin/index.php");
    }
    if(isset($_POST['submitaddvideo'])){
      $addvideo = $_POST['addvideo'];
      $sql6 = "INSERT  INTO videos(videos) VALUE('{$addvideo}');";
      mysqli_query($conn,$sql6) or die("couldnt run query--> add video");
      header("Location: {$host}admin/index.php");
    }

    if(isset($_POST['submiteditdesc'])){
      $descvideo = $_POST['descvideo'];
      $desc = $_POST['desc'];
      $targetmoney = $_POST['targetmoney'];

      $sql9 = "UPDATE sitedata SET descvideo = '{$descvideo}',description = '{$desc}',targetmoney = {$targetmoney}";
      mysqli_query($conn,$sql9) or die("couldnt run query --> edit sitedata");
      header("Location: {$host}admin/index.php");
    }


    if(isset($_POST['submiteditcarousel'])){
      if(isset($_FILES['editcarouselimage']))
      {
        unlink("../upload/{$_POST['editcarousel']}");

        $file_name = $_FILES['editcarouselimage']['name'];
        $file_tmp = $_FILES['editcarouselimage']['tmp_name'];
        $exp  = explode('.',$file_name);
        $end = end($exp);
        $file_ext = strtolower($end);
        $extension = array('jpeg','jpg','png','svg');
        $new_name = time().'-'.basename($file_name);
        $error = "";

        if(in_array($file_ext,$extension) === false)
        {
          $error = "This extension file not allowed. Please choose a PNG,JPG or SVG";
        }

        $image_name = $new_name;
        $target = "";

        if($error == "")
        {
          $target = "../upload/".$image_name;
          move_uploaded_file($file_tmp,$target);        }
        else{
          $error = "something went wrong in uploading image!";
        }
        $sql8 = "UPDATE carousel SET carousel = '{$image_name}' WHERE carousel_id = {$_POST['carouselid']};";
        mysqli_query($conn,$sql8) or die("couldnt run query--> add carousel");
        header("Location: {$host}admin/index.php");
      }
    }

    if(isset($_POST['submitaddcarousel'])){
      if(isset($_FILES['addcarousel']))
      {
        $file_name = $_FILES['addcarousel']['name'];
        $file_tmp = $_FILES['addcarousel']['tmp_name'];
        $exp  = explode('.',$file_name);
        $end = end($exp);
        $file_ext = strtolower($end);
        $extension = array('jpeg','jpg','png','svg');
        $new_name = time().'-'.basename($file_name);
        $error = "";

        if(in_array($file_ext,$extension) === false)
        {
          $error = "This extension file not allowed. Please choose a PNG,JPG or SVG";
        }

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
        $sql8 = "INSERT  INTO carousel(carousel) VALUE('{$image_name}');";
        mysqli_query($conn,$sql8) or die("couldnt run query--> add carousel");
        header("Location: {$host}admin/index.php");
      }
    }



                                                                            
include "header.php";
?>
<script>
  var session = '<?php echo $_SESSION['mailid'];?>';
</script>

<div class="container-fluid px-0">
 
<div class="row ">
  <div class="col nav-bar">
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid px-0" >
            <a class="navbar-brand " href="../index.php"><img class="logo" src="../images/ngo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " style="z-index:9;" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item position-relative">
                  <a class="nav-link" href="../payment.php">Donate</a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link " href="https://www.buymeacoffee.com/gauravsolo" >Buy me a cup of coffee <i class="fas fa-mug-hot" style="color:rgb(68 50 41);"></i></a>
                </li>
              </ul>
              <form class="d-flex">
                <?php
                if($_SESSION['role']){
                ?>
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
                <?php }?>
                <a class="btn btn-warning form-control" href="../logout.php">Log Out</a>

              </form>
            </div>
          </div>
      </nav>
  </div>
</div>

<div class="row  m-0 position-relative" id="main-div">
    <div class="col-md-2 side-panel pe-0">
        <div class="row  head2 " >
            <div class="col-md-12 head">
                <div class="image">
                  <img src="../upload/<?php echo $rows3["image"];?>" id='pic' style="width:100%;height:100%;" alt="Here is image">
                </div>
            </div>
            <div class="name">
                    <h3 id="usr" ><?php echo $rows3["username"];?></h3>
                    <span id='usrmail' ><?php echo $rows3["contactid"];?></span>
            </div>
        </div>
        <div class="row">
            <div class="col ps-0">
                <ul class="nav nav-tabs flex-row flex-sm-column nav-fill" id="myTab" role="tablist">
                <?php 
                if($_SESSION['role'])
                {
                  ?>
                <li class="nav-item " role="presentation">
                    <button class="nav-link <?php echo ($_SESSION['role'] && !$chat )?"active":"";?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="<?php echo ($_SESSION['role'] && !$chat )?"true":"false";?>">Users</button>
                </li>
                <?php } ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?php echo (!$_SESSION['role'] && !$chat )?"active":"";?>" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="<?php echo (!$_SESSION['role'] && !$chat )?"true":"false";?>">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="update-tab" data-bs-toggle="tab" data-bs-target="#update" type="button" role="tab" aria-controls="update" aria-selected="false">Update</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?php echo ($chat)?"active":"";?>" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="<?php echo ($chat)?"true":"false";?>">Chats</button>
                </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-10 main-panel">
        <div class="row">
            <div class="col" >
                
                <div class="tab-content" id="myTabContent">

                  <?php
                  if($_SESSION['role']){
                    ?>
                    <div class="tab-pane fade <?php echo ($_SESSION['role'] && !$chat )?"show active":"";?> " id="home" role="tabpanel" aria-labelledby="home-tab">
                          <div class="table-responsive " style="margin-top:50px;">
                              <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Contactid</th>
                                        <th scope="col">address</th>
                                        <th scope="col">city</th>
                                        <th scope="col">money</th>
                                        <th scope="col">date</th>
                                        <th scope="col">edit</th>
                                        <th scope="col">delete</th>
                                      </tr>
                                    </thead>
                                    <tbody class="userstbody">
                                      <?php

                                        $sql = "SELECT * FROM usersdata";
                                        $result = mysqli_query($conn,$sql) or die("couldnt run query --> fetching data");

                                        if(mysqli_num_rows($result) > 0)
                                        {
                                          $i=0;
                                          while($rows = mysqli_fetch_assoc($result))
                                          {
                                      ?>                                    
                                      <tr>
                                        <th scope="row"><?php echo $i++; ?></th>
                                        <td data-id='<?php echo $rows['user_id'];?>'><?php echo $rows['username']; ?></td>
                                        <td data-id='<?php echo $rows['user_id'];?>'><?php echo $rows['password']; ?></td>
                                        <td data-id='<?php echo $rows['user_id'];?>'><?php echo $rows['contactid']; ?></td>
                                        <td><?php echo $rows['address']; ?></td>
                                        <td data-id='<?php echo $rows['user_id'];?>'><?php echo $rows['city']; ?></td>
                                        <td data-id='<?php echo $rows['user_id'];?>'><?php echo $rows['money']; ?></td>
                                        <td><?php echo $rows['date']; ?></td>
                                        <td class='edit' data-id='<?php echo $rows['user_id'];?>' ><a href="#" ><i class='fa fa-edit'></i></a></td>
                                        <td class='delete' data-id='<?php echo $rows['user_id'];?>'><a href="#" ><i class='fa fa-trash'></i></a></td>
                                      </tr>
                                      <?php }} ?>
                                    </tbody>
                                  </table>
                          </div>
                          <div class="row border-top border-bottom border-info">
                                  <div class="col" style="margin-top:50px;">
                                                  <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                          <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">video_id</th>
                                                            <th scope="col">video</th>
                                                            <th scope="col">edit</th>
                                                            <th scope="col">delete</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody id="videotbody">
                                                          <?php
                                                            $sql10 = "SELECT * FROM videos;";
                                                            $result5 = mysqli_query($conn,$sql10) or die("couldnt run query--> videos");
                                                            if(mysqli_num_rows($result5) > 0){
                                                              $i = 1;
                                                              while($row4 = mysqli_fetch_assoc($result5)){
                                                                
                                                          ?>
                                                          <tr>
                                                            <th scope="row"><?php echo $i++;?></th>
                                                            <td class="videoid" data-id="<?php echo $row4['video_id'];?>" ><?php echo $row4['video_id'];?></td>
                                                            <td class="viddo" data-id="<?php echo $row4['video_id'];?>" ><?php echo $row4['videos'];?></td>
                                                            <td class='edit' data-id="<?php echo $row4['video_id'];?>"  ><a href="#" data-id="<?php echo $row4['video_id'];?>" ><i data-id="<?php echo $row4['video_id'];?>" class='fa fa-edit'></i></a></td>
                                                            <td class='delete' data-id="<?php echo $row4['video_id'];?>"><a href="#" data-id="<?php echo $row4['video_id'];?>" ><i class='fa fa-trash' data-id="<?php echo $row4['video_id'];?>"></i></a></td>
                                                          </tr>
                                                          <?php }}?>
                                                          
                                                        </tbody>
                                                    </table>
                                                  </div>
                                  </div>
                                  <div class="col" style="margin-top:50px;">
                                                  <div class="table-responsive">
                                                  <table class="table table-striped">
                                                      <thead>
                                                        <tr>
                                                          <th scope="col">#</th>
                                                          <th scope="col">Descvideo</th>
                                                          <th scope="col">Description</th>
                                                          <th scope="col">TargetMoney</th>
                                                          <th scope="col">Tuser</th>
                                                          <th scope="col">edit</th>
                                                          <th scope="col">delete</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      <?php
                                                            $sql11 = "SELECT * FROM sitedata;";
                                                            $result6 = mysqli_query($conn,$sql11) or die("couldnt run query--> videos");
                                                            if(mysqli_num_rows($result6) > 0){
                                                              $i = 1;
                                                              while($row5 = mysqli_fetch_assoc($result6)){
                                                                
                                                        ?>
                                                        <tr>
                                                          <th scope="row"><?php echo ($i++);?></th>
                                                          <td class="descvideo" ><?php echo $row5['descvideo'];?></td>
                                                          <td class="description" ><?php echo $row5['description'];?></td>
                                                          <td class="targetmoney" ><?php echo $row5['targetmoney'];?></td>
                                                          <td class="tuser" ><?php echo $row5['total_user'];?></td>
                                                          <td class="edit descedit" ><a href="#" ><i class='fa fa-edit'></i></a></td>
                                                          <td class='delete deletedesc'><a href="#" ><i class='fa fa-trash'></i></a></td>
                                                          <?php
                                                        
                                                      }
                                                    }
                                                    echo "<script> 
                                                    document.querySelector('.descedit').onclick = ()=>{
                                                      // console.log('clicked');
                                                      var [descvideotd,description,targetmoneytd] = [...document.querySelectorAll('.descvideo,.description,.targetmoney')];
                                                      var [decsvideo,desc,targetmoney] = [...document.querySelectorAll('input[name=descvideo],input[name=desc],input[name=targetmoney]')];
                                                      // desc.value = description.innerText;
                                                      [decsvideo.value,desc.value,targetmoney.value] = [descvideotd.innerText,description.innerText,targetmoneytd.innerText];
                                                  
                                                    }
                                                    document.querySelector('.deletedesc').onclick = ()=>{
                                                    
                                                        const xhr = new XMLHttpRequest();
                                                        xhr.open('POST','deletedesc.php',true);
                                                        // xhr.setRequestHeader('Content-Type','multipart/formdata');
                                                        xhr.responseType = 'json';
                                                        xhr.onload = ()=>{
                                                            if(xhr.status === 200)
                                                            {
                                                                var res = xhr.response;
                                                                console.log(res);
                                                    
                                                            }
                                                        };
                                                    
                                                        const formdata = new FormData();
                                                    
                                                        xhr.send(formdata);
                                                    
                                                    }</script>";
                                                    ?>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </div>
                                  </div>
                                  <div class="col" style="margin-top:50px;">
                                                  <div class="table-responsive">
                                                  <table class="table table-striped">
                                                      <thead>
                                                        <tr>
                                                          <th scope="col">#</th>
                                                          <th scope="col">Carousel_Id</th>
                                                          <th scope="col">Carousel</th>
                                                          <th scope="col">edit</th>
                                                          <th scope="col">delete</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody id="carouseltbody">
                                                      <?php
                                                            $sql12 = "SELECT * FROM carousel;";
                                                            $result7 = mysqli_query($conn,$sql12) or die("couldnt run query--> videos");
                                                            if(mysqli_num_rows($result7) > 0){
                                                              $i = 1;
                                                              while($row6 = mysqli_fetch_assoc($result7)){
                                                                
                                                        ?>
                                                        <tr>
                                                          <th scope="row"><?php echo ($i++);?></th>
                                                          <td class="carouselid" data-id="<?php echo $row6['carousel_id'];?>"><?php echo $row6['carousel_id'];?></td>
                                                          <td class="carouselvideo" data-id="<?php echo $row6['carousel_id'];?>"><?php echo $row6['carousel'];?></td>
                                                          <td class='edit ' data-id="<?php echo $row6['carousel_id'];?>" ><a href="#" data-id="<?php echo $row6['carousel_id'];?>"><i data-id="<?php echo $row6['carousel_id'];?>" class='fa fa-edit'></i></a></td>
                                                          <td class='delete' data-id="<?php echo $row6['carousel_id'];?>"><a href="#" data-id="<?php echo $row6['carousel_id'];?>" ><i data-id="<?php echo $row6['carousel_id'];?>" class='fa fa-trash'></i></a></td>
                                                        </tr>
                                                        <?php }} ?>
                                                      </tbody>
                                                    </table>
                                                  </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-4" style="margin-top:50px;">
                                            <div class="row">
                                              <div class="col-12">
                                                  <form class="row g-3" action="index.php" method="POST">
                                                  <div class="col-sm-2">
                                                    <label for="videoid" class="form-label">video_id</label>
                                                    <input type="text" name="videoid" class="form-control pe-0 me-0" id="videoid" >
                                                  </div>
                                                  <div class="col-sm-10">
                                                    <label for="editvideo" class="form-label">video</label>
                                                    <input type="text" name="editvideo" class="form-control" id="editvideo" >
                                                  </div>
                                                  <div class="col-12">
                                                    <button type="submit" name="submiteditvideo" class="btn btn-primary">Edit</button>
                                                  </div>
                                                </form>
                                              </div>
                                              <div class="col-12">
                                                  <form class="row g-3" action="index.php" method="POST">
                                                  <div class="col-12">
                                                    <label for="addvideo" class="form-label">video</label>
                                                    <input type="text" name="addvideo" class="form-control" id="addvideo" >
                                                  </div>
                                                  <div class="col-12">
                                                    <button type="submit" name="submitaddvideo" class="btn btn-primary">Add</button>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                      </div>
                                      <div class="col-sm-4" style="margin-top:50px;">
                                                      <form class="row g-3" action="index.php" method="POST">
                                                      <div class="col-12">
                                                        <label for="descvideo" class="form-label">descvideo</label>
                                                        <input type="text" name="descvideo" class="form-control" id="descvideo" >
                                                      </div>
                                                      <div class="col-12">
                                                        <label for="desc" class="form-label">description</label>
                                                        <input type="text" name="desc" class="form-control" id="desc" >
                                                      </div>
                                                      <div class="col-12">
                                                        <label for="targetmoney" class="form-label">TargetMoney</label>
                                                        <input type="text" name="targetmoney" class="form-control" id="targetmoney" >
                                                      </div>
                                                      <div class="col-12">
                                                        <button type="submit" name="submiteditdesc" class="btn btn-primary">Edit</button>
                                                      </div>
                                                    </form>
                                      </div>
                                      <div class="col-sm-4" style="margin-top:50px;">
                                            <div class="row">
                                              <div class="col-12">
                                              <form class="row g-3" action="index.php" method="POST" enctype="multipart/form-data">
                                              <div class="col-sm-2">
                                                <label for="carouselid" class="form-label">carousel</label>
                                                <input type="text" name="carouselid" class="form-control" id="carouselid" >
                                              </div>
                                              <div class="col-sm-10">
                                                <label for="editcarousel" class="form-label">carousel</label>
                                                <input type="text" name="editcarousel" class="form-control" id="editcarousel" >
                                              </div>
                                              <div class="col-sm-12">
                                                <label for="editcarouselimage" class="form-label">change carousel</label>
                                                <input type="file" name="editcarouselimage" class="form-control" id="editcarouselimage" >
                                              </div>
                                              <div class="col-12">
                                                <button type="submit" name="submiteditcarousel" class="btn btn-primary">Edit</button>
                                              </div>
                                            </form>
                                              </div>
                                              <div class="col-12">
                                              <form class="row g-3" action="index.php" method="POST" enctype="multipart/form-data">
                                              <div class="col-12">
                                                <label for="addcarousel"  class="form-label">carousel</label>
                                                <input type="file" name="addcarousel" class="form-control" id="addcarousel" >
                                              </div>
                                              <div class="col-12">
                                                <button type="submit" name="submitaddcarousel" class="btn btn-primary">Add</button>
                                              </div>
                                            </form>
                                              </div>
                                            </div>
                                      </div>        

                                  </div>
                          </div>
                    </div>

                    <?php }?>

                    <div class="tab-pane fade <?php echo (!$_SESSION['role'] && !$chat )?"show active":"";?> " style="min-height:100vh;" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        
                                        
                    <div class="container">
                                          <div class="row d-flex flex-column flex-sm-row align-items-baseline justify-content-center" style="margin-top:80px;">
                                            <div class="col statistics ">

                                              <div class="card text-dark bg-info mb-3" style="max-width: 18rem;">
                                                <div class="card-header fs-4" style="color:#055160;">DONATED</div>
                                                <div class="card-body bg-info">
                                                  <h5 class="card-title fs-1" style="color:#fd8943;"><?php echo $rows3['money'];?> Rs</h5>
                                                  <?php
                                                   if($rows3['money'] != 0){
                                                  ?>
                                                    <p class="card-text fs-6">You helped many children from this amount .</p>
                                                  <?php
                                                   }else{
                                                   ?>
                                                   <p class="card-text fs-6">Do help children.</p>
                                                   <?php } ?>
                                                </div>
                                              </div>


                                            </div>

                                            <div class="col main-panel-div d-flex justify-content-center" >

                                              <div class="card text-dark bg-info mb-3 d-flex">
                                                <div class="card-header fs-4" style="color:#055160;">Acheivements</div>
                                                <div class="card-body bg-info px-0">
                                                  
                                                    <div class="main-wrapper1 flex-wrap card-title d-flex flex-column  flex-sm-row align-items-center align-items-sm-stretch justify-content-center flex-wrap">
                                                        <div class="badge silver">
                                                          <div class="circle"><i class="fa fa-user fa-street-view"></i></div>
                                                          <div class="ribbon">INITIATOR</div>
                                                        </div>  
                                                        <?php 
                                                        if($rows3['money']  != 0){
                                                          ?>
                                                        <div class="badge yellow">
                                                          <div class="circle"> <i class="fa fa-bolt"></i></div>
                                                          <div class="ribbon">Supporter</div>
                                                        </div>                    
                                                        <?php } ?>                                 
                                                    </div> 
                                                </div>
                                              </div>       
                                             </div>
                                            </div>



                                          <div class="row">
                                            
                                                  <div class="col">

                                                    <div class="main-wrapper">
                                                        <h1 style="border-bottom:2px solid black;color:#ed2d2d;"> BADGES </h1>
                                                        <div class="badge silver">
                                                          <div class="circle"><i class="fa fa-user fa-street-view"></i></div>
                                                          <div class="ribbon">INITIATOR</div>
                                                        </div>
                                                        <div class="badge yellow">
                                                          <div class="circle"> <i class="fa fa-bolt"></i></div>
                                                          <div class="ribbon">Supporter</div>
                                                        </div>
                                                      
                                                        <div class="badge red">
                                                          <div class="circle"> <i class="fa fa-shield"></i></div>
                                                          <div class="ribbon">Member</div>
                                                        </div>
                                                        <div class="badge purple">
                                                          <div class="circle"> <i class="fa fa-anchor"></i></div>
                                                          <div class="ribbon">Durable</div>
                                                        </div>
                                                        <div class="badge teal">
                                                          <div class="circle"> <i class="fa fa-bicycle"></i></div>
                                                          <div class="ribbon">Roamer</div>
                                                        </div>
                                                        <div class="badge blue">
                                                          <div class="circle"> <i class="fa fa-users"></i></div>
                                                          <div class="ribbon">Pusher</div>
                                                        </div>
                                                        <div class="badge blue-dark">
                                                          <div class="circle"> <i class="fa fa-rocket"></i></div>
                                                          <div class="ribbon">Escape</div>
                                                        </div>
                                                        <div class="badge green">
                                                          <div class="circle"> <i class="fa fa-tree"></i></div>
                                                          <div class="ribbon">Jungler</div>
                                                        </div>
                                                        <div class="badge green-dark">
                                                          <div class="circle"> <i class="fa fa-user fa-street-view"></i></div>
                                                          <div class="ribbon">Offlaner</div>
                                                        </div>
                                                        
                                                        <div class="badge gold">
                                                          <div class="circle"> <i class="fa fa-magic"></i></div>
                                                          <div class="ribbon">Support</div>
                                                        </div>
                                                    </div>
                                            
                                                  </div>


                                          </div>
                                        </div>

                                          </div>                  
                    <?php
                        $sql1 = "SELECT user_id,username,password,contactid,city,money FROM usersdata WHERE user_id = {$_SESSION['id']}";
                        $result1 = mysqli_query($conn,$sql1) or die("couldnt run query --> retrieve data");

                        if(mysqli_num_rows($result1) > 0){
                            $rows1 = mysqli_fetch_assoc($result1);
                    ?>
                    <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
                      <div class="row" id="sm">
                          
                      </div>
                      <div class="col-sm-4 mx-auto my-5">
                            <div class="row">
                              <div class="col mb-3">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="e-profile">

                                      <div class="tab-content pt-3">
                                        <div class="tab-pane active">
                                          <form class="form" method="post" id="form" enctype="multipart/form-data">
                                            <div class="row">
                                              <div class="col">
                                                
                                              <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                  <div class="mt-2">
                                                    <label class="text-start w-100 mb-3">Change Photo</label>
                                                    <br>
                                                    <button class="btn btn-primary" type="button">
                                                      <i class="fa fa-fw fa-camera"></i>
                                                      <span><input type="file" id="fileinput" name="profilepic"></span>
                                                    </button>
                                                  </div>
                                                </div>
                                              </div>


                                                <div class="row">
                                                  <div class="col-12  my-3">
                                                    <div class="form-group">
                                                      <label>Full Name</label>
                                                      <input class="form-control mt-2" type="text" name="uname" placeholder="" value="<?php echo $rows1['username'];?>">
                                                    </div>
                                                  </div>
                                                  
                                                </div>

                                                 <div class="row">
                                              <div class="col-12 my-3">
                                                <div class="row">
                                                  <div class="col">
                                                    <div class="form-group">
                                                      <label>New Password</label>
                                                      <input class="form-control mt-2" name="password" type="text" value="<?php echo $rows1['password'];?>">
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            
                                            </div>

                                                <div class="row">
                                                  <div class="col-12 my-3">
                                                    <div class="form-group">
                                                      <label>Email</label>
                                                      <input class="form-control mt-2" type="text" name="mail" data-ctd="<?php echo $rows1['user_id'];?>" placeholder="" value="<?php echo $rows1['contactid'];?>">
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            </div>

                                             <div class="row">
                                              <div class="col-12 my-3">
                                                <div class="row">
                                                  <div class="col">
                                                    <div class="form-group">
                                                      <label>City</label>
                                                      <input class="form-control mt-2" name="city" type="text" value="<?php echo $rows1['city'];?>">
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            
                                            </div>
                                            <?php

                                            if($_SESSION['role'] == '1'){
                                            ?>
                                             <div class="row">
                                              <div class="col-12 my-3">
                                                <div class="row">
                                                  <div class="col">
                                                    <div class="form-group">
                                                      <label>Money</label>
                                                      <input class="form-control mt-2" name="money" type="text" value="<?php echo $rows1['money'];?>">
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            
                                            </div>
                                            <?php }?>
                                           
                                            <div class="row">
                                              <div class="col d-flex justify-content-end">
                                                <button class="btn btn-primary submitupdate" type="submit">Save Changes</button>
                                              </div>
                                            </div>
                                          </form>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                        </div>
                    </div> 
                    <?php }?>
                    <div class="tab-pane fade  <?php echo ($chat)?"show active":"";?>" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                              


                  <div class="row" style="border:2px solid #ccc;">
                    <div class="col-12" id="chatbox" style="height:60vh;overflow-y:scroll;">
                                 
                    </div>

                    <div class="col-12">
                      <input type="hidden" id="<?php echo $_SESSION['id']; ?>" >
                      <input type="text" class="form-control d-inline-block me-0" id="sendinput" name="sendinput" style="width:85%;">
                      <button class="btn btn-primary d-inline-block ms-0 " id="sendbutton" name="sendbutton"  style="width:13%;">Send</button>
                    </div>
                  </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?php
include "footer.php";
?>