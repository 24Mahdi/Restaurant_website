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