<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * 4. Используя https://simplehtmldom.sourceforge.io/ сделать скрипт, который достаёт из Архива результатов Серии А все места заданной команды по сезонам (Например Удинезе)
 * https://terrikon.com/football/italy/championship/
 * Передача имени команды осуществляется через POST-форму
 */

include_once 'simplehtmldom_1_9_1/simple_html_dom.php';


function getListCommands(string $name = null) {
    $html = file_get_html('https://terrikon.com/football/italy/championship/');

    $search = trim($name);
    $articles = [];

    foreach ($html->find('div[id=champs-table] tr[!class]') as $article) {
        $key = intval($article->find('td', 0)->plaintext);
        $articles[$key] = trim($article->find('td.team', 0)->plaintext);
    }

    if (in_array($search, $articles)) {
        $flip = array_flip($articles);
        return "Команда {$search} на {$flip[$search]} месте!";
    }
    return false;
}

if (filter_has_var(INPUT_POST, 'name')) {
    $err = null;

    if (empty($_POST['name'])) {
        $err .= 'Введите значение!' . PHP_EOL;
    }

    if ($result = getListCommands($_POST['name'])) {
        echo $result;
    } else {
        $err .= 'Команда не найдена!' . PHP_EOL;
    }

    if ($err) {
        echo $err;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
</head>
<body>
<form method="post">
    <label>
        <input type="text" name="name">
    </label>

    <button type="submit">Search</button>
</form>
</body>
</html>


