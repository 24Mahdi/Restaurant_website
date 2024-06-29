<?php
if (!isset($_COOKIE['shoes']) || $_COOKIE['shoes'] != '1' || !isset($_COOKIE['userType']) || $_COOKIE['userType'] != 'ClassTeacher') {
    echo '
    
    <link href="CSS/style.css" rel="stylesheet"/>
    <div class="style12">
    </div>
    <meta http-equiv="refresh" content="0; url=../Login.php">
';
    exit();
}

require "restaurant.php";

// Check if the connection is successful
if (!$shoes) {
    die("Connection failed: " . mysqli_connect_error());
}

$Show = "SELECT * FROM recipe";
$Rowbuy = mysqli_query($shoes, $Show);

// Check if the query was successful
if (!$Rowbuy) {
    die("Query failed: " . mysqli_error($shoes));
}

?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الوصفات</title>
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
    <a href="index.php"><i class="fa-solid fa-angle-left" style="color: #4d0202; font-size: 3rem; padding-bottom: 2rem; cursor: pointer;"></i></a>
    <div class="search-container">
        <input type="text" id="searchInput" class="search-box" placeholder="ابحث هنا...">
        <span class="search-icon"><i class="fas fa-search"></i></span>
    </div>

    <div class="flex-container">
        <?php
        while ($row = mysqli_fetch_array($Rowbuy)) {
            echo '
                <div class="wrapper flex-item">
                    <div class="container">
                        <div class="top"><img style="width: 200px; height: 200px; margin: 0px auto; display: flex; justify-content: center; align-items: center;" src="../Admin/Site-management/IMG-AAdmin/' . htmlspecialchars($row['recipe_img']) . '" alt="صورة الوصفة"></div>
                        <div class="bottom">
                            <div class="details">
                                <h1 style="margin-left: 1rem;">' . htmlspecialchars($row['recipe_name']) . '</h1>
                          
                            </div>
                            <button class="add-to-cart-button">أضافة إلى المفضلة</button>
                        </div>
                    </div>
                    <div class="inside">
                        <div class="icon"><i class="material-icons">تفاصيل</i></div>
                        <div class="contents">
                            <table>
                                <tr>
                                    <th>الأسم</th>
                                </tr>
                                <tr>
                                    <td>' . htmlspecialchars($row['recipe_name']) . '</td>
                                </tr>
                                <tr>
                                    <th>المكونات</th>
                                </tr>
                                <tr>
                                    <td>' . htmlspecialchars($row['recipe_ingredients']) . '</td>
                                </tr>
                                <tr>
                                    <th>طريقة التحضير</th>
                                </tr>
                                <tr>
                                    <td>' . htmlspecialchars($row['recipe_info']) . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            ';
        }
        ?>
    </div>

    <script src="Js/Show-Products.js"></script>
</body>

</html>