<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}
if(isset($_POST['code']) && isset($_POST['group_id'])) {
	$user_id = $_SESSION['login_uid'];
	$code = $_POST['code'];
	$group_id = $_POST['group_id'];
	$mysql = new SaeMysql(false);//传入false不做读写分离，防止查不到写入的数据
	$sql = "select * from groups where id=".$mysql->escape($group_id);
	$group = $mysql->getLine($sql);
	if($group) {
		if($code == $group['code']) {
			$insert_sql = "insert into relation (user_id,group_id) values(".$user_id.",".$group['id'].")";
			$mysql->runSql($insert_sql);
			$mysql->closeDb();
			$_SESSION['joined_groups']=$_SESSION['joined_groups'].",".$group['id'];			
			header("Location:group.php?gid=".$group['id']);
		}else{
			$_SESSION['info'] = 'wrongcode';
			header("Location:entergroup.php?gid=".$group['id']);
		}
	}else{
		header("Location:404.php");
	}
	$mysql->closeDb();
}
?>