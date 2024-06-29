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
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حساب السعرات الحرارية</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .Calories {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px;
        }

        .Calories:hover {
            background-color: #45a049;
        }

        h1 {
            color: #ff9f0d;
            font-style: italic;
        }

        .modal {
            display: block;
            /* Always display the modal */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;

            direction: rtl;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .close-modal {
            display: none;
            /* Hide the close button */
        }

        label,
        input,
        select {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 8px;
            box-sizing: border-box;
            font-size: 1.3rem;
        }

        button[type="submit"] {
            background-color: #f60b0b;
            color: #ff9f0d;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        button[type="submit"]:hover {
            background-color: #920202;
        }

        #calorie-result {
            display: none;
            margin-top: 20px;
            padding: 15px;
            background-color: #e2e2e2;
            border-radius: 5px;
        }

        @media screen and (max-width: 600px) {
            .modal-content {
                width: 70%;
                margin-bottom: 9vh;
            }
        }
    </style>
</head>

<body>

    <div class="modal">
        <div class="modal-content">
            <button class="close-modal">&times;</button>
            <h1>حساب الاحتياج اليومي من السعرات</h1>
            <form id="calorie-form">
                <label for="age">العمر:</label>
                <input type="number" id="age" name="age" required>
                <label for="weight">الوزن (kg):</label>
                <input type="number" id="weight" name="weight" required>
                <label for="height">الطول (cm):</label>
                <input type="number" id="height" name="height" required>
                <label for="gender">الجنس:</label>
                <select id="gender" name="gender" required>
                    <option value="" hidden></option>
                    <option value="male">ذكر</option>
                    <option value="female">انثى</option>
                </select>
                <label for="activity-level">معدل النشاط:</label>
                <select id="activity-level" name="activity-level" required>
                    <option value="" hidden></option>
                    <option value="sedentary">غير نشط (ممارسة القليل من التمارين الرياضية أو عدم ممارستها على الإطلاق)</option>
                    <option value="lightly-active">نشاط خفيف (ممارسة تمارين رياضية خفيفة لمدة 1-3 أيام في الأسبوع)</option>
                    <option value="moderately-active">نشط بشكل معتدل (ممارسة الرياضة بشكل معتدل لمدة 3-5 أيام في الأسبوع)</option>
                    <option value="very-active">نشيط للغاية (ممارسة التمارين الرياضية الشاقة 6-7 أيام في الأسبوع)</option>
                    <option value="extra-active">نشاط إضافي (تمرين شاق للغاية/رياضة وعمل بدني أو تدريب مرتين)</option>
                </select>
                <button type="submit">حساب</button>
            </form>
            <div id="calorie-result">
                <h2>تحتاج سعرات:</h2>
                <p id="calorie-needs"></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calorieForm = document.getElementById('calorie-form');
            const resultDisplay = document.getElementById('calorie-needs');
            const resultContainer = document.getElementById('calorie-result');

            if (calorieForm) {
                calorieForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const age = parseInt(document.getElementById('age').value);
                    const weight = parseInt(document.getElementById('weight').value);
                    const height = parseInt(document.getElementById('height').value);
                    const gender = document.getElementById('gender').value;
                    const activityLevel = document.getElementById('activity-level').value;

                    let bmr;

                    if (gender === 'male') {
                        bmr = 88.362 + (13.397 * weight) + (4.799 * height) - (5.677 * age);
                    } else {
                        bmr = 447.593 + (9.247 * weight) + (3.098 * height) - (4.330 * age);
                    }

                    let calories;
                    switch (activityLevel) {
                        case 'sedentary':
                            calories = bmr * 1.2;
                            break;
                        case 'lightly-active':
                            calories = bmr * 1.375;
                            break;
                        case 'moderately-active':
                            calories = bmr * 1.55;
                            break;
                        case 'very-active':
                            calories = bmr * 1.725;
                            break;
                        case 'extra-active':
                            calories = bmr * 1.9;
                            break;
                    }

                    resultDisplay.textContent = `You need ${calories.toFixed(2)} calories per day.`;
                    resultContainer.style.display = 'block';
                });
            }
        });
    </script>
</body>

</html>