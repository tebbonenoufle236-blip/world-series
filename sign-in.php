<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <title>إنشاء حساب - World series</title>

    <link rel="stylesheet" href="style(register).css">
</head>

<body>

    <header>
        <nav>
            <h1>World series</h1>
            <ul>
                <li><a href="Web.html">Home</a></li>
                <li><a href="Trailer.html">Trailer</a></li>
                <li><a href="Tickets.html">Tickets</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="login.php">تسجيل الدخول</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>إنشاء حساب</h2>
            <p>أنشئ حسابك في World series.</p>

            <?php if (isset($_SESSION['signin_error'])): ?>
                <p style="color: #ff6b6b; font-weight: bold; text-align: center; margin-bottom: 15px;">
                    <?php
                        echo htmlspecialchars($_SESSION['signin_error']);
                        unset($_SESSION['signin_error']);
                    ?>
                </p>
            <?php endif; ?>

            <form method="POST" action="register.php" id="signinForm">
                <div>
                    <label for="username">اسم المستخدم</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="أدخل اسم المستخدم"
                        required>
                </div>

                <div>
                    <label for="email">البريد الإلكتروني</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="example@gmail.com"
                        required>
                </div>

                <div>
                    <label for="password">كلمة المرور</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="8 أحرف على الأقل"
                        required>
                    <button type="button" id="showPassword">إظهار كلمة المرور</button>
                </div>

                <div>
                    <label for="confirm-password">تأكيد كلمة المرور</label>
                    <input
                        type="password"
                        id="confirm-password"
                        name="confirm_password"
                        placeholder="أعد كتابة كلمة المرور"
                        required>
                    <button type="button" id="showConfirmPassword">إظهار كلمة المرور</button>
                </div>

                <button type="submit">إنشاء الحساب</button>

                <p id="formMessage"></p>
            </form>

            <p>
                لديك حساب بالفعل؟
                <a href="login.php">تسجيل الدخول</a>
            </p>
        </section>
    </main>

    <footer>
        <p>© 2026 World series</p>
    </footer>

    <script src="Logic.js"></script>
</body>
</html>
