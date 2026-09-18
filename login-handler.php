<?php
session_start();
require_once __DIR__ . '/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    $_SESSION['login_error'] = 'من فضلك املأ جميع الحقول.';
    header('Location: login.php');
    exit;
}

try {
    $user   = new User();
    $result = $user->login($email, $password);

    if ($result['success']) {
        // Regenerating the session id on login helps prevent session fixation.
        session_regenerate_id(true);
        $_SESSION['user_id']  = $result['user']['id'];
        $_SESSION['username'] = $result['user']['username'];
        header('Location: index.php');
    } else {
        $_SESSION['login_error'] = $result['message'];
        header('Location: login.php');
    }
} catch (PDOException $e) {
    // Don't leak DB internals to the browser; log them instead.
    error_log('DB error in login-handler.php: ' . $e->getMessage());
    $_SESSION['login_error'] = 'تعذّر الاتصال بقاعدة البيانات. تأكد أن MySQL يعمل وأنك استوردت database.sql وأن بيانات Database.php صحيحة.';
    header('Location: login.php');
}
exit;
