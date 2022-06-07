<?php 
    if (session_id() === '') 
    {
        session_start();
        $json = file_get_contents("product.json"); 
        $products = json_decode($json);
    }
    if(!$products)
    {
        echo 'Required Product.json';
        die();
    }
    
    if(isset($_GET['id'])){
        if(isset($_SESSION['cart']))
        {
            $hasOrder=false;
            foreach($_SESSION['cart'] as $c)
            {
                if($_GET['id'] == $c->id)
                {
                    $c->order += 1;
                    $hasOrder = true;
                }
            }if($hasOrder != true)
            {
                goto newProduct;
            }
        }else
        {   
            newProduct: 
            foreach($products as $p)
            {
                if($p->id == $_GET['id'])
                {
                    $temp = $p;
                    $temp->order+=1;
                    $_SESSION['cart'][]=$temp;
                }
            }
        }
        
    }
  
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopping</title>
        <!-- CSS only -->
        <style>
            .count{
                right: 221px;
                background-color: red;
                border-radius: 50%;
                height: 25px;
                width: 25px;
                text-align: center;
                position:absolute;  
            }
            .cart{
                cursor: pointer;
                position: relative;
            }
            
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-10">
                    <?php 
                        foreach($products as $p)
                        {    
                            echo '
                            <div class="card d-inline-block m-2" style="width: 18rem; ">
                            
                            <img src="img/iphonexsmax.jpg" class="img-fluid card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">'.$p->name.'</h5>
                                <p class="card-text">Ngày sản xuất: '.$p->create_at.'</p>
                                <p class="card-text">Số lượng: '.$p->amount.'</p>

                                <a href="?id='.$p->id.'" class="btn btn-primary">Thêm vào giỏ hàng</a>
                            </div>
                            
                            </div>
                            ';
                        }
                    ?>
                </div>
                <div class="col-2">
                    <div >
                    <?php 
                    if(isset($_GET['cart']))
                    {
                       echo' <image class="cart" src="img/icons8-buying-48.png" alt="icons8.com"></image>';
                    }else
                    {
                       echo' 
                        <image id="cart" class="cart"  src="img/icons8-buying-48.png" alt="icons8.com"></image>
                        ';
                        if(isset($_SESSION['cart'])) // * Xử lý biến đếm giỏ hàng
                        {
                            $dem = 0;
                            foreach($_SESSION['cart'] as $c)
                            {
                                 $dem += $c->order-1;
                            }
                            $dem += count($_SESSION['cart']) ;
                            echo '
                            <span class="count">'.$dem.'</span>
                            ';
                            
                        }else
                        echo '<span class="count">0</span>';
                    }
                    ?>
                   
                    </div>
                </div>
            </div>
            
        </div>
        <script type="text/javascript">
             document.getElementById("cart").onclick = function(){
                 location.href="cart.php"
             }
        </script>
    </body>
</html>