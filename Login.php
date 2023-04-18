<?php

    session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){     //Something was posted
      
      $user_name =  $_POST['user_name'];
      $password = $_POST['password'];


      
                          

      if(!empty($user_name) && !empty($password)){
        
        //reading from database

        $query = "Select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);

        if($result){
            if($result && mysqli_num_rows($result)>0){              //checking is result is positive and number of rows >0 
                
                $user_data = mysqli_fetch_assoc($result);           //assoc = associative array
                
                if($user_data['password'] === $password){

                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    
                    die;
                }
                else{
                    ?>
                        <script>
                            alert("Password not matched");
                        </script>
                    <?php 
                }
            }
            else{
                ?>
                    <script>
                        alert("Username does not exist");
                    </script>
                <?php 
              }

        } 

      } //save to database

      else{
        ?>
            <script>
                alert("Enter valid info");
            </script>
        <?php 
      }
    }

?>



<!DOCTYPE html>
<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

    <link type="text/css" rel="stylesheet" href="CSS/Orderstylesheet.css?version=1"/>
    
    <title>FoodGorilLaLoginPage</title>
</head>

<body class="bodybg">
    <div class="container">
        <div class="row rowbg pt-3 pb-3">
            <div class=" col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <img class="img-fluid"src="IMAGES/LoginBurger.jpg">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 formbox">
                <form action=" "method="POST">
                    <div class="loginlog">
                        <img src="IMAGES/Logo/Foodgorilla.png">
                    </div>
                    <div class="loginlogo">
                        <p class="loginfoodgorilla">fOoD gOrIlLa</p>
                    </div>
                    <div class="formbox welcome">
                        <p>WELCOME  !!</p>
                    </div>
                    <div class="formbox">
                        <p class="dont">Sign in with your email address and password.</p>
                    </div>
                    <div class="form-group formbox mb-3"> 
                        <label class="mb-3 formlabel">User Name</label>
                        <input type="text" placeholder="Enter your User Name" name="user_name" value="" class="form-control" required/>
                    </div>
                    <div class="form-group formbox mb-3"> 
                        <label class="mb-3 formlabel">Password</label>
                        <input type="password" placeholder="Enter your password" name="password" value="" class="form-control" required/>
                    </div>
                    <div class="formbox formbuto mb-3"> 
                        <input type="submit" name="Signin" value="Sign In" class="btn-secondary" />
                    </div>
                    <div class="signup formbox mb-3"> 
                        <p class="dont">Don't have an account??</p>
                        <a class="signupregi" href="Register.php">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>