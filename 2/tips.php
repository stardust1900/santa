<?php
session_start();
if(isset($_SESSION['info'])){
	if("wishmade" == $_SESSION['info']) {
		$msg="已经在该小组许过愿了，不要太贪心哦～";
	}else if("wishtoken" == $_SESSION['info']) {
		$msg="已经在该小组领取过愿望了，给别人留点机会吧～";
	}
}
include 'header.php';
?>
<div class="alert alert-danger" role="alert"><?=$msg?></div>
<?php 		
    include 'footer.php';
?>