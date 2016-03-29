<?php
$page_title = 'Login | MyPath';
require_once 'snippets/load.php';
require_once 'layout/header.php';
if(!$login){
	$user->login('index.php');
?>
<main class="row">
	<h2 class="col-md-offset-1">Login:</h2>
	<div class="col-md-offset-2 col-md-8">
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<table class="table">
				<tr>
					<td><label for="_loginemail">Email:</label></td>
					<td><input type="text" name="email" class="form-control" id="_loginemail"></td>
				</tr>
				<tr>
					<td><label for="_loginpass">Password:</label></td>
					<td><input type="password" name="password" class="form-control" id="_loginpass"></td>
				</tr>
			</table>
			<input class="btn btn-default" type="submit">
		</form>
	</div>
</main>
<?php
}
else{
	?>
<main class="row">
	<div class="col-md-12">
		<p>You are already logged in.</p>
	</div>
</main>
	<?php
}
require_once 'layout/footer.php';
?>