<?php include_once('includes/header.php');
$u = null;
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    $sql_user = "SELECT * FROM `users` WHERE id = ?";
    $stm_user = $pdo->prepare($sql_user);
    $stm_user->execute([$userId]);
    $u = $stm_user->fetchAll(PDO::FETCH_ASSOC);
}
if (isset($_POST['edit_btn'])) {
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $sql_edit_user = "UPDATE `users` SET `fullname` = ?, `email` = ?, `phone` = ?, `role` = ? WHERE id = ?";
    $stm_edit_user = $pdo->prepare($sql_edit_user);
    if ($stm_edit_user->execute([$fullname, $email, $phone, $role, $user_id])) {
        header('Location: accounts.php?action=edit');
    }
}

if (isset($_GET['action']) && ($_GET['action'] === 'delete')) {
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $sql_delete_user = "DELETE FROM `users` WHERE id = ?";
        $stm_delete_user = $pdo->prepare($sql_delete_user);
        $stm_delete_user->execute([$user_id]);
    }
}

$users = [];
$sql_users = "SELECT * FROM `users`";
$stm_users = $pdo->prepare($sql_users);
$stm_users->execute();
$users = $stm_users->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- row -->
<div class="row tm-content-row tm-mt-big">
    <div class="tm-col tm-col-big col-md-7 col-12">
        <div class="bg-white tm-block">
            <div class="row">
                <div class="col-12">
                    <h2 class="tm-block-title d-inline-block">Accounts</h2>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    <thead>
                        <tr class="tm-bg-gray">
                            <th scope="col">No.</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td class="tm-user-name"><?= $user['fullname'] ?></td>
                                <td class="tm-user-name d-none"><?= $user['id'] ?></td>
                                <td class="tm-user-name"><?= $user['email'] ?></td>
                                <td class="tm-user-name"><?= $user['phone'] ?></td>
                                <td class="text-center">
                                    <a href="?action=delete&user_id=<?= $user['id'] ?>"><i class="fas fa-trash-alt tm-trash-icon"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tm-col tm-col-big col-md-5 col-12">
        <div class="bg-white tm-block">
            <div class="row">
                <div class="col-12">
                    <h2 class="tm-block-title">Edit Account</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="tm-signup-form">
                        <?php if ($u !== null) : ?>
                            <?php foreach ($u as $u) : ?>
                                <div class="form-group">
                                    <label for="name">Account Name</label>
                                    <input value="<?= $u['fullname'] ?>" id="name" name="fullname" type="text" class="form-control validate">
                                    <input value="<?= $u['id'] ?>" name="user_id" type="text" hidden>
                                </div>
                                <div class="form-group">
                                    <label for="email">Account Email</label>
                                    <input value="<?= $u['email'] ?>" id="email" name="email" type="email" class="form-control validate">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input value="<?= $u['phone'] ?>" id="phone" name="phone" type="tel" class="form-control validate">
                                </div>
                                <div class="form-group">
                                    <label for="role">Account Role</label>
                                    <select name="role" id="role" class="custom-select">
                                        <option value="<?= $u['role'] ?>" selected><?= $u['role'] ?></option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <button class="btn btn-primary" name="edit_btn">Upadate</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(function() {
        $('.tm-user-name').on('click', function() {
            var userId = $(this).siblings('.d-none').text();
            localStorage.setItem('selectedUserId', userId);
            var itemId = localStorage.getItem('selectedUserId');
            var url = "accounts.php?userId=" + itemId;
            window.location.href = url;
        });
    });
</script>
</body>

</html>