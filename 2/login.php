<?php
session_start();
if(isset($_SESSION['login_uid'])){
    header("Location:index.php");
}
if(isset($_SESSION['info'])){
	if('regsuccess' == $_SESSION['info']) {
		$msg = "注册成功，请登录！";
		unset($_SESSION['info']);
	}else if('wrongpassword' == $_SESSION['info']){
		$msg = "密码错误！";
		unset($_SESSION['info']);
	}else if('unregisted' == $_SESSION['info']){
		$msg = "该用户没有注册！";
		unset($_SESSION['info']);
	}
}
require_once('sdk/DoubanOAuth.php');
require_once('config.php');
include_once('saetv2.ex.class.php' );
$douban = new DoubanOAuth(array(
    'key' => KEY,
    'secret' => SECRET,
    'redirect_url' => REDIRECT,
  ));

  $url = $douban->getAuthorizeURL(SCOPE, STATE);

$o = new SaeTOAuthV2(WB_AKEY,WB_SKEY);
$aurl = $o->getAuthorizeURL(WB_CALLBACK_URL);
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="wb:webmaster" content="093c5be6392da13d" />
    <title>谁是我的圣诞老公公</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
 <div class="container">
  <nav class="navbar navbar-default" role="navigation">
  	<div class="navbar-header">
      <a class="navbar-brand" href="index.php">Santa</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="index.php">首页</a></li>
      </ul>
    </div>
</nav>
  		<?php
  		if($msg) {
  		?>
  		<div class="alert alert-info alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  <?=$msg?>
		</div>
  		<?php
  		}
  		?>
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">登录</h3>
	  </div>
	  <div class="panel-body">
	  	<P class="text-center"><a href="<?=$url?>"><img src="images/douban.png"></a> <a href="<?=$aurl?>"><img src="images/weibo.png"></a></P>
	   <form class="form-horizontal" role="form" method="POST" action="doLogin.php">
		  <div class="form-group">
		    <label for="email" class="col-sm-2 control-label">电邮</label>
		    <div class="col-sm-10">
		      <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="passwd" class="col-sm-2 control-label">密码</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Password" required>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default btn-lg" >登录</button>
		      <a href="reg.php" class="btn btn-default btn-lg" role="button">注册</a>
		    </div>
		  </div>
		</form>
	  </div>
	</div>
</div>

    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>