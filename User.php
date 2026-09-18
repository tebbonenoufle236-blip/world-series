<?php

require_once __DIR__ . '/Database.php';

/**
 * User
 * Handles everything related to accounts: checking for existing
 * username/email, registering a new user, and verifying a login.
 *
 * All queries use prepared statements (PDO) so user input is never
 * concatenated into SQL — this is what stops SQL injection.
 * Passwords are never stored in plain text — password_hash() /
 * password_verify() handle that.
 */
class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function usernameExists(string $username): bool
    {
        $stmt = $this->db->prepare('SELECT id FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);

        return (bool) $stmt->fetch();
    }

    public function emailExists(string $email): bool
    {
        $stmt = $this->db->prepare('SELECT id FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);

        return (bool) $stmt->fetch();
    }

    /**
     * @return array{success: bool, message: string}
     */
    public function register(string $username, string $email, string $password): array
    {
        if ($this->usernameExists($username)) {
            return ['success' => false, 'message' => 'اسم المستخدم موجود بالفعل.'];
        }

        if ($this->emailExists($email)) {
            return ['success' => false, 'message' => 'البريد الإلكتروني مستخدم بالفعل.'];
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare(
            'INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)'
        );

        $stmt->execute([
            'username'      => $username,
            'email'         => $email,
            'password_hash' => $hash,
        ]);

        return ['success' => true, 'message' => 'تم إنشاء الحساب بنجاح.'];
    }

    /**
     * @return array{success: bool, message?: string, user?: array}
     */
    public function login(string $email, string $password): array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return ['success' => false, 'message' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.'];
        }

        return ['success' => true, 'user' => $user];
    }
}