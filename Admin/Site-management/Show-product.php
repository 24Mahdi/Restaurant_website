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
$RunShow = mysqli_query($shoes, $Show);

@$Dave = $_GET['T'];
if (@$_GET['d'] == 'd') {
    $ves = "DELETE FROM product WHERE product_token='$Dave'";
    $RunVes = mysqli_query($shoes, $ves);
    $Error = 'تم حذف المنتج بنجاح';
}

@$post01 = $_POST['get01'];
@$post02 = $_POST['get02'];
@$post03 = $_POST['get03'];

@$upd = $_GET['T'];
$edi = "SELECT * FROM product WHERE product_token='$upd'";
$Runedi = mysqli_query($shoes, $edi);
$RowEdi = mysqli_fetch_array($Runedi);

// امر رفع الصورة
$image = @$_FILES['show_img2']['name'];
$image_temp = @$_FILES['show_img2']['tmp_name'];
@$pathimg = "IMG-AAdmin/";
@$target = $pathimg . basename($_FILES['show_img2']['name']);
$imgtarget2 = strtolower(pathinfo($target, PATHINFO_EXTENSION));
$Dev = 225;
@$Vis = uniqid('MR-', true) . '.' . strtolower(pathinfo($_FILES['show_img2']['name'], PATHINFO_EXTENSION));

if (isset($_POST['get04'])) {
    if (empty($post01) || empty($post02) || empty($post03) || empty($image)) {
        $Error = "<p class='style11'>عذراً يجب عليك ملء البيانات</p>";
    } else {
        if ($imgtarget2 != '' && $imgtarget2 != 'jpg' && $imgtarget2 != 'png' && $imgtarget2 != 'gif') {
            $Dev = 0;
        }
        if ($Dev == 0) {
            $Error = "<p class='style11'>عذراً الامتداد غير مسموح به</p>";
        }
        if ($image != '') {
            move_uploaded_file($image_temp, "IMG-AAdmin/$Vis");
            @unlink("IMG-AAdmin/" . @$RowEdi['IMG-AAdmin'] . "");
        } else {
            $Vis = $RowEdi['IMG-AAdmin'];
        }
        $Ces = "UPDATE product SET
                product_name = '$post01',
                product_price = '$post02',
                product_img = '$Vis',
                product_info = '$post03'
                WHERE product_token = '$upd'
            ";
        if (mysqli_query($shoes, $Ces)) {
            echo "
                <meta http-equiv='refresh' content='0; url=Show-product.php?T=' . $upd . ''/>
            ";
            exit();
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
                        <i class="fa-solid fa-users" style="color: #ff9f0d;padding-right: 1rem;font-size: 1.3rem;"></i>
                        المستخدمين
                    </a>
                </li>
                <li class="nav-list-item">
                    <a class="nav-list-link" href="add-recipe.php">
                        <i class="fa-solid fa-note-sticky" style="color: #ff9f0d;padding-right: 1rem;font-size: 1.3rem;"></i>
                        أضافة وصفة
                    </a>
                </li>
                <li class="nav-list-item">
                    <a class="nav-list-link" href="add-product.php">
                        <i class="fa-solid fa-plus" style="color: #ff9f0d;padding-right: 1rem;font-size: 1.3rem;"></i>
                        أضافة منتج
                    </a>
                </li>
                <li class="nav-list-item">
                    <a class="nav-list-link" href="add-device.php">
                        <i class="fa-solid fa-bolt" style="color: #ff9f0d;padding-right: 1rem;font-size: 1.3rem;"></i>
                        أضافة جهاز
                    </a>
                </li>
                <li class="nav-list-item">
                    <a class="nav-list-link" href="Requests.php">
                        <i class="fa-solid fa-bell" style="color: #ff9f0d;padding-right: 1rem;font-size: 1.3rem;"></i>
                        الطلبات
                    </a>
                </li>
            </ul>
        </div>
        <div class="app-main">
            <div class="main-header-line">
                <h1>المنتجات</h1>
                <div class="action-buttons">
                    <button class="open-right-area">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                        </svg>
                    </button>
                    <button id="delete-rules-btn" class="menu-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12" />
                            <line x1="3" y1="6" x2="21" y1="6" />
                            <line x1="3" y1="18" x2="21" y1="18" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="container">
                <h2>المنتجات<small></small></h2>

                <?php echo isset($Error) ? $Error : ''; ?>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">ت</div>
                        <div class="col col-1">الصورة</div>
                        <div class="col col-1">الاسم</div>
                        <div class="col col-1">الوزن</div>
                        <div class="col col-1">السعر</div>
                        <div class="col col-1">تعديل</div>
                        <div class="col col-1">حذف</div>
                    </li>
                    <?php
                    $number = 1;
                    while ($Runshow = mysqli_fetch_array($RunShow)) {
                        echo '<li class="table-row">
                <div class="col col-1" data-label="ت">' . $number++ . '</div>
                <div class="col col-1" data-label="الصورة"><img class="style-img" src="IMG-AAdmin/' . $Runshow['product_img'] . '" /></div>
                <div class="col col-1" data-label="الاسم">' . $Runshow['product_name'] . '</div>
                <div class="col col-1" data-label="الموصفات">' . $Runshow['product_info'] . '</div>
                <div class="col col-1" data-label="السعر">' . $Runshow['product_price'] . '</div>
                <div class="col col-1" data-label="تعديل">
                    <a href="Show-product.php?edit=' . $Runshow['product_token'] . '">تعديل</a>
                </div>
                <div class="col col-1" data-label="حذف">
                    <a href="Show-product.php?d=d&T=' . $Runshow['product_token'] . '" class="Runshow"><i class="fa-solid fa-trash" style="color:#ff9f0d;"></i></a>
                </div>
            </li>';
                    }
                    ?>
                </ul>
                <?php if (isset($_GET['edit'])) : ?>
                    <?php
                    $deviceToken = $_GET['edit'];
                    $deviceQuery = "SELECT * FROM product WHERE product_token='$deviceToken'";
                    $deviceResult = mysqli_query($shoes, $deviceQuery);
                    $device = mysqli_fetch_array($deviceResult);
                    ?>
                    <div id="editModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="document.getElementById('editModal').style.display = 'none';">&times;</span>
                            <h4>تعديل المنتج</h4>
                            <form id="editForm" action="Show-product.php?T=<?php echo $device['product_token']; ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="editToken" value="<?php echo $device['product_token']; ?>">
                                <div class="form-group">
                                    <label for="editProductName">الاسم</label>
                                    <input type="text" class="form-control" name="get01" value="<?php echo $device['product_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editIngredients">الوزن</label>
                                    <input type="text" class="form-control" name="get03" value="<?php echo $device['product_info']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editInstructions">السعر</label>
                                    <input type="text" class="form-control" name="get02" value="<?php echo $device['product_price']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editImage">الصورة الحالية</label><br>
                                    <img src="IMG-AAdmin/<?php echo $device['product_img']; ?>" alt="صورة الجهاز" style="width: 30%;"><br>
                                    <label for="editImage">تغيير الصورة</label>
                                    <input type="file" class="form-control" name="show_img2">
                                </div>
                                <button type="submit" class="btn btn-primary" name="get04">حفظ التعديلات</button>
                            </form>
                        </div>
                    </div>
                    <script>
                        document.getElementById('editModal').style.display = 'block';
                    </script>
                <?php endif; ?>
            </div>
            <script src="Js/Dashboard.js"></script>
</body>

</html>