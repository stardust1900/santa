<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}

$sql = "select a.content,a.memo,b.name,b.id group_id,a.status,a.make_time from wish a left join groups b on a.group_id = b.id where a.make_by=".$_SESSION['login_uid'];
$mysql = new SaeMysql();
$wishes =  $mysql->getData($sql);

if( $mysql->errno() != 0 )
 {
     die( "Error:" . $mysql->errmsg() );
 }

$mysql->closeDb();
include 'header.php';
?>
<div class="panel panel-default">
  <div class="panel-heading">许下的心愿</div>
  <div class="panel-body">

<table class="table">
  <tr>
  	<th>心愿</th>
  	<th>悄悄话</th>
  	<th>小组</th>
  	<th>状态</th>
  	<th>许愿时间</th>
  </tr>
  <?php
  	if($wishes) {
  		foreach ($wishes as $wish) {
  ?>
<tr>
	<td><?=$wish['content']?></td>
	<td><?=$wish['memo']?></td>
	<td><a href="group.php?gid=<?=$wish['group_id']?>"><?=$wish['name']?></a></td>
	<td>
    <?php if(0==$wish['status']) {?>
    <span class="label label-danger">待领取</span>
    <?php }else{ ?>
    <span class="label label-default">已被领取</span>
    <?php }?>
  </td>
	<td><?=$wish['make_time']?></td>

</tr>
  <?php
  		}
  	}
  ?>
</table>
  </div>
</div>
<script type="text/javascript">
$().ready(function() {
  $("#home").removeClass("active");
  $("#mywishes").addClass("active");

});
</script>
<?php 		
    include 'footer.php';
?>