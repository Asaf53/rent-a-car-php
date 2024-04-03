<?php
include_once('includes/header.php');

$cars = [];
$sql = "SELECT * FROM `cars`";
$stm = $pdo->prepare($sql);
$stm->execute();
$cars = $stm->fetchAll(PDO::FETCH_ASSOC);

foreach ($cars as $key => $car) {
    $carImages = [];
    $sql = "SELECT * FROM `cars_images` WHERE `car_id` = ?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$car['id']]);
    $carImages = $stm->fetchAll(PDO::FETCH_ASSOC);
    $cars[$key]['images'] = $carImages;
}
?>
<div class="container mt-5">
    <div class="swiper rental-swiper mb-5">
        <div class="swiper-wrapper">
            <?php foreach ($cars as $car) : ?>
                <div class="swiper-slide">
                    <div class="card rounded-0">
                        <div id="carsCarousel<?= $car['id'] ?>" class="carousel slide">
                            <div class="carousel-inner">
                                <?php foreach ($car['images'] as $index => $image) : ?>
                                    <div class="carousel-item <?= ($index === 0) ? 'active' : '' ?>">
                                        <img src="assets/img/cars/<?= $image['images'] ?>" class="d-block w-100" alt="cars-<?= $car['id'] ?>-<?= $index ?>">
                                    </div>
                                <?php endforeach; ?>
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
</div>
<?php
include_once('includes/footer.php');
?>