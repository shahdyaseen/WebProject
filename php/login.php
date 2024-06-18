<?php
session_start();

$servername = "localhost";
$dbusername = "root"; // اسم المستخدم لقاعدة البيانات
$dbpassword = ""; // كلمة المرور لقاعدة البيانات
$dbname = "7akora"; // اسم قاعدة البيانات

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// التحقق من وجود أخطاء في الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من أن النموذج قد تم إرساله باستخدام طريقة POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // إعداد استعلام البحث
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // المستخدم موجود، تحقق من كلمة المرور
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // كلمة المرور صحيحة، قم بتسجيل دخول المستخدم
            $_SESSION['username'] = $row['username']; // يمكنك تغيير هذا إلى ما تريد تخزينه في الجلسة
            header("Location: ../htmlUser/home.htmlUser"); // توجيه المستخدم إلى صفحة الترحيب
            exit(); // تأكد من إيقاف تشغيل النص بعد التوجيه
        } else {
            echo "كلمة المرور غير صحيحة";
        }
    } else {
        echo "البريد الإلكتروني غير مسجل";
    }

    // إغلاق البيان
    $stmt->close();
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
