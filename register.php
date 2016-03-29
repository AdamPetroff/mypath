<?php
$page_title = 'Register | MyPath';
require_once 'snippets/load.php';
require_once 'layout/header.php';
$user -> register('login.php');
?>
<main class="row">
	<h2 class="col-md-offset-1">Register:</h2>
	<div class="col-md-8 col-md-offset-2">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<table class="table">
				<tr>
					<td><label for="_register_email">Email:</label></td>
					<td><input type="email" class="form-control" id="_register_email" name="email" required></td>
				</tr>
				<tr>
					<td><label for="_register_name">Name:</label></td>
					<td><input type="text" class="form-control" id="_register_name" name="name" required></td>
				</tr>
				<tr>
					<td><label for="_register_password">Password:</label></td>
					<td><input type="password" class="form-control" id="_register_password" name="password" required></td>
				</tr>
				<tr>
					<td><label for="_register_repassword">Please type in your password again:</label></td>
					<td><input type="password" class="form-control" id="_register_repassword" name="repassword" required></td>
				</tr>
			</table>
			<input name="registered" value="<?php echo time(); ?>" hidden>
			<input type="submit" class="btn btn-default">
		</form>
	</div>
</main>
<?php
require_once 'layout/footer.php';
?>