<?php
include_once('includes/header.php');

$login_errors = [];
if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $login_errors[] = "Please enter a valid email address.";
    }

    if (count($login_errors) === 0) {
        $sql = "SELECT * FROM `users` WHERE email = ?";
        $stm = $pdo->prepare($sql);
        if ($stm->execute([$email])) {
            $user = $stm->fetch();
            if (password_verify($password, $user['password'])) {
                $_SESSION['is_loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['role'] = $user['role'];
                if ($user['role'] === 'admin') {
                    header('Location: admin/index.php');
                } else {
                    header('Location: index.php?action=login');
                }
            } else {
                $login_errors[] = "Something went wrong!!";
            }
        }
    }
}
?>
<div class="container w-25 my-5">
    <main class="form-signin w-100 m-auto">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <h4 class="text-center">Login</h4>
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" autocomplete="false">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="false">
                <label for="password">Password</label>
            </div>
            <button class="btn border-outline-primary w-100 py-2 mb-2" name="login_btn" type="submit">Log in</button>
            <a class="text-secondary-emphasis" href="register.php">Sign in</a>
        </form>
    </main>
</div>
<?php
include_once('includes/footer.php');
?>