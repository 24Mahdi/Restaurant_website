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
?>
<?php
require "restaurant.php";
global $shoes;

$TokenUser = $_COOKIE['Token'];
$into = "SELECT * FROM user WHERE user_token='$TokenUser'";
$Runinto = mysqli_query($shoes, $into);
$Rowinto = mysqli_fetch_array($Runinto);

@$post01 = $_POST['get01'];
@$post02 = $_POST['get02'];
@$post03 = $_POST['get03'];
@$post04 = $_POST['get04'];

if (isset($_POST['get05'])) {
    if (empty($post01) || empty($post02) || empty($post03) || empty($post04)) {
        $Error = "<p class='style11'>عذراً يجب عليك ملء البيانات</p>";
    } else {
        $isert = "UPDATE user SET
            user_name = '$post01',
            user_password = '$post02',
            user_email = '$post03',
            user_phone = '$post04'

            WHERE user_token = '$TokenUser'
        ";
        if (mysqli_query($shoes, $isert)) {
            echo '
                    <p>شكراً لك تم تحديث البيانات بنجاح</p>
                <meta http-equiv="refresh" content="2, url=profile.php"/>
            ';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الشخصي</title>
    <link href="CSS/style0.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome/css/brands.css" rel="stylesheet">
    <link href="fontawesome/css/solid.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="style-body">
    <a href="index.php"><i class="fa-solid fa-angle-left" style="color: #4d0202;"></i></a>
    <main>
        <form action="" method="post" enctype="multipart/form-data">

            <h2>الملف الشخصي</h2>
            <?php echo @$Error; ?>
            <div class="input-container">
                <input name="get01" value="<?php echo $Rowinto['user_name']; ?>" type="text" required>
                <label for="first name">الاسم</label>
            </div>
            <div class="input-container">
                <input name="get03" value="<?php echo $Rowinto['user_email']; ?>" type="email" required>
                <label for="Last name">البريد الاكتروني</label>
            </div>
            <div class="input-container">
                <input name="get04" value="<?php echo $Rowinto['user_phone']; ?>" type="text" required>
                <label for="Email">رقم الهاتف</label>
            </div>
            <div class="input-container">
                <input name="get02" value="<?php echo $Rowinto['user_password']; ?>" type="text" required>
                <label for="Password">كلمة المرور</label>
            </div>
            <input name="get05" class="sing" type="submit" value="تعديل">


        </form>
    </main>
</body>

</html>