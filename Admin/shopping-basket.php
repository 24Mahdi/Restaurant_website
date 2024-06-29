<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$total = 0;

if (isset($_GET['delete_index'])) {
    $delete_index = $_GET['delete_index'];
    if (isset($cart[$delete_index])) {
        unset($cart[$delete_index]);
        $_SESSION['cart'] = $cart;
    }
}

require "restaurant.php";
global $shoes;

if (isset($_POST['get01'])) {
    $post02 = mysqli_real_escape_string($shoes, $_POST['get02']);
    $Token = date("dmyhis");

    // Insert query
    foreach ($cart as $index => $item) {
        // تأخير لمدة ثانية بين إضافة كل منتج
        sleep(1);

        $RandNumber = rand(100, 200);
        $NewToken = $Token . $RandNumber;

        $nameP = mysqli_real_escape_string($shoes, $item['product_name']);
        $priceP = mysqli_real_escape_string($shoes, $item['product_price']);
        $imgP = mysqli_real_escape_string($shoes, $item['product_img']);

        $insert_query = "INSERT INTO shop 
            (
                shop_token,
                shop_nameP,
                shop_priceP,
                shop_imgP,
                shop_qty,
                shop_phoneU
            ) VALUES (
                '$NewToken',
                '$nameP',
                '$priceP',
                '$imgP',
                '" . $_POST['quantity'][$index] . "',
                '$post02'
            )";
        if (mysqli_query($shoes, $insert_query)) {
            echo '
                <p>شكراً لك تم شراء المنتج بنجاح</p>
                <meta http-equiv="refresh" content="2; url=shopping-basket.php"/>
            ';
            unset($_SESSION['cart']);
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($shoes);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة المشتريات</title>
    <link href="CSS/shopping-basket.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome/css/brands.css" rel="stylesheet">
    <link href="fontawesome/css/solid.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <a href="index.php"><i class="fa-solid fa-angle-left" style="color: #4d0202; font-size: 3rem; padding-left: 2rem;cursor: pointer;"></i></a>
        <div class="wrap cf">
            <h1 class="projTitle">عربة التسوق</h1>
            <div class="cart">
                <ul class="cartWrap">
                    <?php
                    if (empty($cart)) {
                        echo '<li class="items odd"><div class="infoWrap"><div class="cartSection"><h3>السلة فارغة</h3></div></div></li>';
                    } else {
                        foreach ($cart as $index => $item) {
                            $total += $item['product_price'];
                            echo '
                        <li class="items odd">
                            <div class="infoWrap">
                                <div class="cartSection">
                                    <img src="Site-management/IMG-AAdmin/' . htmlspecialchars($item['product_img']) . '" alt="" class="itemImg" />
                                    <h3>' . htmlspecialchars($item['product_name']) . '</h3>
                                    <p class="itemPrice">' . htmlspecialchars($item['product_price']) . ' IQ</p>
                                    <input type="number" class="qty" name="quantity[' . $index . ']" value="1" min="1" />
                                </div>
                                <div class="prodTotal cartSection">
                                    <p>' . htmlspecialchars($item['product_price']) . ' IQ</p>
                                </div>
                                <div class="cartSection removeWrap">
                                    <a href="?delete_index=' . $index . '" class="remove">x</a>
                                </div>
                            </div>
                        </li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="subtotal cf" style="direction: rtl;">
                <ul>
                    <li class="totalRow"><span class="label">السعر</span><span class="value" id="price"><?php echo 'IQ ' . number_format($total, 2); ?></span></li>
                    <li class="totalRow"><span class="label">الشحن</span><span class="value" id="shipping">IQ 5.00</span></li>
                    <li class="totalRow final"><span class="label">المجموع</span><span class="value" id="total"><?php echo 'IQ ' . number_format($total + 5, 2); ?></span></li>
                    <li class="totalRow final"><span class="label">أدخل رقم الهاتف</span><span class="value"><input name="get02" required type="text" style="padding: 0.2rem;"></span></li>
                    <li class="totalRow"><button name="get01" type="submit" class="btn continue">شراء</button></li>
                </ul>
            </div>
        </div>
    </form>
</body>
<script src="JS/shopping-basket.js"></script>

</html>