<?php
    include_once 'final_header.php';   
?>

<!DOCTYPE html>
<html lang="en">
    <head>        
        <style>      
        
            body {
                background-color: #FFDDCA;
            }

            h1 {
                font-size: 3em;
            }

            img {                
                margin-top: 100px;
                height: 400px;
                opacity: 0.7;
            }           
            
        </style>
        <title>Shop Home</title>
    </head>
    <body>    
        <div>
            <?php   
                if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
                    echo '<h2>Hello, ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '!</h2>';                
                } 
            ?>
        </div>

        <h1>Welcome to our cafe!</h1>

        <div id="bg">
            <img src="final_photos/shop_front.jpg">
        </div>
    </body>
</html>