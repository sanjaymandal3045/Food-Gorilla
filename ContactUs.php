<?php

  session_start();

  include("connection.php");
  include("functions.php");
  $count = 0;

  $user_data = Justcheck($con);
  if($user_data){
    $visibility = "display:none";
    $logoutButtonStatus = "";
    $available = "";
  }
  else{
    $available = "disabled";
    $logoutButtonStatus = "display:none";
    $visibility = "";
  }

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if( isset($_SESSION['user_id']) ){
      $user_id = $_SESSION['user_id'];
    }

    if( isset($_POST['contactusSend']) ){

      $fullname = $_POST['contactusname'];
      $email = $_POST['contactusemail'];
      $phone = $_POST['contactusnumber'];
      $message = $_POST['usermessage'];
      $rating = $_POST['rating'];

      //echo $fullname." ".$rating;

      if(!empty($fullname) && !empty($email) && !empty($phone) && !empty($message) && !empty($rating)){

        $query = "insert into userreviews(UserID,full_name,email,phone,review,rating) VALUES ('$user_id','$fullname','$email','$phone','$message','$rating')";
        mysqli_query($con,$query);
  
        //unset($_SESSION['cart']);
        echo"<script>
          alert('Thanks for ur Review!!!!!!!!!');
          window.location.href='index.php';
          </script>";
      }
      
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

        <link type="text/css" rel="stylesheet" href="CSS/Orderstylesheet.css"/>

        <link rel="stylesheet" href="CSS/all.min.css"/>
        
        <title>FoodGorillaContactus</title>
    </head>

    <body class="bodybg">
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
                  <li class="nav-item">
                    <a class="nav-link navitems" style="<?= $logoutButtonStatus?>" href="ViewOrderList.php">My orders</a>
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

          <div class="">
              <div class="container">
                  <div class="row contactus">
                      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 contactusbg">
                          <P class="contactushead">Contact Us</P>
                          <div class="contactusinfos">
                            <i class="cpontactusicons fas fa-map-marker-alt"></i>
                            <div class="contactusinfosp">
                                <p class="contactusheading mt-5">Address</p>
                                <p class="contactuspara">141 & 142, Love Rd, Dhaka 1208</p>
                            </div>
                          </div>
                          <div class="contactusinfos">
                            <i class="cpontactusicons fas fa-phone-alt"></i>
                            <div class="contactusinfosp">
                                <p class="contactusheading">Phone</p>
                                <p class="contactuspara">+880-1708-708708</p>
                            </div>
                          </div>
                          <div class="contactusinfos">
                            <i class="cpontactusicons fas fa-envelope"></i>
                            <div class="contactusinfosp">
                                <p class="contactusheading">Email</p>
                                <p class="contactuspara">xyz@gmail.com</p>
                            </div>
                          </div>
                      </div>


                      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 sendmessage">
                          <p class="contactushead">Send Message </p>
                          <div class="contactuspara pb-3" style="<?=$visibility?>">
                          <p>Please Login to give us a review.</p>
                          </div>
                          <form action=" "method="POST">
                            <div class="form-group mb-3"> 
                                <label class="contactuspara pb-3">Full Name</label>
                                <input type="text" placeholder="Enter your name" name="contactusname" value="" class="form-control" <?= $available?> />
                            </div>
                            <div class="form-group mb-3"> 
                                <label class="contactuspara pb-3">Email Address</label>
                                <input type="text" placeholder="Enter your email" name="contactusemail" value="" class="form-control" <?= $available?>/>
                            </div>
                            <div class="form-group mb-3"> 
                                <label class="contactuspara pb-3">Phone Number</label>
                                <input type="text" placeholder="Enter your number" name="contactusnumber" value="" class="form-control" <?= $available?>/>
                            </div>
                            <div class="form-group"> 
                              <label class="contactuspara pb-3">Enter Message</label>
                              <textarea name="usermessage" placeholder="Enter any message if you wish to"  class="form-control mb-4" <?= $available?>> </textarea>
                            </div>
                            <div class="form-group mb-3">
                              <label class="contactuspara pb-3">Ratings</label>
                              <input class='text-center iquantity' name="rating" placeholder="Rate us out of 5" onchange='' type='number' value='5' min='0' max= '5' <?= $available?>>
                            </div>
                            <div class="mb-3"> 
                                <input type="submit" name="contactusSend" value="SEND" class="btn " <?= $available?> />
                            </div>
                          </form>
                      </div>
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