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
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
<div class="container">
<nav class="navbar navbar-default" role="navigation">
 <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand" href="index.php">Santa</a>
    </div>

   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li id="home" class="active"><a href="index.php">首页</a></li>
        <li id="mygroup"><a href="mygroup.php">小组</a></li>
        <li id="mywishes"><a href="mywishes.php">心愿</a></li>
        <li id="mygifts"><a href="mygifts.php">认领</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(isset($_SESSION['login_uid'])){?>
          <li id="profile"><a href="profile.php">资料</a></li>
          <li><a href="logout.php">注销</a></li>
         <?php }else{?>
          <li><a href="login.php">登录</a></li>
        <?php
         } ?>
      </ul>
    </div>
</nav>