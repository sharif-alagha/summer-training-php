<?php
session_start();

require_once 'functions.php';

$customers = getAllCustomers();

require_once 'layouts/header.php';
require_once 'layouts/sidebar.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
	<?php if (isset($_SESSION['success_msg'])) { ?>
		<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
			<?php echo $_SESSION['success_msg']; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php } ?>

	<?php if (isset($_SESSION['error_msg'])) { ?>
		<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
			<?php echo $_SESSION['error_msg']; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php } ?>

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Customers List</h1>

		<div class="btn-toolbar mb-2 mb-md-0">
			<a href="add_customer.php" class="btn btn-success">Add a new customer</a>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope="col">Image</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($customers as $k => $v) { ?>
					<tr>
						<td><?php echo $k + 1; ?></td>
						<td><?php echo $v['first_name']; ?></td>
						<td><?php echo $v['last_name']; ?></td>
						<td><?php echo $v['email']; ?></td>
						<td>
							<?php if ($v['image_path']) { ?>
								<img src="<?php echo $v['image_path']; ?>" width="100" height="100" class="img-thumbnail">
							<?php } ?>
						</td>
						<td>
							<a href="edit_customer.php?action=edit&customer-id=<?php echo $v['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
							<a href="#" class="btn btn-danger btn-sm delete-btn" data-customer-id="<?php echo $v['id']; ?>">Delete</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</main>

<div class="modal fade" id="delete-modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="delete_customer.php">
				<input type="hidden" name="id">

				<div class="modal-body">
					<b>Confirm delete?</b>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.delete-btn').on('click', function() {
			var customerId = $(this).data('customer-id');

			$('#delete-modal input[name="id"]').val(customerId);

			$('#delete-modal').modal('show');
		});
	});
</script>

<?php
unset($_SESSION['success_msg']);
unset($_SESSION['error_msg']);
require_once 'layouts/footer.php';
?>