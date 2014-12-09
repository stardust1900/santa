<?php

  define('KEY', '0717897e58e2492215469c7b0aa6db66');
  define('SECRET', '24631e1141b6ac30');
  define('REDIRECT', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'douban_callback.php');

  define('SCOPE', 'douban_basic_common,book_basic_r,book_basic_w,shuo_basic_r,shuo_basic_w');
  define('STATE', 'Something');

  define( "WB_AKEY" , '2113224735' );
  define( "WB_SKEY" , 'f89edfaf85b1b0b7f319041ead7ee1db');
  define( "WB_CALLBACK_URL" , 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'weibo_callback.php');

  define( "DOUBAN_PEOPLE_URL" , 'http://www.douban.com/people/' );
