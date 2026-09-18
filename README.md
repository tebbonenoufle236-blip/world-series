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

##
Developer: Noufle  
© 2026 World series
