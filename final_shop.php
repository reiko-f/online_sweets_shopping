<?php 
    include_once 'final_header.php';
    require_once 'includes/final_dbh.inc.php';
    
    if (isset($_POST['add_to_cart'])) {
        if (isset($_SESSION['cart'])) {
            $count = count($_SESSION['cart']);

            $item_array_id = array_column($_SESSION['cart'], 'item_id');

            if (!in_array($_GET['item_id'], $item_array_id)) {
                
                // pre_r($item_array_id);
                // pre_r($_SESSION);    

                $_SESSION['cart'][$count] = array(
                    'item_id' => $_GET['item_id'],
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'quantity' => $_POST['quantity']
                );
                
            } else {
                for ($i=0; $i < count($item_array_id); $i++) {
                    if ($item_array_id[$i] == $_GET['item_id']) {        
                        $_SESSION['cart'][$i]['quantity'] += $_POST['quantity'];
                    }
                }

            }
        } else {
            $_SESSION['cart'][0] = array(
                'item_id' => $_GET['item_id'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity']
            );
        }
    }            

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'delete') {
            foreach($_SESSION['cart'] as $key => $item) {
                if ($item['item_id'] == $_GET['item_id']) {
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
    }

    // $_SESSION['cart'] = array_values($_SESSION['cart']);

?>

<!DOCTYPE html>
<html lang="en">
    <head>   
        <style>
            body {
                color: gray;
                background-color: #CCFFFF; 
            }

            form {
                padding: 20px;                
                background-color: #FBFBF9;
            }
            
            img {
                width: 250px;
                height:250px;
                border-radius: 15px;
            }

            .btn-info {
                background-color: #FFFACD;
                border-radius: 5px;
            }

            .btn-info:hover {
                background-color: #FFF380;
            }

            h2 {
                padding-left: 70px;
            }

            h3 {
                padding-left: 100px;
            }

            #checkout {
                font-size: 1.2em;
                color: gray;
                background-color: #C3FDBA;
                width: 300px;
                height: 50px;
                margin-left: 120px;
            }

            #checkout:hover {
                background-color: #6AFB92;
                color: snow;
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
        <title>Shopping</title>
    </head>
    <body>        
        
    <?php
                
        if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
            echo '<h2>Hello, ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '!</h2>';                
        }       

    ?>

        <div class="container">
            <div class="row">

    <?PHP 
        // $connect = mysqli_connect('localhost', 'root', '', 'loginsystem') or die('Unable to connect' . mysqli_connect_error());
                                                
        $sql = "SELECT * FROM items ORDER BY item_id;";

        $result = mysqli_query($connect, $sql) or die("No Match Found . $sql");                     
        
        $count = mysqli_num_rows($result);           
        
    ?>        

            <h3>Our Menu</h3>
            <?php
            if ($result) {
                if ($count > 0) {
                    while ($item = mysqli_fetch_assoc($result)) {           
                        // print_r($item);
                    ?>
                    
                    <div class="col-sm-4 col-md-3">
                        <form action="final_shop.php?action=add&item_id=<?php echo $item['item_id']; ?>" method="POST">                            
                            <div class="items">
                                <img src="<?php echo $item['image']; ?>" class="img-responsive"><br>
                                <?php echo $item['name'];  ?><br>
                                $ <?php echo $item['price'];  ?><br><br>   
                                <label for="quantity"></label>
                                <input type="number" name="quantity" value=1 min=0 max=100>
                                <input type="hidden" name="name" value="<?php echo $item['name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $item['price']; ?>"><br>
                                <input type="submit" name="add_to_cart"  class="btn btn-info" value="Add to Cart">
                            </div>  
                        </form>
                    </div>
                            
                    <?php
                    }
                }
            } 
            ?>
            </div>
        </div>
        <br>

        <div style="clear:both"></div>
        <br>        
        <div class="table-responsive">        
            <table class="table table-bordered">
            <h3>Shopping Cart</h3>
                <th width="35%">Item Name</th>
                <th width="10%">Quantity</th>
                <th width="15%">Price</th>
                <th width="10%">Total Price</th>
                <th width="5%">Delete</th>
            </tr>

            <?php 
                if (!empty($_SESSION['cart'])) {
                    $total = 0;
                    foreach($_SESSION['cart'] as $key => $item) {
                    ?>
                        <tr>
                            <td><?php echo $item['name']?></td>
                            <td><?php echo $item['quantity']?></td>
                            <td>$ <?php echo $item['price']?></td>
                            <td>$ <?php echo number_format($item['price'] * $item['quantity'], 2)?></td>
                            <td><a href="final_shop.php?action=delete&item_id=<?php echo $item['item_id']?>"><div class="btn btn-danger">Delete</div></a></td>
                        </tr>
                        <?php
                            $total = $total + $item['price'] * $item['quantity'];
                    }        
                    ?>
                        <tr>
                            <td colspan="3" align="right">Total</td>
                            <th align="right">$ <?php echo number_format($total, 2);?></th>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                            <?php
                                if (isset($_SESSION['cart'])) {
                                    if (count($_SESSION['cart']) > 0) {                            
                            ?>
                            <a href="final_checkout.php" class="button"><button type="button" id="checkout" class="btn btn-primary btn-lg btn-block">Checkout</button></a>
                            

                            </td>
                        </tr>                            
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
            </table>
        </div>
    </body>
</html>
