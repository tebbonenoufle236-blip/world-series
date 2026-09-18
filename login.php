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

    <title>تسجيل الدخول - World series</title>

    <link rel="stylesheet" href="style(Login).css">
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
                <li><a href="sign-in.php">إنشاء حساب</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>تسجيل الدخول - World series</h2>
            <p>سجّل دخولك إلى World series.</p>

            <?php if (isset($_SESSION['login_error'])): ?>
                <p style="color: red; font-weight: bold;">
                    <?php 
                        echo htmlspecialchars($_SESSION['login_error']); 
                        unset($_SESSION['login_error']);
                    ?>
                </p>
            <?php endif; ?>

            <?php if (isset($_SESSION['login_success'])): ?>
                <p style="color: green; font-weight: bold;">
                    <?php 
                        echo htmlspecialchars($_SESSION['login_success']); 
                        unset($_SESSION['login_success']);
                    ?>
                </p>
            <?php endif; ?>

            <form method="POST" action="login-handler.php">
                <div>
                    <label for="email">البريد الإلكتروني</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="أدخل بريدك الإلكتروني"
                        required>
                </div>

                <div>
                    <label for="password">كلمة المرور</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="أدخل كلمة المرور"
                        required>
                    <button type="button" id="showPassword">إظهار كلمة المرور</button>
                </div>

                <button type="submit">تسجيل الدخول</button>
            </form>

            <p>
                ليس لديك حساب؟
                <a href="sign-in.php">إنشاء حساب</a>
            </p>
        </section>
    </main>

    <footer>
        <p>© 2026 World series.</p>
    </footer>

    <script src="Logic.js"></script>
</body>
</html>
