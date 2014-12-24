<?php
session_start();
require_once('sdk/DoubanOAuth.php');
include_once( 'saetv2.ex.class.php' );
require_once('config.php');
header("Content-Type: text/html; charset=utf-8");
if(isset($_POST['user_id']) && isset($_POST['group_id']) && isset($_POST['content']) && isset($_POST['memo'])) {
	$user_id = $_POST['user_id'];
	$group_id = $_POST['group_id'];
	$content = $_POST['content'];
	$memo = $_POST['memo'];

	$mysql = new SaeMysql();
	$insert_sql = "insert into wish (content,memo,make_by,make_time,group_id) values('".$mysql->escape($content)."','".$mysql->escape($memo)."',".$user_id.",NOW(),".$group_id.")";
	$mysql->runSql($insert_sql);
	

 	$user_sql = "select * from user where id=".$user_id;
 	$member = $mysql->getLine($user_sql);

 	$group_sql = "select * from groups where id=".$group_id;
 	$group = $mysql->getLine($group_sql);
 	$text = "谁是我的圣诞老公公？我在".$group['name']."小组许了愿，快来帮我实现吧！http://santaclaus.sinaapp.com/";

 	if('douban'==$member['source']){
 		$douban_sql = "select * from douban where user_id=".$user_id;
 		$record = $mysql->getLine($douban_sql);
 		$douban = new DoubanOAuth(array(
          'key' => KEY,
          'secret' => SECRET,
          'redirect_url' => REDIRECT,
           'access_token' =>$record['db_access_token'],));
 		$ret = $douban->post('shuo/v2/statuses/',array('source'=>KEY,'text'=>$text,));
 	}else if('weibo'==$member['source']){
 		$weibo_sql = "select * from weibo where user_id=".$user_id;
 		$record = $mysql->getLine($weibo_sql);
 		$weibo = new SaeTClientV2( WB_AKEY , WB_SKEY,$record['wb_access_token']);
		$weibo->update($text);
 	}
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