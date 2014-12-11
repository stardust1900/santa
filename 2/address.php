<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}
$user_id = $_SESSION['login_uid'];
$mysql = new SaeMysql();
$address_sql = "select * from address where user_id=".$user_id;
$address = $mysql->getLine($address_sql);
include 'header.php';
if(isset($_GET['modify']) && 1==$_GET['modify'] && $address){
?>
<form class="form-horizontal" role="form" method="POST" action="modifyAddress.php" id="addressForm">
		  <div class="form-group">
		    <label for="address" class="col-sm-2 control-label">地址</label>
		    <div class="col-sm-10">
		      <textarea class="form-control" rows="3" name="address" id="address" placeholder=""><?=$address['address']?></textarea>
		      <input type="hidden" name="user_id" value="<?=$user_id?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="realname" class="col-sm-2 control-label">收件人</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="realname" name="realname" value="<?=$address['name']?>" placeholder="" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="phone" class="col-sm-2 control-label">手机</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="phone" name="phone" value="<?=$address['phone']?>" placeholder="" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default btn-lg" >确定</button>
		    </div>
		  </div>
		</form>
<?php }else {
?>
<div class="alert alert-danger" role="alert">想收到礼物？先留下你的地址吧！(此信息不会公开，只有领取你愿望的人才能看到)</div>
<form class="form-horizontal" role="form" method="POST" action="addAddress.php" id="addressForm">
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
<?php } ?>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
$().ready(function() {
	$("#addressForm").validate(
		{
			rules:{
				address:{required: true,
				         minlength: 10},
				realname:"required",
				phone:{required: true,
    					minlength: 11,
    				    maxlength: 11,
    				    digits:true}
			},
			messages:{
				address:{required: "请输入地址",
	                     minlength: "地址太短"},
				realname:"请输入收件人",
				phone:{required: "请输入手机号码",
    					minlength: "请输入正确手机号",
    					maxlength: "请输入正确手机号",
    					digits:  "请输入正确手机号"}
			},

			highlight : function(element) {  
                $(element).closest('.form-group').addClass('has-error');  
            },  
  
            success : function(label) {  
                label.closest('.form-group').removeClass('has-error');  
                label.remove();  
            },  
  
            errorPlacement : function(error, element) {  
                element.parent('div').append(error);  
            },  
  
            submitHandler : function(form) {  
                form.submit();  
            }  
		}
		);
});
</script>

<?php 		
    include 'footer.php';
?>