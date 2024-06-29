<?php
if (isset($_COOKIE['shoes']) && $_COOKIE['shoes'] == '1') {
    echo '
          <link rel="stylesheet" type="text/css" href="style.css" />
          <div style="
          text-align: center;
          font-size: 37px;
          font-weight: bold;
          font-family: auto;
          ">
              <p>عذراً لقد تم تسجيل الدخول</p>
          </div>
          <meta http-equiv="refresh" content="2; url=User/index.php">
      ';
    exit();
}

require "restaurant.php";
global $shoes;

$post01 = isset($_POST['get01']) ? htmlspecialchars($_POST['get01']) : '';
$post02 = isset($_POST['get02']) ? htmlspecialchars($_POST['get02']) : '';
$post03 = isset($_POST['get03']) ? htmlspecialchars($_POST['get03']) : '';
$post04 = isset($_POST['get04']) ? htmlspecialchars($_POST['get04']) : '';

$Token = date("dmyhis");
$RandNumber = rand(100, 200);
$NewToken = $Token . $RandNumber;

if (isset($_POST['get05'])) {
    if (empty($post01) || empty($post02) || empty($post03) || empty($post04)) {
        $Error = "<p style='color:#f00;font-size:1.2rem;'>عذراً يجب عليك ملء البيانات</p>";
    } else {
        // التحقق مما إذا كان البريد الإلكتروني موجوداً بالفعل في قاعدة البيانات
        $checkEmailQuery = "SELECT * FROM user WHERE user_email = '$post03'";
        $result = mysqli_query($shoes, $checkEmailQuery);

        if (mysqli_num_rows($result) > 0) {
            $Error = "<p style='color:#f00;font-size:1.2rem;'>عذراً، هذا البريد الإلكتروني  غير صالح</p>";
        } else {
            $PIZZ = "INSERT INTO user 
                (
                    user_token,
                    user_name,
                    user_password,
                    user_email,
                    user_phone
                ) VALUES (
                    '$NewToken',
                    '$post01',
                    '$post02',
                    '$post03',
                    '$post04'
                )";
            if (mysqli_query($shoes, $PIZZ)) {
                setcookie("Token", "$NewToken", time() + (86400 * 30 * 12), "/");
                setcookie("user", "$post01", time() + (86400 * 30 * 12), "/");
                setcookie("shoes", "1", time() + (86400 * 30 * 12), "/");
                echo '
                        <link href="CSS/style.css" rel="stylesheet"/>
                        <div class="style12">
                            <p>شكراً لك تم انشاء الحساب</p>
                        </div>
                        <meta http-equiv="refresh" content="2; url=User/index.php">
                    ';
                exit();
            } else {
                $Error = "<p style='color:#f00;font-size:1.2rem;'>حدث خطأ أثناء إنشاء الحساب</p>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>

<body>
    <main>
        <form method="POST" action="">
            <h2>إنشاء حساب</h2>
            <?php echo @$Error; ?>
            <div class="input-container">
                <input type="text" required name="get01">
                <label for="first name">الاسم</label>
            </div>
            <div class="input-container">
                <input name="get03" type="email" required>
                <label for="Last name">البريد الإلكتروني</label>
            </div>
            <div class="input-container">
                <input name="get04" type="text" required>
                <label for="Email">رقم الهاتف</label>
            </div>
            <div class="input-container">
                <input name="get02" type="password" required>
                <label for="Password">كلمة المرور</label>
            </div>
            <input name="get05" class="sing" type="submit" value="إنشاء حساب">
            <br> <a href="Login.php">تسجيل دخول</a>
        </form>
    </main>
</body>

</html>