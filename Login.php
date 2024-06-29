<?php
// تعيين مسار إعادة التوجيه بناءً على نوع المستخدم من الكوكي
if (isset($_COOKIE['userType']) && $_COOKIE['userType'] == "Administrator") {
    $redirectUrl = 'Admin/index.php';
} else {
    $redirectUrl = 'User/index.php';
}



require "restaurant.php";

$post01 = $_POST['get01'] ?? null;
$post02 = $_POST['get02'] ?? null;
$userType = $_POST['userType'] ?? null;

if (isset($_POST['get03'])) {
    if (empty($post01) || empty($post02) || empty($userType)) {
        $Error = "<p style='color: #f00; text-align: center; font-size: 1.2rem;'>عذرًا يجب عليك ملء جميع البيانات</p>";
    } else {
        // اختيار الجدول بناءً على نوع المستخدم
        if ($userType == "Administrator") {
            $PIZZ = "SELECT * FROM admin_user WHERE admin_email='$post01'";
        } elseif ($userType == "ClassTeacher") {
            $PIZZ = "SELECT * FROM user WHERE user_email='$post01'";
        } else {
            $Error = "<p style='color: #f00; text-align: center; font-size: 1.2rem;'>نوع المستخدم غير صحيح</p>";
        }

        if (isset($PIZZ)) {
            $RunPIZZ = mysqli_query($shoes, $PIZZ);
            if ($RunPIZZ && mysqli_num_rows($RunPIZZ) > 0) {
                $RowPIZZ = mysqli_fetch_assoc($RunPIZZ);
                @$NameUser = @$RowPIZZ['user_email'];
                $PasswordUser = ($userType == "Administrator") ? $RowPIZZ['admin_password'] : $RowPIZZ['user_password'] ?? null;

                if ($PasswordUser === null) {
                    $Error = "<p style='color: #f00; text-align: center; font-size: 1.2rem;'>عذرًا كلمة المرور غير موجودة في السجل</p>";
                } elseif ($PasswordUser !== $post02) {
                    $Error = "<p style='color: #f00; text-align: center; font-size: 1.2rem;'>عذرًا كلمة المرور أو البريد الإلكتروني غير صحيح</p>";
                } else {
                    $TokenUser = $RowPIZZ['user_name'];
                    setcookie("Token", $TokenUser, time() + (86400 * 30 * 12), "/");
                    setcookie("user", $NameUser, time() + (86400 * 30 * 12), "/");
                    setcookie("shoes", "1", time() + (86400 * 30 * 12), "/");
                    setcookie("userType", $userType, time() + (86400 * 30 * 12), "/");

                    // تحديد وجهة التوجيه بناءً على نوع المستخدم
                    $redirectUrl = ($userType == "Administrator") ? 'Admin/index.php' : 'User/index.php';

                    echo '
                        <link href="style.css" rel="stylesheet"/>
                        <div style="
                        text-align: center;
                        font-size: 37px;
                        font-weight: bold;
                        font-family: auto;
                        ">
                            <p>شكراً لك تم تسجيل الدخول</p>
                        </div>
                        <meta http-equiv="refresh" content="1;url=' . htmlspecialchars($redirectUrl, ENT_QUOTES, 'UTF-8') . '">
                    ';
                    exit();
                }
            } else {
                $Error = "<p style='color: #f00; text-align: center; font-size: 1.2rem;'>عذرًا كلمة المرور أو البريد الإلكتروني غير صحيح</p>";
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
    <title>تسجيل دخول</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>

<body>
    <main>
        <form class="user" method="POST" action="">
            <h2>تسجيل دخول</h2>

            <?php echo @$Error; ?>
            <div class="form-group">
                <select style="margin: auto; display: block; padding: 1rem; width: 100%; margin-bottom: 1rem; font-size: 1.7rem;" required name="userType" class="form-control mb-3">
                    <option value=""> اختيار وظيفتك </option>
                    <option value="Administrator">مدير</option>
                    <option value="ClassTeacher">مستخدم </option>
                </select>
            </div>
            <div class="input-container">
                <input type="email" name="get01" required>
                <label for="Last name">البريد الإلكتروني</label>
            </div>
            <div class="input-container">
                <input type="password" name="get02" required>
                <label for="Password">كلمة المرور</label>
            </div>
            <input name="get03" class="sing" type="submit" value="تسجيل دخول">
            <br>
            <a href="index.php">إنشاء حساب</a>
        </form>
    </main>
</body>

</html>