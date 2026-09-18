<?php
session_start();
require_once __DIR__ . '/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: sign-in.php');
    exit;
}

$username        = trim($_POST['username'] ?? '');
$email           = trim($_POST['email'] ?? '');
$password        = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

$error = null;

if ($username === '' || $email === '' || $password === '' || $confirmPassword === '') {
    $error = 'من فضلك املأ جميع الحقول.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'من فضلك اكتب إيميل صحيح مثل example@gmail.com';
} elseif (strlen($password) < 8) {
    $error = 'كلمة المرور يجب أن تحتوي على 8 أحرف على الأقل.';
} elseif ($password !== $confirmPassword) {
    $error = 'كلمتا المرور غير متطابقتين.';
}

if ($error !== null) {
    $_SESSION['signin_error'] = $error;
    header('Location: sign-in.php');
    exit;
}

try {
    $user   = new User();
    $result = $user->register($username, $email, $password);

    if ($result['success']) {
        $_SESSION['login_success'] = 'تم إنشاء الحساب بنجاح، يمكنك تسجيل الدخول الآن.';
        header('Location: login.php');
    } else {
        $_SESSION['signin_error'] = $result['message'];
        header('Location: sign-in.php');
    }
} catch (PDOException $e) {
    // Don't leak DB internals to the browser; log them instead.
    error_log('DB error in register.php: ' . $e->getMessage());
    $_SESSION['signin_error'] = 'تعذّر الاتصال بقاعدة البيانات. تأكد أن MySQL يعمل وأنك استوردت database.sql وأن بيانات Database.php صحيحة.';
    header('Location: sign-in.php');
}
exit;
