<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header('Location: customers.php');
}

if (!empty($_POST)) {
    require_once 'functions.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $adminInfo = getAdminInfo($username);

    if (!empty($adminInfo)) {
        $hash = $adminInfo[0]['password'];
        $result = password_verify($password, $hash);

        if ($result) {
            $_SESSION['logged_in'] = true;
            header('Location: customers.php');
        } else {
            $errorMessage = 'Invalid username and/or password.';
        }
    } else {
        $errorMessage = 'Invalid username and/or password.';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/login.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form method="post">
            <img class="mb-4" src="assets/images/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please log in</h1>

            <?php if (isset($errorMessage)) { ?>
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    <?php echo $errorMessage; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <div class="form-floating">
                <input type="username" name="username" class="form-control" id="username">
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password">
                <label for="password">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>
            <p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y'); ?></p>
        </form>
    </main>

</body>

</html>