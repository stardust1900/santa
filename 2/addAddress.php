<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}

if(isset($_POST['address']) && isset($_POST['realname']) && isset($_POST['phone'])) {
	$address = $_POST['address'];
	$realname = $_POST['realname'];
	$phone = $_POST['phone'];
	$user_id = $_SESSION['login_uid'];

	$mysql = new SaeMysql();
	$insert_sql = "insert into address(user_id,address,name,phone) values(".$mysql->escape($user_id).",'".$mysql->escape($address)."','".$mysql->escape($realname)."','".$mysql->escape($phone)."')";
	
	$mysql->runSql($insert_sql);
	if( $mysql->errno() != 0 ){
     die( "Error:" . $mysql->errmsg());
 	}else{
 		header("Location:makewish.php?gid=".$_SESSION['group_id']);
 	}
	$mysql->closeDb();
}
?>