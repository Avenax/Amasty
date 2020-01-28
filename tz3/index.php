#!/usr/bin/php
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * 3. Реализовать консольный скрипт на php, который в качестве параметра будет принимать строку из разделённых между собой натуральных чисел.
 * Выводит этот же массив отсортированный в порядке возрастания.
 * Во входной строке числа разделены как минимум одним пробелом, в сортировке участвуют только числа
 * Пример команды в консоли - php 3.php “1 -2 -3 4 5 -6f ss3 0 0 0 -0 0.0 0.05”
 * Результат: -3 -2 0 1 4 5
 */

if (empty($argv)) {
    return false;
}
# php index.php 1 -2 -3 4 5 -6f ss3 0 0 0 -0 0.0 0.05
$arr = [];

foreach ($argv as $value) {

    if (false !== filter_var($value, FILTER_VALIDATE_INT)) {
        $arr[] = intval($value);
    }
}
$arr = array_unique($arr);
sort($arr);
echo implode(" ", $arr);