<?php
/**
 * Database connection (PDO singleton).
 * Edit $host / $dbname / $username / $password to match your MySQL setup.
 */
class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $host     = 'localhost';
            $dbname   = 'world_series_db';
            $username = 'root';
            $password = ''; // ضع كلمة مرور MySQL الخاصة بك إن وُجدت

            self::$pdo = new PDO(
                "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        }

        return self::$pdo;
    }
}
