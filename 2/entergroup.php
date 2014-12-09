<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}

if(!isset($_GET['gid'])){
    header("Location:index.php");
}
$group_id = $_GET['gid'];

$joined_groups = $_SESSION['joined_groups'];
if(strstr($joined_groups.",",",".$group_id.",")){
	 header("Location:group.php?gid=".$group_id);
}

$mysql = new SaeMysql();
$sql = "select * from groups where id=".$mysql->escape($group_id);
$group = $mysql->getLine($sql);
if(!$group){
	 header("Location:404.php");
}

if(isset($_SESSION['info'])){
	if('wrongcode' == $_SESSION['info']) {
		$msg = "暗号不对！";
		unset($_SESSION['info']);
	}
}

$mysql->closeDb();
include 'header.php';
?>

    <div class="page-header">
      <h1>谁是我的圣诞老人？<small>许下你的心愿，看看谁会帮你实现</small></h1>
    </div>

       <?php
  		if($msg) {
  		?>
  		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  <?=$msg?>
		</div>
  		<?php
  		}
  		?>
<div class="panel panel-default">
  <div class="panel-heading"><h4 class="panel-title">加入“<?=$group['name']?>”？</h4></div>
  <div class="panel-body">
  <div class="well"><?=$group['about']?></div>
  <form class="form-horizontal" role="form" method="POST" action="joinGroup.php">
  <div class="form-group">
    <label for="code" class="col-sm-2 control-label">请输入暗号：</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="code" name="code" placeholder="不知道的问群主" required>
      <input type="hidden" id="group_id" name="group_id" value="<?=$group['id']?>"/>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" class="btn btn-danger btn-lg active" >加入</button>
    </div>
  </div>

  </form>
  </div>
</div>
<?php 		
    include 'footer.php';
?>