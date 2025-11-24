<?php
// PHP 8 compatibility polyfills for legacy code

if (!function_exists('each')) {
    function each(array &$array) {
        $key = key($array);
        if ($key === null) return false;
        $value = current($array);
        next($array);
        return [1 => $value, 'value' => $value, 0 => $key, 'key' => $key];
    }
}

if (!function_exists('create_function')) {
    function create_function($args, $code) {
        $wrapped = 'return function(' . $args . '){' . $code . '};';
        $fn = eval($wrapped);
        if ($fn instanceof Closure) return $fn;
        throw new Exception('create_function polyfill failed');
    }
}

if (!function_exists('ereg')) {
    function ereg($pattern, $string, &$regs = null) {
        $delim = '/';
        $pat = $pattern;
        if ($pattern === '' || $pattern[0] !== $delim) {
            $pat = $delim . str_replace($delim, '\' . $delim, $pattern) . $delim;
        }
        $res = @preg_match($pat, $string, $matches);
        if ($res && $regs !== null) $regs = $matches;
        return (int)$res;
    }
}

if (!function_exists('eregi')) {
    function eregi($pattern, $string, &$regs = null) {
        $delim = '/';
        $pat = $pattern;
        if ($pattern === '' || $pattern[0] !== $delim) {
            $pat = $delim . str_replace($delim, '\' . $delim, $pattern) . $delim . 'i';
        }
        $res = @preg_match($pat, $string, $matches);
        if ($res && $regs !== null) $regs = $matches;
        return (int)$res;
    }
}

if (!function_exists('split')) {
    function split($pattern, $string, $limit = -1) {
        $delim = '/';
        $pat = $pattern;
        if ($pattern === '' || $pattern[0] !== $delim) {
            $pat = $delim . str_replace($delim, '\' . $delim, $pattern) . $delim;
        }
        return preg_split($pat, $string, $limit);
    }
}
