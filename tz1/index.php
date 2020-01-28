<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * 1. Реализовать два класса: First и Second
 * - в результате вызовов функции getClassname() у объекта класса First должно выводиться сообщение "First"
 * - в результате вызовов функции getClassname() у объекта класса Second должно выводиться сообщение "Second"
 * - в результате вызовов функции getLetter() у объекта класса First должно выводиться сообщение "A"
 * - в результате вызовов функции getLetter() у объекта класса Second должно выводиться сообщение "B"
 * Суммарно для двух классов должно быть реализовано 3 (три) метода
 */

spl_autoload_register(function ($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        include_once $file;
        return true;
    }
    return false;
});

$first = new First();
$second = new Second();


var_dump($first->getClassname());

var_dump($second->getClassname());

var_dump($first->getLetter('A'));

var_dump($second->getLetter('B'));