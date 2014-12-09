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

$mysql = new SaeMysql();
$sql = "select * from groups where id=".$mysql->escape($group_id);
$group = $mysql->getLine($sql);
if(!$group){
	 header("Location:404.php");
}
$member_sql = "select * from user where id in (select user_id from relation where group_id=".$mysql->escape($group_id).")";
$members =  $mysql->getData($member_sql);

if( $mysql->errno() != 0 )
 {
     die( "Error:" . $mysql->errmsg() );
 }

 $mysql->closeDb();
include 'header.php';
?>

<div class="page-header">
      <h1>谁是我的圣诞老人？<small>许下你的心愿，看看谁会帮你实现</small></h1>
    </div>

    <div class="media">
    <a class="media-left" href="#">
      <img src="<?=$group['icon']?>" alt="...">
    </a>
    <div class="media-body">
      <h4 class="media-heading"><?=$group['name']?></h4>
     <?=$group['about']?>
    </div>
  </div>
<br/>
  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">成员</h3>
  </div>
  <div class="panel-body">
    <p class="lead">
    	<?php
    		if($members){
    			foreach($members as $member){
    				echo $member['nickname']."&nbsp;&nbsp;";
    			}
    		}
		?>
    </p>
  </div>
</div>
<br/>
<br/>
<br/>
<br/>

<p class="text-center">
  <a href="makewish.php?gid=<?=$group['id']?>" class="btn btn-danger btn-lg active" role="button">许下你的心愿</a>
  <a href="wishes.php?gid=<?=$group['id']?>" class="btn btn-danger btn-lg active" role="button">完成小伙伴的心愿</a>
</p>

<?php 		
    include 'footer.php';
?>