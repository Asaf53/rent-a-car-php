<?php
function countDays($start_date, $end_date)
{
    $pickUpDate = date("Y-m-d", strtotime($start_date));
    $returnDate = date("Y-m-d", strtotime($end_date));

    $start = new DateTime($pickUpDate);
    $end = new DateTime($returnDate);

    $interval = $start->diff($end);

    $days = $interval->days;

    return $days;
}
