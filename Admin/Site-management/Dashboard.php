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

$Show = "SELECT * FROM user";
$RunShow = mysqli_query($shoes, $Show);
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>أدارة الموقع</title>
    <link href="CSS/Dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="app-container">
        <div class="app-left">
            <button class="close-menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
            <div class="app-logo">
                <svg style="color: #f60b0b;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                    <line x1="18" y1="20" x2="18" y2="10" />
                    <line x1="12" y1="20" x2="12" y2="4" />
                    <line x1="6" y1="20" x2="6" y2="14" />
                </svg>
                <a href="../index.php"><span style="font-size: 1.5rem;font-style:italic;">إدارة الموقع</span></a>
            </div>
            <ul class="nav-list">
                <li class="nav-list-item active">
                    <a class="nav-list-link" href="Dashboard.php">
                        <i class="fa-solid fa-users" style="color: #ff9f0d;color: #ff9f0d;padding-right: 1rem;font-size: 1.3rem;"></i>
                        المستخدمين
                    </a>
                </li>

                <li class="nav-list-item">
                    <a class="nav-list-link" href="add-recipe.php">
                        <i class="fa-solid fa-note-sticky" style="color: #ff9f0d;color: #ff9f0d;padding-right: 1rem;font-size: 1.3rem;"></i>
                        أضافة وصفة
                    </a>
                </li>
                <li class="nav-list-item">
                    <a class="nav-list-link" href="add-product.php">
                        <i class="fa-solid fa-plus" style="color: #ff9f0d;color: #ff9f0d;padding-right: 1rem;font-size: 1.3rem;"></i>
                        أضافة منتج
                    </a>
                </li>
                <li class="nav-list-item">
                    <a class="nav-list-link" href="add-device.php">
                        <i class="fa-solid fa-bolt" style="color: #ff9f0d;color: #ff9f0d;padding-right: 1rem;font-size: 1.3rem;"></i>
                        أضافة جهاز
                    </a>
                </li>
                <li class="nav-list-item">
                    <a class="nav-list-link" href="Requests.php">
                        <i class="fa-solid fa-bell" style="color: #ff9f0d;color: #ff9f0d;padding-right: 1rem;font-size: 1.3rem;"></i>
                        الطلبات
                    </a>
                </li>
            </ul>
        </div>
        <div class="app-main">
            <div class="main-header-line">
                <h1>عرض المستخدمين</h1>
                <div class="action-buttons">
                    <button class="open-right-area">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                        </svg>
                    </button>
                    <button id="delete-rules-btn" class="menu-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12" />
                            <line x1="3" y1="6" x2="21" y2="6" />
                            <line x1="3" y1="18" x2="21" y2="18" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="container">
                <h2>المستخدمين<small></small></h2>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">ت</div>
                        <div class="col col-1">ألاسم</div>
                        <div class="col col-2">رقم الهاتف</div>
                        <div class="col col-3">البريد الأكتروني</div>

                    </li>
                    <?php
                    $number = 1;
                    while ($Runshow = mysqli_fetch_array($RunShow)) {

                        echo '<li class="table-row">
                        <div class="col col-1" data-label="ت">' . $number++ . '</div>
                        <div class="col col-1" data-label="الاسم">' . $Runshow['user_name'] . '</div>
                        <div class="col col-1" data-label="رقم الهاتف">' . $Runshow['user_phone'] . '</div>
                        <div class="col col-3" data-label="بريد الاكتروني">' . $Runshow['user_email'] . '</div>
                        
                    </li>';
                    };
                    ?>

                </ul>
            </div>

        </div>

    </div>
    <script src="Js/show.js"></script>
</body>

</html>