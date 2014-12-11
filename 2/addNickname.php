<?php
if(isset($_POST['nickname']) && isset($_POST['user_id']) ) {
	$nickname = $_POST['nickname'];
	$user_id = $_POST['user_id'];
	$mysql = new SaeMysql();

	$update_sql = "update user set nickname = '".$mysql->escape($nickname)."' where id = ".$user_id;
	
	$mysql->runSql($update_sql);
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