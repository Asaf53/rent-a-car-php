<?php
include_once('includes/header.php');

$user_id = $_SESSION['user_id'];

$users = [];
$sql = "SELECT * FROM `users` WHERE id = ?";
$stm = $pdo->prepare($sql);
$stm->execute([$user_id]);
$users = $stm->fetchAll(PDO::FETCH_ASSOC);

$bookings = [];
$sql_bookings = "SELECT * FROM `rental` 
INNER JOIN `users` ON `rental`.`user_id` = `users`.`id` 
INNER JOIN `cars` ON `rental`.`car_id` = `cars`.`id`
INNER JOIN `locations` AS `pickup_location` ON `rental`.`pickup_location_id` = `pickup_location`.`id`
INNER JOIN `locations` AS `return_location` ON `rental`.`return_location_id` = `return_location`.`id` WHERE `rental`.`user_id` = ?";
$stm_bookings = $pdo->prepare($sql_bookings);
$stm_bookings->execute([$user_id]);
$bookings = $stm_bookings->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['action'])) {
    $rental_number = $_GET['rental_number'];
    if ($_GET['action'] === 'rental' || $_GET['action'] === 'rental_number') {
        $alert = "Your rental has been confirmed. Thank you for choosing our service. <br> Your Booking Number is: <b>$rental_number</b>";
    }
}
?>
<div class="container my-4 py-4">
    <?php if (isset($_GET['action'])) : ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?= $alert; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <h2 class="text-dark fw-bold mb-4">My Bookings</h2>
    <div class="table-responsive">
        <table class="table table-hover table-striped tm-table-striped-even mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Number</th>
                    <th scope="col">Car</th>
                    <th scope="col">Pick Up Location</th>
                    <th scope="col">Return Location</th>
                    <th scope="col">Pick Up Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created at</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($bookings as $book) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td class="fw-bold"><?= $book['rental_number'] ?></td>
                        <td><?= $book['make'] . " " . $book['model'] ?></td>
                        <td><?= $book['name'] . " - " . $book['address'] ?></td>
                        <td><?= $book['name'] . " - " . $book['address'] ?></td>
                        <td><?= $book['start_date'] ?></td>
                        <td><?= $book['end_date'] ?></td>
                        <td><?= $book['total_cost'] ?>&euro;</td>
                        <td>
                            <?php
                            switch ($book['status']):
                                case 'Pending': ?>
                                    <div>
                                        <span class="badge text-bg-warning p-2 text-white">Pending</span>
                                    </div>
                                <?php break;
                                case 'Confirmed': ?>
                                    <div>
                                        <span class="badge text-bg-success p-2 text-white">Confirmed</span>
                                    </div>
                            <?php break;
                            endswitch; ?>
                        </td>
                        <td><?= $book['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include_once('includes/footer.php');
?>