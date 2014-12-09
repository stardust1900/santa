<?php
session_start();
if(isset($_POST['email']) && isset($_POST['passwd'])) {
	$email = $_POST['email'];
	$passwd = $_POST['passwd'];
	$mysql = new SaeMysql();
	$sql = "select * from user where email='".$mysql->escape($email)."'";
	$record = $mysql->getLine($sql);
	if($record) {
		if(md5($passwd) == $record['password']) {
			$_SESSION['login_uid']=$record['id'];
			$group_sql = "select * from relation where user_id=".$record['id'];
			$joined_groups = $mysql->getData($group_sql);
			if($joined_groups) {
				foreach($joined_groups as $group){
					$_SESSION['joined_groups']=$_SESSION['joined_groups'].",".$group['group_id'];
				}
			}

			header("Location:index.php");
		}else{
			$_SESSION['info'] = 'wrongpassword';
			header("Location:login.php");
		}

	}else{
		$_SESSION['info'] = 'unregisted';
		header("Location:login.php");
	}
	$mysql->closeDb();
}
?>