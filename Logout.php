<?php

    session_start();

    if(isset($_SESSION['user_id'])){
        unset($_SESSION['user_id']);
    }
    if(isset($_SESSION['cart'])){
        unset($_SESSION['cart']);
    }

    session_destroy();
    echo"<script>
        alert('Logged Out');
        window.location.href='Index.php';
    </script>"; 
    die;

?>