<?php
function getAvailableCars($pickUpDate, $returnDate)
{
    // Convert dates to MySQL date format
    $pickUpDate = date("Y-m-d", strtotime($pickUpDate));
    $returnDate = date("Y-m-d", strtotime($returnDate));

    global $pdo; // Assuming $pdo is the PDO instance from your header.php file

    // SQL query to get available cars
    $sql = "SELECT * FROM cars 
    WHERE cars.id NOT IN (
    SELECT rental.car_id FROM rental 
    WHERE 
    (rental.start_date BETWEEN :pickUpDate AND :returnDate) OR
    (rental.end_date BETWEEN :pickUpDate AND :returnDate) OR
    (rental.start_date <= :pickUpDate AND rental.end_date >= :returnDate))";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);
    // Bind parameters
    $stmt->bindParam(':pickUpDate', $pickUpDate);
    $stmt->bindParam(':returnDate', $returnDate);
    // Execute the query
    $stmt->execute();

    // Fetch all available cars
    $availableCars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $availableCars;
}
