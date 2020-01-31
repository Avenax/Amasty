<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * 2. Реализовать Тест Струпа
 * - на экран вывести сообщение 5 строк по 5 слов в каждом
 * - цвета|слова - red, blue, green, yellow, lime, magenta, black, gold, gray, tomato
 * - цвет и слово не должны совпадать (например слово lime может быть покрашено в любой из цветов кроме lime), выбор цвета - случайный
 */

function key_compare_func($a, $b) {
    if ($a === $b) {
        return 0;
    }
    return ($a > $b) ? 1 : -1;
}

$numReq = 5;

function setArray($numReq) {
    // array list colors
    $arr = ['red', 'blue', 'green', 'yellow', 'lime', 'magenta', 'black', 'gold', 'gray', 'tomato'];

    // array random & get num value
    $shuffle = array_rand($arr, $numReq);
    // empty array
    $newArr = [];
    // pars random value
    foreach ($shuffle as $value) {
        // set color in emty array
        $newArr[$value] = $arr[$value];
    }

    // diff arrays
    $result = array_diff_uassoc($arr, $newArr, "key_compare_func");
    // sort key
    sort($result);
    // return result
    return [
        'result' => $result,
        'arr' => $arr,
        'shuffle' => $shuffle
    ];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stroop effect</title>
</head>
<body>

<?php for ($i = 0; $i < $numReq; $i++): ?>
    <?php $result = setArray($numReq); ?>
    <p>
        <?php for ($j = 0; $j < $numReq; $j++): ?>
            <span style="color: <?= $result['result'][$j]; ?>"><?= $result['arr'][$result['shuffle'][$j]]; ?></span>
        <?php endfor; ?>
    </p>
<?php endfor; ?>

</body>
</html>
