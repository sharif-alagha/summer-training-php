<?php
require_once 'functions.php';

if (!empty($_POST)) {
	session_start();

	$result = deleteCustomer();

	if ($result > 0) {
		$_SESSION['success_msg'] = 'Customer has been deleted successfully.';
	} else {
		$_SESSION['error_msg'] = 'Failed to delete customer, please try again.';
	}

	header('Location: customers.php');
}