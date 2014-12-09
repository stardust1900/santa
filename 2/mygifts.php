<?php
session_start();
if(!isset($_SESSION['login_uid'])){
    header("Location:login.php");
}

$user_id = $_SESSION['login_uid'];
$sql = "select a.content,a.memo,b.address,b.name,b.phone from wish a left join address b on a.make_by = b.user_id where take_by=".$user_id;

$mysql = new SaeMysql();
$wishes =  $mysql->getData($sql);
if( $mysql->errno() != 0 ){
     die( "Error:" . $mysql->errmsg() );
}
$mysql->closeDb();

include 'header.php';
?>
<div class="panel panel-default">
  <div class="panel-heading">已领取的心愿</div>
<?php 
if(!empty($wishes)){ 
?>
  <ul class="list-group">
<?php    foreach ($wishes as $wish) {
?>
<li class="list-group-item">
	<p>心愿：<?=$wish['content']?></p>
	<p>悄悄话：<?=$wish['memo']?></p>
	<address>
	  地址：<strong><?=$wish['address']?></strong><br>
	   收件人：<?=$wish['name']?><br>
	  <abbr title="Phone">电话:</abbr><?=$wish['phone']?>
	</address>
</li>
<?php } ?>
 </ul>
<?php
} else{ ?>
	<div class="panel-body">
		<P><h3>你还没有领取心愿</h3></P>
	</div>
</div>
<?php } ?>

<script type="text/javascript">
$().ready(function() {
  $("#home").removeClass("active");
  $("#mygifts").addClass("active");

});
</script>
<?php 		
    include 'footer.php';
?>