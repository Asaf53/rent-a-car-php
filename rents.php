<?php
include_once('includes/header.php');
include_once('helpers/getAvailableCars.php');
include_once('helpers/countDays.php');

if (isset($_GET['pickupDate']) && isset($_GET['returnDate'])) {
    $pickUpDate = $_GET['pickupDate'];
    $returnDate = $_GET['returnDate'];

    $cars = getAvailableCars("$pickUpDate", "$returnDate");
    $days = countDays("$pickUpDate", "$returnDate");
}
?>

<div class="container">
    <div class="col-md-8 col-12 mx-auto">
        <?php foreach ($cars as $car) : ?>
            <div class="d-flex flex-column flex-md-row border p-3 mb-3">
                <div class="col-md-4">
                    <h5><?= $car['make'] . " " . $car['model'] ?></h5>
                    <img src="assets/img/cars/3-1.jpg" class="w-100" alt="">
                    <div class="d-flex align-items-center">
                        <span class="me-2"><img src="assets/img/icon/doors.svg" class="me-1" alt="door icon"><?= $car['doors'] ?></span> |
                        <span class="me-2 ms-2"><img src="assets/img/icon/seat.svg" class="me-1" alt="seat icon"><?= $car['seats'] ?></span> |
                        <span class="me-2 ms-2"><img src="assets/img/icon/gear.svg" class="me-1" alt="gear icon"></span><?= $car['gearbox'] ?>
                    </div>
                </div>
                <hr class="d-md-none">
                <div class="col-md-8 d-flex justify-content-center flex-column align-items-md-end">
                    <span>Price for <?= $days ?> days!</span>
                    <h4 class="m-0">€ <?= $days * $car['rental_rate'] ?></h4>
                    <span>€<?= $car['rental_rate'] ?> /day</span>
                    <button class="btn btn-outline-dark" type="submit" value="<?= $car['id'] ?>" name="book_btn">Book Now</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
include_once('includes/footer.php');
?>