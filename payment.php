<?php
    
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="css/payment.css">
    <link rel="stylesheet" href="admin/css/styles.css">

    <title>ngo project</title>
  </head>
  <body>

  <div class="row ">
  <div class="col nav-bar">
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid px-0" >
            <a class="navbar-brand " href="index.php"><img class="logo" src="images/ngo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " style="z-index:9;" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link"  href="index.php">Home</a>
                </li>
                <li class="nav-item position-relative">
                  <a class="nav-link active" aria-current="page" href="payment.php">Donate</a>
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
                <?php if(isset($_SESSION['id'])){ ?>
                <a class="btn btn-warning form-control" href="logout.php" style="min-width:140px;height:50px; border-radius:5px;">Log Out</a>
                <?php }?>
              </form>
            </div>
          </div>
      </nav>
  </div>
</div>


  <div class="container bg-light d-md-flex align-items-center">
    <div class="card box1 shadow-sm p-md-5 p-md-5 p-4 order-3 order-sm-4">
        <div class="fw-bolder mb-4">
            <!-- <span class="fas fa-dollar-sign"></span> -->
            <span class="ps-1">Notice</span></div>
        <div class="d-flex flex-column">
            <!-- <div class="d-flex align-items-center justify-content-between text"> <span class="">Commission</span> <span class="fas fa-dollar-sign"><span class="ps-1">1.99</span></span> </div>
            <div class="d-flex align-items-center justify-content-between text mb-4"> <span>Total</span> <span class="fas fa-dollar-sign"><span class="ps-1">600.99</span></span> </div> -->
            <div class="border-bottom mb-4"></div>
            <div class="d-flex flex-column mb-4 " style="text-align:justify;" ><span class="ps-3" >*Right now payment gateway is not initiated We are developing .For now you'll have to send amount directly to given number. After receiving payment I will text you in chat box.</span> </div>
            <div class="d-flex flex-column mb-5"><span class="ps-3">22 july,2018</span> </div>
            <div class="d-flex align-items-center justify-content-between text mt-5">
                <div class="d-flex flex-column text"> <span>online chat 24/7</span> </div>
                
            </div>
        </div>
    </div>

    <div class="card box2 shadow-sm order-1 order-sm-5">
        <div class="d-flex align-items-center justify-content-between p-md-5 p-4"> <span class="h5 fw-bold m-0">Payment </span>
        </div>
        <ul class="nav nav-tabs mb-3 px-md-4 px-2">
            <li class="nav-item"> <a class="nav-link px-2 active" aria-current="page" href="#">Mobile Payment</a> </li>
        </ul>
        <div class="px-md-5 px-4 mb-4 ">
            <div class="row">
                <div class="number">
                    <span class="minus">-</span>
                    <input type="text" value="50"/>
                    <span class="plus">+</span>
                </div>
            </div>
        </div>
        <form action="">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-column px-md-5 px-4 mb-4"> <span class="mb-3">Phonepe | Paytm | Gpay</span>
                        <div class="inputWithIcon"> <input class="form-control fs-4" value="9548523294"  type="text" disabled> </div>
                    </div>
                </div>
               
                <div class="col-12">
                    <div class="d-flex flex-column px-md-5 px-4 mb-4"> <span>Or click on this <a href="https://instamojo.com/@gauravsolo" target="_blank" style="" >link</a></span>
                        <div class="inputWithIcon">  <span class="far fa-user"></span> </div>
                    </div>
                </div>
                <div class="col-12 px-md-5 px-4 mt-3">
                    <div class="btn btn-primary w-100 " style="opacity:.5;cursor:not-allowed;">Pay</div>
                </div>
            </div>
        </form>
    </div>
    
</div>
    


  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="script/paymentscript.js"></script>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js" ></script>  
</body>
</html>


<!-- <div class="btn btn-primary rounded-circle"><span class="fas fa-comment-alt"></span></div> -->