<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}
$user_id = $_SESSION['login_uid'];
$mysql = new SaeMysql();
$sql = "select * from groups where id in (select group_id from relation where user_id=".$user_id.")";
$groups =  $mysql->getData($sql);

if( $mysql->errno() != 0 )
 {
     die( "Error:" . $mysql->errmsg() );
 }
$mysql->closeDb();
include 'header.php';
?>
<div class="panel panel-default">
  <div class="panel-heading">加入的小组</div>
  <div class="panel-body">
<?php  if(!empty($groups)) { ?>
<table class="table">
	<?php  foreach($groups as $group) {
	?>
	<tr>
		<td><a href="entergroup.php?gid=<?=$group['id']?>"><img src="<?=$group['icon']?>" alt="..." class="img-circle"></a></td>
		<td><a href="entergroup.php?gid=<?=$group['id']?>"><?=$group['name']?></a></td>
		<td><?=$group['about']?></td>
	</tr>
	<?php } ?>
</table>
<?php  } else { ?>
<div class="alert alert-danger" role="alert">你没有加入任何小组</div>
<?php } ?>
  </div>
</div>

<script type="text/javascript">
$().ready(function() {
	$("#home").removeClass("active");
	$("#mygroup").addClass("active");

});
</script>
<?php 		
    include 'footer.php';
?>