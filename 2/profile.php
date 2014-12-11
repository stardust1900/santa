<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}
$modify = false;
if(isset($_GET['modify'])){
	if(1==$_GET['modify']) {
		$modify = true;
	}
}
$user_id = $_SESSION['login_uid'];
$sql = "select * from user where id=".$user_id;
$mysql = new SaeMysql();
$people = $mysql->getLine($sql);

$address_sql = "select * from address where user_id=".$user_id;
$address = $mysql->getLine($address_sql);

include 'header.php';
?>
<div class="panel panel-default">
  <div class="panel-heading">个人信息</div>
  <div class="panel-body">
  <?php if(""==$people['nickname'] || $modify) { ?>
    <div class="alert alert-danger" role="alert">请输入昵称</div>

    <form id="form1" class="form-horizontal" role="form" method="POST" action="addNickname.php">
		<div class="form-group">
	    <label class="col-sm-2 control-label">昵称：</label>
	    <div class="col-sm-8">
	    <input name="user_id" type="hidden" value="<?=$user_id?>" >
	    <input name="nickname" type="text" class="form-control" value="<?=$people['nickname']?>" required>
	    </div>
	    </div>
	    <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default btn-lg" >确定</button>
		    </div>
		  </div>
    </form>
  <?php }else{ ?>

		<div class="form-group">
		    <label >昵称：</label>
		    <span><?=$people['nickname']?></span>
		</div>
			<a href="profile.php?modify=1">
			<span class="glyphicon glyphicon-edit"></span>
			</a>
  <?php	} ?>
  </div>

 </div>

 <div class="panel panel-default">
  <div class="panel-heading">地址</div>
  <div class="panel-body"> 
  <?php if($address) { ?>
         <div class="form-group">
		    <label >地址：</label>
		    <span><?=$address['address']?></span>
		</div>
		 <div class="form-group">
		    <label >收件人：</label>
		    <span><?=$address['name']?></span>
		</div>
		 <div class="form-group">
		    <label >手机：</label>
		    <span><?=$address['phone']?></span>
		</div>
		<a href="address.php?modify=1">
			<span class="glyphicon glyphicon-edit"></span>
		</a>
  <?php } else{ ?>
  		<a href="address.php" class="btn btn-default btn-lg active" role="button">添加地址</a>
  <?php } ?>
  </div>

 </div>
<script type="text/javascript">
$().ready(function() {
	$("#home").removeClass("active");
	$("#profile").addClass("active");

});
</script>

 <?php
   include 'footer.php';
 ?>