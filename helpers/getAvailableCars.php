<?php
function getAvailableCars($pickUpDate, $returnDate)
{
    $pickUpDate = date("Y-m-d", strtotime($pickUpDate));
    $returnDate = date("Y-m-d", strtotime($returnDate));

    global $pdo;

    $sql = "SELECT * FROM cars 
    WHERE cars.id NOT IN (
    SELECT rental.car_id FROM rental 
    WHERE 
    (rental.start_date BETWEEN :pickUpDate AND :returnDate) OR
    (rental.end_date BETWEEN :pickUpDate AND :returnDate))";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':pickUpDate', $pickUpDate);
    $stmt->bindParam(':returnDate', $returnDate);
    $stmt->execute();

    $availableCars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $availableCars;
}
