<?php
session_start();
include 'header.php';
?>

<div class="jumbotron">
  <h1>谁是我的圣诞老人？</h1>
  <p class="text-danger">许下你的心愿，看看谁会帮你实现</p>
  <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p> -->
</div>
<div class="panel panel-default">
  <div class="panel-body">
<div class="row">
<div class="col-xs-6 col-md-3">
  <div class="text-center">
      <a href="entergroup.php?gid=101"><img src="images/santa.jpg" alt="..." class="img-circle"></a>
      <div class="caption">
        <a href="entergroup.php?gid=101"><h4>打劫圣诞老人</h4></a>
      </div>
  </div>
  </div>

  <div class="col-xs-6 col-md-3">
  <div class="text-center">
      <a href="entergroup.php?gid=102"><img src="images/reading.jpg" alt="..." class="img-circle"></a>
      <div class="caption">
        <a href="entergroup.php?gid=102"><h4>一分钟读书会</h4></a>
      </div>
  </div>
  </div>

  <div class="col-xs-6 col-md-3">
  <div class="text-center">
      <a href="entergroup.php?gid=103"><img src="images/yidao.jpg" alt="..." class="img-circle"></a>
      <div class="caption">
        <a href="entergroup.php?gid=103"><h4>王一刀的朋友们</h4></a>
      </div>
  </div>
  </div>

  <div class="col-xs-6 col-md-3">
  <div class="text-center">
      <a href="entergroup.php?gid=104"><img src="images/moon.jpg" alt="..." class="img-circle"></a>
      <div class="caption">
        <a href="entergroup.php?gid=104"><h4>老少女联盟</h4></a>
      </div>
  </div>
  </div>
</div>

  </div>
</div
<?php 		
    include 'footer.php';
?>