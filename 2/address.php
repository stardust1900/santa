<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}
include 'header.php';
?>
<div class="alert alert-danger" role="alert">想收到礼物？先留下你的地址吧！(此信息不会公开，只有领取你愿望的人能开到)</div>
<form class="form-horizontal" role="form" method="POST" action="addAddress.php" id="register">
		  <div class="form-group">
		    <label for="address" class="col-sm-2 control-label">地址</label>
		    <div class="col-sm-10">
		      <textarea class="form-control" rows="3" name="address" id="address" placeholder=""></textarea>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="realname" class="col-sm-2 control-label">收件人</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="realname" name="realname" placeholder="" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="phone" class="col-sm-2 control-label">手机</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default btn-lg" >确定</button>
		    </div>
		  </div>
		</form>

<?php 		
    include 'footer.php';
?>