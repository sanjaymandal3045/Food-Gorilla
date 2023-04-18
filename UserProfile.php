<?php

  session_start();

  include("connection.php");
  include("functions.php");
  $user_data = checklogin($con);
  $password;
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

  if( isset($_SESSION['user_id']) ){
    $user_id = $_SESSION['user_id'];
  }

  $query = "Select * from users where user_id = '$user_id' limit 1";
  $result = mysqli_query($con, $query);

  $setEnable = "disabled";

  if($result){
    if($result && mysqli_num_rows($result)>0){              //checking is result is positive and number of rows >0 
        
        $user_data = mysqli_fetch_assoc($result);
        $fullName = $user_data['full_name'];
        $email = $user_data['email'];
        $contact = $user_data['contact'];
        $userName = $user_data['user_name'];
        $password = $user_data['password'];
        $pic = $user_data['pic'];
        //echo $userName;
    }
  }

  if(isset($_POST['edit_button'])){
    $available='';
  }
  else{
    $available='disabled';
  }

  if(isset($_POST['UserProfileconfirm']) && isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    

    if($_POST['userprofilename']){
      $newName = $_POST['userprofilename'];
      //echo $_POST['userprofilename'];
    }
    else{
      $newName = $fullName;
    }

    if($_POST['userPassword']){
      $newPass = $_POST['userPassword'];
    }
    else{
      $newPass = $password;
      //echo $user_;
    }

    if($_POST['userprofileemail']){
      $newEmail=$_POST['userprofileemail'];
    }
    else{
      $newEmail=$email;
    }

    if($_POST['userprofilecontactno']){
      $newContact = $_POST['userprofilecontactno'];
    }
    else{
      $newContact = $contact;
    }

    if(!empty($_FILES)){
      $destination = "IMAGES/upload/";
      $destination_file = $destination.basename($_FILES['pictureUploader']['name']);

      //if(file_exists($_FILES['pictureUploader']['name'])){
        $imageFileType = strtolower(pathinfo($_FILES['pictureUploader']['name'],PATHINFO_EXTENSION));
        $destination_file = $destination.$user_id.".".$imageFileType;
        move_uploaded_file($_FILES['pictureUploader']['tmp_name'],$destination_file);
        $pic = $destination_file;
      //}

      
    }

    

    //if(!empty($_FILES)){
      $query2 = "UPDATE `users` SET `password`='$newPass',`contact`='$newContact',`email`='$newEmail',`full_name`='$newName',`pic`='$pic' WHERE `user_id` = '$user_id'";
      $result = mysqli_query($con,$query2);
      echo"<script>
          alert('Profile updated!!!');
          window.location.href='UserProfile.php';
      </script>";
      //echo $query2;
    //}
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
        
        <title>FoodGorillaUserProfile</title>
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
                    <a class="nav-link navitems" style="<?= $visibility?>" href="Register.php">Register</a>
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

          <div class="container userprofileform">
            
              <div class="row userprofileformrow">
                
                  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 userprofiledit0">
                    <div class="userprofileimage">
                      <!--<i class="fas fa-user"></i>-->
                      
                      <img src="<?php echo $pic?>" alt="Profile pic" class="">
                    </div>
                  </div>

                  
                  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 userprofiledit ">
                      <div class="userprofileheading mt-4">
                          <p class="userprofileheadinguser">User Profile</p>

                          <form action='UserProfile.php' method='POST'>
                            <button type="submit" name='edit_button' class='plusMinusButton'> EDIT </button> 
                          </form>

                      </div>
                      <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-4 mt-2 userprofilecontents">
                          <p class="userprofilelabels">Full Name</p>
                          <input type="text" placeholder=" <?php echo $fullName ?>" name="userprofilename" value="" class="form-control userformholders" <?=$available?>/>
                        </div>
                        <div class="mb-4 mt-2 userprofilecontents">
                          <label class="userprofilelabels">Email</label>
                          <input type="email" placeholder="<?php echo $email ?>" name="userprofileemail" value="" class="form-control userformholders" <?=$available?>/>
                        </div>
                        <div class="mb-4 mt-2 userprofilecontents">
                          <label class="userprofilelabels">Contact No.</label>
                          <input type="text" placeholder="<?php echo $contact ?>" name="userprofilecontactno" value="" class="form-control userformholders" <?=$available?>/>
                        </div>
                        <div class="mb-4 mt-2 userprofilecontents">
                          <label class="userprofilelabels">Password</label>
                          <input type="password" placeholder="<?php echo $password ?>" name="userPassword" value="" class="form-control userformholders" <?=$available?>/>
                        </div>
                        <div class="mb-4 mt-2 userprofilecontents">
                          <label class="userprofilelabels">User Name:</label>
                          <input type="text" placeholder="<?php echo $userName ?>" name="username" value="" class="form-control userformholders" disabled/>
                        </div>


                        <div class="mb-4 mt-2 userprofilecontents">
                        <label class="userprofilelabels">Picture:</label>
                        <input type="file" name="pictureUploader" class="form-control userformholders" id="customFile" <?=$available?> />
                        </div>


                        
                        <div class="userprofileallbuttons">
                          <button type="submit" name="UserProfileconfirm" value="Save changes" class="savechangesbutton" onclick=" " <?=$available?>> submit</button>
                          <!--<input type="submit" name="UserProfilePasswordChange" value="Change Password" class="passwordchangebutton" onclick=" "/>-->
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









