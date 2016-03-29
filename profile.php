<?php
$page_title = "Profile | MyPath";
require_once 'snippets/load.php';
require_once 'layout/header.php';
if($login){
	$user_data = $db->select('user_data','*',"user_id='{$login->user_id}'");
	if(!empty($_GET)){
		if($_GET['action'] === 'Edit profile'){
?>
<main class="row">
	<h2 class="col-md-offset-1">My profile</h2>
	<div class="col-md-8 col-md-offset-2">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
			<ul>
				<li><label>Email:</label><input type="text" class="form-control" name="user_email" value="<?php echo $login->user_email ?>"></li>
				<li><label>User name:</label><input type="text" class="form-control" name="user_name" value="<?php echo $login->user_name ?>"></li>
			</ul>
			<input class="btn btn-default" type="submit" value="Save changes">
		</form>
	</div>
</main>
<?php
		}
	}
	else{
		if(!empty($_POST)){
			$data = $db->clean($_POST);
			foreach ($data as $key => $value) {
				$array[] = $key . "='" . $value . "'"; 
			}
			$colls_values = implode(',', $array);
			if(isset($data['user_email']) && isset($data['user_name'])){
				$table = 'logins';
			}
				
			if(isset($data['chall_name']) && isset($data['chall_day'])){
				$table = 'user_data';
			}
				
			
			if($db -> update($table,$colls_values,"user_id='{$login->user_id}'")){
				
				$phpself = htmlentities($_SERVER['PHP_SELF']);
				header("Location:index.php");
				exit;
			}
			else
				echo '<mark>Server Error</mark>';

		}
?>
<main class="row">
	<h2 class="col-md-offset-1">Profile:</h2>
	<div class="col-md-8 col-md-offset-2">
		<ul>
			<li><?php echo $login->user_email; ?></li>
			<li><?php echo $login->user_name; ?></li>
		</ul>
		<form method="get" action="<?php echo(htmlentities($_SERVER['PHP_SELF'])); ?>">
			<input type="submit" class="btn btn-default" value="Edit profile" name="action">
		</form>
	</div>
</main>
<?php
	}
}
require_once 'layout/footer.php';
?>