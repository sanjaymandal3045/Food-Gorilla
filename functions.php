<?php

    function checklogin($con){                     //a function checking if the user is logged in

        if( isset($_SESSION['user_id']) ){          //checking if the value is set
            
            $id = $_SESSION['user_id'];
            $query = "select * from users where user_id = '$id' limit 1";        //now checking if the user really exist in our database
            
            $result = mysqli_query($con,$query);
            
            if($result && mysqli_num_rows($result)>0){              //checking is result is positive and number of rows >0 
                
                $user_data = mysqli_fetch_assoc($result);           //assoc = associative array
                return $user_data;
            }
        
        
        }

        //if none of the things happen above then redirect to login

        

        echo"<script>
                    alert('Please login first');
                    window.location.href='login.php';
                </script>";
        die;

    } 
    
    
    function Justcheck($con){                     //a function checking if the user is logged in

        if( isset($_SESSION['user_id']) ){          //checking if the value is set
            
            $id = $_SESSION['user_id'];
            $query = "select * from users where user_id = '$id' limit 1";        //now checking if the user really exist in our database
            
            $result = mysqli_query($con,$query);
            
            if($result && mysqli_num_rows($result)>0){              //checking is result is positive and number of rows >0 
                
                $user_data = mysqli_fetch_assoc($result);           //assoc = associative array
                return $user_data;
            }
        
        
        }

        //if none of the things happen above then redirect to login



    }
    
    function randomnum($length){
        
        $text = "";
        if($length<5){
            $length = 5;
        }

        $len = rand(4,$length);    //getting random number in length between 4 to $length 

        for($i = 0; $i<$len ;$i++){

            $text .= rand(0,9);     //generating different value lengths, .= Concatenation assignment
        }

        return $text;
    }

?>