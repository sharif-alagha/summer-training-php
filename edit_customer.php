<?php
require_once 'functions.php';

if (!empty($_POST)) {
	session_start();

	$result = editCustomer();

	if ($result > 0) {
		$_SESSION['success_msg'] = 'Customer has been updated successfully.';
	} else {
		$_SESSION['error_msg'] = 'Failed to updated customer, please try again.';
	}

	header('Location: customers.php');
} else {
	$id = $_GET['customer-id'];

	$customer = getCustomerById($id);
}

require_once 'layouts/header.php';
require_once 'layouts/sidebar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Edit Customer</h1>
	</div>

	<form id="customer-form" class="mb-5" method="post" action="edit_customer.php?id=<?php echo $customer[0]['id'] ?>">
		<input type="hidden" name="id" value="<?php echo $customer[0]['id']; ?>">

		<div class="form-group mb-2">
			<label for="name">First Name:</label>
			<input type="text" class="form-control w-50" id="fname" name="fname" value="<?php echo $customer[0]['first_name']; ?>">
		</div>

		<div class="form-group mb-2">
			<label for="name">Last Name:</label>
			<input type="text" class="form-control w-50" id="lname" name="lname" value="<?php echo $customer[0]['last_name']; ?>">
		</div>

		<div class="form-group mb-2">
			<label for="email">Email address:</label>
			<input type="text" class="form-control w-50" id="email" name="email" value="<?php echo $customer[0]['email']; ?>">
		</div>

		<div class="form-group mb-2">
			<label for="password">Password:</label>
			<input type="password" class="form-control w-50" id="password" name="password">
		</div>

		<div class="form-group mb-2">
			<label for="password_confirmation">Confirm password:</label>
			<input type="password" class="form-control w-50" id="password_confirmation" name="password_confirmation">
		</div>

		<button id="submit-btn" type="submit" class="btn btn-primary"><span data-feather="check"></span> Submit
		</button>
	</form>
</main>

<?php
require_once 'layouts/footer.php';
?>