<?php
/**
 * @throws Exception
 */
function countTuesdaysBetweenDates($startDate, $endDate) {
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);

    $interval = $start->diff($end);
    $fullWeeks = floor($interval->days / 7);

    $startDayOfWeek = (int)$start->format('N');
    $endDayOfWeek = (int)$end->format('N');

    $extraTuesdays = 0;

    if ($startDayOfWeek > 2) {
        $extraTuesdays++;
    }

    if ($endDayOfWeek >= 2) {
        $extraTuesdays++;
    }

    return $fullWeeks * 2 + $extraTuesdays;
}

$startDate = '2024-01-01';
$endDate = '2024-12-31';

try {
    echo "Количество вторников между $startDate и $endDate: " . countTuesdaysBetweenDates($startDate, $endDate);
} catch (Exception $e) {
}