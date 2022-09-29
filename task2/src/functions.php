<?php

function task1(array $array, $param = false)
{
    if ($param) {
        return implode(' ', $array);
        die;
    }
    foreach ($array as $item) {
        echo '<p>' . $item . '</p>';
    }
}

function task2(string $operator, int|float ...$args): float|int|string
{
    $result = 0;
    if ($operator == '+') {
        for ($i = 1; $i < sizeof($args); $i++) {
            $result += $args[$i];
        }
    } elseif ($operator == '-') {
        for ($i = 1; $i < sizeof($args); $i++) {
            $result -= $args[$i];
        }
    } elseif ($operator == '*') {
        $result = 1;
        for ($i = 1; $i < sizeof($args); $i++) {
            $result *= $args[$i];
        }
    } elseif ($operator == '/') {
        $result = 1;
        for ($i = 1; $i < sizeof($args); $i++) {
            $result /= $args[$i];
        }
    } else {
        return 'Данный оператор не определен';
    }
    return $result;
}

function task3($number1, $number2): void
{
    if (is_int($number1) && is_int($number2)) {
        echo '<table>';
        for ($i = 1; $i <= $number1; $i++) {
            echo '<tr>';
            for ($j = 1; $j <= $number2; $j++) {
                $result = $i * $j;
                echo '<td>' . $result . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Введены не верные данные';
    }
}

function task4(): void
{
    echo date("d.m.Y H:i") . '<br>';

    $time = '24.02.2016 00:00:00';
    echo strtotime($time);
}

function task5(): void
{
    $string1 = 'Карл у Клары украл Кораллы';
    $string2 = 'Две бутылки лимонада';

    echo str_replace('К', '', $string1) . '<br>';

    echo str_replace('Две', 'Три', $string2);
}

function task6(): void
{
    file_put_contents('text.txt', 'Hello again!');

    $data = file_get_contents('text.txt');
    var_dump($data);
}
