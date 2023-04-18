<?php

    session_start();

    include("connection.php");
    include("functions.php");
    $count = 0;

    $user_data = Justcheck($con);
    if($user_data){
      $visibility = "display:none";
      $logoutButtonStatus = "";
    }
    else{
      $logoutButtonStatus = "display:none";
      $visibility = "";
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){     //Something was posted
      
      $user_name =  $_POST['username'];
      $password = $_POST['registeredpassword'];
      $full_name = $_POST['registeredname'];
      $contact = $_POST['registeredcontactno'];
      $email_address = $_POST['registeredemail'];

      
                          

      if(!empty($user_name) && !empty($password) && !empty($full_name) && !empty($contact) && !empty($email_address)){

        $query = "Select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);

        

        
        if($result && mysqli_num_rows($result)>0){

          ?>
            <script>
              alert("User already exists");
            </script>
          <?php 

        }

        else{
          $user_id = randomnum(20);      //generating unique user id for every user

          if(!empty($_FILES)){
            $destination = "IMAGES/upload/";
            $destination_file = $destination.basename($_FILES['pictureUploader']['name']);
      
            //if(file_exists($_FILES['pictureUploader']['name'])){
              $imageFileType = strtolower(pathinfo($_FILES['pictureUploader']['name'],PATHINFO_EXTENSION));
              $destination_file = $destination.$user_id.".".$imageFileType;
              move_uploaded_file($_FILES['pictureUploader']['tmp_name'],$destination_file);
            //}
          }


          $query = "insert into users (user_id,user_name,password,contact,email,full_name,pic) values ('$user_id','$user_name','$password','$contact','$email_address','$full_name','$destination_file')";
          mysqli_query($con, $query);
          header("Location: login.php");
          die;
        }
        
        

      } //save to database

      else{
        echo "Please enter valid info";
      }
    }

?>




<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

        <link type="text/css" rel="stylesheet" href="CSS/Orderstylesheet.css?version=1"/>

        <link rel="stylesheet" href="CSS/all.min.css"/>
        
        <title>FoodGorillaRegister</title>
    </head>

    <body class="registerbody">
    <nav class="navbar navbar-expand-lg navbg">
            <div class="container">
                    <a class="navbar-brand navigationlogo">
                    <img src="IMAGES/Logo/Foodgorilla.png" alt="" class="d-table">fOoD gOrIlLa</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
              </button>
              <div class="collapse navbar-collapse justify-content-between " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0 ">
                  <li class="nav-item">
                <a class="nav-link active navitems" aria-current="page" href="Index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navitems" href="Menu.php">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navitems" href="Order.php">Order</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navitems" href="AboutUs.php">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navitems" href="Team.php">Devs Corner</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navitems" href="ContactUs.php">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navitems" href="Register.php">Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navitems" style="<?= $visibility?>" href="Login.php">Log In</a>
              </li>
            </ul>
            <ul class="navbar-nav navsecond ml-auto">
                <?php
                        if(isset($_SESSION['cart'])){
                          $count = count($_SESSION['cart']);
                        }
                      ?>
                <li class="nav-item">
                    <a class="nav-link navitems2" href="Order.php"><i class="fas fa-shopping-cart">(<?php echo $count ?>)</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navitems2" href="UserProfile.php"><i class="fas fa-user"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navitems2" style="<?= $logoutButtonStatus?>" href="Logout.php"><i class="fas fa-sign-out-alt"></i></a>
                </li> 
            </ul>
          </div>
        </div>
      </nav>



          <div class="container">
              <div class="row">
                  <div class="col registerform">
                    <div>
                      <p class="registerheading">SIGN UP</p>
                    </div>
                      <form action=" " method="POST" enctype="multipart/form-data">
                          <div class="mb-4 mt-2">
                            <input type="text" placeholder="Full Name*" name="registeredname" value="" class="form-control" required/>
                          </div> 
                          <div class="mb-4 mt-2">
                            <input type="text" placeholder="Username*" name="username" value="" class="form-control" required/>
                          </div>
                          <div class="mb-4 mt-4">
                            <input type="email" placeholder="Email address*" name="registeredemail" value="" class="form-control" required/>
                          </div>
                          <div class="mb-4 mt-4">
                            <input type="text" placeholder="Contact No.*" name="registeredcontactno" value="" class="form-control" required/>
                          </div>
                          <div class="mb-4 mt-4">
                            <input type="password" placeholder="Password*" name="registeredpassword" value="" class="form-control" required/>
                          </div>
                          <div class="mb-4 mt-4">
                            <input type="file" name="pictureUploader" class="form-control" id="customFile" />
                          </div>
                        
                          <div>
                            <input type="submit" name="Registerconfirm" value="Register" class="registerbutton" onclick=""/>
                          </div>
                      </form>
                  </div>
              </div>
          </div>




          <div class="lastrow">
            <div class="container">
                <div class="row pt-4">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 lastpart">
                        <div class="lastpartwithlog">
                            <img src="IMAGES/Logo/Foodgorilla.png">
                            <p class="logopart">fOoD GoRiLla</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 lastpart  middlepart">
                      <div class="pt-3"><a class="middlepartdes" href="Index.php">Home</a></div>
                      <div class="pt-3"><a class="middlepartdes" href="Menu.php">Menu</a></div>
                      <div class="pt-3"><a class="middlepartdes" href="Order.php">Order</a></div>
                      <div class="pt-3"><a class="middlepartdes" href="AboutUs.php">About</a></div>
                      <div class="pt-3"><a class="middlepartdes" href="Team.php">Developers</a></div>
                      <div class="pt-3 pb-4"><a class="middlepartdes" href="ContactUs.php">Contact Us</a></div>
                  </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 lastpart middlepart">
                        <div class="pt-3 display-flex"><a href="https://www.facebook.com/foodpandaBangladesh/"><i class=" iconpartdes face fab fa-facebook"></i></a></div>
                        <div class="pt-3"><a href="https://www.instagram.com/foodpanda.bd/?hl=en"><i class="iconpartdes insta fab fa-instagram-square"></i></a></div>
                        <div class="pt-3"><a href="https://bd.linkedin.com/in/navid-sarwar"><i class="iconpartdes fab fa-linkedin-in"></i></a></div>
                        <div class="pt-3 pb-4"><a href="https://twitter.com/foodpandaglobal?lang=en"><i class=" twitt iconpartdes fab fa-twitter"></i></a></div>
                    </div>
                </div>
                <p class="copy">© All rights reserved by AUST CSE-42</p>
            </div>
        </div>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>









