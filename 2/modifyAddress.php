<?php 
if(isset($_POST['address']) && isset($_POST['realname']) && isset($_POST['phone']) && isset($_POST['user_id'])) {
	$address = $_POST['address'];
	$realname = $_POST['realname'];
	$phone = $_POST['phone'];
	$user_id = $_POST['user_id'];

	$mysql = new SaeMysql();
	$insert_sql = "update address set address='".$mysql->escape($address)."',name='".$mysql->escape($realname)."',phone='".$mysql->escape($phone)."' where user_id=".$mysql->escape($user_id);
	
	$mysql->runSql($insert_sql);
	if( $mysql->errno() != 0 ){
     die( "Error:" . $mysql->errmsg());
 	}else{
 		header("Location:profile.php");
 	}
	$mysql->closeDb();
}else{
	header("Location:tips.php");
}

?>