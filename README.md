# World Series Website

موقع ويب بسيط لعرض مسلسلات تلفزيونية مميزة، مع صفحات للـ Trailers و Tickets و About، ونظام تسجيل دخول وإنشاء حساب باستخدام PHP + MySQL.

## المميزات

- صفحة رئيسية (Web.html) مع بحث وعرض المسلسلات الشهيرة
- صفحة Trailers مع فيديوهات YouTube
- صفحة Tickets مع رابط خارجي
- صفحة About
- نظام حسابات آمن:
  - كلمات المرور مشفرة بـ `password_hash()`
  - استعلامات محمية من SQL Injection باستخدام PDO Prepared Statements
  - Session management مع `session_regenerate_id`

## المتطلبات

- PHP 7.4+ (يفضل 8.x)
- MySQL / MariaDB
- خادم ويب (Apache / Nginx) أو XAMPP / WAMP / Laragon محلياً

## التثبيت

1. انسخ المجلد إلى مجلد الويب (مثل `htdocs` أو `www`).

2. أنشئ قاعدة البيانات:
   ```bash
   mysql -u root -p < database.sql
   ```
   أو استورد `database.sql` من خلال phpMyAdmin.

3. عدّل بيانات الاتصال في ملف `Database.php`:
   ```php
   $host     = 'localhost';
   $dbname   = 'world_series_db';
   $username = 'root';
   $password = '';          // ضع كلمة مرور MySQL الخاصة بك
   ```

4. افتح الموقع في المتصفح:
   - الصفحة الرئيسية: `Web.html` أو `index.php`
   - تسجيل الدخول: `login.php`
   - إنشاء حساب: `sign-in.php`

## هيكل الملفات

```
world-series-website/
├── Web.html              # الصفحة الرئيسية
├── Trailer.html          # التريلرات
├── Tickets.html          # التذاكر
├── about.html            # عن الموقع
├── login.php             # صفحة تسجيل الدخول
├── sign-in.php           # صفحة إنشاء حساب
├── login-handler.php     # معالجة تسجيل الدخول
├── register.php          # معالجة إنشاء الحساب
├── User.php              # كلاس إدارة المستخدمين
├── Database.php          # اتصال قاعدة البيانات
├── index.php             # توجيه بعد تسجيل الدخول
├── Logic.js              # البحث + View all + إظهار كلمة المرور
├── database.sql          # سكيمة قاعدة البيانات
├── Login.html            # إعادة توجيه إلى login.php
├── register.html         # إعادة توجيه إلى sign-in.php
├── style.css             # ستايل الصفحة الرئيسية
├── style(Login).css
├── style(register).css
├── style(Trailer).css
├── style(Tickets).css
├── style(about).css
└── photos/               # ضع صور اللوجو هنا (اختياري)
```

## ملاحظات

- الصور في مجلد `photos/` (مثل `logo_bg_4d0000.png` و `LOgo_Play.jpg`) اختيارية؛ الصفحة تعمل بدونها.
- `Login.html` و `register.html` يعيدان التوجيه تلقائياً إلى النسخ PHP.
- الرسائل بالعربية في نظام الحسابات، والواجهة الرئيسية بالإنجليزية مع أوصاف عربية للمسلسلات.

## الأمان

- لا تخزن كلمات المرور كنص عادي.
- استخدم HTTPS في الإنتاج.
- غيّر بيانات `Database.php` ولا ترفع ملف يحتوي على كلمة مرور حقيقية إلى مستودع عام.

---

Developer: Noufle  
© 2026 World series
