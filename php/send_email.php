<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpMailer/src/Exception.php';
require '../phpMailer/src/PHPMailer.php';
require '../phpMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient_email = "shadthabit@gmail.com"; // بريد المستلم
    $subject = "New message from 7AKORA"; // عنوان الرسالة

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // تهيئة PHPMailer
    $mail = new PHPMailer(true);

    try {
        // إعداد المتغيرات
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'shadthabit@gmail.com'; // بريد Gmail
        $mail->Password = 'wqni qucc dqbk fupw'; // كلمة المرور
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // تهيئة محتوى البريد الإلكتروني
        $mail->setFrom($email, $name);
        $mail->addAddress($recipient_email);
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = "sender name: $name\n\nemail: $email\n\nmessage:\n$message";

        // إرسال البريد الإلكتروني
        $mail->send();
        echo "تم إرسال البريد الإلكتروني بنجاح!";
    } catch (Exception $e) {
        echo "حدث خطأ أثناء محاولة إرسال البريد الإلكتروني: {$mail->ErrorInfo}";
    }
}
?>
