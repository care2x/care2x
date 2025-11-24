<?php
/**
 * Lightweight PDO factory and helper for transitioning from mysql_* and ADODB to PDO.
 * Provides simple query/prepare wrappers and legacy-style fetch helpers.
 */
class Database
{
    private static ?PDO $pdo = null;

    public static function init(string $host, string $dbname, string $user, string $pass, string $charset = 'utf8mb4'): void
    {
        if (self::$pdo !== null) {
            return; // already initialized
        }
        $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        self::$pdo = new PDO($dsn, $user, $pass, $options);
    }

    public static function pdo(): PDO
    {
        if (!self::$pdo) {
            throw new RuntimeException('PDO not initialized');
        }
        return self::$pdo;
    }

    // Legacy convenience wrappers
    public static function query(string $sql, array $params = []): PDOStatement
    {
        if (!$params) {
            return self::pdo()->query($sql);
        }
        $stmt = self::pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function fetchAll(string $sql, array $params = []): array
    {
        return self::query($sql, $params)->fetchAll();
    }

    public static function fetchOne(string $sql, array $params = []): ?array
    {
        $stmt = self::query($sql, $params);
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public static function exec(string $sql, array $params = []): int
    {
        $stmt = self::query($sql, $params);
        return $stmt->rowCount();
    }
}
