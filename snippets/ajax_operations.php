<?php
require_once 'load.php';
if($login = $user->check_login()){
	if(!empty($_GET)){
		
	}

	if(!empty($_POST)){
		$clean_post = $db->clean($_POST);
		if(isset($clean_post['array']) && isset($clean_post['col'])){
			$string = implode(',',$clean_post['array']);
			$response = $db->update('user_data',$clean_post['col']."='$string'","user_id='{$login->user_id}'");
			die($response);
		}
		if(isset($clean_post['chall_name'])){
			$response = $db->update('user_data',"chall_name='{$clean_post['chall_name']}'","user_id='{$login->user_id}'");
			die($response);
		}
		if(isset($clean_post['chall_day'])){
			if($clean_post['chall_day'] < 28)
				$response = $db->update('user_data',"chall_day='{$clean_post['chall_day']}'","user_id='{$login->user_id}'");
			else
				$response = $db->update('user_data',"chall_day=NULL, chall_name=NULL","user_id='{$login->user_id}'");
			die($response);
		}
	}
}
?>