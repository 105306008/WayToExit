<?php
session_start();

if(!isset($_SESSION['username'])){
//    echo '<p style="font-size:25px">操作錯誤！</p>';
    //return;
}else{
//    echo '<p style="font-size:25px">登出中</p>';
    session_destroy();
}

echo '<meta http-equiv=REFRESH CONTENT=0;url=Title.html>';

