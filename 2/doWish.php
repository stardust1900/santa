<?php
session_start();
if(isset($_POST['user_id']) && isset($_POST['group_id']) && isset($_POST['content']) && isset($_POST['memo'])) {
	$user_id = $_POST['user_id'];
	$group_id = $_POST['group_id'];
	$content = $_POST['content'];
	$memo = $_POST['memo'];

	$mysql = new SaeMysql();
	$insert_sql = "insert into wish (content,memo,make_by,make_time,group_id) values('".$mysql->escape($content)."','".$mysql->escape($memo)."',".$user_id.",NOW(),".$group_id.")";
	$mysql->runSql($insert_sql);
	if( $mysql->errno() != 0 ){
     die( "Error:" . $mysql->errmsg());
 	}else{
 		header("Location:mywishes.php");
 	}
	$mysql->closeDb();
}else{
	header("Location:tips.php");
}
?>