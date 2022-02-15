<?php 
include_once "config.class.php";
include_once "line.class.php";

// ลองเติม comment ตรงนี้ดูนะคับ
$Line = new Line();
$message = "Hello Notify!";
echo $Line->send_notify($message);