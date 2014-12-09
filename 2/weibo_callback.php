<?php
session_start();
include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
header('Content-Type:text/html; charset=utf-8');
$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
	} catch (OAuthException $e) {
	}
}
if($token) {
	$weibo_uid = $token["uid"];
	$weibo_access_token = $token["access_token"];
    
    $mysql = new SaeMysql();
    $sql = "select * from weibo where wb_uid = '".$weibo_uid."'";
    $record = $mysql -> getLine($sql);
    if ($mysql->errno() != 0) {
       die("Error:" . $mysql->errmsg());
    }
    if($record){
         $user_id =$record['user_id'];
         if($access_token != $record['wb_access_token']) {
             $updateSql = "update weibo set wb_access_token='".$weibo_access_token."' where wb_uid='".$weibo_uid."'";
              $mysql->runSql($updateSql);
             
             if ($mysql->errno() != 0) {
                die("Error:" . $mysql->errmsg());
             }
         }
     }else{
        $weibo = new SaeTClientV2( WB_AKEY , WB_SKEY,$weibo_access_token);
        $uid_get = $weibo->get_uid();
		$uid = $uid_get['uid'];
        $people = $weibo->show_user_by_id($uid);
        $sql = "insert into user (nickname,source,reg_time) values('".$people['screen_name']."','weibo',NOW())";
        $mysql->runSql($sql);
        $user_id = $mysql->lastId();
        $insertSql = "insert into weibo (user_id,wb_uid, wb_access_token) values('".$user_id."','".$weibo_uid."','".$weibo_access_token."')";
        $mysql->runSql($insertSql);
         if ($mysql->errno() != 0) {
                die("Error:" . $mysql->errmsg());
         }
         $_SESSION['db_uid'] = $douban_user_id;
     }

     $_SESSION['login_uid']=$user_id;
      $group_sql = "select * from relation where user_id=".$user_id;
      $joined_groups = $mysql->getData($group_sql);
      if($joined_groups) {
        foreach($joined_groups as $group){
          $_SESSION['joined_groups']=$_SESSION['joined_groups'].",".$group['group_id'];
        }
      }

    $mysql->closeDb();

header("Location:index.php");
}else{
  $url =$o->getAuthorizeURL(WB_CALLBACK_URL);
  include 'header.php';
  echo '<div class="alert alert-danger" role="alert">授权失败,请重试<a href="'.$url.'">返回</a></div>';
  include 'footer.php';
}

?>

