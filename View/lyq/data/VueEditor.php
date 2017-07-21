<?php
header('Content-Type: application/json;charset=UTF-8');

$number = $_GET['number'];
$region = $_GET['region'];
$kdate = $_GET['kdate'];
$resource = $_GET['resource'];
$adesc = $_GET['adesc'];



include('0_config.php'); //包含指定文件的内容在当前位置
$conn = mysqli_connect($db_url, $db_user, $db_pwd, $db_name, $db_port);

//SQL1：设置编码方式
$sql = "SET NAMES UTF8";
mysqli_query($conn, $sql);

//插入数据
$sql = "INSERT INTO ty_payment VALUES(null, '$number', '$region', '$kdate'  , '$resource', '$adesc')";
$result = mysqli_query($conn,$sql);
$cid = mysqli_insert_id($conn);
