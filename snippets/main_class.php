<?php
class user{
	public function register($redirect){
		if(!empty($_POST)){
			require_once 'db_class.php';
			global $db;
			$array = $db->clean($_POST);
			$email = $array['email'];
			$name = $array['name'];
			$password = $array['password'];
			$repassword = $array['repassword'];
			$registered = $array['registered'];
			if($repassword == $password){
				$nonce = md5('registration-' . $name . $registered . NONCE_SALT);
				$password = $db->hash_pass($password,$nonce);
				if($insert_logins = $db->insert('logins',"user_email,user_name,user_password,user_registered","'$email','$name','$password',$registered"))
					if($user_id = $db->select('logins','user_id',"user_registered='{$registered}'"))
						if($insert_user_data = $db->insert('user_data',"user_id","'{$user_id->user_id}'")){
							$url = $_SERVER['PHP_SELF'];
							$url = str_replace('register.php', $redirect, $url);
							header("Location: $url");
							exit;
						}
						else
							die('Server Error: your data wasn\'t saved in the database.');
				}
				else
					echo 'You typed in two different passwords. Please resubmit your form.';
		}
	}
	public function login($redirect){
		if(!empty($_POST)){
			global $db;
			$db -> clean($_POST);
			$email = $_POST['email'];
			$password = $_POST['password'];
			if($result = $db -> select('logins','*',"user_email='$email'")){
				$nonce = md5('registration-' . $result->user_name . $result->user_registered . NONCE_SALT);
				$password = $db -> hash_pass($password,$nonce);
				if(md5($password) === md5($result->user_password)){
					$auth_nonce = md5('cookie-' . $result->user_email . $result->user_registered . AUTH_SALT);
					$auth_cookie = $db->hash_pass($password,$auth_nonce);
					setcookie('user_auth',$auth_cookie,time() + 1000*60*60*24,'','','',true);
					setcookie('user_id',$result->user_id,time() + 1000*60*60*24,'','','',true);
					$url = str_replace('login.php', $redirect, $_SERVER['PHP_SELF']);
					header("Location: $url");
					exit;
				}
				else{
					echo('Submitted email adress and/or password weren\'t reckognized. Please try again.');
				}
			}
			else{
				echo('Submitted email adress and/or password weren\'t reckognized. Please try again.');
			}
		}
	}
	public function check_login(){
		if(isset($_COOKIE['user_auth']) && isset($_COOKIE['user_id'])){
			global $db;
			if($result = $db -> select('logins','*',"user_id='{$_COOKIE['user_id']}'")){
				$check_auth = md5('cookie-' . $result->user_email . $result->user_registered . AUTH_SALT);
				$check_auth = $db->hash_pass($result->user_password,$check_auth);
				if($_COOKIE['user_auth'] === $check_auth)
					return $result;
			}
			else
				return false;
		}
	}
	public function logout(){
		setcookie('user_email','',0,'','','',true);
		setcookie('user_auth','',0,'','','',true);
		header("Location:". $_SERVER['PHP_SELF']);
		exit;
	}
}
$user = new user();
?>