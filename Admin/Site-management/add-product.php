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


@$post01 = $_POST['get01'];
@$post02 = $_POST['get02'];
@$post03 = $_POST['get03'];

                        $Token = date("dmyhis");
                        $RandNumber = rand(100, 200);
                        $NewToken = $Token . $RandNumber;

$image = @$_FILES['show_img2']['name'];
$image_temp = @$_FILES['show_img2']['tmp_name'];
@$pathimg = "IMG-AAdmin/";
@$target = $pathimg . basename($_FILES['show_img2']['name']);
$imgtarget2 = strtolower(pathinfo($target, PATHINFO_EXTENSION));
$inser = 2424;
@$Ad = uniqid('MR-', true) . '.' . strtolower(pathinfo($_FILES['show_img2']['name'], PATHINFO_EXTENSION));

if (isset($_POST['get04'])) {
    if (empty($post01) || empty($post02) || empty($post03) || empty($image)) {
        $Error = "<p class='style11'>عذراً يجب عليك ملء كل البيانات ورفع صورة للجهاز</p>";
    } else {

        if ($imgtarget2 != 'jpg' && $imgtarget2 != 'png' && $imgtarget2 != 'gif') {
            $Error = "<p class='style11'> عذراً الامتداد غير مسموح به</p>";
        } else {

            move_uploaded_file($image_temp, "IMG-AAdmin/$Ad");
            $devi = "INSERT INTO product 
            (
                product_token,
                product_name,
                product_price,
                product_info,
                product_img
            ) VALUES (
                '$NewToken',
                '$post01',
                '$post02',
                '$post03',
                '$Ad'
            )";
            if (mysqli_query($shoes, $devi)) {
                echo '
                <div>
                    <p style="text-align: center;
                    font-size: 3rem;">شكراً لك تم اضافة المنتج الى قاعدة البيانات</p>
                </div>
                <meta http-equiv="refresh" content="2, url=add-device.php"/>
            ';
                exit();
            } else {
                $Error = "<p class='style11'>عذراً، حدث خطأ أثناء إضافة الجهاز</p>";
            }
        }
    }
}
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
        <style>
            .stylr-input {
                font-size: 1.2rem;
                width: 90%;
                padding: 0.4rem;
                font-size: 1.2rem;
                margin: 0.2rem;
            }

            .stylr-input:hover {
                border: 1px solid #ff9f0d;
            }
        </style>
        <div class="app-main">
            <div class="main-header-line">
                <a href="../index.php">
                    <h1>الموقع</h1>
                </a>
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
                <form action="" method="post" enctype="multipart/form-data" style="direction: rtl;margin: auto;display: block;text-align: center;padding-bottom: 1rem;">
                    <div class="row">
                        <h4 style="font-size: 1.3rem;">أضافة منتج</h4>
                        <?php echo isset($Error) ? $Error : ''; ?>
                        <?php echo isset($Success) ? $Success : ''; ?>
                        <div class="input-group input-group-icon">
                            <input name="get01" class="stylr-input" type="text" placeholder="اسم المنتج">

                        </div>
                        <div class="input-group input-group-icon">
                            <input name="get02" class="stylr-input" type="number" placeholder="سعر المنتج">
                        </div>
                        <style>
                            .Style-text {
                                font-size: 1rem;
                                width: 100%;
                                height: 10rem;
                                background: #f9f9f9;
                                resize: none;
                            }

                            .Style-text:active {
                                border: 1px solid #ff9f0d;
                            }
                        </style>
                        <div class="input-group input-group-icon">
                            <input name="get03" class="stylr-input" type="text" placeholder="وزن المنتج">
                        </div>
                    </div>
                    <div class=" row">
                        <div class="col-half">
                            <h4 style="font-size: 1.3rem;">صورة المنتج</h4>
                            <div class="col-third" style="    width: 100%;">
                                <input name="show_img2" class="stylr-input" type="file" placeholder="اضف الصورة">
                            </div>
                        </div>

                    </div>
                    <style>
                        .style-aadd {
                            text-align: center;
                            display: block;
                            background: #f60b0b;
                            padding: 0.5rem;
                            color: #fff;
                            border-radius: 0.5rem;
                            font-size: 1.3rem;
                            transition: all 0.1s;
                            width: 50%;
                            border: none;
                            margin-right: auto;
                            margin-left: auto;
                            margin-top: 0.5rem;
                            margin-bottom: 0.5rem;
                        }

                        .style-aadd:hover {
                            background: #9f0404;

                        }
                    </style>
                    <button name="get04" href="#" class="style-aadd">أضافة</button>
                    <a href="Show-product.php">
                        <p>عرض المنتجات</p>
                    </a>
                </form>
            </div>

        </div>

    </div>

    </div>
    <script src="Js/show.js"></script>
</body>

</html>