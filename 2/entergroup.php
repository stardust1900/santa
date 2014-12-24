<?php
session_start();
if(!isset($_GET['gid'])){
    header("Location:index.php");
}
$group_id = $_GET['gid'];

$mysql = new SaeMysql();
$sql = "select * from groups where id=".$mysql->escape($group_id);
$group = $mysql->getLine($sql);
if(!$group){
	 header("Location:404.php");
}

$joined_groups = $_SESSION['joined_groups'];
if(strstr($joined_groups.",",",".$group_id.",")){
   header("Location:group.php?gid=".$group_id);
}

$member_sql = "select * from user where id in (select user_id from relation where group_id=".$mysql->escape($group_id).")";
$members =  $mysql->getData($member_sql);

if(isset($_SESSION['info'])){
	if('wrongcode' == $_SESSION['info']) {
		$msg = "暗号不对！";
		unset($_SESSION['info']);
	}
}

$wish_sql = "select * from wish where group_id=".$group_id;

$mysql = new SaeMysql();
$wishes =  $mysql->getData($wish_sql);

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

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">心愿</h3>
  </div>
  <div class="panel-body">
<table class="table">
  <tr>
    <th>心愿</th>
    <th>许愿时间</th>
    <th>状态</th>
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
  <?php }else {?>
  <td><span class="label label-default">已领取</span></td>
  <?php }?>
</tr>
  <?php
      }
    }else{
      echo "<tr><td colspan='3'>还没有人许愿呢<td></tr>";
    }
  ?>
</table>
  </div>
</div>

<?php 		
    include 'footer.php';
?>