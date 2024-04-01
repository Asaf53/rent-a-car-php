<?php
include_once('includes/header.php');



// Example usage
$availableCars = getAvailableCars("2024-01-20", "2024-01-25");
echo "<pre>";
print_r($availableCars); // Output the available cars
