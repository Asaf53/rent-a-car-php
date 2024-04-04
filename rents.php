<?php
include_once('includes/header.php');
include_once('helpers/getAvailableCars.php');
include_once('helpers/countDays.php');


$errors = [];
if (isset($_GET['pickupDate'], $_GET['returnDate'], $_GET['pickupLocation'], $_GET['returnLocation'])) {
    $pickUpDate = $_GET['pickupDate'];
    $returnDate = $_GET['returnDate'];
    $pickupLocation = $_GET['pickupLocation'];
    $returnLocation = $_GET['returnLocation'];
    if (!empty($pickUpDate) && !empty($returnDate) && !empty($pickupLocation) && !empty($returnLocation)) {
        $cars = getAvailableCars("$pickUpDate", "$returnDate");
        if (empty($cars)) {
            $errors[] = "No cars available for the specified dates and locations.";
        }
        $days = countDays("$pickUpDate", "$returnDate");
    } else {
        $errors[] = "Required fields are empty.";
    }
}
// Check if form has been submitted
if (isset($_POST['book_btn'])) {
    $pickup_date = $_POST['pickup_date'];
    $return_date = $_POST['return_date'];
    $pickup_location = $_POST['pickup_location'];
    $return_location = $_POST['return_location'];
    $total_cost = $_POST['total_cost'];
    $car_id = $_POST['car_id'];
    $rental_number = rand(100000, 999999);

    $sql = "INSERT INTO `rental` (`user_id`, `car_id`, `pickup_location_id`, `return_location_id`, `start_date`, `end_date`, `total_cost`, `rental_number`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stm = $pdo->prepare($sql);
    if ($stm->execute([$_SESSION['user_id'], $car_id, $pickup_location, $return_location, $pickup_date, $return_date, $total_cost, $rental_number])) {
        header("Location: index.php?action=rental");
    } else {
        $errors[] = "Something went wrong!!";
    }
}
?>

<div class="container">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) : ?>
                <?= $error ?>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="col-md-8 col-12 mx-auto">
            <?php foreach ($cars as $car) : ?>
                <div class="d-flex flex-column flex-md-row border p-3 mb-3">
                    <div class="col-md-4">
                        <h5><?= $car['make'] . " " . $car['model'] ?></h5>
                        <img src="assets/img/cars/3-1.jpg" class="w-100" alt="">
                        <div class="d-flex align-items-center">
                            <span class="me-2"><img src="assets/img/icon/doors.svg" class="me-1" alt="door icon"><?= $car['doors'] ?></span> |
                            <span class="me-2 ms-2"><img src="assets/img/icon/seat.svg" class="me-1" alt="seat icon"><?= $car['seats'] ?></span> |
                            <span class="me-2 ms-2"><img src="assets/img/icon/gear.svg" alt="gear icon"></span><?= $car['gearbox'] ?>
                        </div>
                    </div>
                    <hr class="d-md-none">
                    <div class="col-md-8 d-flex justify-content-center flex-column align-items-md-end">
                        <span>Price for <?= $days ?> days!</span>
                        <h4 class="m-0">€ <?= $days * $car['rental_rate'] ?></h4>
                        <span>€<?= $car['rental_rate'] ?> /day</span>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                            <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
                            <input type="hidden" name="pickup_date" value="<?= $pickUpDate ?>">
                            <input type="hidden" name="return_date" value="<?= $returnDate ?>">
                            <input type="hidden" name="pickup_location" value="<?= $pickupLocation ?>">
                            <input type="hidden" name="return_location" value="<?= $returnLocation ?>">
                            <input type="hidden" name="total_cost" value="<?= $days * $car['rental_rate'] ?>">
                            <button class="btn btn-outline-dark" type="submit" name="book_btn">Book Now</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
</div>

<?php
include_once('includes/footer.php');
?>