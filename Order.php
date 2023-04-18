<?php
  session_start();

  include("connection.php");
  include("functions.php");
  $user_data = checklogin($con);
  if($user_data){
    $visibility = "display:none";
    $logoutButtonStatus = "";
  }
  else{
    $logoutButtonStatus = "display:none";
    $visibility = "";
  }
  $price = 0;
  $count = 0;
  

  if($_SERVER['REQUEST_METHOD'] == "POST"){     //Something was posted
   

    if( isset($_SESSION['user_id']) ){
      $user_id = $_SESSION['user_id'];
    }


    $name =  $_POST['username'];
    $contact = $_POST['usercontact'];
    $useraddress = $_POST['useraddress'];
    $usermessage = $_POST['usermessage'];
    $finalTotal = $_POST['finalTotal'];

    //echo $user_id." ".$contact." ".$useraddress." ".$usermessage." ".$finalTotal;

    $i=1;
      $ItemNames="";
      foreach($_SESSION['cart'] as $x=>$z){

        $ItemNames .= $i.". ".$z['Item_name']."<br>"; 
        $i++; 

        
        
      }
    
    

    if(!empty($user_id) && !empty($contact) && !empty($useraddress) && !empty($usermessage) && !empty($finalTotal) && !empty($ItemNames)){

      $query = "insert into placedorders(UserID,fullname,contact,address,message,Items,totalprice) VALUES ('$user_id','$name','$contact','$useraddress','$usermessage','$ItemNames','$finalTotal')";
      mysqli_query($con,$query);

      unset($_SESSION['cart']);
      echo"<script>
        alert('Checked out');
        //window.location.href='Menu.php';
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
          
          <div class="row allorders">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="table-responsive">
              <table class="table table-bordered ordertable mt-5">
                <thead>
                  <tr class="text-align-center">
                    <th scope="col" class="orderhead">Serial No.</th>
                    <th scope="col" class="orderhead">Item Name and Description</th>
                    <th scope="col" class="orderhead">Base Price</th>
                    <th scope="col" class="orderhead">Quantity</th>
                    <th scope="col" class="orderhead">Total Price</th>
                    <th scope="col" class="orderhead"></th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <?php
                  if(isset($_SESSION['cart'])){
                    foreach($_SESSION['cart'] as $key => $value){
                      $serial = $key+1;
                  
                      //print_r($key);
                      echo"
                        <tr>
                          <td class='orderdatas'>$serial</td>
                          <td class='orderdatas'>$value[Item_name]</td>
                          <td class='orderdatas'>$value[Item_price]<input type='hidden' class='iprice' value='$value[Item_price]'</td>
                          <td class='orderdatas'>
                              <input class='text-center iquantity' onchange='subTotal()' type='number' value='$value[Quantity]' min='1' max= '20'>
                          </td>
                          <td class='itotal orderdatas'></td>
                          <td>
                            <form action='ManageCart.php' method='POST'>
                              <button name='Remove_Item' class='plusMinusButton'> REMOVE </button>
                              <input type='hidden' name='Item_name' value='$value[Item_name]'>
                            </form>
                          </td>
                         </tr> 
                        ";
                        
                    }
                  }
                  ?> 
                </tbody>
              </table>
            </div>
              </div>
            
            <form action="" method="POST">
            <div class="col-xl-12">
                <div class="mt-3 mb-3"> 
                  <label class="mb-2 orderhead">Recipient Name</label>
                  <input type="text" placeholder="Enter your name" name="username" value="" class="form-control" required/>
                </div>
              </div>
            

              <div class="col-xl-12">
                <div class=" mb-3"> 
                  <label class="mb-2 orderhead">Contact Number</label>
                  <input type="text" placeholder="Enter your contact number" name="usercontact" value="" class="form-control" />
                </div>
              </div>

              <div class="col-xl-12">
                <div class="mb-3"> 
                  <label class="mb-2 orderhead">Enter Address</label>
                  <textarea name="useraddress" placeholder="Enter your full address"  class="form-control" > </textarea>
                </div>
              </div>

              <div class="col-xl-12">
                <div class="mb-3"> 
                  <label class="mb-2 orderhead">Enter message</label>
                  <textarea name="usermessage" placeholder="Enter any message if you wish to"  class="form-control" > </textarea>
                </div>
              </div>
              <div class="col-xl-12" style="display:none">
                <div class=" mb-3"> 
                  <label class="mb-2 orderhead">Contact Number</label>
                  <input type="text" placeholder="Enter your contact number" id="finalTotal"name="finalTotal" value="" class="form-control" />
                </div>
              </div>

            <div class="col-xl-3 mb-4 pb-3">
              <div class="border bd-light rounded p-4 orderdatas d-flex flex-column align-items-center">
                <h5>Grand Total:</h5>
                <h3 class="text-center orderdatas"  id="gtotal"></h3>
                <br>
                <button type="submit" name="submitButton" class="orderButton" onclick="">Confirm Order</button>
              </div>
            </div> 
          </form>
            
          </div>
      
      </div>

    
      <div class="lastrow">
            <div class="container lastrowcol">
                <div class="row pt-4 ">
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

        <script>
          var gt=0;
          var iprice = document.getElementsByClassName('iprice');
          var iquantity = document.getElementsByClassName('iquantity');
          var itotal = document.getElementsByClassName('itotal');
          var gtotal = document.getElementById('gtotal');

          function subTotal(){
            

            gt=0;
            for(i=0;i<iprice.length;i++){
              itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);
              gt=gt+(iprice[i].value)*(iquantity[i].value);
            }
            gtotal.innerText=gt;
            var finalTotal= document.getElementById('gtotal').innerHTML;
            document.getElementById('finalTotal').value=finalTotal;
             console.log(finalTotal);

            
          
          }
      

          subTotal();
          
        </script>
    </body>
</html>