<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * 5. Выполнить запросы к данной БД. Исходные данные: изначально у всех людей из таблицы persons было по 100 рублей.
 * Передача денег из таблицы transactions отражает кто (from) кому(to) сколько денег передал.
 * а) написать запрос, который бы выводил полное имя и баланс человека на данный момент
 * б) написать запрос, который бы выводил город, представители которого участвовали в передаче денег наибольшее количество раз
 * в) написать запрос, отражающий все транзакции, где передача денег осуществлялась между представителями одного города
 */

include_once 'DB.php';

function pre($str) {
    echo '<pre>';
    print_r($str);
    echo '</pre>';
}

$aSql = 'SELECT `p`.`fullname`,
    ROUND(
        100
        - IFNULL((SELECT SUM(`t`.`amount`) FROM `transactions` as `t` WHERE `t`.`from_person_id` = `p`.`id`), 0)
        + IFNULL((SELECT SUM(`t`.`amount`) FROM `transactions` as `t` WHERE `t`.`to_person_id` = `p`.`id`), 0),
        2) AS Cash FROM `persons` AS `p`';

$aStmt = DB::run($aSql)->fetchAll();
pre($aStmt);

$bSql = 'SELECT `s`.`name`, COUNT(*) AS `count` FROM `transactions` AS `t` 
    INNER JOIN `persons` AS `p` ON `p`.`id` = `t`.`from_person_id` 
    INNER JOIN `cities` AS `s` ON `s`.`id` = `p`.`city_id`
    GROUP BY 1 HAVING COUNT(*) > 1 ORDER BY `count` DESC LIMIT 1';

$bStmt = DB::run($bSql)->fetch();
pre($bStmt);

$cSql = 'SELECT `t`.* FROM `transactions` AS `t` 
    INNER JOIN `persons` AS `p` ON `p`.`id` = `t`.`from_person_id` 
    INNER JOIN `cities` AS `s` ON `s`.`id` = `p`.`city_id` 
    INNER JOIN `persons` AS `p2` ON `p2`.`id` = `t`.`to_person_id` 
    INNER JOIN `cities` AS `s2` ON `s2`.`id` = `p2`.`city_id` 
        WHERE `s`.`id` = `s2`.`id`';

$cStmt = DB::run($cSql)->fetchAll();
pre($cStmt);