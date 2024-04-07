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

        foreach ($cars as $key => $car) {
            $carImages = [];
            $sql = "SELECT * FROM `cars_images` WHERE `car_id` = ?";
            $stm = $pdo->prepare($sql);
            $stm->execute([$car['id']]);
            $carImages = $stm->fetchAll(PDO::FETCH_ASSOC);
            $cars[$key]['images'] = $carImages;
        }
        
        if (empty($cars)) {
            $errors[] = "No cars available for the specified dates and locations.";
        }
        $days = countDays("$pickUpDate", "$returnDate");
    } else {
        $errors[] = "Required fields are empty.";
    }
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?action=rent_login&type=warning');
    die();
}

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
        header("Location: profile.php?action=rental&rental_number=$rental_number");
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
                        <div id="carsCarousel<?= $car['id'] ?>" class="carousel slide">
                            <div class="carousel-inner">
                                <?php if (count($car['images']) > 0) : ?>
                                    <?php foreach ($car['images'] as $index => $image) : ?>
                                        <div class="carousel-item <?= ($index === 0) ? 'active' : '' ?>">
                                            <img src="assets/img/cars/<?= $image['images'] ?>" class="d-block w-100" alt="cars-<?= $car['id'] ?>">
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <img src="assets/img/cars/noimage.jpg" class="d-block w-100" alt="cars-noimage">
                                <?php endif; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carsCarousel<?= $car['id'] ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carsCarousel<?= $car['id'] ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
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