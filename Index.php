<?php

    session_start();
    include("connection.php");
    include("functions.php");

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
    $count = 0;

    

?>


<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

        <link type="text/css" rel="stylesheet" href="CSS/Orderstylesheet.css?version=1"/>
        
        <title>FoodGorilLaLandingPage</title>
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
          
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <?php

                $query = "SELECT * From aboutustexts";
                $result = mysqli_query($con,$query);

                while($row = mysqli_fetch_array($result)){
                    $Itext1 = $row['IndexText1'];
                    $Itext2 = $row['IndexText2'];
                    $Itext3 = $row['IndexText3'];
                    $Itext4 = $row['IndexText4'];
                    $Itext5 = $row['IndexText5'];
                    $Itext6 = $row['IndexText6'];
                  }


              ?>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="IMAGES/Slide/Slide1.jpg" class="d-block w-100" alt="...">
                        <div class="container carousel-caption d-block d-md-block">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-8 slidedes">
                                    <p class="Slidehead"><?= $Itext1 ?></p>
                                    <p class="Slidepara"><?= $Itext2 ?></p>
                                    <button type="button" class="btn ordernowbutton"> 
                                        <a href="menu.php" class="ordernow">ORDER NOW</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="carousel-item">
                    <img src="IMAGES/Slide/Slide2.jpg" class="d-block w-100" alt="...">
                    <div class="container carousel-caption d-block d-md-block">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-8 slidedes">
                                <p class="Slidehead"><?= $Itext3 ?></p>
                                <p class="Slidepara"><?= $Itext4?></p>
                                <button type="button" class="btn ordernowbutton"> 
                                     <a href="menu.php" class="ordernow">ORDER NOW</a>
                                </button>
                            </div>
                        </div>
                    </div>
            </div>


            <div class="carousel-item">
                <img src="IMAGES/Slide/Slide3.jpg" class="d-block w-100" alt="...">
                <div class="container carousel-caption d-block d-md-block">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-8 slidedes">
                            <p class="Slidehead"><?=$Itext5?></p>
                            <p class="Slidepara"><?=$Itext6?></p>
                            <button type="button" class="btn ordernowbutton"> 
                                <a href="menu.php" class="ordernow">ORDER NOW</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>


                <p class=" food">Our Foods</p><!---------->


                <div class="container">
                    <?php
                    
                //$user_data = Justcheck($con);
                if($user_data){?>
                <div class="row">

                        <?php

                        $query = "SELECT * From products limit 4";
                        $result = mysqli_query($con,$query);

                        while($row = mysqli_fetch_array($result)){
                          
                            $afterDiscountedPrice = $row['Price'] - (($row['Price']*10)/100)?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 menuall">
                                <div class="Items">
                                    <img src= "<?= $row['image'] ?>">
                                    <form action="ManageCart.php" method="POST">

                                        <div class="allthings card-body">

                                            <div class="insider">
                                                 <p class="itemheading "><?= $row['title'] ?><p>

                                                 <p class="itemdes"><?= $row['description'] ?></p>

                                                 <p class="itemprize"><del><?= $row['Price'] ?></del> <?=$afterDiscountedPrice?> BDT (-10%)</p>

                                                <button type="submit" name="Add_To_Cart" class = "cartButton"> Add To Cart</button>

                                            </div>
                                                <input type="hidden" name="Item_name" value="<?=$row['title']?>">
                                                <input type="hidden" name="Item_price" value="<?=$afterDiscountedPrice?>">

                                        </div>  
                                      </form>
                                </div>    
                            </div>
                        <?php }                        
                      ?>
                </div>

            <?php }

              else{?>

              <div class="row">

              <?php

              $query = "SELECT * From products limit 4";
              $result = mysqli_query($con,$query);

              while($row = mysqli_fetch_array($result)){?>
                  <div class="col-12 col-sm-6 col-md-2 col-lg-3 col-xl-3 menuall">
                      <div class="Items">
                          <img src= "<?= $row['image'] ?>">

                          <form action="ManageCart.php" method="POST">
                              <div class="allthings card-body text-center d-flex flex-column align-items-center">
                                  <p class="itemheading text-center"><?= $row['title'] ?><p>
                                  <p class="itemdes text-center"><?= $row['description'] ?></p>

                                  <p class="itemprize text-center"><?= $row['Price'] ?> BDT</p>
                                  <button type="submit" name="Add_To_Cart" class = "cartButton"> Add To Cart</button>
                                  <input type="hidden" name="Item_name" value="<?=$row['title']?>">
                                  <input type="hidden" name="Item_price" value="<?=$row['Price']?>">
                              </div>  
                            </form>
                      </div>    
                  </div>
              <?php } 
              
              }
              ?>
                </div>

                <div class="container">
                <div class=" viewmore"> 
                        <p class="">VIEW MORE</p>
                        <i class="fas fa-long-arrow-alt-right arrow"></i>
                    </div>
                    <p class="browse">What our customers say !!!!!</p>
                </div>
                </div>
                
                
                
                <div class="container">
                    <div class="row">
                    <?php

                    $query = "SELECT * From userreviews";
                    $result = mysqli_query($con,$query);

                    while($row = mysqli_fetch_array($result)){
                        $user = $row['UserID'];
                        $query2 = "Select * from users where user_id = '$user' limit 1";
                        $result2 = mysqli_query($con, $query2);
                        if($result && mysqli_num_rows($result2)>0){
                            $user_data = mysqli_fetch_assoc($result2);
                            $pic = $user_data['pic'];
                        }
                        ?>
                        <div class="col-xl-4">
                            <div class="Reviewitems">
                                <img src="<?=$pic?>" class="rounded-circle">
                                <div>
                                <?php
                                $stars = $row['rating'];
                                for($i=0;$i<$stars;$i++){    ?>  
                                    <i class="fas fa-star"></i>
                                <?php }
                                ?>
                                </div>
                                <p class="Reviewitemsname"><?= $row['full_name']?> says</p>
                                <p class="Reviewitemsdes">"<?= $row['review']?> "</p>
                            </div>
                        </div>
                    <?php } 
                ?>
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