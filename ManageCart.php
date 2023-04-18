<?php
session_start();
include("connection.php");
include("functions.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){           //je Form theke value pacchi ta POST method dewa kina check kore
        
    if(isset($_POST['Add_To_Cart'])){               //Oi form er vitor Add_to_cart name e kono button set/press kora hoise kina check kore
        if(isset($_SESSION['cart'])){

            $myitems = array_column($_SESSION['cart'],'Item_name');
            if(in_array($_POST['Item_name'],$myitems)){
                echo"<script>
                    alert('Item Already Added!!!!!!!');
                    window.location.href='Menu.php';
                </script>"; 
            }

            else{
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array('Item_name'=>$_POST['Item_name'],'Item_price'=>$_POST['Item_price'],'Quantity'=>1);

                echo"<script>
                        alert('Item Added!');
                        window.location.href='Menu.php';
                    </script>";
            }

            
        
        }
        else{
            $_SESSION['cart'][0]=array('Item_name'=>$_POST['Item_name'],'Item_price'=>$_POST['Item_price'],'Quantity'=>1);
            //print_r($_SESSION['cart']);
            echo"<script>
                    alert('Item Added!');
                    window.location.href='Menu.php';
                </script>"; 
        
        }
    }

    if(isset($_POST['Remove_Item'])){              
        foreach($_SESSION['cart'] as $key => $value){ 
            //print_r($key);
            if($value['Item_name'] == $_POST['Item_name']){
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo"<script>
                    alert('Item Removed!!!');
                    window.location.href='Order.php';
                </script>";

            }


            
        }
    }
}

?>