<?php
if (!empty($_POST)) {
    session_start();
    
    require_once 'functions.php';

    $result = addCustomer();
    
    if ($result > 0) {
        $_SESSION['success_msg'] = 'Customer has been added successfully.';
    } else {
        $_SESSION['error_msg'] = 'Failed to add customer, please try again.';
    }

    header('Location: customers.php');
}

require_once 'layouts/header.php';
require_once 'layouts/sidebar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add a New Customer</h1>
    </div>

    <form id="customer-form" class="mb-5" method="post" action="add_customer.php" enctype="multipart/form-data">
        <div class="form-group mb-2">
            <label for="name">First Name:</label>
            <input type="text" class="form-control w-50" id="fname" name="fname" value="">
        </div>

        <div class="form-group mb-2">
            <label for="name">Last Name:</label>
            <input type="text" class="form-control w-50" id="lname" name="lname" value="">
        </div>

        <div class="form-group mb-2">
            <label for="email">Email address:</label>
            <input type="text" class="form-control w-50" id="email" name="email" value="">
        </div>

        <div class="form-group mb-2">
            <label for="password">Password:</label>
            <input type="password" class="form-control w-50" id="password" name="password">
        </div>

        <div class="form-group mb-2">
            <label for="password_confirmation">Confirm password:</label>
            <input type="password" class="form-control w-50" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="form-group mb-2">
            <label for="image">Customer Image:</label>
            <input type="file" class="form-control w-50" id="image" name="image">
        </div>

        <button id="submit-btn" type="submit" class="btn btn-primary"><span data-feather="check"></span> Submit
        </button>
    </form>
</main>

<?php
require_once 'layouts/footer.php';
?>