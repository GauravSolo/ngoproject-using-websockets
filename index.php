<?php
  include "header.php";
  
include "config.php";
session_start();

if(isset($_SESSION['id']))
    $logout = 1;
  else
    $logout = 0;

  if(!isset($_COOKIE['user']))
  {
    setcookie('user','yes',time()+(60*60*24*30));
    mysqli_query($conn,"UPDATE sitedata SET total_user=total_user+1");    
  }

    $ip = $_SERVER['REMOTE_ADDR'];
    if($ip != ""){
          $sqlip = "SELECT * FROM addresses WHERE ip = '{$ip}'";
          $result = mysqli_query($conn,$sqlip) or die("couldnt run query--> ipaddress");
          
          if(mysqli_num_rows($result) == 0)
          {
            $sqladd = "INSERT INTO addresses(ip) VALUE('$ip');";
            mysqli_query($conn,$sqladd) or die("couldnt run query --> address");
          }
    }

?>    

  <!-- signupmodal -->
      <div class="container-fluid outerdiv">
       <div class="row">
           <div class="col mx-auto formcol">
               <form  method="POST" class="signupform" id='ff' enctype="multipart/form-data" >
                   <button type="button" class="btn-close" aria-label="Close"></button>
                   <div class="row">
                       <div class="col">
                           <h1 class="text-primary text-center"> SignUp</h1>
                       </div>
                   </div>                    
                     <div id="sm">
                 
                       <!-- <iframe name="signupframe" id="signupframe" sandbox="allow-same-origin allow-scripts allow-popups allow-forms"  frameborder="0" class="src  w-100"  height="40" scrolling="no"></iframe> -->
                   </div>
                   <div>
                       <label for="inputuesrname" class="form-label">Name</label>
                       <input type="text" name="inputusername" class="form-control" id="inputusername" required>
                   </div>
                   <div>
                       <label for="inputemail" class="form-label">
                           Email or Phone
                       </label>
                      <input type="text" name="inputemail" class="form-control" id="inputemail" required>
                    </div>
                   <div>
                       <label for="inputpassword" class="form-label">Password</label>
                       <input type="password" name='inputpassword' class="form-control" id="inputpassword" required>
                   </div>
                   <div>
                       <label for="inputcity" class="form-label">City</label>
                       <select class="form-select" style="position:absolute;" onchange="this.nextElementSibling.value=this.value" aria-label="Default select example">
                        <option value="4">ALIGARH</option>
                        <option value="1">Hathras</option>
                        <option value="2">Agra</option>
                        <option value="3">Delhi</option>
                        </select>
                        <input type="text" name='select' style="position:relative; left:1px; margin-right: 25px;" value="Aligarh" class="form-control">
                   </div>
                   <div>
                   <label class="form-label" for="inputGroupFile02">Upload photo (optional)</label>
                   <div class="input-group mb-3">
                    <input type="file" name="profilepic" class="form-control" id="inputGroupFile02" >
                  </div>
                </div>
                   <div>
                       <button type="submit" name='signupsubmit' class="btn btn-primary form-control">Submit</button>
                   </div>
                   <div class="form-text text-center">Already signed up ? <a href="#"  class="text-primary logbutton">log in</a></div>
               </form>
           </div>
        </div>
      </div>

    <!-- login -->
    <div class="container-fluid outerdiv">
       <div class="row">
           <div class="col mx-auto formcol">
              
               <form  method="POST" class="signupform loginform" id='ll'>
                   <button type="button" class="btn-close" aria-label="Close"></button>
                   <div class="row">
                       <div class="col" >
                           <h1 class="text-primary text-center"> Log In</h1>
                       </div>
                   </div>
                   <div id="lm"> 
                   
                  </div>
                   <div>
                       <label for="inputnameemail" class="form-label">Email</label>
                       <input type="text" name='inputnameemail' class="form-control" id="inputnameemail" required>
                   </div>
                    <div>
                       <label for="inputuserpassword" class="form-label">Password</label>
                       <input type="password" name='inputuserpassword' class="form-control" id="inputuserpassword" required>
                   </div>
                   <div>
                       <button type="submit" name='loginsubmit' class="btn btn-primary form-control">Log in</button>
                   </div>
                   <div  class="form-text text-center">Create Account! <a href="#" class="text-primary logbutton">Sign up</a></div>
               </form>
           </div>
        </div>
    </div>
      
        <!-- carousel -->
      <div class="row " id="carousel">
              <div class="col-12 navcar">
                <div class="row">
                  <div class="col p-0">
                <!-- navbar -->
                      <nav class="navbar navbar-expand-lg navbar-light container">
                            <div class="container p-0">
                              <a class="navbar-brand" href="#"><img class="logo" src="images/ngo.png" alt=""></a>
                              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                              </button>
                              <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
                                <ul class="navbar-nav text-center" id="nav" >
                                  <?php

                                  if(isset($_SESSION['id'])){
                                    ?>
                                  <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="admin/index.php">Profile</a>
                                  </li>
                                  <?php
                                  }else{
                                    ?>
                                    <li class="nav-item">
                                    <a class="nav-link " aria-current="page" href="index.php">Home</a>
                                  </li>
                                  <?php }                              
                                  ?>
                                  <li class="nav-item me-sm-3 forum">
                                    <a class="nav-link position-relative" id="sign" href="<?php echo isset($_SESSION['id'])?'admin/index.php?chat=1':'#';?>">
                                        Forum
                                        <span class="position-absolute top-0 start-md-100 translate-middle badge rounded-pill bg-danger" style="font-size:.5rem;">
                                          new
                                        </span>      
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="payment.php">Donate</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link"  id="about" href="#!">
                                      About
                                    </a>
                                  </li>
                                  <?php 
                                  
                                  if($logout){
                                    ?>
                                  <li class="nav-item">
                                    <a class="nav-link"  href="logout.php">
                                      Log out
                                    </a>
                                  </li>
                                  <?php  }?>
                                </ul>
                              </div>
                            </div>
                      </nav>
                    </div>
                </div>
              </div>
        <div class="col-12" style="padding: 0;">
          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <!-- <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div> -->

            <div class="carousel-inner" >
                <?php
                    // include "config.php";
                    $sql4 = "SELECT * FROM carousel";
                    $result4 = mysqli_query($conn,$sql4) or die("couldnt run query--> rows");
                    $i = 1;
                    $active = "active";
                    $active = "";
                    while($row4 = mysqli_fetch_assoc($result4)){

                ?> 
                      <div class="carousel-item <?php echo ($i==1)?"active":""; ?> " data-bs-interval="3000">
                        <img src="upload/<?php echo $row4['carousel']; ?>" class="d-block " >
                      </div>
                      
                  <?php $i++; } ?>
            </div>

            <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button> -->
          </div>
        </div>
      </div>
      
      
  <div class="container">
      <!-- description -->
      <?php
        // include "config.php";
        $sql2 = "SELECT * FROM sitedata";
        $result2 = mysqli_query($conn,$sql2) or die("couldnt run query--> rows");
        $row2 = mysqli_fetch_assoc($result2);

      ?> 
      <div class="row justify-content-md-between" id="description">
        <div class="col-md-auto my-2 mx-auto" id="video"> 
          <!-- <video  class="my-2 w-75" controls loop
          src="videos/bird_small_animal_feathers_river_679.mp4">
        </video> -->
        <iframe class="my-2 mx-auto" src="<?php echo $row2['descvideo']; ?> " title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="col-lg-7 px-4 mx-auto" id="desc">
        <h4 >description</h4>
        <span class="overflow-auto d-block h-75">
        <?php echo $row2['description']; ?>
        </span>
      </div>
      
      </div>
    
    
    
    <!-- progressbar -->
      <?php
        // include "config.php";
        $sql1 = "SELECT COUNT(money) FROM usersdata WHERE money >= 0";
        $result1 = mysqli_query($conn,$sql1) or die("couldnt run query--> rows");
        $row = mysqli_fetch_array($result1);

        $sql4 = "SELECT SUM(money) AS funds FROM usersdata";
        $result4 = mysqli_query($conn,$sql4) or die("couldnt run query--> money");
        $data = mysqli_fetch_assoc($result4);
                              
      ?> 
    <div class="row" id="progressbar">
      <div class="col-lg-6 ">
        <div class="row" id="progressparent">
          <div class="col-12" id="customprogress">
            <h3>On Going</h3>
            <div class="progress" style="height:10px; border-radius:100px;">
              <div class="progress-bar progress-bar-animated progress-bar-striped" style="border-radius:100px;width:50%;" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="col-12 <?php echo !$_SESSION['role']?'target':''; ?>" id="targetparent">
            Raised <span class="percentage"><?php echo $data['funds']; ?> Rs</span>
            <span class="float-end">Target <span id="target"><?php echo $row2['targetmoney']; ?></span> Rs</span>
        </div>
      </div>
    </div>
      <div class="col-lg-6 my-lg-5 fs-1" >
        <div class="row h-100" id='progressbarmargin'>
          <div class="col text-center my-auto">
            <h3>
              Members
            </h3> 
            <span class="d-block ">
              <?php echo $row[0]; ?>
            </span>
          </div>
          
          <div class="col-6 text-center my-auto" >
            <h3>
              Total Fund Raised 
            </h3>
            <span class="d-block">
              <?php echo $data['funds']; ?>  Rs
            </span>
          </div>
        </div>
      </div>
    </div>
    
    
    <!-- Our Work -->
    <div class="row" id="ourwork">
      <div class="col-12 text-center my-3 fs-3 text-uppercase fw-bold">
        Our Work
      </div>
      <!-- Swiper -->
      <div class="col">
    <div class="swiper mySwiper">
          <div class="swiper-wrapper">
                <?php
                    // include "config.php";
                    $sql3 = "SELECT * FROM videos";
                    $result3 = mysqli_query($conn,$sql3) or die("couldnt run query--> rows");
                    while($row3 = mysqli_fetch_assoc($result3)){

                ?> 

                <div class="swiper-slide"><iframe  class="my-2 mx-auto" src="<?php echo $row3['videos']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <?php } ?>
            </div>
          <div class="swiper-pagination"></div>
        </div>
        </div>
    </div>
    
    <!-- our team -->
    <div class="row" id="ourteam">
       <div class="col-12 text-center my-3 fs-3 text-uppercase fw-bold">
        Our team
      </div>
      <div class="cards">
        <div class="carditem">
            <div class="image">
                <div class="img">
                    <img src="images/Gaurav.jpg">
                </div>
            </div>
            <div class="info">
                <div class="desc">
                    <h2>Gaurav Sharma</h2>
                    <span>Web developer</span>
                </div>
                <div class="links">
                    <ul>
                      <!-- <li><a href="https://www.instagram.com/gaurav_solo/?hl=en" style ="color:#1a74ec;" target="_blank"><i class="fab fa-facebook"></i></a></li> -->
                      <li><a href="https://www.instagram.com/gaurav_solo/?hl=en" style ="color:#e02a73;" target="_blank"><i class="fab fa-instagram"></i></a></li>
                      <li><a href="https://twitter.com/Gaurav_Solo" style ="color:#059aed;" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="carditem">
            <div class="image">
              <div class="img">
                <img src="images/img.jpg">
              </div>
            </div>
            <div class="info">
                <div class="desc">
                  <h2>Gajendra</h2>
                    <span>Worker</span>
                </div>
                <div class="links">
                    <ul>
                        <li><a href="https://getbootstrap.com/docs/5.0/components/carousel/" style ="color:#1a74ec;" target="_blank"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="https://www.youtube.com/watch?v=60ItHLz5WEA" style ="color:#e02a73;" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- faq -->
    <div class="row">
      <div class="col">
      <div class="row" id="faq">
        <div class="col-12 text-center fs-2" >
          FAQ
        </div>
        <div class="col">
          <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          Which type of NGO is this?
        </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">This NGO created for helping poor children who cant efford money for clothes and food.We have seen many girls who had torn clothes.</div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingTwo">
        <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
          How can I contribute?
        </button>
      </h2>
      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">You can help poor children by send only 30 rs per month. It is just 1rs per day.</div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingThree">
        <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
          How would I know where my money is going?
        </button>
      </h2>
      <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">For that we have a page to show history of our transaction where have we spent money and we will capture a photo of every charity every time </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingThree">
        <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
          What are payment methods?
        </button>
      </h2>
      <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">You can join patreon page or you can also send through paytm ,phonepe,gpay</div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingFive">
        <button class="accordion-button collapsed bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
          I am facing problem in payment process!
        </button>
      </h2>
      <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">send message at this gmailid or you can simply message in chat box of this site</div>
      </div>
    </div>
  </div>
      </div>
    </div>


    <span style="color:yellow;font-size:25px;text-align:center;display:block;">Supporters</span>
      <marquee width="100%" direction="left" height="40px" style="border:2px dashed #fff30d;color:#48fd00; display:flex; align-items:center;font-weight:bold;">
        <ul style="display:flex;list-style:number;width:300px;justify-content:space-between;">
        <?php 
           $sqls = "SELECT username,money FROM usersdata WHERE money > 0;";
           $results = mysqli_query($conn,$sqls) or die("couldnt run query--> supporters");
           while($rowss = mysqli_fetch_assoc($results)){
        
                echo "<li>".$rowss['username']." ".$rowss['money']."rs</li>";

            }
            ?>
        </ul>
      </marquee>
    <!-- footer -->
    <div class="row">
      <div class="col">

   
      
        <footer class="text-center text-white">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-3" id="footer">
      <!-- Facebook -->
      <a
        class="btn btn-primary btn-floating m-1"
        style="background-color: rgb(255 66 77);"
        href="#!"
        role="button"
        ><i class="fab fa-patreon"></i></a>

      <!-- Twitter -->
      <a
        class="btn btn-primary btn-floating m-1"
        style="background-color: #55acee;"
        href="https://twitter.com/Gaurav_Solo"
        role="button"
        ><i class="fab fa-twitter"></i
      ></a>

      <!-- Google -->
      <a
        class="btn btn-primary btn-floating m-1"
        style="background-color: #dd4b39;"
        href="#!"
        role="button"
        ><i class="fas fa-mug-hot"></i></a>

      <!-- Instagram -->
      <a
        class="btn btn-primary btn-floating m-1"
        style="background-color: #ac2bac;"
        href="https://www.instagram.com/gaurav_solo/?hl=en"
        role="button"
        ><i class="fab fa-instagram"></i
      ></a>
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center py-3 bg-secondary" id="footabout" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2021 Copyright:
    <a class="text-white" href="#">GauravSolo</a>
  </div>
  <!-- Copyright -->
</footer>
      </div>
    </div>
      </div>
    </div>


    
  </div>

  <?php
    include "footer.php";
  ?>