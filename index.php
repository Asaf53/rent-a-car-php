<?php
include_once('includes/header.php');


$cars = [];
$sql = "SELECT * FROM `cars`";
$stm = $pdo->prepare($sql);
$stm->execute();
$cars = $stm->fetchAll(PDO::FETCH_ASSOC);

$locations = [];
$sql_location = "SELECT * FROM `locations`";
$stm_location = $pdo->prepare($sql_location);
$stm_location->execute();
$locations = $stm_location->fetchAll(PDO::FETCH_ASSOC);

foreach ($cars as $key => $car) {
    $carImages = [];
    $sql = "SELECT * FROM `cars_images` WHERE `car_id` = ?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$car['id']]);
    $carImages = $stm->fetchAll(PDO::FETCH_ASSOC);
    $cars[$key]['images'] = $carImages;
}


if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $alert = 'You have successfully logged in.';
            break;
        case 'rental':
            $alert = 'Your rental has been confirmed. Thank you for choosing our service.';
            break;
    }
}
?>

<!-- hero section start  -->
<?php if (isset($_GET['action'])) : ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <?= $alert; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<section id="hero" class=" position-relative overflow-hidden">
    <div class="pattern-overlay pattern-right position-absolute">
        <img src="assets/img/home/hero-pattern-right.png" alt="pattern">
    </div>
    <div class="pattern-overlay pattern-left position-absolute">
        <img src="assets/img/home/hero-pattern-left.png" alt="pattern">
    </div>
    <div class="hero-content container text-center">
        <div class="row">
            <div class="mb-4">
                <h1 class="hero-title">Find your <span class="text-primary">rental car</span></h1>
                <p class="hero-paragraph">We have many best rental car collections.</p>
            </div>
        </div>
    </div>
</section>

<!-- search section start  -->
<section id="search" class="main">
    <div class="container search-block p-5 bg-white rounded-0">
        <form class="row" action="rents.php">
            <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
                <div class="form-floating">
                    <select class="form-select rounded-0" aria-label="Default select example" name="pickupLocation" id="pickup">
                        <option value="" selected>Pickup</option>
                        <?php foreach ($locations as $location) : ?>
                            <option value="<?= $location['id'] ?>"><?= $location['name'] . " - " . $location['address'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="return">Pickup Location</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
                <div class="form-floating">
                    <select class="form-select rounded-0" aria-label="Default select example" name="returnLocation" id="return">
                        <option value="" selected>Return</option>
                        <?php foreach ($locations as $location) : ?>
                            <option value="<?= $location['id'] ?>"><?= $location['name'] . " - " . $location['address'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="return">Return Location</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
                <div class="form-floating">
                    <input type="date" class="form-control rounded-0" id="pickupDate" name="pickupDate">
                    <label for="pickupDate">Pickup Date:</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mt-4 mt-lg-0">
                <div class="form-floating">
                    <input type="date" class="form-control rounded-0" id="returnDate" name="returnDate">
                    <label for="returnDate">Return Date:</label>
                </div>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button class="btn btn-dark rounded-0 py-3" type="submit" name="search_btn">Find your car</button>
            </div>
        </form>
    </div>
</section>

<!-- cars section start  -->
<section class="position-relative">
    <div class="container my-0 my-md-5 py-0 py-md-5">
        <h2 class="text-center my-5">Our Cars</h2>
        <div class="swiper rental-swiper mb-5">
            <div class="swiper-wrapper">
                <?php foreach ($cars as $car) : ?>
                    <div class="swiper-slide">
                        <div class="card rounded-0">
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
                            <div class="card-body p-4">
                                <h4 class="card-title"><?= $car['make'] . " " . $car['model'] ?></h4>
                                <div class="card-text">
                                    <div class="d-flex">
                                        <span class="pe-3 border-end d-flex align-items-center justify-content-between"><i class="bx bx-user me-1"></i> <?= $car['seats'] ?> Passengers</span>
                                        <span class="pe-3 ps-3 border-end d-flex align-items-center justify-content-between"><img src="assets/img/icon/gear.svg" alt="gear icon"><?= $car['gearbox'] ?></span>
                                        <span class="ps-3 d-flex align-items-center justify-content-between"><i class='bx bx-calendar-alt me-1'></i><?= $car['year'] ?></span>
                                    </div>
                                </div>
                                <hr>
                                <h3 class="pt-2 h4">$<?= $car['rental_rate'] ?> <span class="rental-price">/ day</span></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="text-center"><a href="cars.php" class="btn btn-outline-dark">View More</a></div>
    </div>
</section>

<?php
include_once('includes/footer.php');
?>