<?php
/**
 * mysql_* compatibility layer for PHP8 using PDO.
 * Allows gradual migration without touching all legacy calls immediately.
 */
if (!class_exists('Database')) {
    require_once __DIR__ . '/Database.php';
}

class MysqlCompatState {
    public static string $lastError = '';
    public static ?PDOStatement $lastStatement = null;
}

if (!function_exists('mysql_connect')) {
    function mysql_connect($host = null, $user = null, $pass = null, $new_link = false, $client_flags = 0) {
        // Defer actual init to inc_db_makelink which already sets globals.
        global $dbname, $dbusername, $dbpassword;
        $host = $host ?: 'localhost';
        $user = $user ?: $dbusername;
        $pass = $pass ?: $dbpassword;
        try {
            Database::init($host, $dbname, $user, $pass);
            return true;
        } catch (Throwable $e) {
            MysqlCompatState::$lastError = $e->getMessage();
            return false;
        }
    }
}

if (!function_exists('mysql_select_db')) {
    function mysql_select_db($dbname, $link = null) {
        // Already selected in DSN; return true.
        return true;
    }
}

if (!function_exists('mysql_query')) {
    function mysql_query($query, $link_identifier = null) {
        try {
            $stmt = Database::pdo()->query($query);
            MysqlCompatState::$lastStatement = $stmt;
            return $stmt;
        } catch (Throwable $e) {
            MysqlCompatState::$lastError = $e->getMessage();
            return false;
        }
    }
}

if (!function_exists('mysql_fetch_assoc')) {
    function mysql_fetch_assoc($result) {
        return $result ? $result->fetch(PDO::FETCH_ASSOC) : false;
    }
}

if (!function_exists('mysql_fetch_array')) {
    function mysql_fetch_array($result, $result_type = MYSQLI_BOTH) {
        $mode = PDO::FETCH_BOTH;
        if ($result_type === MYSQLI_ASSOC) $mode = PDO::FETCH_ASSOC;
        elseif ($result_type === MYSQLI_NUM) $mode = PDO::FETCH_NUM;
        return $result ? $result->fetch($mode) : false;
    }
}

if (!function_exists('mysql_fetch_row')) {
    function mysql_fetch_row($result) {
        return $result ? $result->fetch(PDO::FETCH_NUM) : false;
    }
}

if (!function_exists('mysql_num_rows')) {
    function mysql_num_rows($result) {
        return $result ? $result->rowCount() : 0;
    }
}

if (!function_exists('mysql_affected_rows')) {
    function mysql_affected_rows($link_identifier = null) {
        return MysqlCompatState::$lastStatement ? MysqlCompatState::$lastStatement->rowCount() : 0;
    }
}

if (!function_exists('mysql_real_escape_string')) {
    function mysql_real_escape_string($string, $link_identifier = null) {
        $quoted = Database::pdo()->quote($string);
        // PDO::quote wraps in quotes; strip them
        if ($quoted[0] === "'" || $quoted[0] === '"') {
            return substr($quoted, 1, -1);
        }
        return $quoted;
    }
}

if (!function_exists('mysql_insert_id')) {
    function mysql_insert_id($link_identifier = null) {
        return (int) Database::pdo()->lastInsertId();
    }
}

if (!function_exists('mysql_error')) {
    function mysql_error($link_identifier = null) {
        return MysqlCompatState::$lastError;
    }
}
