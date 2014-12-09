<?php
session_start();
if(isset($_SESSION['errorinfo'])){
	if('duplicate email' == $_SESSION['errorinfo']) {
		$errormsg = "你输入的电邮已经注册！";
		unset($_SESSION['errorinfo']);
	}else if('dberror'==$_SESSION['errorinfo']){
		$errormsg = "数据库错误，注册失败！";
		unset($_SESSION['errorinfo']);
	}
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
  		if($errormsg) {
  		?>
  		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  <?=$errormsg?>
		</div>
  		<?php
  		}
  		?>
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">注册</h3>
	  </div>
	  <div class="panel-body">
	   <form class="form-horizontal" role="form" method="POST" action="doReg.php" id="register">
		  <div class="form-group">
		    <label for="email" class="col-sm-2 control-label">电邮</label>
		    <div class="col-sm-10">
		      <input type="email" class="form-control" id="email" name="email" placeholder="Email" required >
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="nickname" class="col-sm-2 control-label">昵称</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="nickname" name="nickname" placeholder="昵称" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="passwd" class="col-sm-2 control-label">密码</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Password" required>
		    </div>
		  </div>

		   <div class="form-group">
		    <label for="passwd2" class="col-sm-2 control-label">确认密码</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="passwd2" name="passwd2" placeholder="Password" required>
		    </div>
		  </div>

		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default btn-lg" >确定</button>
		      <a href="login.php" class="btn btn-default btn-lg" role="button">返回</a>
		    </div>
		  </div>
		</form>
	  </div>
	</div>
</div>
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>

	<script>
	$().ready(function() {
		$("#register").validate(
		{
			rules:{
				email:{required: true,
	                     email: true},
				nickname:"required",
				passwd:{required: true,
    					minlength: 5},
				passwd2:{required: true,
					    minlength: 5,
					    equalTo: "#passwd"}
			},
			messages:{
				email:{required: "请输入Email地址",
	                     email: "请输入正确的email地址"},
				nickname:"请输入昵称",
				passwd:{required: "请输入密码",
    					minlength: "密码不能小于5个字符"},
				passwd2:{required: "请输入确认密码",
					    minlength: "密码不能小于5个字符",
					    equalTo: "两次输入密码不一致"}
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
  </body>
</html>