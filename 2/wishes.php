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
$sql = "select * from wish where group_id=".$group_id." and make_by <>".$user_id;

$mysql = new SaeMysql();
$wishes =  $mysql->getData($sql);
if( $mysql->errno() != 0 ){
     die( "Error:" . $mysql->errmsg() );
 }

$mysql->closeDb();

include 'header.php';
?>
<div class="panel panel-default">
  <div class="panel-body">
<table class="table">
  <tr>
  	<th>心愿</th>
  	<th>许愿时间</th>
  	<th>状态</th>
  	<th>领取</th>
  </tr>
  <?php
  	if($wishes) {
  		foreach ($wishes as $wish) {
  ?>
<tr>
	<td><?=$wish['content']?></td>
	<td><?=$wish['make_time']?></td>
	<?php if(0==$wish['status']){?>
	<td><span class="label label-danger">待领取</span></td>
	<td><a href="takeWish.php?wid=<?=$wish['id']?>&gid=<?=$group_id?>" class="btn btn-danger active" role="button">领取</a></td>
	<?php }else {?>
	<td><span class="label label-default">已领取</span></td>
	<td><a href="#" class="btn btn-default" role="button">领取</a></td>
	<?php }?>
</tr>
  <?php
  		}
  	}
  ?>
</table>

  </div>
</div>
<?php 		
    include 'footer.php';
?>