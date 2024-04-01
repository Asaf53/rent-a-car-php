<?php
function countDays($start_date, $end_date)
{
    // Create DateTime objects for start and end dates
    $pickUpDate = date("Y-m-d", strtotime($start_date));
    $returnDate = date("Y-m-d", strtotime($end_date));

    $start = new DateTime($pickUpDate);
    $end = new DateTime($returnDate);

    // Calculate the difference between dates
    $interval = $start->diff($end);

    // Get the difference in days
    $days = $interval->days;

    return $days;
}
