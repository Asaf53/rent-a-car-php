<?php
include_once('includes/header.php');
?>
<div class="container w-25 my-5">
    <main class="form-signin w-100 m-auto">
        <form autocomplete="off" method="post">
            <img class="mb-4" src="assets/img/logo/logo.png" alt="logo">
            <h5 class="mb-3">Please log in</h5>
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