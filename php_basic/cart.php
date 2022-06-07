<?php 
    if (session_id() === '') session_start();
    
    if(isset($_GET['deleted']))
    {
        deleted();
    }

    function deleted()
    {
        if($_GET['deleted']=='all')
        unset($_SESSION['cart']);
        else
        {
            $index = 0;
          foreach($_SESSION['cart'] as $c)
          {
            if($c->id == $_GET['deleted'])
                array_splice($_SESSION['cart'],$index,1);
            $index += 1;    
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
        <title>Giỏ hàng</title>
        <!-- CSS only -->
       
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <a href="index.php" class="btn btn-primary">Trở về</a>
            <a href="?deleted=all" class="float-end btn btn-danger">Xóa toàn bộ</a>

            <div>
                    <?php 
                    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])  )
                    {
                        foreach($_SESSION['cart'] as $c)
                        {    
                            echo '
                            <div class="card d-inline-block m-2" style="width: 18rem; ">
                                <img src="img/iphonexsmax.jpg" class="img-fluid card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">'.$c->name.'</h5>
                                    <p class="card-text">Ngày sản xuất: '.$c->create_at.'</p>
                                    <p class="card-text">Số lượng: '.$c->order.'</p>
                                    <a href="?deleted='.$c->id.'" class="btn btn-danger">Xóa khỏi giỏ hàng</a>
                                </div>
                            </div>
                            ';
                        }
                    }else
                    {
                        echo 'Giỏ hàng trống';
                    }
                    ?>
            </div>
        </div>
    </body>
</html>