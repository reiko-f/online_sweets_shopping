<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

            body {
                margin: 25px;
                padding-left: 25px;
                font-family: 'Montserrat', sans-serif;
                background-color: #CCFFFF;
                color: gray;
                text-decoration: none;                                
            }

            .tab-container {               
                background-color: #7FFFD4;
            }

            .tabs {
                float: left;
                background-color: #DBF9DB;                
                width: 100px;
                height:30px;
                border: snow;
                text-align: center;
                list-style: none;
            }

            .tabs:hover {
                background-color: #B5EAAA;
            }

            ul {
                list-style-type: none;
            }

            a {
                color: gray;
                text-decoration: none;                
            }

            a:hover {
                color: gray;
            }
            
        </style> 
    </head>
    <body>
        <header>
            <nav id="tab-container">
                <ul>
                    <li class="tabs" name="home"><a href="final_index.php">Home</a></li>
                    <?php
                        if (isset($_SESSION['username'])) {
                            echo '<li class="tabs" name="logout"><a href="includes/final_logout.inc.php">Logout</a></li>';
                            echo '<li class="tabs" name="shop"><a href="final_shop.php">Shop</a></li>';
                        } else {
                            echo '<li class="tabs" name="login"><a href="final_login.php">Login</a></li>';
                            echo '<li class="tabs" name="register"><a href="final_register.php">Register</a></li>';
                            echo '<li class="tabs" name="shop"><a href="final_shop.php">Shop</a></li>';
                        }
                    ?>                    
                </ul>     
            </nav>
        </header>    
        <br><br>
    </body>
</html>