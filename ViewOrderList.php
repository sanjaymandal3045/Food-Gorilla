<?php
  session_start();

  include("connection.php");
  include("functions.php");
  $count = 0;
  $user_data = checklogin($con);
  if($user_data){
    $visibility = "display:none";
    $logoutButtonStatus = "";
  }
  else{
    $logoutButtonStatus = "display:none";
    $visibility = "";
  }
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['Remove_order_button'])){  

        $OrderID = $_POST['order_id'];

        $query = "DELETE FROM `placedorders` WHERE `placedorders`.`orderid` = $OrderID";
        $result = mysqli_query($con,$query);
        echo"<script>
            alert('Order Cancelled!!!');
            window.location.href='ViewOrderList.php';
        </script>";
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
        <title>FoodGorillaOrderPage</title>
    </head>

    <body>
<div class="bodybg">
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
            <li class="nav-item ">
                <a class="nav-link navitems2" style="<?= $logoutButtonStatus?>" href="Logout.php"><i class="fas fa-sign-out-alt"></i></a>
            </li> 
        </ul>
      </div>
    </div>
  </nav>


      <div class="container ">
          
          <div class="row allorders ">

            <div class="col-xl-12">
            <div class="table-responsive">
              <table class="table table-bordered ordertable mt-5">
                <thead>
                  <tr class="text-align-center">
                    <th scope="col" class="orderhead">Recipient</th>
                    <th scope="col" class="orderhead">Item Name</th>
                    <th scope="col" class="orderhead">Price</th>
                    <th scope="col" class="orderhead">Address</th>
                    <th scope="col" class="orderhead">Message</th>
                    <th scope="col" class="orderhead">Contact</th>
                    <th scope="col" class="orderhead"></th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <?php

                  if( isset($_SESSION['user_id']) ){
                    $user_id = $_SESSION['user_id'];
                  }

                  $query = "SELECT * From placedorders where UserID = $user_id";
                  $result = mysqli_query($con,$query);
                  while($row = mysqli_fetch_array($result)){
                    //echo $row['Items'];
                    
                    if(!empty($row['fullname'] && $row['contact'] && $row['address'] && $row['message']) && $row['totalprice']){
                      $recipient = $row['fullname'];
                      $Contact = $row['contact'];
                      $Address = $row['address'];
                      $Message = $row['message'];
                      $Items = $row['Items'];
                      $totalPrice = $row['totalprice'];
                      $orderid = $row['orderid'];

                      //echo $orderid;

                        echo"
                          <tr>
                            <td class='orderdatas'>$recipient</td>
                            <td class='orderdatas'>$Items</td>
                            <td class='orderdatas'>$totalPrice</td> 
                            <td class='orderdatas'>$Address</td> 
                            <td class='orderdatas'>$Message</td> 
                            <td class='orderdatas'>$Contact</td>
                            <td class='orderdatas'>
                            <form action='' method='POST'>
                              <button tupe='submit' name='Remove_order_button' class='plusMinusButton'> Cancel Order </button>
                              <input type='hidden' name='order_id' value=$orderid>
                            </form>
                            </td> 
                           </tr> 
                          ";

                      //}
                    }
                        
                  }
                  ?> 
                </tbody>
              </table>
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