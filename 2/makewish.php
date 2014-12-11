<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}

if(!isset($_GET['gid']) || !isset($_SESSION['joined_groups'])){
    header("Location:index.php");
}

$group_id = $_GET['gid'];
$joined_groups = $_SESSION['joined_groups'];
if(!strstr($joined_groups.",",",".$group_id.",")){
	 header("Location:index.php");
}

$user_id = $_SESSION['login_uid'];
$mysql = new SaeMysql();
if(!isset($_SESSION['address'])) {
	$address_sql = "select * from address where user_id=".$user_id;
	
	$address = $mysql->getLine($address_sql);
	if($address){
		 $_SESSION['address']=$address['id'];
	}else{
		 $_SESSION['group_id']=$group_id;
		 header("Location:address.php");
	}
}

$wish_sql = "select * from wish where make_by=".$user_id." and group_id=".$group_id;
$wish = $mysql->getLine($wish_sql);
if($wish){
   $_SESSION['info']="wishmade";
  header("Location:tips.php");
}

include 'header.php';
?>

<div class="page-header">
      <h1>谁是我的圣诞老人？<small>许下你的心愿，看看谁会帮你实现</small></h1>
    </div>


    <form class="form-horizontal" role="form" method="POST" action="doWish.php" id="wishForm">
    <input type="hidden" id="user_id" name="user_id" value="<?=$user_id?>"/>
    <input type="hidden" id="group_id" name="group_id" value="<?=$group_id?>"/>
  <div class="form-group">
    <label for="content" class="col-sm-2 control-label">我希望</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="content" id="content" placeholder="" required></textarea>
    </div>
  </div>

    <div class="form-group">
    <label for="memo" class="col-sm-2 control-label">对圣诞老人说</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" name="memo" id="memo" placeholder="" required></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-danger btn-lg">阿门</button>
    </div>
  </div>
</form>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
$().ready(function() {
  $("#wishForm").validate(
    {
      rules:{
        content:"required",
        memo:"required"
      },
      messages:{
        content:"请输入心愿",
        memo:"请输入悄悄话"
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