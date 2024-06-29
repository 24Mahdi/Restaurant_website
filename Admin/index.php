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

$Show = "SELECT * FROM devices";
$RunShow = mysqli_query($shoes, $Show);
?>
<?php
session_start();

// تحقق من إرسال النموذج وإضافة المنتج إلى السلة
if (isset($_POST['addToCart'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // بناء مصفوفة للمنتج
    $product = array(
        'product_name' => $_POST['productName'],
        'product_price' => $_POST['productPrice'],
        'product_img' => $_POST['productImg']
    );

    // إضافة المنتج إلى السلة
    array_push($_SESSION['cart'], $product);

    // رسالة تأكيد الإضافة
    echo '<script>alert("تم إضافة المنتج إلى السلة بنجاح!");</script>';
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وصفات الطعام</title>
    <link href="CSS/style.css" rel="stylesheet">
    <!-- Font Awesome Additional Styles (Brands, Solid) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome/css/brands.css" rel="stylesheet">
    <link href="fontawesome/css/solid.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- main article -->
    <section id="section--1">
        <div class="style01">
            <nav>
                <ul class="style02">
                    <li class="li"><a href="#section--1">الرئسية</a></li>
                    <li class="li">
                        اقسام الوصفات
                        <ul>
                            <li><a href="Show-recipes.php">أطباق شرقية</a></li>
                            <li><a href="Show-recipes.php">وجبة سريعة</a></li>
                            <li><a href="Show-recipes.php">مشروبات</a></li>

                        </ul>
                    </li>
                    <li class="li"><a href="#section--2">شراء الأغذية</a></li>
                    <li class="li"><a href="#section--3">شراء أدوات المطبخ</a></li>
                    <li class="li"><a href="#section--4" class="btn--show-modal">التواصل</a></li>

                </ul>

                <a href="javascript:void(0)" class="style03" onclick="toggleDrawer()">
                    <div class="style027">
                        <i class="fa-solid fa-bars" style="color: #ff9f0d; font-size: 5rem;"></i>
                    </div>
                </a>
            </nav>

            <!-- Drawer Menu -->
            <div id="myDrawer" class="drawer-menu">
                <a href="Profile.php">الملف الشخصي</a>
                <a href="shopping-basket.php"> سلة المشتريات </a>
                <a href="Site-management/Dashboard.php">أدارة الموقع</a>
                <a href="Log-out.php">تسجيل خروج</a>
            </div>
            <nav class="bottom-navbar">
                <a href="javascript:void(0)" class="style03" onclick="toggleDrawer()">
                    <div class="style027">
                        <i class="fa-solid fa-bars" style="color: #ff9f0d; font-size: 5rem;"></i>
                    </div>
                </a>
                <ul class="style02">
                    <li class="li">
                        <a href="#section--1"><i class="fa-solid fa-house" style="color: #ff9f0d;"></i> </a>
                    </li>
                    <li class="li">
                        <a href="#section--6"><i class="fa-solid fa-bars" style="color: #ff9f0d;"></i></a>
                        <ul class="sub-menu">
                            <li><a href="#"> أطباق شرقية</a></li>
                            <li><a href="#"> وجبة سريعة</a></li>
                            <li><a href="#"> مشروبات</a></li>

                        </ul>
                    </li>
                    <li class="li"><a href="#section--2"><i class="fa-solid fa-lemon" style="color: #ff9f0d;"></i> </a></li>
                    <li class="li"><a href="#section--3"><i class="fa-solid fa-cart-shopping" style="color: #ff9f0d;"></i>
                        </a>
                    </li>
                    <li class="li"><a href="#section--4" class="btn--show-modal"><i class="fa-solid fa-comments" style="color: #ff9f0d;"></i> </a></li>
                </ul>
            </nav>

            <section class="section--afect">
                <div class="style05">
                    <div class="image-container">
                        <img class="style06" src="..\IMG\FOOD\PIZZ.png" alt="">
                    </div>
                    <div>
                        <img class="style09" src="..\IMG\FOOD\tamat0002.png">
                        <!-- <p class="style08">
                        أطبخ معنا
                    </p> -->
                        <a href="Show-recipes.php">
                            <button class="style07">عرض الوصفات</button><a>
                    </div>
                </div>
            </section>

        </div>
    </section>
    <section class="section--afect">
        <div style="display: flex;    flex-wrap: wrap;">
            <div class="style010">
                <a href="Show-recipes.php" class="style013">نقدم لكم أشهر الوصفات في العالم</a>
            </div>
            <div class="style011">
                <a href="Show-Products.php" class="style012">أحدث أجهزة الطبخ</a>
            </div>
    </section>

    <h1 class="style016 section--afect">لماذا تختارنا ؟</h1>

    <p style="    font-size: 2rem;text-align: center;
    padding: 2rem;font-weight: bold;color: #999999;"> نحن نوفر جميع مع تحتاجه في مكان واحد</p>
    <section class="style014">
        <div class="feature-item">
            <div class="style015">
                <i class="fa-solid fa-shield" style="color: #ff9f0d;"></i>
            </div>
            <div>
                <h4 class="style017">وصفات أمنة</h4>
                <p class="style018">وصفات أمنة تعد من أشهر الطباخين في العالم</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="style015">
                <i class="fa-solid fa-wheat-awn" style="color: #ff9f0d;"></i>
            </div>
            <div>
                <h4 class="style017">منتجات غذائية</h4>
                <p class="style018">منتجات غذائية زرعت في أفضل الظروف البيئية, من أجل تحضير وصفاتكم</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="style015">
                <i class="fa-solid fa-fire-burner" style="color: #ff9f0d;"></i>
            </div>
            <div>
                <h4 class="style017">أحدث الأجهزة</h4>
                <p class="style018">أجهزة من مصانع عالمية مختبرة, من قبل طباخين لضمان وصفاتكم</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="style015">
                <i class="fa-solid fa-truck-fast" style="color: #ff9f0d;"></i>
            </div>
            <div>
                <h4 class="style017">توصيل سريع</h4>
                <p class="style018">توصيل مجاني للأجهزة بقيمة 100 دينار أو أكثر</p>
            </div>
        </div>
        </div>
    </section>


    <section id="section--2" class="section--afect">
        <h1 class="recipe-title">المواد الغذائية</h1>
        <p style="font-size: 2rem;text-align: center;
    padding: 2rem;color: #999999;margin-bottom: 2rem;"> نوفر لكم أفضل أنواع المواد الغذائية و لحوم الخالية من المود الكيميائية</p>
        <div class="container">
            <button class="nav prev">←</button>
            <div class="products-wrapper">
                <div class="products">

                    <?php
                    while ($row = mysqli_fetch_array($Rowbuy)) {
                        echo '
        <div class="product">
            <img src="Site-management/IMG-AAdmin/' . htmlspecialchars($row['product_img']) . '" alt="منتج 2">
            <h2 class="style-name">' . htmlspecialchars($row['product_name']) . '</h2>
            <p class="style-price">IQ20 :' . htmlspecialchars($row['product_price']) . '</p>
            <form method="post">
                <input type="hidden" name="product_id" value="' . htmlspecialchars($row['product_id']) . '">
                <input type="hidden" name="productName" value="' . htmlspecialchars($row['product_name']) . '">
                <input type="hidden" name="productPrice" value="' . htmlspecialchars($row['product_price']) . '">
                <input type="hidden" name="productImg" value="' . htmlspecialchars($row['product_img']) . '">
                <button type="submit" name="addToCart" class="add-to-cart-button">أضف إلى السلة</button>
            </form>
        </div>';
                    }
                    ?>

                </div>
            </div>
            <button class="nav next">→</button>

    </section>

    <br>
    <section class="section--afect" class="recipe-section" style="margin-top: 6rem;direction: rtl;">
        <h1 class="recipe-title">وصفة اليوم</h1>
        <div class="recipe-container">
            <div class="recipe-content">
                <h2 class="recipe-subtitle">وصفة تحضير الدولة</h2>
                <p class="recipe-description">تمن و شكر وملح و عدس و لحم و دجاج و كرفس و كشمش و بصل و طماطة و تفاح وطحين و صمون و ورق عنب و خبز و زبدة و زيت و كريمة</p>
                <h3 class="recipe-subtitle">طريقة التحضير</h3>
                <p class="recipe-description">نخلط العنب و الطحين مدة ساعتين ثم نضيف عصير التمر و نخلط عشرة دقائق ثم نضيف الماءوالتمن و نخلط عشر ساعات ثم نضيف الكشمش و التفاح و نخلط ساعتين ثم نطحن الطماطة و الخس و نضيفهم على الخلطة ثم نضيف الزبيب والبرتقال ثم نضع قليل من المكونات في ورقة العنب و نلف الورقة و المكونات ثم نضعهم في قدر كبير و نسكب فوقهم خل التفاح و خل التمرو عصير اليمون و يترك على نار عالية لمدة عشرين ساعة</p>
            </div>
            <div class="recipe-image">
                <img src="../IMG/FOOD/DOLMA.png" alt="Dolma">
            </div>
        </div>
    </section>
    <hr>

    <section class="section--afect" id="section--3" style="
    text-align: center;">
        <h1 class="recipe-title" style="margin-top: 2rem;">أدوات المطبخ</h1>
        <p style="font-size: 2rem;text-align: center;
   color: #999999;margin-bottom: 2rem;">أحدث و أفضل أجهزة الطبخ و أحدث أدوت الطبخ</p>
        <section id="section--3">
            <div class="row" style="padding: 2rem;">
                <?php
                $i = 0;
                while ($Runshow = mysqli_fetch_array($RunShow)) {
                    if ($i < 6) {
                        echo '   <div class="item">
                    <div class="media-box">
                        <img src="Site-management/IMG-AAdmin/' . $Runshow['Devices_img'] . '" alt="BODY BUILDING CLASSES" class="img-fluid">
                    </div>
                    <div class="body-box">
                        <div class="title">' . $Runshow['Devices_name'] . '</div>
                        <form method="post">
                            <input type="hidden" name="Devices_id" value="' . htmlspecialchars($Runshow['Devices_id']) . '">
                            <input type="hidden" name="productName" value="' . htmlspecialchars($Runshow['Devices_name']) . '">
                            <input type="hidden" name="productPrice" value="' . htmlspecialchars($Runshow['Devices_price']) . '">
                            <input type="hidden" name="productImg" value="' . htmlspecialchars($Runshow['Devices_img']) . '">
                            <button type="submit" name="addToCart" class="add-to-cart-button">أضف إلى السلة</button>
                        </form>
                    </div>
                </div>';
                        $i++;
                    } else {
                        break;
                    }
                }
                ?>



            </div>
        </section>
        <hr>
        <section class="section--afect" id="section--4" style="    margin-bottom: 5rem;">
            <div class="operations">
                <div class="operations__tab-container">
                    <button style="background-color: #ff9f0d; color: #fff;    font-size: 2rem;" class="btn-1 operations__tab operations__tab--1 operations__tab--active" data-tab="1">
                        تنبيه للوصفات
                    </button>
                    <button style="background-color: #4bbb7d; color: #fff;    font-size: 2rem;" class="btn-1 operations__tab operations__tab--2" data-tab="2">
                        المواد المتوفر
                    </button>
                    <button style="background-color: #fd424b; color: #fff;    font-size: 2rem;" class="btn-1 operations__tab operations__tab--3" data-tab="3">
                        تحذير
                    </button>
                </div>
                <div class="operations__content operations__content--1 operations__content--active">
                    <p style=" font-size: 2rem;">
                        <strong>يجب تطبيق الوصفة كما هي بدون تغير</strong>
                        <br>
                        <br>في حال واجهة مشكلة أو صعوبة يمكنك التواصل مع الأدارة
                        <br>
                        <br>تتوفر دورات تعليمة لطرق و أساليب الطبخ من أشهر الطباخين في العالم
                    </p>
                </div>
                <div class="operations__content operations__content--2">
                    <p style="font-size: 2rem;">
                        تتوفر لدينا جميع أنواع الفواكه و الحوم و المواد الغذائية
                        <br><br>
                        تتوفر أحدث تقنيات و أجهزة الطبخ و أدوات من الطبخ من مصانع عالمية
                        <br><br>
                        لطلب الفواكة و لحوم النادرة و اللأجهزة التوصل على الرقم التالي :<br>
                        <br>077X-XXX-XXXX
                    </p>
                </div>
                <div class="operations__content operations__content--3">
                    <p style="font-size: 2rem;">
                        إدارة الموقع غير مسؤولة عن الأصابة في حالات التسمم بسبب الوصفات وحتى غير مسؤولة عن حالأت الوفاة الناتجة من الوصفات
                    </p>
                </div>
            </div>
        </section>

        <hr>
        <br>
        <br>

        <footer class="section--afect">

            <div class="footer">
                <div class="heading">
                    <h2><sup></sup></h2>
                </div>
                <div class="content">
                    <div class="links">
                        <h4>التنقل</h4>
                        <p><a href="#">الرئيسة</a></p>
                        <p><a href="#">شراء الأغذية</a></p>
                        <p><a href="#">شراء أدوات المطبخ</a></p>
                        <p><a href="#">التواصل</a></p>
                    </div>
                    <div class="services">
                        <h4>الخدمات</h4>
                        <p><a href="Calorie.php">حساب السعرات الحرارية</a></p>
                        <p><a href="#">نقدم وصفات الطعام</a></p>
                        <p><a href="#">بيع المواد الغذائية</a></p>
                        <p><a href="#">بيع أجهزة و أدوات الطبخ</a></p>
                        <p><a href="#">تتوفر خدمة توصيل مجاني</a></p>


                    </div>
                    <div class="details">
                        <h4 class="mobile">هاتف</h4>
                        <p><a href="#">077X-XXX-XXXX</a></p>
                        <h4 class="mail">البريد الأكتروني</h4>
                        <p><a href="#">Cooking@gmail.com</a></p>
                    </div>
                </div>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </footer>
        </article>
        <script src="Js/JavaScript.js">
        </script>
</body>

</html>