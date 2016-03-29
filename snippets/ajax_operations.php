<?php
require_once 'load.php';
if($login = $user->check_login()){
	if(!empty($_GET)){
		
	}

	if(!empty($_POST)){
		if(isset($_POST['array']) && isset($_POST['col'])){
			$clean_post = $db->clean($_POST);
			$string = implode(',',$clean_post['array']);
			$response = $db->update('user_data',$clean_post['col']."='$string'","user_id='{$login->user_id}'");
			die($response);
		}
		if(isset($_POST['chall_name'])){
			$clean_post = $db->clean($_POST);
			$response = $db->update('user_data',"chall_name='{$clean_post['chall_name']}'","user_id='{$login->user_id}'");
			die($response);
		}
	}
}
?>