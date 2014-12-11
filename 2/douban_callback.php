<?php
session_start();
require_once('sdk/DoubanOAuth.php');
require_once('config.php');
header("Content-Type: text/html; charset=utf-8");
  $douban = new DoubanOAuth(array(
    'key' => KEY,
    'secret' => SECRET,
    'redirect_url' => REDIRECT,
  ));

$result = $douban->getAccessToken($_GET['code']);

if(isset($result['access_token'])) {
   $access_token = $result['access_token'];
   $douban_user_id = $result['douban_user_id'];
    
    $mysql = new SaeMysql();
    $sql = "select * from douban where db_uid = '".$douban_user_id."'";
    $record = $mysql -> getLine($sql);
    if ($mysql->errno() != 0) {
       die("Error:" . $mysql->errmsg());
    }
     if($record){
         $user_id =$record['user_id'];
         if($access_token != $record['db_access_token']) {
             $updateSql = "update douban set db_access_token='".$access_token."' where db_uid='".$douban_user_id."'";
              $mysql->runSql($updateSql);
             
             if ($mysql->errno() != 0) {
                die("Error:" . $mysql->errmsg());
             }
         }

      $_SESSION['login_uid']=$user_id;
      $group_sql = "select * from relation where user_id=".$user_id;
      $joined_groups = $mysql->getData($group_sql);
      if($joined_groups) {
        foreach($joined_groups as $group){
          $_SESSION['joined_groups']=$_SESSION['joined_groups'].",".$group['group_id'];
        }
      }
      header("Location:index.php");
     }else{
        $douban = new DoubanOAuth(array(
          'key' => KEY,
          'secret' => SECRET,
          'redirect_url' => REDIRECT,
           'access_token' =>$access_token,));

        $people = $douban->get('v2/user/~me');
        $sql = "insert into user (nickname,source,reg_time) values('".$people['name']."','douban',NOW())";
        $mysql->runSql($sql);
        $user_id = $mysql->lastId();
        $insertSql = "insert into douban (user_id,db_uid, db_access_token) values('".$user_id."','".$douban_user_id."','".$access_token."')";
        $mysql->runSql($insertSql);
         if ($mysql->errno() != 0) {
                die("Error:" . $mysql->errmsg());
         }
         $_SESSION['login_uid']=$user_id;
         header("Location:profile.php");
     }
    $mysql->closeDb();
}else{
  $url = $douban->getAuthorizeURL(SCOPE, STATE);
  include 'header.php';
  echo '<div class="alert alert-danger" role="alert">授权失败,请重试<a href="'.$url.'">返回</a></div>';
  include 'footer.php';
}
