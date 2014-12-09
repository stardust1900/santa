<?php
session_start();
if(isset($_POST['email']) && isset($_POST['nickname']) && isset($_POST['passwd']) && isset($_POST['passwd2'])) {
	$email = $_POST['email'];
	$nickname = $_POST['nickname'];
	$passwd = $_POST['passwd'];
	$passwd2 = $_POST['passwd2'];

	if($passwd!=$passwd2){
		$_SESSION['errorinfo'] = 'duplicate password';
 		header("Location:reg.php");
	}

	$mysql = new SaeMysql();
	$sql = "select * from user where email='".$mysql->escape($email)."'";
	if($mysql->getLine($sql)){
		 $_SESSION['errorinfo'] = 'duplicate email';
		 header("Location:reg.php");
	}else{
		$insert_sql = "insert into user(nickname,email,password,source,reg_time) values('".$mysql->escape($nickname)."','".$mysql->escape($email)."','".md5($passwd)."','self',NOW())";
		$mysql->runSql($insert_sql);
		if( $mysql->errno() != 0 ){
			$_SESSION['errorinfo'] = 'dberror';
			header("Location:reg.php");
		}else{
			$_SESSION['info'] = 'regsuccess';
			header("Location:login.php");
		}
	}

	$mysql->closeDb();
}
?>