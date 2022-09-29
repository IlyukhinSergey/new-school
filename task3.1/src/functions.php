<?php

function task1()
{
    $users = [];

    for ($i = 0; $i < 50; $i++) {
        $userName = rand(1, 5);
        $userAge = rand(18, 45);

        switch ($userName) {
            case 1:
                $name = 'Sasha';
                break;
            case 2:
                $name = 'Steffi';
                break;
            case 3:
                $name = 'Masha';
                break;
            case 4:
                $name = 'Ivan';
                break;
            case 5:
                $name = 'Sidr';
                break;
        }
        $users[$i] = ['name' => $name, 'age' => $userAge];
    }
    return $users;
}

function task2($users)
{
    $json = json_encode($users);
    file_put_contents('users.json', $json);
}

function task3()
{
    $users = json_decode(file_get_contents('users.json'), true);

    $sasha = 0;
    $steffi = 0;
    $masha = 0;
    $ivan = 0;
    $sidr = 0;
    $allAge = 0;

    foreach ($users as $user) {
        switch ($user['name']) {
            case 'Sasha':
                $sasha++;
                break;
            case 'Steffi':
                $steffi++;
                break;
            case 'Masha':
                $masha++;
                break;
            case 'Ivan':
                $ivan++;
                break;
            case 'Sidr':
                $sidr++;
                break;
        }
        $allAge += $user['age'];
    }

    echo 'В массиве users количество имен:' . '<br>' .
      'имени Sasha = ' . $sasha . '<br>' .
      'имени Steffi = ' . $steffi . '<br>' .
      'имени Masha = ' . $masha . '<br>' .
      'имени Ivan = ' . $ivan . '<br>' .
      'имени Sidr = ' . $sidr . '<br>' .
      'Общий возраст составляет - ' . $allAge / sizeof($users);
}