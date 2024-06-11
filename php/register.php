<?php
session_start();

$servername = "localhost";
$username = "root"; // اسم المستخدم لقاعدة البيانات
$password = ""; // كلمة المرور لقاعدة البيانات
$dbname = "7akora"; // اسم قاعدة البيانات

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من وجود أخطاء في الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من أن النموذج قد تم إرساله باستخدام طريقة POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // التحقق من أن البريد الإلكتروني غير موجود بالفعل
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "البريد الإلكتروني مستخدم بالفعل";
    } else {
        // تجزئة كلمة المرور قبل تخزينها
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // إعداد استعلام الإدراج
        $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // ربط المتغيرات بالمعلمات في الاستعلام
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        // تنفيذ الاستعلام
        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            header("Location: welcome.php"); // قم بتوجيه المستخدم إلى صفحة الترحيب بعد التسجيل
            exit(); // تأكد من إيقاف تشغيل النص بعد التوجيه
        } else {
            echo "خطأ: " . $stmt->error;
        }
    }

    // إغلاق البيان
    $stmt->close();
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
