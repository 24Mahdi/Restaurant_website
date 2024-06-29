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

@setcookie("Token", "$NewToken", time() - 3600, "/");
@setcookie("user", "$post01", time() - 3600, "/");
@setcookie("shoes", "1", time() - 3600, "/");
header("Refresh: 1; url=../index.php");
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>تم تسجيل الخروج</title>
</head>

<body>
    <script>
        window.onload = function() {
            alert("تم تسجيل الخروج بنجاح!");
        }
    </script>
</body>

</html>