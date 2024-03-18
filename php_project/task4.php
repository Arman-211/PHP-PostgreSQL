<?php
function getSumOfNeighbors($matrix, $row, $col) {
    $sum = 0;
    $n = count($matrix);
    $m = count($matrix[0]);

    // Проверка соседей вверх, вниз, влево, вправо
    $neighbors = array(
        array(-1, 0), // вверх
        array(1, 0),  // вниз
        array(0, -1), // влево
        array(0, 1)   // вправо
    );

    foreach ($neighbors as $neighbor) {
        $r = $row + $neighbor[0];
        $c = $col + $neighbor[1];

        // Проверяем, находится ли сосед в пределах матрицы
        if ($r >= 0 && $r < $n && $c >= 0 && $c < $m) {
            $sum += $matrix[$r][$c];
        }
    }

    return $sum;
}

// Пример использования:
$matrix = array(
    array(51, 71, 1, 50),
    array(13, 5, 19, 11),
    array(60, 4, 11, 20),
    array(13, 34, 17, 0),
    array(16, 53, 1, 32)
);

$row = 3;
$col = 2;

echo "Сумма соседей для элемента ($row, $col): " . getSumOfNeighbors($matrix, $row, $col);
