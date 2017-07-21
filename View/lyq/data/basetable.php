<?php
header('Content-Type: application/json;charset=UTF-8');

$jqname = $_GET['jqname'];
$region = $_GET['region'];
$gdate = $_GET['gdate'];
$delivery = $_GET['delivery'];
$gdesc = $_GET['gdesc'];
$number = $_GET['number'];
$tdata = $_GET['tdata'];
$name = $_GET['name'];
$tag = $_GET['tag'];
$detailed = $_GET['detailed'];

include('0_config.php'); //包含指定文件的内容在当前位置
$conn = mysqli_connect($db_url, $db_user, $db_pwd, $db_name, $db_port);

//SQL1：设置编码方式
$sql = "SET NAMES UTF8";
mysqli_query($conn, $sql);

//插入数据
$sql = "INSERT INTO ty_basetable VALUES(null, '$jqname', '$region', '$gdate', '$delivery' , '$gdesc','$number','$tdata','$name','$tag','$detailed')";
$result = mysqli_query($conn,$sql);
$cid = mysqli_insert_id($conn);
