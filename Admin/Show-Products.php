<?php
if (!isset($_COOKIE['shoes']) || $_COOKIE['shoes'] != '1' || !isset($_COOKIE['userType']) || $_COOKIE['userType'] != 'Administrator') {
    echo '
          <!DOCTYPE html>
          <html lang="ar">
          <head>
              <meta charset="UTF-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>خطأ في الصفحة</title>
              <link rel="stylesheet" href="../css/style.css">
          </head>
          <body>
              <div class="error-message">
                  <img src="../img/error.gif" width="350" alt="خطأ">
                  <h1>الصفحة غير موجودة</h1>
              </div>
          </body>
          </html>
      ';
    exit();
}
require "restaurant.php";
global $shoes;

$Show = "SELECT * FROM product";
$Rowbuy = mysqli_query($shoes, $Show);

session_start();

if (isset($_POST['addToCart'])) {
    // تأكد من أن السلة معرفة في الجلسة
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $Token = date("dmyhis");
    $RandNumber = rand(100, 200);
    $NewToken = $Token . $RandNumber;
    // إضافة المنتج إلى السلة
    $product = array(
        'product_name' => $_POST['productName'],
        'product_price' => $_POST['productPrice'],
        'product_img' => $_POST['productImg'], 'shop_token' => isset($_POST[$NewToken]) ? $_POST[$NewToken] : ''

    );

    array_push($_SESSION['cart'], $product);
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض المنتجات</title>
    <link href="CSS/Show-Products.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome/css/brands.css" rel="stylesheet">
    <link href="fontawesome/css/solid.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>


<body>
    <a href="index.php"><i class="fa-solid fa-angle-left" style="color: #4d0202; font-size: 3rem; padding-bottom: 2rem;cursor: pointer;"></i></a>
    <div class="search-container">
        <!-- حقل البحث مع الأيقونة -->
        <input type="text" id="searchInput" class="search-box" placeholder="ابحث هنا...">
        <span class="search-icon"><i class="fas fa-search"></i></span>
    </div>

    <div class="flex-container">
        <?php
        while ($row = mysqli_fetch_array($Rowbuy)) {
            echo '
            <div class="wrapper flex-item">
                <div class="container">
                    <div class="top"><img style="width: 200px;height: 200px;margin: 0px auto;display: flex;justify-content: center;align-items: center;" src="Site-management/IMG-AAdmin/' . htmlspecialchars($row['product_img']) . '" alt=""></div>
                    <div class="bottom">
                        <div class="details">
                            <h1 style="margin-left: 1rem;">' . htmlspecialchars($row['product_name']) . '</h1>
                            <p style="font-size: 1.5rem; margin-left: 1rem; margin-top: 0.5rem;">' . htmlspecialchars($row['product_price']) . '</p>
                        </div>
                        <form method="post">
                            <input type="hidden" name="productName" value="' . htmlspecialchars($row['product_name']) . '">
                            <input type="hidden" name="productPrice" value="' . htmlspecialchars($row['product_price']) . '">
                            <input type="hidden" name="productImg" value="' . htmlspecialchars($row['product_img']) . '">
                            <button type="submit" name="addToCart" class="add-to-cart-button">أضف إلى السلة</button>
                        </form>
                    </div>
                </div>
            </div>';
        }
        ?>

    </div>
    </div>

    <script src="Js/Show-Products.js"></script>

</body>

</html>