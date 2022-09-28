<?php

echo '<table>';
for ($i = 1; $i < 11; $i++) {
    echo '<tr>';
    for ($j = 1; $j < 11; $j++) {
        $result = $i * $j;
        if ($j % 2 == 0 && $i % 2 == 0) {
            echo '<td>' . '(' . $result . ')' . '</td>';
        } elseif ($j % 2 != 0 && $i % 2 != 0) {
            echo '<td>' . '[' . $result . ']' . '</td>';
        } else {
            echo '<td>' . $result . '</td>';
        }
    }
    echo '</tr>';
}
echo '</table>';
