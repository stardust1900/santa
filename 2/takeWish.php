<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}

if(!isset($_GET['wid']) ||!isset($_GET['gid']) || !isset($_SESSION['joined_groups'])){
    header("Location:index.php");
}

$group_id = $_GET['gid'];
$joined_groups = $_SESSION['joined_groups'];
if(!strstr($joined_groups.",",",".$group_id.",")){
	 header("Location:index.php");
}

$user_id = $_SESSION['login_uid'];
$wish_id = $_GET['wid'];

$mysql = new SaeMysql();
$sql= "select * from wish where take_by=".$user_id." and group_id=".$group_id;
$wish = $mysql->getLine($sql);
if($wish){
	$_SESSION['info']="wishtoken";
	header("Location:tips.php");
}else{
	$update_sql = "update wish set status = 1,take_by=".$user_id.",take_time=NOW() where id=".$mysql->escape($wish_id)." and status = 0";

	$mysql->runSql($update_sql);
	if( $mysql->errno() != 0 ){
	     die( "Error:" . $mysql->errmsg() );
	}
	$mysql->closeDb();
	header("Location:mygifts.php");
}

?>