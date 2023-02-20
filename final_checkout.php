<?php 
    include_once 'final_header.php';
    require_once 'includes/final_dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>        
        <style>            
            body {                
                background-color: #E0FFFF;
                color: gray;
            }

            btn-info {
                background-color: #FFFACD;
                border-radius: 5px;
            }

            .btn-info:hover {
                background-color: #FFF380;
            }
            
            h3 {
                padding-left: 100px;
            }

            #order {
                
                font-size: 1.2em;
                color: gray;
                background-color: #FFFFC2;
                width: 300px;
                height: 50px;
                margin-left: 120px;
            }

            #order:hover {
                background-color: #FFF380;
                color: gray;
            }

            #ordering {
                text-align: center;
            }
                    
            table, th, tr, td {
                text-align: center;
                color: gray;
            }
            
            .btn-danger {
                color: gray;
                background-color: #FFCBA4;

            }

            .btn-danger:hover {
                color: snow;
                background-color: #EB5406;

            }
            
        </style>
        <title>Checkout</title>
    </head>
    <body>
        
        <?php 

            // $connect = mysqli_connect('localhost', 'root', '', 'loginsystem') or die('Unable to connect' . mysqli_connect_error());
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM users WHERE user_id = '$user_id';";
                $result = mysqli_query($connect, $sql) or die("No Match Found . $sql");           
                
                $count=mysqli_num_rows($result);

                    if ($count>=1) {
                
                    echo "<h2>Checkout</h2>";
                            
                    if (isset($_POST['order'])) {
                        unset($_SESSION['cart']);
                        echo "<p style='color:#F67280; font-size:2em'>{$_SESSION['username']}, thank you for shopping!</p>";
                        echo "<p>Logout <a href='includes/final_logout.inc.php'><button>Logout</button></a></p>";
                        echo "<p>Continue shopping? <a href='final_shop.php'><button>Shop</button></a></p>";
                    }
        ?>     
               
            <div style="clear:both"></div>
            <br>        
            <div class="table-responsive">        
                <table class="table table-bordered">
                <h3>User Information</h3>
                <tr>
                    <th>user_id</th>
                    <th>firstname</th>
                    <th>lastname</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>address</th>                        

                </tr>

        <?php 
                while($row = mysqli_fetch_assoc($result)) {                        
                    echo "<tr>";
                    echo "<td>{$row['user_id']}</td>";
                    echo "<td>{$row['firstname']}</td>";
                    echo "<td>{$row['lastname']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['phoneNumber']}</td>";  
                    echo "<td>{$row['address']}</td>";                
                    echo "</tr>";                 
                } 

                } else {
                    echo "Record Not Found";
                }
        ?>        
                
                </table>

                
        <?php
            } 
        
        ?>

        </table>
            
        <div style="clear:both"></div>
        <br>        
        <div class="table-responsive">        
            <table class="table table-bordered">
            <h3>Order Total</h3>
            <tr>                
                <th width="40%">Total Price</th>
            </tr>

         <?php
                if (!empty($_SESSION['cart'])) {
                    $total = 0;
                    foreach($_SESSION['cart'] as $key => $item) {
                    ?>
                        
                            <?php echo $item['name']?>
                            <?php echo $item['quantity']?>
                            <?php echo $item['price']?>
                            <?php echo number_format($item['price'] * $item['quantity'], 2)?>
                            <?php echo $item['item_id']?>
                        
                        <?php
                            $total = $total + $item['price'] * $item['quantity'];
                    }        
                    ?>
                        <tr>
                            <td colspan="3" align="right">Total</td>
                            <th align="right">$ <?php echo number_format($total, 2);?></th>
                            <td></td>
                        </tr>
                        
                            <?php
                                if (isset($_SESSION['cart'])) {
                                    if (count($_SESSION['cart']) > 0) {                            
                            ?>                                             
                         
                    </table>    
                    
                    <form id="ordering" action="final_checkout.php" method="POST">                        
                        <input type="submit" value="order" name="order" id="order" value="order" class="btn btn-primary btn-lg btn-block">
                    </form>
                        <?php
                                    }
                                }
                    }
                    

                    // function pre_r($array) {
                    //     echo '<pre>';
                    //     print_r($array);
                    //     echo '</pre>';
                    // }
                
            
    ?>    
    </body>
</html>




        