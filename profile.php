<?php
include_once('includes/header.php');

$user_id = $_GET['user_id'];

$users = [];
$sql = "SELECT * FROM `users` WHERE id = ?";
$stm = $pdo->prepare($sql);
$stm->execute([$user_id]);
$users = $stm->fetchAll(PDO::FETCH_ASSOC);

print_r($users);
?>

<?php
include_once('includes/footer.php');
?>